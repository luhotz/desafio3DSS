<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'customers' => Customer::count(),
            'courts' => Court::count(),
            'reservations' => Reservation::count(),
            'confirmed' => Reservation::where('status', 'Confirmada')->count(),
            'monthly_income' => Reservation::whereMonth('reservation_date', now()->month)
                ->whereYear('reservation_date', now()->year)
                ->sum('total'),
        ];

        // Ejemplo de Query Builder solicitado en el desafio.
        $reservationsByStatus = DB::table('reservations')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $latestReservations = Reservation::with(['customer', 'court'])
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('stats', 'reservationsByStatus', 'latestReservations'));
    }
}
