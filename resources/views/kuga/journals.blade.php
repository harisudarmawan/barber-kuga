@extends('kuga.layouts.app')
@section('content')

    <section class="section" style="padding-top: 150px;">
        <div class="container">
            <div class="section-title">
                <h1>Style <span class="gradient-text">Journal</span></h1>
                <p>Panduan lengkap gaya rambut dan tips grooming terbaik dari Barber Expert kami.</p>
            </div>

            <div class="services-grid">
                @foreach ($journals as $journal)
                    <div class="service-card" style="padding: 0; overflow: hidden;">
                        <img src="{{ asset('storage/' . $journal->image) }}"
                            style="width: 100%; height: 250px; object-fit: cover;">
                        <div style="padding: 2rem;">
                            <h3>{{ $journal->title }}</h3>
                            <p>{{ $journal->summary }}</p>
                            <a href="{{ route('journal.view', $journal->title) }}" class="btn btn-outline"
                                style="width: 100%; margin-top: 1rem;">Baca
                                Panduan</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection