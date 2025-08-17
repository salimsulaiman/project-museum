@extends('layout.app')

@section('title', 'Berita')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
@endpush

@section('content')

    <!-- Hero Banner -->
    <div class="hero-banner position-relative">
        <div class="hero-content text-center position-absolute top-50 start-50 translate-middle">
            <h1 class="fw-bold text-dark mb-2">Berita Terbaru</h1>
            <p class="text-dark-50">Dapatkan informasi terkini dari Museum Nasional</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="container my-4 max-content-width">
        <div class="row">
            <div class="col search-bar-wrapper text-end">
                <form class="d-flex justify-content-end search-form" role="search">
                    <div class="input-group">
                        <input class="form-control search-input" type="search" placeholder="Cari berita..."
                            aria-label="Search">
                        <button class="btn-search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Berita -->
    <div class="berita mt-4 px-3 max-content-width mb-5">
        <h4 class="fw-bold mb-3">Berita</h4>
        <hr>
        <div class="row g-4">
            @foreach ($news as $item)
                <div class="col-md-3 col-sm-6 d-flex">
                    <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none w-100">
                        <div class="news-card h-100 d-flex flex-column">
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-100" alt="Berita">
                            <div class="p-3 flex-grow-1">
                                <h5 class="fw-semibold">{{ $item->title }}k</h5>
                                <p class="mb-0 text-muted">{{ Str::limit($item->summary, 70, '...') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $news->links() }}
    </div>

@endsection
