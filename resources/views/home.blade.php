@extends('layouts.app')

@section('title', 'Inicio | CanchApp Reservas')

@section('content')
    <section class="card">
        <div class="header-row">
            <div>
                <h1>Sistema de Reservas de Canchas Deportivas</h1>
                <p class="muted">Aplicación web desarrollada con Laravel MVC, Blade, Eloquent ORM, migraciones y base de datos MySQL/MariaDB.</p>
            </div>
            <a href="{{ route('reservas.create') }}" class="btn success">Crear reserva</a>
        </div>
    </section>

    <section class="grid">
        <div class="stat"><strong>{{ $stats['customers'] }}</strong><span>Clientes registrados</span></div>
        <div class="stat"><strong>{{ $stats['courts'] }}</strong><span>Canchas disponibles</span></div>
        <div class="stat"><strong>{{ $stats['reservations'] }}</strong><span>Reservas totales</span></div>
        <div class="stat"><strong>${{ number_format($stats['monthly_income'], 2) }}</strong><span>Ingresos del mes</span></div>
    </section>

    <section class="card">
        <h2>Reservas por estado</h2>
        <table>
            <thead>
                <tr>
                    <th>Estado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservationsByStatus as $item)
                    <tr>
                        <td><span class="badge {{ strtolower($item->status) }}">{{ $item->status }}</span></td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2">Aún no hay datos.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <section class="card">
        <div class="header-row">
            <h2>Últimas reservas</h2>
            <a href="{{ route('reservas.index') }}" class="btn secondary">Ver listado</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Cancha</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestReservations as $reservation)
                    <tr>
                        <td>{{ $reservation->customer->full_name }}</td>
                        <td>{{ $reservation->court->name }}</td>
                        <td>{{ $reservation->reservation_date->format('d/m/Y') }} {{ substr($reservation->start_time, 0, 5) }}</td>
                        <td><span class="badge {{ strtolower($reservation->status) }}">{{ $reservation->status }}</span></td>
                        <td>${{ number_format($reservation->total, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No hay reservas registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
