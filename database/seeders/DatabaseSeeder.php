<?php

namespace Database\Seeders;

use App\Models\Court;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $customers = collect([
            ['full_name' => 'Carlos Hernández', 'phone' => '7012-4567', 'email' => 'carlos@example.com'],
            ['full_name' => 'María López', 'phone' => '7220-1001', 'email' => 'maria@example.com'],
            ['full_name' => 'Kevin Morales', 'phone' => '7999-2424', 'email' => 'kevin@example.com'],
            ['full_name' => 'Andrea Escobar', 'phone' => '7555-8899', 'email' => 'andrea@example.com'],
        ])->map(fn ($data) => Customer::create($data));

        $courts = collect([
            ['name' => 'Cancha Norte', 'sport_type' => 'Fútbol 5', 'hourly_rate' => 25.00],
            ['name' => 'Cancha Sur', 'sport_type' => 'Fútbol 7', 'hourly_rate' => 35.00],
            ['name' => 'Cancha Techada', 'sport_type' => 'Baloncesto', 'hourly_rate' => 20.00],
        ])->map(fn ($data) => Court::create($data));

        $services = collect([
            ['name' => 'Árbitro', 'price' => 12.00, 'description' => 'Servicio de arbitraje por partido.'],
            ['name' => 'Iluminación nocturna', 'price' => 8.00, 'description' => 'Uso de luminarias durante reserva nocturna.'],
            ['name' => 'Balón oficial', 'price' => 3.00, 'description' => 'Alquiler de balón durante la reserva.'],
            ['name' => 'Hidratación básica', 'price' => 6.00, 'description' => 'Paquete de agua para el equipo.'],
        ])->map(fn ($data) => Service::create($data));

        $reservationOne = Reservation::create([
            'customer_id' => $customers[0]->id,
            'court_id' => $courts[0]->id,
            'reservation_date' => now()->addDays(2)->toDateString(),
            'start_time' => '18:00',
            'end_time' => '20:00',
            'status' => 'Confirmada',
            'notes' => 'Partido amistoso entre compañeros de trabajo.',
            'total' => 70.00,
        ]);
        $reservationOne->services()->sync([$services[0]->id, $services[1]->id]);

        $reservationTwo = Reservation::create([
            'customer_id' => $customers[1]->id,
            'court_id' => $courts[2]->id,
            'reservation_date' => now()->addDays(5)->toDateString(),
            'start_time' => '15:00',
            'end_time' => '17:00',
            'status' => 'Pendiente',
            'notes' => 'Reserva para entrenamiento juvenil.',
            'total' => 43.00,
        ]);
        $reservationTwo->services()->sync([$services[2]->id]);
    }
}
