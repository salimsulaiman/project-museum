@extends('layout.app')

@section('title', 'Kegiatan')

@section('content')


    <div class="w-full relative bg-gray-100 h-64 md:h-96 pt-8 flex items-center bg-cover bg-center justify-center"
        style="background-image: url('/images/ocean-bg.jpg');">
        <div class="absolute inset-0 bg-sky-900/90"></div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">Kegiatan</h1>
            <p class="text-white text-base md:text-lg max-w-lg">Selamat Datang di Halaman Kegiatan Museum Nasional</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Judul --}}
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-900">EVENT</h3>
            <p class="text-gray-500">Museum Maritim</p>
        </div>

        {{-- Slider Event --}}
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            @foreach ($topEvents as $topEvent)
                <a href="{{ route('activity.show', $topEvent->slug) }}"
                    class="relative block group rounded-xl overflow-hidden shadow">
                    <img src="{{ asset('storage/' . $topEvent->thumbnail) }}"
                        class="w-full h-52 object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/50"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white">
                        <span class="bg-yellow-400 text-gray-900 text-xs font-semibold px-2 py-1 rounded">EVENT</span>
                        <h6 class="mt-2 text-lg font-bold">{{ $topEvent->title }}</h6>
                        <small class="text-gray-200">{{ $topEvent->created_at }}</small>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                @foreach ($events as $item)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-0 overflow-hidden">
                        <div class="h-52 w-full">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="p-5">
                            <h5 class="text-xl font-bold text-gray-900 mb-1">{{ $item->title }}</h5>
                            <small class="text-gray-500">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('F d, Y') }}
                            </small>
                            <p class="mt-3 text-gray-600 line-clamp-2">
                                {!! Str::limit($item->description ?? $item->content, 200, '...') !!}
                            </p>
                            <a href="{{ route('activity.show', $item->slug) }}"
                                class="inline-block mt-3 px-4 py-2 bg-sky-600 text-white text-sm rounded-full hover:bg-sky-700 transition">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="mt-6">
                    {{ $events->links('pagination::tailwind') }}
                </div>
            </div>

            <div class="space-y-6">
                <h6 class="text-lg font-semibold text-gray-900 border-b pb-2">LATEST NEWS</h6>
                <div class="space-y-4">
                    @foreach ($latestNews as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="flex gap-3 group">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="w-24 h-16 object-cover rounded shadow" loading="lazy">
                            <div>
                                <p class="text-sm font-semibold text-gray-800 group-hover:text-sky-600 transition">
                                    {{ $item->title }}
                                </p>
                                <small class="text-gray-500">{{ $item->created_at }}</small>
                            </div>
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('news') }}"
                    class="block w-full text-center px-4 py-2 border border-sky-600 text-sky-600 rounded-full hover:bg-sky-50 transition">
                    Muat Lebih
                </a>
            </div>
        </div>
    </div>

@endsection
