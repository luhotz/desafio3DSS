@extends('layouts.app')

@section('title', 'Crear reserva')

@section('content')
    <section class="card">
        <h1>Crear nueva reserva</h1>
        <p class="muted">Complete el formulario. El total se calcula automáticamente en el controlador usando la tarifa de la cancha y los servicios seleccionados.</p>
    </section>

    <section class="card">
        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf
            @include('reservations.partials.form')
            <div class="actions-row" style="margin-top: 18px;">
                <a href="{{ route('reservas.index') }}" class="btn secondary">Cancelar</a>
                <button type="submit" class="btn success">Guardar reserva</button>
            </div>
        </form>
    </section>
@endsection
