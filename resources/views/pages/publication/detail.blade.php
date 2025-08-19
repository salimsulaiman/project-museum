@extends('layout.app')

@section('title', $publication->title)

@section('content')
    <div class="w-full h-96 overflow-hidden relative">
        <img src="{{ asset('storage/' . $publication->image) }}" alt="museum" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="p-6">
                        <span
                            class="inline-block bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full mb-3">
                            {{ $publication->category->name }}
                        </span>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ $publication->title }}
                        </h1>
                        <p class="text-sm text-gray-500 mb-4">Penulis: {{ $publication->author }}</p>
                        <article class="prose prose-sm max-w-none text-gray-700">
                            {!! $publication->content !!}
                        </article>
                        <a href="{{ Str::startsWith($publication->url, ['http://', 'https://']) ? $publication->url : 'https://' . $publication->url }}"
                            target="_blank"
                            class="inline-block mt-6 px-5 py-2 bg-sky-600 text-white text-sm font-medium rounded-lg hover:bg-sky-700 transition">
                            Lihat Publikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Publikasi Lain -->
            <div class="space-y-6">
                @foreach ($otherPublications as $otherPublication)
                    <div class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">
                        <div class="h-40">
                            <img src="{{ asset('storage/' . $otherPublication->image) }}" alt="Thumbnail"
                                class="w-full h-full object-cover object-center">
                        </div>
                        <div class="p-4">
                            <span
                                class="inline-block bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full mb-2">
                                {{ $otherPublication->category->name }}
                            </span>
                            <h2 class="text-sm font-semibold text-gray-800 mb-2 line-clamp-2">
                                <a href="{{ route('publication.show', $otherPublication->slug) }}"
                                    class="hover:text-sky-600 transition">
                                    {{ $otherPublication->title }}
                                </a>
                            </h2>
                            <p class="text-xs text-gray-600 line-clamp-3">
                                {{ Str::limit(strip_tags($otherPublication->content), 150, '...') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
