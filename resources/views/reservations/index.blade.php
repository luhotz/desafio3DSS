@extends('layouts.app')

@section('title', 'Listado de reservas')

@section('content')
    <section class="card">
        <div class="header-row">
            <div>
                <h1>Listado de reservas</h1>
                <p class="muted">Consulta, filtra, visualiza, edita o elimina reservas registradas.</p>
            </div>
            <a href="{{ route('reservas.create') }}" class="btn success">Nueva reserva</a>
        </div>

        <form method="GET" action="{{ route('reservas.index') }}" class="filter-form" style="margin-top: 16px;">
            <div>
                <label for="search">Buscar por cliente, teléfono, cancha o deporte</label>
                <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Ejemplo: Carlos, Norte, Fútbol">
            </div>
            <div>
                <label for="status">Estado</label>
                <select name="status" id="status">
                    <option value="">Todos</option>
                    @foreach (['Pendiente', 'Confirmada', 'Cancelada', 'Finalizada'] as $item)
                        <option value="{{ $item }}" @selected($status === $item)>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn" type="submit">Filtrar</button>
        </form>
    </section>

    <section class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Cancha</th>
                    <th>Fecha y hora</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr>
                        <td>#{{ $reservation->id }}</td>
                        <td>{{ $reservation->customer->full_name }}<br><span class="muted">{{ $reservation->customer->phone }}</span></td>
                        <td>{{ $reservation->court->name }}<br><span class="muted">{{ $reservation->court->sport_type }}</span></td>
                        <td>{{ $reservation->reservation_date->format('d/m/Y') }}<br>{{ substr($reservation->start_time, 0, 5) }} - {{ substr($reservation->end_time, 0, 5) }}</td>
                        <td><span class="badge {{ strtolower($reservation->status) }}">{{ $reservation->status }}</span></td>
                        <td>${{ number_format($reservation->total, 2) }}</td>
                        <td>
                            <a class="btn secondary" href="{{ route('reservas.show', $reservation) }}">Ver</a>
                            <a class="btn warning" href="{{ route('reservas.edit', $reservation) }}">Editar</a>
                            <form action="{{ route('reservas.destroy', $reservation) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Desea eliminar esta reserva?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No se encontraron reservas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $reservations->links() }}</div>
    </section>
@endsection
