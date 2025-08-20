@extends('layout.app')

@section('title', 'Hasil Pencarian Koleksi')

@section('content')

    <div class="w-full relative bg-gray-100 h-64 md:h-96 pt-8 flex items-center bg-cover bg-center justify-center"
        style="background-image: url('/images/footer-bg.jpg');">
        <div class="absolute inset-0 bg-gray-900/90"></div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">Koleksi</h1>
            <p class="text-white text-base md:text-lg max-w-lg">Selamat Datang di Halaman Kegiatan Museum Nasional</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('collection.search') }}" method="GET"
            class="flex flex-col md:flex-row items-center gap-3 mb-6 w-full justify-start" x-data="{
                open: false,
                selected: '{{ request('category') ? $categories->firstWhere('id', request('category'))->name : 'Semua' }}',
                selectedCategory: '{{ request('category') ?? '' }}'
            }">

            <!-- Hidden input kategori -->
            <input type="hidden" name="category" x-model="selectedCategory">

            <!-- Select Kategori (Dropdown Custom) -->
            <div class="relative w-full md:w-64">
                <!-- Trigger -->
                <button type="button" @click="open = !open"
                    class="flex justify-between items-center w-full px-6 py-2 h-10 bg-gray-100 rounded-full shadow-sm text-gray-900 text-base focus:outline-none">
                    <span x-text="selected"></span>
                    <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                </button>

                <!-- Options -->
                <div x-show="open" x-cloak @click.away="open = false"
                    class="absolute mt-2 w-full bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                    <ul class="max-h-60 overflow-y-auto">
                        <!-- Option Semua -->
                        <li>
                            <button type="submit" @click="selected = 'Semua'; selectedCategory = ''; open = false"
                                class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg">
                                Semua
                            </button>
                        </li>
                        <!-- Option per kategori -->
                        @foreach ($categories as $category)
                            <li>
                                <button type="submit"
                                    @click="selected = '{{ $category->name }}'; selectedCategory = '{{ $category->id }}'; open = false"
                                    class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    {{ $category->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Input Search -->
            <div class="flex items-center bg-gray-100 rounded-full overflow-hidden shadow-sm w-full md:w-64">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari koleksi..."
                    class="flex-grow px-6 py-2 bg-transparent text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0">
                <button type="submit" class="bg-transparent text-gray-500 hover:text-gray-700 ps-2 pe-4 py-2">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>


        @if ($query || $categoryId)
            <p class="text-gray-600 mb-8">
                Menampilkan hasil untuk
                @if ($query)
                    "<span class="font-semibold">{{ $query }}</span>"
                @endif
                @if ($categoryId)
                    dalam kategori <span class="font-semibold">{{ $categories->firstWhere('id', $categoryId)->name }}</span>
                @endif
            </p>
        @endif

        <!-- Grid Koleksi -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($collections as $collection)
                <a href="{{ route('collection.show', $collection->slug) }}"
                    class="relative bg-white rounded-2xl shadow hover:shadow-xl overflow-hidden transition aspect-square group">

                    <img src="{{ $collection->thumbnail ? asset('storage/' . $collection->thumbnail) : asset('images/default-collection.jpg') }}"
                        alt="{{ $collection->name }}"
                        class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500 ease-in-out"
                        loading="lazy">

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-80 group-hover:opacity-90 transition duration-300">
                    </div>

                    <div
                        class="absolute bottom-0 left-0 right-0 p-5 z-10 text-center text-white transform translate-y-6 group-hover:translate-y-0 transition-all duration-500 ease-in-out">
                        <h4 class="text-lg font-semibold mb-1 line-clamp-1">{{ $collection->name }}</h4>
                        <p class="text-sm text-gray-200 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            Klik untuk melihat detail koleksi
                        </p>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-500 col-span-full">Tidak ada koleksi ditemukan.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $collections->links('pagination::tailwind') }}
        </div>
    </div>

@endsection
