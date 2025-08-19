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
                    <img :src="'/storage/' + banner.image" alt="Banner" class="w-full h-full object-cover">

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                    <!-- Caption -->
                    <div class="absolute inset-0 flex items-center justify-center flex-col gap-8">
                        <h1 class="text-white font-semibold text-2xl md:text-4xl text-center px-4">
                            <span x-text="banner.title"></span>
                        </h1>
                        <p class="text-white text-base">
                            <span x-text="banner.description"></span>
                        </p>
                    </div>
                </div>
            </template>

            <!-- Controls -->
            <button @click="active = (active - 1 + total) % total; resetInterval()"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button @click="active = (active + 1) % total; resetInterval()"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-2 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    @endif

    <div class="w-full bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-2 mt-8">
                <div class="self-stretch w-2 bg-sky-800 rounded-full"></div>
                <h1 class="text-2xl font-bold text-slate-800">Kategori</h1>
            </div>
            <p class="text-slate-600 max-w-xl mt-4">Temukan beragam kategori utama seperti Koleksi, Berita, Publikasi, dan
                Event yang dirancang untuk memudahkan Anda dalam menjelajahi konten.</p>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center mt-6">
                @foreach ($categories as $category)
                    <a href="{{ url($category->url) }}"
                        class="group block text-gray-700 hover:text-gray-900 transition-colors">
                        <div
                            class="rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow bg-white overflow-hidden aspect-square">
                            <!-- Icon / Image -->
                            <div class="aspect-square rounded-xl overflow-hidden mb-3 relative">
                                <div
                                    class="bg-sky-800 z-10 text-sm rounded-r-full absolute w-fit h-fit px-4 py-2 top-4 left-0 flex items-center justify-center text-white group-hover:px-10 transition-all duration-300 ease-in-out shadow">
                                    {{ $category->title }}</div>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                <div
                                    class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-opacity duration-300">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>

    <div class="w-full mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="p-6 rounded-xl border border-gray-200 shadow-sm bg-sky-700">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">

                    <div class="md:col-span-3 text-right md:text-end">
                        <h3 class="text-lg font-semibold text-white">Layanan</h3>
                        <p class="text-white mt-2">
                            {{ $service->day }}<br>
                            {{ $service->time }}
                        </p>
                    </div>

                    <div class="md:col-span-5">
                        <h4 class="text-lg font-semibold text-white mb-2">Prosedur Kunjungan</h4>
                        <div class="prose prose-invert max-w-none text-white">
                            {!! $service->procedure !!}
                        </div>
                    </div>

                    <div class="md:col-span-4 text-center">
                        <a href="{{ $service->url }}" target="_blank"
                            class="group block rounded-xl overflow-hidden shadow hover:shadow-md transition">
                            <img src="{{ $service->thumbnail ? asset('storage/' . $service->thumbnail) : asset('images/virtualmuseum.jpg') }}"
                                alt="Virtual Museum"
                                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="w-full py-12 bg-slate-200 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center">
                <div class="flex gap-2">
                    <div class="self-stretch w-2 bg-sky-800 rounded-full"></div>
                    <h1 class="text-2xl font-bold text-slate-800">Video Streaming</h1>
                </div>
                <p class="text-slate-600 max-w-xl mt-4">Temukan beragam kategori utama seperti Koleksi, Berita, Publikasi,
                    dan
                    Event yang dirancang untuk memudahkan Anda dalam menjelajahi konten.</p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 mt-6">
                    @foreach ($video_streamings as $video_streaming)
                        <a href="{{ $video_streaming->video_url }}" target="_blank"
                            class="group relative overflow-hidden rounded-lg shadow hover:shadow-lg transition">
                            <img src="{{ asset('storage/' . $video_streaming->thumbnail) }}"
                                class="w-full h-32 md:h-40 object-cover transform group-hover:scale-105 transition duration-300 rounded-lg">
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-50 transition"></div>
                        </a>
                    @endforeach
                </div>

                <div class="flex justify-center lg:justify-start mt-4">
                    <a href="https://www.youtube.com/" target="_blank"
                        class="bg-sky-700 hover:bg-sky-800 text-white font-semibold px-6 py-2 rounded-full shadow transition text-sm">
                        Lihat Konten
                    </a>
                </div>
            </div>

        </div>
    </div>


    {{-- <div class="w-full py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <!-- Grafik Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 relative">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Grafik Data Pengunjung</h3>
                <canvas id="pengunjungChart" class="w-full h-[300px]"></canvas>
            </div>

            <!-- Image Card -->
            <div class="relative group rounded-2xl overflow-hidden shadow-xl">
                <img src="images/ruang-kegiatan.jpg" alt="Ruang Kegiatan"
                    class="w-full h-[350px] object-cover transform group-hover:scale-105 transition duration-500">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-6">
                    <span class="text-white text-lg font-medium">Ruang Kegiatan</span>
                </div>
            </div>

        </div>
    </div> --}}


    {{-- Berita --}}
    @if ($news->count() > 0)
        <div class="w-full mt-8 mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex gap-2">
                    <div class="self-stretch w-2 bg-sky-800 rounded-full"></div>
                    <h1 class="text-2xl font-bold text-slate-800">Berita</h1>
                </div>
                <p class="text-slate-600 max-w-xl mt-4">Temukan beragam kategori utama seperti Koleksi, Berita, Publikasi,
                    dan
                    Event yang dirancang untuk memudahkan Anda dalam menjelajahi konten.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                    @foreach ($news as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="block group">
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden h-full flex flex-col">

                                <!-- Gambar -->
                                <div class="h-44 overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>

                                <!-- Konten -->
                                <div class="py-4 flex-1 flex flex-col">
                                    <h5 class="text-gray-900 font-semibold mb-1 truncate">{{ $item->title }}</h5>
                                    <p class="text-gray-500 text-xs mb-2">
                                        {{ $item->created_at->translatedFormat('j F Y') }}</p>
                                    <p class="text-gray-600 text-sm flex-1 line-clamp-2">
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
