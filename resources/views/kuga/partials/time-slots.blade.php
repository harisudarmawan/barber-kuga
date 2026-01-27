@forelse ($timeSlots as $slot)
    @php
        $time = \Carbon\Carbon::parse($slot->start_time)->format('H:i');
        $isBooked = in_array($time, $bookedTimes);
    @endphp

    <label class="time-slot {{ $isBooked ? 'disabled' : '' }}">
        <input type="radio" name="bookingTime" value="{{ $time }}" {{ $isBooked ? 'disabled' : '' }}>
        <span>{{ $time }}</span>
    </label>
@empty
    <p>Jam belum tersedia.</p>
@endforelse