@extends('layout.app')

@section('title', 'Cari Publikasi')

@section('content')

    <!-- Hero Section -->
    <div class="w-full relative bg-gray-100 h-64 md:h-96 pt-8 flex items-center bg-cover bg-center justify-center"
        style="background-image: url('/images/footer-bg.jpg');">
        <div class="absolute inset-0 bg-gray-900/90"></div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">Hasil Pencarian</h1>
            <p class="text-white text-base md:text-lg max-w-lg">Temukan publikasi berdasarkan kata kunci dan kategori</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header: Judul + Filter -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Kiri: Judul dan kategori -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('publication.search', ['search' => request('search')]) }}"
                    class="px-3 py-1 rounded-full text-sm font-medium transition
                          {{ request('category') ? 'bg-gray-100 text-gray-600 hover:bg-gray-200' : 'bg-sky-600 text-white hover:bg-sky-700' }}">
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('publication.search', ['category' => $category->id, 'search' => request('search')]) }}"
                        class="px-3 py-1 rounded-full text-sm font-medium transition
                              {{ request('category') == $category->id ? 'bg-sky-600 text-white hover:bg-sky-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <!-- Kanan: Search input -->
            <form method="GET" action="{{ route('publication.search') }}" class="w-full md:w-64">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <div class="flex items-center bg-gray-100 rounded-full overflow-hidden shadow-sm">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Search..."
                        class="flex-grow px-4 py-2 bg-transparent text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0">
                    <button type="submit" class="text-gray-500 hover:text-gray-700 px-4 py-2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Grid Card -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @forelse ($publications as $publication)
                <a href="{{ route('publication.show', $publication->slug) }}"
                    class="group bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden flex flex-col">
                    <div class="h-48 w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->title }}"
                            class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-300"
                            loading="lazy">
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <span class="text-xs font-medium text-gray-600 bg-gray-100 px-2 py-1 rounded w-fit mb-2">
                            {{ $publication->category->name }}
                        </span>
                        <h3 class="text-base font-semibold text-gray-800 mb-2 group-hover:text-blue-600 line-clamp-2">
                            {{ $publication->title }}
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2">
                            {{ Str::limit(strip_tags($publication->content), 150, '...') }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">Tidak ada hasil ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $publications->links() }}
        </div>
    </div>

@endsection
