@extends('kuga.layouts.app')

@section('content')

    <section class="hero" id="home">
        <div class="hero-content">
            <span class="hero-badge">Premium Experience at KUGA Barbershop</span>
            <h1 class="hero-title">Life Begins <br><span style="color: var(--gold-accent);">After Haircut</span></h1>
            <p class="hero-description">
                Transformasi gaya Anda dengan layanan barbershop premium yang teliti dan berkelas.
                Temukan versi terbaik diri Anda di tangan para expert kami.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('booking') }}" class="btn btn-book">Booking Sekarang <span class="arrow">→</span></a>
                <a href="#layanan" class="btn btn-view">Lihat Layanan <span class="arrow">→</span></a>
            </div>
        </div>

        <div class="scroll-indicator">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
        </div>
    </section>

    <section class="location-map" id="lokasi">
        <div class="container location-grid">
            <div class="map-column fade-in">
                <div class="map-wrapper">
                    <iframe src="https://www.google.com/maps?q=KUGA+Barber+Jl.+Melanti+No.23+Palaran+Samarinda&output=embed"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="map-info">
                        <p>📍 Jl. Melanti RT. 37 No. 23, Palaran</p>
                    </div>
                </div>
            </div>
            <div class="review-column fade-in">
                <div class="review-card">
                    <div class="review-stars">⭐⭐⭐⭐⭐</div>
                    <h3>Customer Experience</h3>
                    <p class="review-text">"Potongan rambut paling detail dan rapi di Samarinda. Pelayanan ramah, tempat
                        nyaman, dan sangat profesional!"</p>
                    <div class="review-metrics">
                        <div class="metric-item">
                            <span class="metric-value">5.0</span>
                            <span class="metric-label">Rating</span>
                        </div>
                        <div class="metric-item">
                            <span class="metric-value">200+</span>
                            <span class="metric-label">Review</span>
                        </div>
                    </div>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-review">Baca Semua Ulasan →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about section" id="tentang">
        <div class="container">
            <div class="about-content">
                <div class="about-text fade-in">
                    <h2>Tentang <span style="color: var(--gold-accent);">KUGA Barbershop</span></h2>
                    <p>
                        KUGA Barbershop adalah destinasi grooming premium yang menghadirkan pengalaman berbeda
                        dalam perawatan rambut dan penampilan pria. Dengan konsep modern dan pelayanan profesional,
                        kami berkomitmen memberikan hasil terbaik untuk setiap klien.
                    </p>
                    <p>
                        Tim barber kami terdiri dari profesional berpengalaman yang telah terlatih dengan teknik
                        terkini dalam dunia barbering. Kami menggunakan produk berkualitas premium dan peralatan
                        modern untuk memastikan kepuasan Anda.
                    </p>
                    <p>
                        Di KUGA, kami percaya bahwa setiap pria berhak mendapatkan penampilan terbaik mereka.
                        Lebih dari sekedar potong rambut, kami memberikan pengalaman yang membuat Anda merasa
                        percaya diri dan siap menaklukkan dunia.
                    </p>
                    <a href="#layanan" class="btn btn-primary">Jelajahi Layanan Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section class="services section" id="layanan">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Layanan <span class="gradient-text">Premium</span> Kami</h2>
                <p>Pilihan perawatan terbaik untuk penampilan maksimal Anda</p>
            </div>
            @foreach ($categories as $category)
                <h3
                    style="margin-top: 3rem; margin-bottom: 2rem; color: var(--primary-color); border-left: 4px solid var(--primary-color); padding-left: 1rem;">
                    {{ $category->name }}
                </h3>
                <div class="services-grid">
                    @foreach ($category->services as $service)
                        <div class="service-card fade-in">
                            <div class="service-icon">{{ $service->emoji }}</div>
                            <h3>{{ $service->name }}</h3>
                            <p>{{ $service->description }}</p>
                            <p class="service-price">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section class="gallery section" id="galeri">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Galeri <span class="gradient-text">Hasil Karya</span> Kami</h2>
                <p>Lihat transformasi gaya yang telah kami ciptakan</p>
            </div>
            <div class="gallery-grid">
                @foreach ($galeris as $galeri)
                    <div class="gallery-item fade-in">
                        <img src="{{ asset('storage/' . $galeri->image) }}" alt="{{ $galeri->name }}" class="gallery-img">
                        <div class="gallery-overlay">
                            <span class="gallery-overlay-text">{{ $galeri->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PRICING SECTION -->
    <section class="pricing section" id="harga">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Paket <span class="gradient-text">Spesial</span></h2>
                <p>Pilih paket terbaik untuk kebutuhan grooming Anda</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card fade-in">
                    <h3>Basic Package</h3>
                    <div class="pricing-amount">150K</div>
                    <p class="pricing-period">Per Kunjungan</p>
                    <ul class="pricing-features">
                        <li>Classic Haircut</li>
                        <li>Hair Wash & Tonic</li>
                        <li>Hot Towel Treatment</li>
                        <li>Basic Styling</li>
                        <li>Complimentary Coffee</li>
                    </ul>
                    <a href="booking.html" class="btn btn-outline">Pilih Paket</a>
                </div>
                <div class="pricing-card featured fade-in">
                    <span class="pricing-badge">MOST POPULAR</span>
                    <h3>Premium Package</h3>
                    <div class="pricing-amount">275K</div>
                    <p class="pricing-period">Per Kunjungan</p>
                    <ul class="pricing-features">
                        <li>Premium Haircut & Styling</li>
                        <li>Beard Grooming</li>
                        <li>Hair Treatment</li>
                        <li>Head Massage (15 menit)</li>
                        <li>Premium Hair Products</li>
                        <li>Complimentary Beverage</li>
                    </ul>
                    <a href="booking.html" class="btn btn-primary">Pilih Paket</a>
                </div>
                <div class="pricing-card fade-in">
                    <h3>Ultimate Package</h3>
                    <div class="pricing-amount">450K</div>
                    <p class="pricing-period">Per Kunjungan</p>
                    <ul class="pricing-features">
                        <li>Luxury Haircut & Styling</li>
                        <li>Complete Beard Care</li>
                        <li>Hair Coloring/Treatment</li>
                        <li>Full Body Massage (30 menit)</li>
                        <li>Facial Treatment</li>
                        <li>Take Home Products</li>
                        <li>Priority Booking</li>
                    </ul>
                    <a href="booking.html" class="btn btn-outline">Pilih Paket</a>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG SECTION -->
    <section class="blog section" id="journal">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Style <span class="gradient-text">Journal</span></h2>
                <p>Inspirasi & Tips Grooming Terkini</p>
            </div>
            <!-- JOURNAL SLIDER -->
            <div class="journal-slider-container fade-in">
                <div class="journal-wrapper" id="journalWrapper">
                    @foreach ($journals as $journal)
                        <div class="service-card" style="padding: 0; overflow: hidden;">
                            <img src="{{ asset('storage/' . $journal->image) }}"
                                style="width: 100%; height: 200px; object-fit: cover;">
                            <div style="padding: 1.5rem;">
                                <h4 style="margin-bottom: 0.5rem;">{{ $journal->title }}</h4>
                                <p style="font-size: 0.9rem; color: var(--gray-text);">{{ $journal->summary }}</p>
                                <a href="{{ route('journal.view', $journal->title) }}"
                                    style="color: var(--primary-color); font-weight: 600; text-decoration: none; font-size: 0.9rem;">Selengkapnya
                                    →</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- SLIDER CONTROLS -->
                <div class="slider-controls" style="padding-bottom: 2px;">
                    <button class="slider-btn" id="prevJournal" aria-label="Previous">←</button>
                    <button class="slider-btn" id="nextJournal" aria-label="Next">→</button>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;" class="fade-in">
                <a href="{{ route('journal.index') }}" class="btn btn-outline" style="padding: 1rem 3rem;">Lihat Semua Style
                    Journal
                    ({{ $journalCount }}+) →</a>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="contact section" id="kontak">
        <div class="container">
            <div class="section-title fade-in">
                <h2>Hubungi <span class="gradient-text">Kami</span></h2>
                <p>Booking appointment atau tanyakan informasi lebih lanjut</p>
            </div>
            <div class="contact-container">
                <div class="contact-info fade-in">
                    <h3>Informasi Kontak</h3>
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h4>Alamat</h4>
                            <p>Jl. melanti RT. 37. No. 23<br>Palaran Samarinda, 75243</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-details">
                            <h4>Telepon</h4>
                            <p>+62 812 5662 6112</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-details">
                            <h4>Email</h4>
                            <p>kuga03042022@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🕒</div>
                        <div class="contact-details">
                            <h4>Jam Operasional</h4>
                            <p>Senin - Sabtu: 09.00 - 21.00<br>Minggu: 10.00 - 18.00</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form fade-in">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" required placeholder="Masukkan nama Anda">
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Masukkan nomor telepon">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Masukkan email Anda">
                        </div>
                        <div class="form-group">
                            <label for="service">Layanan yang Diminati</label>
                            <input type="text" id="service" name="service" placeholder="Contoh: Classic Haircut">
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" name="message"
                                placeholder="Tulis pesan atau pertanyaan Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection