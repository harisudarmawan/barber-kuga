@extends('kuga.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">

    <section class="booking-hero hero">
        <div class="hero-content">
            <p class="hero-subtitle">Reservasi Online</p>
            <h1 class="hero-title" style="font-size: 3.5rem;">Booking Sekarang</h1>
            <p class="hero-description">
                Pesan jadwal potong rambut Anda dengan mudah dan cepat. Pilih layanan, barber favorit, dan waktu yang
                sesuai.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="booking-container">
            {{-- Error Validation Message --}}
            @if ($errors->any())
                <div class="booking-notes" style="background: rgba(255, 99, 71, 0.1); border-left-color: #ff6347;">
                    <h4 style="color: #ff6347;">⚠️ Perhatian</h4>
                    <ul style="color: var(--light-text);">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="booking-notes">
                <h4>📌 Informasi Penting</h4>
                <ul>
                    <li>Harap datang 5-10 menit sebelum waktu yang dijadwalkan</li>
                    <li>Saat waktu booking sudah tiba dan Anda belum datang, maka DP booking hangus</li>
                    <li>Konfirmasi booking akan dikirim via WhatsApp</li>
                </ul>
            </div>

            <div class="booking-form-wrapper fade-in">
                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-section">
                        <h3>1️⃣ Informasi Pribadi</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fullName">Nama Lengkap *</label>
                                <input type="text" id="fullName" name="fullName" required
                                    placeholder="Masukkan nama lengkap" class="form-control" value="{{ old('fullName') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon *</label>
                                <input type="tel" id="phone" name="phone" required placeholder="08xx-xxxx-xxxx"
                                    class="form-control" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: var(--spacing-md);">
                            <label for="email">Email (Opsional)</label>
                            <input type="email" id="email" name="email" placeholder="email@example.com" class="form-control"
                                value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-section">
                    <h3>2️⃣ Pilih Layanan</h3>

                    <div class="service-options">
                        @foreach ($services as $service)
                            <label class="option-card {{ old('service_id') == $service->id ? 'selected' : '' }}">

                                <input
                                    type="radio"
                                    name="service_id"
                                    value="{{ $service->id }}"
                                    data-price="{{ $service->price }}"
                                    data-duration="{{ $service->duration }}"
                                    {{ old('service_id') == $service->id ? 'checked' : '' }}
                                    required
                                >

                                <div class="option-icon">{{ $service->emoji }}</div>
                                <div class="option-title">{{ $service->name }}</div>
                                <div class="option-duration">⏱️ {{ $service->duration }} menit</div>
                                <div class="option-price">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>


                    <div class="form-section">
                        <h3>3️⃣ Pilih Barber</h3>
                        <div class="barber-options">
                            @foreach ($barbers as $barber)
                                 <label class="option-card {{ old('barber') == $barber->id ? 'selected' : '' }}">
                                <input type="radio" name="barber" value="{{ $barber->id }}" required {{ old('barber') == $barber->id ? 'checked' : '' }}>
                                <div class="barber-card">
                                    <div class="barber-avatar">{{ $barber->avatar }}</div>
                                    <div class="option-title">{{ $barber->name }}</div>
                                    <div class="option-duration">{{ $barber->status }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bookingDate">Tanggal *</label>
                        <input
                            type="date"
                            id="bookingDate"
                            name="bookingDate"
                            class="form-control"
                            min="{{ now()->toDateString() }}"
                            value="{{ old('bookingDate') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label>Waktu *</label>
                        <div
                            id="timeSlotsGrid"
                            class="time-slots-grid"
                            data-url="{{ route('booking.time-slots') }}"
                        >
                        </div>


                    </div>


                    <div class="form-section">
                        <h3>5️⃣ Catatan Tambahan (Opsional)</h3>
                        <div class="form-group">
                            <label for="notes">Catatan untuk Barber</label>
                            <textarea id="notes" name="notes" class="form-control"
                                placeholder="Contoh: Saya ingin model rambut seperti...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>6️⃣ Metode Pembayaran (DP 50%)</h3>
                        <p style="margin-bottom: var(--spacing-md); font-size: 0.95rem; color: var(--gray-text);">
                            Silakan pilih metode untuk pembayaran DP sebesar 50%.
                        </p>

                        <div class="service-options">
                            <label class="option-card {{ old('payment') == 'bca' ? 'selected' : '' }}">
                                <input type="radio" name="payment" value="bca" required {{ old('payment') == 'bca' ? 'checked' : '' }}>
                                <div class="option-icon">🏦</div>
                                <div class="option-title">Transfer BCA</div>
                                <div class="option-duration">Nomor Rekening:</div>
                                <div class="option-price" style="font-size: 0.9rem;">123-456-7890</div>
                            </label>
                            <label class="option-card {{ old('payment') == 'mandiri' ? 'selected' : '' }}">
                                <input type="radio" name="payment" value="mandiri" {{ old('payment') == 'mandiri' ? 'checked' : '' }}>
                                <div class="option-icon">🏦</div>
                                <div class="option-title">Transfer Mandiri</div>
                                <div class="option-duration">Nomor Rekening:</div>
                                <div class="option-price" style="font-size: 0.9rem;">987-654-3210</div>
                            </label>
                            <label class="option-card {{ old('payment') == 'bni' ? 'selected' : '' }}">
                                <input type="radio" name="payment" value="bni" {{ old('payment') == 'bni' ? 'checked' : '' }}>
                                <div class="option-icon">📱</div>
                                <div class="option-title">Transfer BNI</div>
                                <div class="option-duration">Nomor Rekening:</div>
                                <div class="option-price" style="font-size: 0.9rem;">123-456-7890</div>
                            </label>
                            <label class="option-card {{ old('payment') == 'dana' ? 'selected' : '' }}">
                                <input type="radio" name="payment" value="dana" {{ old('payment') == 'dana' ? 'checked' : '' }}>
                                <div class="option-icon">📱</div>
                                <div class="option-title">DANA</div>
                                <div class="option-duration">Nomor HP:</div>
                                <div class="option-price" style="font-size: 0.9rem;">0812-5662-6112</div>
                            </label>

                            <label class="option-card {{ old('payment') == 'qris' ? 'selected' : '' }}">
                                <input type="radio" name="payment" value="qris" {{ old('payment') == 'qris' ? 'checked' : '' }}>
                                <div class="option-icon">📸</div>
                                <div class="option-title">QRIS</div>
                                <div class="option-duration">Semua E-Wallet</div>
                                <div class="option-price" style="font-size: 0.9rem;">Scan Barcode</div>
                            </label>
                        </div>

                        <div id="qris-display-area" style="display: none; margin-top: 2rem; text-align: center;">
                            <div
                                style="background: var(--bg-white); padding: 1.5rem; border: 2px dashed var(--primary-color); border-radius: var(--radius-lg); display: inline-block;">
                                <p style="margin-bottom: 1rem; font-weight: 600; color: var(--light-text);">Scan QRIS untuk
                                    Pembayaran DP</p>
                                <img src="{{ asset('images/qr-code.svg') }}" alt="QRIS Barcode"
                                    style="max-width: 200px; width: 100%; height: auto; display: block; margin: 0 auto;">
                            </div>
                        </div>
                    </div>

                    <div class="form-section" style="margin-top: 2rem;">
        <h3>7️⃣ Upload Bukti Pembayaran</h3>
        <p style="margin-bottom: var(--spacing-md); font-size: 0.95rem; color: var(--gray-text);">
            Harap transfer sesuai nominal DP, lalu upload bukti screenshot di sini.
        </p>

        <div class="form-group">
            <label for="payment_proof">Foto Bukti Transfer *</label>
            <input type="file" id="payment_proof" name="payment_proof" class="form-control"
                   accept="image/*" required style="padding: 10px; height: auto;">
            <small style="color: var(--gray-text); display: block; margin-top: 5px;">
                Format: JPG, PNG, JPEG. Maksimal: 2MB.
            </small>

            {{-- Error feedback untuk file --}}
            @error('payment_proof')
                <div style="color: #ff6347; font-size: 0.9rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

                    <div class="booking-summary">
                        <h3>📋 Ringkasan Booking</h3>
                        <div class="summary-item">
                            <span>Layanan:</span> <strong id="summaryService">-</strong>
                        </div>
                        <div class="summary-item">
                            <span>Barber:</span> <strong id="summaryBarber">-</strong>
                        </div>
                        <div class="summary-item">
                            <span>Tanggal:</span> <strong id="summaryDate">-</strong>
                        </div>
                        <div class="summary-item">
                            <span>Waktu:</span> <strong id="summaryTime">-</strong>
                        </div>
                        <div class="summary-item">
                            <span>Durasi:</span> <strong id="summaryDuration">-</strong>
                        </div>
                        <div class="summary-item">
                            <span>Metode:</span> <strong id="summaryPayment">-</strong>
                        </div>
                        <div class="summary-item summary-total">
                            <span>Total Harga:</span> <span id="summaryTotal">Rp 0</span>
                        </div>
                        <div
                            style="background: rgba(102, 126, 234, 0.15); padding: var(--spacing-sm); border-radius: var(--radius-sm); margin-top: var(--spacing-sm); text-align: right;">
                            <span style="font-weight: 600; color: var(--accent-color);">DP 50% yang harus dibayar:</span>
                            <br>
                            <span id="summaryDP" style="font-size: 1.2rem; font-weight: 800; color: var(--accent-color);">Rp
                                0</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; margin-top: var(--spacing-md); font-size: 1.2rem; padding: 1.2rem;">
                        Konfirmasi Booking 🎉
                    </button>
                </form>
            </div>
        </div>
    </section>

    @if(session('success'))
<div id="successOverlay" class="success-overlay" style="display:flex;">
    <div class="success-card booking-form-wrapper">

        {{-- ICON --}}
        <div class="success-icon pending">⏳</div>

        {{-- TITLE --}}
        <h2 style="color: var(--light-text); margin-top:.5rem;">
            Booking Berhasil Dikirim
        </h2>

        {{-- DESC --}}
        <p style="color: var(--gray-text); text-align:center;">
            Bukti pembayaran Anda telah berhasil dikirim dan
            sedang menunggu verifikasi dari admin.
        </p>

        {{-- BOOKING CODE --}}
        <div class="booking-id-tag">
            Kode Booking:
            <span>{{ session('booking_code') }}</span>
        </div>

        {{-- PAYMENT INFO --}}
        <div class="payment-info-card">
            <p style="color: var(--light-text); font-size:.9rem;">
                Metode Pembayaran
            </p>

            <h3 style="color: var(--accent-color); margin:.3rem 0;">
                {{ strtoupper(session('payment_method')) }}
            </h3>

            <p style="color: var(--gray-text); font-size:.85rem;">
                Status: <strong>Menunggu Verifikasi</strong>
            </p>
        </div>

        {{-- NOTE --}}
        <div style="margin-top:1rem; font-size:.85rem; color:var(--gray-text); text-align:center;">
            ⏱️ Proses verifikasi biasanya memakan waktu beberapa menit.
            Anda akan dihubungi jika diperlukan.
        </div>

        {{-- ACTION --}}
        <a href="{{ route('home') }}"
           class="btn btn-primary"
           style="margin-top:1.5rem;">
            Kembali ke Beranda
        </a>

    </div>
</div>
@endif


    <script src="{{ asset('js/booking.js') }}"></script>
@endsection
