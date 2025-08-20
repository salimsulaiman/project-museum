@extends('layout.app')

@section('title', 'Beranda')

@section('content')

    @if ($banners->count() > 0)
        <div x-data="{
            active: 0,
            total: {{ $banners->count() }},
            intervalId: null,
            startInterval() {
                this.intervalId = setInterval(() => {
                    this.active = (this.active + 1) % this.total
                }, 4000);
            },
            resetInterval() {
                clearInterval(this.intervalId);
                this.startInterval();
            }
        }" x-init="startInterval()" class="relative w-full h-screen overflow-hidden">
            <!-- Slides -->
            <template x-for="(banner, index) in {{ json_encode($banners) }}" :key="index">
                <div x-show="active === index" x-transition:enter="transition ease-in-out duration-700"
                    x-transition:enter-start="opacity-0 brightness-50" x-transition:enter-end="opacity-100 brightness-100"
                    x-transition:leave="transition ease-in-out duration-700"
                    x-transition:leave-start="opacity-100 brightness-100" x-transition:leave-end="opacity-0 brightness-50"
                    class="absolute inset-0">
                    <!-- Background Image -->
                    <img :src="'/storage/' + banner.image" alt="Banner" class="object-cover w-full h-full" loading="lazy">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                    <!-- Caption -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-8">
                        <h1 class="px-4 text-2xl font-semibold text-center text-white md:text-4xl">
                            <span x-text="banner.title"></span>
                        </h1>
                        <p class="text-base text-white">
                            <span x-text="banner.description"></span>
                        </p>
                    </div>
                </div>
            </template>

            <!-- Controls -->
            <button @click="active = (active - 1 + total) % total; resetInterval()"
                class="absolute p-2 text-white -translate-y-1/2 rounded-full left-4 top-1/2 bg-black/40 hover:bg-black/60">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button @click="active = (active + 1) % total; resetInterval()"
                class="absolute p-2 text-white -translate-y-1/2 rounded-full right-4 top-1/2 bg-black/40 hover:bg-black/60">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    @endif

    <div class="w-full bg-white">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex gap-2 mt-8">
                <div class="self-stretch w-2 rounded-full bg-sky-800"></div>
                <h1 class="text-2xl font-bold text-slate-800">Kategori</h1>
            </div>
            <p class="max-w-xl mt-4 text-slate-600">Temukan beragam kategori utama seperti Koleksi, Berita, Publikasi, dan
                Event yang dirancang untuk memudahkan Anda dalam menjelajahi konten.</p>
            <div class="grid grid-cols-2 gap-6 mt-6 text-center lg:grid-cols-4">
                @foreach ($categories as $category)
                    <a href="{{ url($category->url) }}"
                        class="block text-gray-700 transition-colors group hover:text-gray-900">
                        <div
                            class="overflow-hidden transition-shadow bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md aspect-square">
                            <!-- Icon / Image -->
                            <div class="relative mb-3 overflow-hidden aspect-square rounded-xl">
                                <div
                                    class="absolute left-0 z-10 flex items-center justify-center px-4 py-2 text-sm text-white transition-all duration-300 ease-in-out rounded-r-full shadow bg-sky-800 w-fit h-fit top-4 group-hover:px-10">
                                    {{ $category->title }}</div>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}"
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105"
                                    loading="lazy">
                                <div
                                    class="absolute inset-0 transition-opacity duration-300 bg-black opacity-0 group-hover:opacity-30">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>

    <div class="w-full mt-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="p-6 border border-gray-200 shadow-sm rounded-xl bg-sky-700">
                <div class="grid items-center grid-cols-1 gap-6 md:grid-cols-12">

                    <div class="text-right md:col-span-3 md:text-end">
                        <h3 class="text-lg font-semibold text-white">Layanan</h3>
                        <p class="mt-2 text-white">
                            {{ $service->day }}<br>
                            {{ $service->time }}
                        </p>
                    </div>

                    <div class="md:col-span-5">
                        <h4 class="mb-2 text-lg font-semibold text-white">Prosedur Kunjungan</h4>
                        <div class="prose text-white prose-invert max-w-none">
                            {!! $service->procedure !!}
                        </div>
                    </div>

                    <div class="text-center md:col-span-4">
                        <a href="{{ $service->url }}" target="_blank"
                            class="block overflow-hidden transition shadow group rounded-xl hover:shadow-md">
                            <img src="{{ $service->thumbnail ? asset('storage/' . $service->thumbnail) : asset('images/virtualmuseum.jpg') }}"
                                alt="Virtual Museum"
                                class="object-cover w-full h-48 transition-transform duration-300 group-hover:scale-105"
                                loading="lazy">
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="relative w-full py-12 mt-10 bg-center bg-cover bg-slate-200"
        style="background-image: url('/images/virtual-bg.webp');">
        <div class="absolute inset-0 bg-slate-200/80"></div>
        <div class="relative z-10 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center">
                <div class="flex gap-2">
                    <div class="self-stretch w-2 rounded-full bg-sky-800"></div>
                    <h1 class="text-2xl font-bold text-slate-800">Video Streaming</h1>
                </div>
                <p class="max-w-xl mt-4 text-slate-600">Temukan beragam kategori utama seperti Koleksi, Berita, Publikasi,
                    dan
                    Event yang dirancang untuk memudahkan Anda dalam menjelajahi konten.</p>
                <div class="grid grid-cols-2 gap-4 mt-6 mb-4 md:grid-cols-3">
                    @foreach ($video_streamings as $video_streaming)
                        <a href="{{ Str::startsWith($video_streaming->video_url, ['http://', 'https://'])
                            ? $video_streaming->video_url
                            : 'https://' . $video_streaming->video_url }}"
                            target="_blank"
                            class="relative overflow-hidden transition rounded-lg shadow group hover:shadow-lg">
                            <img src="{{ asset('storage/' . $video_streaming->thumbnail) }}"
                                class="object-cover w-full h-32 transition duration-300 transform rounded-lg md:h-40 group-hover:scale-105"
                                loading="lazy">
                            <div class="absolute inset-0 transition opacity-0 bg-black/20 group-hover:opacity-50"></div>
                        </a>
                    @endforeach
                </div>

                <div class="flex justify-center mt-4 lg:justify-start">
                    <a href="https://www.youtube.com/" target="_blank"
                        class="px-6 py-2 text-sm font-semibold text-white transition rounded-full shadow bg-sky-700 hover:bg-sky-800">
                        Lihat Konten
                    </a>
                </div>
            </div>

        </div>
    </div>


    {{-- <div class="w-full py-12 bg-gray-50">
        <div class="grid items-center grid-cols-1 gap-10 px-6 mx-auto max-w-7xl lg:px-8 lg:grid-cols-2">

            <!-- Grafik Card -->
            <div class="relative p-6 bg-white shadow-lg rounded-2xl">
                <h3 class="mb-4 text-xl font-semibold text-gray-800">Grafik Data Pengunjung</h3>
                <canvas id="pengunjungChart" class="w-full h-[300px]"></canvas>
            </div>

            <!-- Image Card -->
            <div class="relative overflow-hidden shadow-xl group rounded-2xl">
                <img src="images/ruang-kegiatan.jpg" alt="Ruang Kegiatan"
                    class="w-full h-[350px] object-cover transform group-hover:scale-105 transition duration-500">
                <div
                    class="absolute inset-0 flex items-end p-6 transition opacity-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent group-hover:opacity-100">
                    <span class="text-lg font-medium text-white">Ruang Kegiatan</span>
                </div>
            </div>

        </div>
    </div> --}}


    {{-- Berita --}}
    @if ($news->count() > 0)
        <div class="w-full mt-8 mb-12">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex gap-2">
                    <div class="self-stretch w-2 rounded-full bg-sky-800"></div>
                    <h1 class="text-2xl font-bold text-slate-800">Berita</h1>
                </div>
                <p class="max-w-xl mt-4 text-slate-600">Temukan beragam kategori utama seperti Koleksi, Berita, Publikasi,
                    dan
                    Event yang dirancang untuk memudahkan Anda dalam menjelajahi konten.</p>
                <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($news as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="block group">
                            <div class="flex flex-col h-full overflow-hidden bg-white shadow-sm rounded-2xl">

                                <!-- Gambar -->
                                <div class="overflow-hidden h-44">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105"
                                        loading="lazy">
                                </div>

                                <!-- Konten -->
                                <div class="flex flex-col flex-1 px-2 py-4">
                                    <h5 class="mb-1 font-semibold text-gray-900 truncate">{{ $item->title }}</h5>
                                    <p class="mb-2 text-xs text-gray-500">
                                        {{ $item->created_at->translatedFormat('j F Y') }}</p>
                                    <p class="flex-1 text-sm text-gray-600 line-clamp-2">
                                        {{ Str::limit($item->summary, 100, '...') }}
                                    </p>
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


@endsection
{{-- @section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pengunjungChart').getContext('2d');
        const pengunjungChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: @json($data), // Data dummy, bisa diganti dari database
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 2
                        }
                    }
                }
            }
        });
    </script>
@endsection --}}
