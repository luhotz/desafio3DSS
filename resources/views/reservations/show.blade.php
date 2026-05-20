@extends('layouts.app')

@section('title', 'Detalle de reserva')

@section('content')
    <section class="card">
        <div class="header-row">
            <div>
                <h1>Detalle de reserva #{{ $reservation->id }}</h1>
                <p class="muted">Información completa de la reserva registrada.</p>
            </div>
            <div>
                <a href="{{ route('reservas.edit', $reservation) }}" class="btn warning">Editar</a>
                <a href="{{ route('reservas.index') }}" class="btn secondary">Volver</a>
            </div>
        </div>
    </section>

    <section class="card detail-grid">
        <div class="detail-item">
            <strong>Cliente</strong>
            <p>{{ $reservation->customer->full_name }}</p>
            <span class="muted">{{ $reservation->customer->phone }} | {{ $reservation->customer->email ?? 'Sin correo' }}</span>
        </div>
        <div class="detail-item">
            <strong>Cancha</strong>
            <p>{{ $reservation->court->name }}</p>
            <span class="muted">{{ $reservation->court->sport_type }} | ${{ number_format($reservation->court->hourly_rate, 2) }} por hora</span>
        </div>
        <div class="detail-item">
            <strong>Fecha y horario</strong>
            <p>{{ $reservation->reservation_date->format('d/m/Y') }}</p>
            <span class="muted">{{ substr($reservation->start_time, 0, 5) }} - {{ substr($reservation->end_time, 0, 5) }}</span>
        </div>
        <div class="detail-item">
            <strong>Estado y total</strong>
            <p><span class="badge {{ strtolower($reservation->status) }}">{{ $reservation->status }}</span></p>
            <span class="muted">Total: ${{ number_format($reservation->total, 2) }}</span>
        </div>
    </section>

    <section class="card">
        <h2>Servicios adicionales</h2>
        @forelse ($reservation->services as $service)
            <span class="badge">{{ $service->name }} - ${{ number_format($service->price, 2) }}</span>
        @empty
            <p class="muted">La reserva no tiene servicios adicionales.</p>
        @endforelse
    </section>

    <section class="card">
        <h2>Notas</h2>
        <p>{{ $reservation->notes ?? 'Sin notas registradas.' }}</p>
    </section>
@endsection
