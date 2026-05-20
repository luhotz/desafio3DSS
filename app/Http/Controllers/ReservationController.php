<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Court;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $reservations = Reservation::query()
            ->with(['customer', 'court', 'services'])
            ->when($search, function ($query, $search) {
                $query->whereHas('customer', function ($customerQuery) use ($search) {
                    $customerQuery->where('full_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                })->orWhereHas('court', function ($courtQuery) use ($search) {
                    $courtQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('sport_type', 'like', "%{$search}%");
                });
            })
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderByDesc('reservation_date')
            ->orderByDesc('start_time')
            ->paginate(8)
            ->withQueryString();

        return view('reservations.index', compact('reservations', 'search', 'status'));
    }

    public function create()
    {
        return view('reservations.create', [
            'reservation' => new Reservation(),
            'customers' => Customer::where('status', 'Activo')->orderBy('full_name')->get(),
            'courts' => Court::where('is_active', true)->orderBy('name')->get(),
            'services' => Service::where('is_active', true)->orderBy('name')->get(),
            'selectedServices' => [],
            'statuses' => $this->statuses(),
        ]);
    }

    public function store(StoreReservationRequest $request)
    {
        $data = $request->validated();
        $services = $data['services'] ?? [];
        unset($data['services']);

        $data['total'] = $this->calculateTotal($data, $services);
        $reservation = Reservation::create($data);
        $reservation->services()->sync($services);

        return redirect()
            ->route('reservas.show', $reservation)
            ->with('success', 'Reserva creada correctamente.');
    }

    public function show(Reservation $reserva)
    {
        $reserva->load(['customer', 'court', 'services']);
        return view('reservations.show', ['reservation' => $reserva]);
    }

    public function edit(Reservation $reserva)
    {
        $reserva->load('services');

        return view('reservations.edit', [
            'reservation' => $reserva,
            'customers' => Customer::where('status', 'Activo')->orderBy('full_name')->get(),
            'courts' => Court::where('is_active', true)->orderBy('name')->get(),
            'services' => Service::where('is_active', true)->orderBy('name')->get(),
            'selectedServices' => $reserva->services->pluck('id')->toArray(),
            'statuses' => $this->statuses(),
        ]);
    }

    public function update(UpdateReservationRequest $request, Reservation $reserva)
    {
        $data = $request->validated();
        $services = $data['services'] ?? [];
        unset($data['services']);

        $data['total'] = $this->calculateTotal($data, $services);
        $reserva->update($data);
        $reserva->services()->sync($services);

        return redirect()
            ->route('reservas.show', $reserva)
            ->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy(Reservation $reserva)
    {
        $reserva->services()->detach();
        $reserva->delete();

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva eliminada correctamente.');
    }

    private function statuses(): array
    {
        return ['Pendiente', 'Confirmada', 'Cancelada', 'Finalizada'];
    }

    private function calculateTotal(array $data, array $services): float
    {
        $court = Court::findOrFail($data['court_id']);

        $start = strtotime($data['start_time']);
        $end = strtotime($data['end_time']);
        $hours = max(($end - $start) / 3600, 1);

        $serviceTotal = Service::whereIn('id', $services)->sum('price');

        return round(($court->hourly_rate * $hours) + $serviceTotal, 2);
    }
}
