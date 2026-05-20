<div class="form-grid">
    <div>
        <label for="customer_id">Cliente</label>
        <select name="customer_id" id="customer_id" required>
            <option value="">Seleccione un cliente</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $reservation->customer_id) == $customer->id)>
                    {{ $customer->full_name }} - {{ $customer->phone }}
                </option>
            @endforeach
        </select>
        @error('customer_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="court_id">Cancha</label>
        <select name="court_id" id="court_id" required>
            <option value="">Seleccione una cancha</option>
            @foreach ($courts as $court)
                <option value="{{ $court->id }}" @selected(old('court_id', $reservation->court_id) == $court->id)>
                    {{ $court->name }} - {{ $court->sport_type }} (${{ number_format($court->hourly_rate, 2) }}/hora)
                </option>
            @endforeach
        </select>
        @error('court_id') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="reservation_date">Fecha de reserva</label>
        <input type="date" name="reservation_date" id="reservation_date" value="{{ old('reservation_date', optional($reservation->reservation_date)->format('Y-m-d')) }}" required>
        @error('reservation_date') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="status">Estado</label>
        <select name="status" id="status" required>
            @foreach ($statuses as $item)
                <option value="{{ $item }}" @selected(old('status', $reservation->status ?? 'Pendiente') === $item)>{{ $item }}</option>
            @endforeach
        </select>
        @error('status') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="start_time">Hora inicial</label>
        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $reservation->start_time ? substr($reservation->start_time, 0, 5) : '') }}" required>
        @error('start_time') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="end_time">Hora final</label>
        <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $reservation->end_time ? substr($reservation->end_time, 0, 5) : '') }}" required>
        @error('end_time') <div class="error">{{ $message }}</div> @enderror
    </div>
</div>

<div style="margin-top: 18px;">
    <label>Servicios adicionales</label>
    <div class="checkbox-group">
        @foreach ($services as $service)
            @php
                $checkedServices = old('services', $selectedServices);
            @endphp
            <label class="checkbox-card">
                <input type="checkbox" name="services[]" value="{{ $service->id }}" @checked(in_array($service->id, $checkedServices ?? []))>
                {{ $service->name }} - ${{ number_format($service->price, 2) }}
                <br><span class="muted">{{ $service->description }}</span>
            </label>
        @endforeach
    </div>
    @error('services') <div class="error">{{ $message }}</div> @enderror
    @error('services.*') <div class="error">{{ $message }}</div> @enderror
</div>

<div style="margin-top: 18px;">
    <label for="notes">Notas</label>
    <textarea name="notes" id="notes" placeholder="Ejemplo: Reserva para torneo interno, requiere puntualidad, etc.">{{ old('notes', $reservation->notes) }}</textarea>
    @error('notes') <div class="error">{{ $message }}</div> @enderror
</div>
