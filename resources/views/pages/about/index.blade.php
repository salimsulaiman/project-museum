@extends('layout.app')

@section('title', 'Tentang Kami')

@section('content')

    <div class="w-full relative bg-gray-100 h-64 md:h-96 pt-8 flex items-center bg-cover bg-center justify-center"
        style="background-image: url('/images/ocean-bg.jpg');">
        <div class="absolute inset-0 bg-sky-900/90"></div>

        <div class="relative z-10 text-center px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2">Tentang Kami</h1>
            <p class="text-white text-base md:text-lg max-w-lg">Menjaga warisan maritim Indonesia untuk generasi mendatang
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full py-16" x-data="{ tab: 'visi' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="flex flex-col w-full md:w-64 space-y-3">
                <button @click="tab = 'profil'"
                    :class="tab === 'profil'
                        ?
                        'bg-sky-600 text-white shadow' :
                        'border border-sky-600 text-sky-600 hover:bg-sky-50'"
                    class="px-5 py-3 rounded-full transition text-center font-medium">
                    Profil
                </button>
                <button @click="tab = 'visi'"
                    :class="tab === 'visi'
                        ?
                        'bg-sky-600 text-white shadow' :
                        'border border-sky-600 text-sky-600 hover:bg-sky-50'"
                    class="px-5 py-3 rounded-full transition text-center font-medium">
                    Visi dan Misi
                </button>
                <button @click="tab = 'struktur'"
                    :class="tab === 'struktur'
                        ?
                        'bg-sky-600 text-white shadow' :
                        'border border-sky-600 text-sky-600 hover:bg-sky-50'"
                    class="px-5 py-3 rounded-full transition text-center font-medium">
                    Struktur Organisasi
                </button>
            </div>

            <!-- Main Content -->
            <div class="flex-1 prose max-w-none prose-sky">
                <div x-show="tab === 'profil'">
                    {!! $profile->content ?? '<p>Belum ada data Profil</p>' !!}
                </div>

                {{-- Visi Misi --}}
                <div x-show="tab === 'visi'">
                    {!! $visionMission->content !!}
                </div>

                {{-- Struktur --}}
                <div x-show="tab === 'struktur'">
                    <div class="w-full">
                        <h3 class="mb-6 text-2xl font-semibold text-center text-gray-800">
                            {{ $structure->title }}
                        </h3>

                        <div class="w-full flex justify-center">
                            <img src="{{ $structure && $structure->image ? asset('storage/' . $structure->image) : asset('images/strukturorganisasi.jpg') }}"
                                alt="Struktur Organisasi Museum Maritim Indonesia"
                                class="max-h-[600px] object-contain mx-auto" />
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>


@endsection
