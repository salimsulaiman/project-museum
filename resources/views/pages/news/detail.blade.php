@extends('layout.app')

@section('title', 'Tentang Kami')

@section('content')

    <div class="w-full h-96 overflow-hidden relative">
        <img src="{{ asset('storage/' . $news->image) }}" alt="museum" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 my-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">{{ $news->title }}</h1>
        <p class="text-gray-500 text-sm mb-6">{{ $news->created_at->format('d F Y') }}</p>

        <article class="prose prose-slate max-w-none">
            {!! $news->content !!}
        </article>
    </div>

    @if ($relatedNews->count())
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-12">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Berita Lainnya</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($relatedNews as $item)
                    <a href="{{ route('news.show', $item->slug) }}" class="group block">
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden flex flex-col h-full">

                            <div class="h-40 overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>

                            <div class="p-4 flex-1 flex flex-col">
                                <h6 class="text-gray-900 font-semibold mb-1 truncate">{{ $item->title }}</h6>
                                <p class="text-gray-500 text-sm flex-1">{{ Str::limit($item->summary, 80, '...') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

@endsection
