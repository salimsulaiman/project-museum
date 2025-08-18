@extends('layout.app')

@section('title', 'Hasil Pencarian Koleksi')

@section('content')

    <div class="container py-4">
        <h3 class="mb-4">Hasil Pencarian Koleksi</h3>

        <!-- Form Search & Filter -->
        <form action="{{ route('collection.search') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-7">
                <input type="text" name="q" value="{{ $query }}" class="form-control"
                    placeholder="Cari koleksi...">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        @if ($query || $categoryId)
            <p class="text-muted">
                Menampilkan hasil untuk
                @if ($query)
                    "<strong>{{ $query }}</strong>"
                @endif
                @if ($categoryId)
                    dalam kategori <strong>{{ $categories->firstWhere('id', $categoryId)->name }}</strong>
                @endif
            </p>
        @endif

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
            @forelse ($collections as $collection)
                <div class="col">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <img src="{{ $collection->thumbnail ? asset('storage/' . $collection->thumbnail) : asset('images/default-collection.jpg') }}"
                            class="w-100" style="height: 180px; object-fit: cover; object-position: center;"
                            alt="{{ $collection->name }}">

                        <div class="card-footer bg-dark text-white fw-bold">
                            <a href="{{ route('collection.show', $collection->slug) }}"
                                class="text-white text-decoration-none">
                                {{ $collection->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Tidak ada koleksi ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $collections->links() }}
        </div>
    </div>

@endsection
