@extends('kuga.layouts.app')
@section('content')

    <section class="article-hero" style="--bg-image: url('{{ asset('storage/' . $journal->image) }}')">
        <div class="container">
            <h1 class="gradient-text">{{ $journal->title }}</h1>
            <p>{{ $journal->summary }}</p>
        </div>
    </section>
    <article class="article-content">
        <a href="{{ route('journal.index') }}" class="back-link">← Kembali ke Jurnal</a>
        {!! $journal->content !!}
    </article>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/journal-view.css') }}">
@endpush