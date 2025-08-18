@extends('layout.app')

@section('title', 'Hasil Pencarian Berita')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
@endpush

@section('content')

    <!-- Hero Banner -->
    <div class="hero-banner position-relative">
        <div class="hero-content text-center position-absolute top-50 start-50 translate-middle">
            <h1 class="fw-bold text-dark mb-2">Hasil Pencarian</h1>
            <p class="text-dark-50">Berita terkait Museum Nasional</p>
        </div>
    </div>

    <div class="container">
        <!-- Search Bar -->
        <form class="mb-4" role="search" action="{{ route('news.search') }}" method="GET">
            <div class="input-group">
                <input class="form-control" type="search" name="q" placeholder="Cari berita..." aria-label="Search">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <!-- Info Keyword -->
        <div class="container mt-3 text-center">
            <p class="text-muted mb-0">
                Menampilkan hasil pencarian untuk: <strong>{{ $query }}</strong>
            </p>
        </div>

        <!-- Daftar Berita -->
        <div class="berita mt-4 px-3 max-content-width mb-5">
            <h4 class="fw-bold mb-3">Berita</h4>
            <hr>
            <div class="row g-4">
                @forelse ($news as $item)
                    <div class="col-md-3 col-sm-6 d-flex">
                        <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none w-100">
                            <div class="news-card h-100 d-flex flex-column">
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-100" alt="Berita">
                                <div class="p-3 flex-grow-1">
                                    <h5 class="fw-semibold">{{ $item->title }}</h5>
                                    <p class="mb-0 text-muted">{{ Str::limit($item->summary, 70, '...') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Tidak ada berita ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $news->links() }}
        </div>
    </div>

@endsection
