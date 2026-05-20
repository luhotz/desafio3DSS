@extends('layouts.app')

@section('title', 'Editar reserva')

@section('content')
    <section class="card">
        <h1>Editar reserva #{{ $reservation->id }}</h1>
        <p class="muted">Actualice la información y guarde los cambios.</p>
    </section>

    <section class="card">
        <form action="{{ route('reservas.update', $reservation) }}" method="POST">
            @csrf
            @method('PUT')
            @include('reservations.partials.form')
            <div class="actions-row" style="margin-top: 18px;">
                <a href="{{ route('reservas.show', $reservation) }}" class="btn secondary">Cancelar</a>
                <button type="submit" class="btn success">Actualizar reserva</button>
            </div>
        </form>
    </section>
@endsection
