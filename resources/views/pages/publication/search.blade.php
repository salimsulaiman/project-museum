@extends('layout.app')

@section('title', 'Cari Publikasi')

@section('content')

    <div class="container my-4">
        <div class="row align-items-center justify-content-between">
            <!-- Filter kategori -->
            <div class="col-md-8 d-flex align-items-center flex-wrap gap-2">
                <h6 class="fw-bold mb-0 me-3">HASIL PENCARIAN</h6>

                <a href="{{ route('publication.search', ['search' => request('search')]) }}"
                    class="btn btn-sm {{ request('category') ? 'btn-outline-secondary' : 'btn-primary' }}">
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('publication.search', ['category' => $category->id, 'search' => request('search')]) }}"
                        class="btn btn-sm {{ request('category') == $category->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <!-- Search input -->
            <div class="col-md-4 d-flex justify-content-end">
                <form role="search" class="w-100" style="max-width: 250px;" method="GET"
                    action="{{ route('publication.search') }}">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <div class="input-group input-group-sm">
                        <input type="search" name="search" class="form-control" placeholder="Search"
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row g-3">
            @forelse ($publications as $publication)
                <div class="col-md-6 col-sm-12">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="{{ route('publication.show', $publication->slug) }}"
                            class="text-decoration-none text-dark">
                            <div style="height: 250px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $publication->image) }}" class="w-100 h-100"
                                    style="object-fit: cover; object-position: center;" alt="">
                            </div>
                            <div class="card-body">
                                <span class="badge bg-secondary mb-2">{{ $publication->category->name }}</span>
                                <h6 class="card-title fw-bold">{{ $publication->title }}</h6>
                                <p class="card-text text-muted" style="font-size: 14px;">
                                    {{ Str::limit(strip_tags($publication->content), 200, '...') }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Tidak ada hasil ditemukan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $publications->links() }}
        </div>
    </div>

@endsection
