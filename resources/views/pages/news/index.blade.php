@extends('layout.app')

@section('title', 'Berita')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
@endpush

@section('content')

    <div class="w-full relative bg-gray-100 h-64 md:h-96 pt-8 flex items-center bg-cover bg-center justify-center"
        style="background-image: url('/images/ocean-bg.jpg');">
        <div class="absolute inset-0 bg-sky-900/90"></div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">Berita Terbaru</h1>
            <p class="text-white text-base md:text-lg max-w-lg">Dapatkan informasi terkini dari Museum Nasional</p>
        </div>
    </div>

    <div class="w-full">


        <!-- Daftar Berita -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('news.search') }}" method="GET" class="my-8 max-w-md mx-auto">
                <div class="flex bg-gray-100 rounded-full overflow-hidden shadow-sm">
                    <input type="search" name="q" placeholder="Cari berita..."
                        class="flex-grow px-6 py-2 bg-transparent text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0">
                    <button type="submit" class="bg-transparent text-gray-500 hover:text-gray-700 ps-2 pe-4 py-2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($news as $item)
                    <a href="{{ route('news.show', $item->slug) }}" class="block group">
                        <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col h-full">
                            <div class="w-full h-48 relative overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Berita"
                                    class="w-full h-full object-cover group-hover:scale-105 absolute transition-all duration-300 ease-in-out">
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-gray-500 text-sm flex-grow line-clamp-2">
                                    {{ Str::limit($item->summary, 70, '...') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $news->links() }}
        </div>

    </div>

@endsection
