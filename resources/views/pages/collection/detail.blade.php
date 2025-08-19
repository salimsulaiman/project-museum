@extends('layout.app')

@section('title', 'Koleksi')

@section('content')

    <div class="w-full h-96 overflow-hidden relative">
        <img src="{{ asset('storage/' . $collection->thumbnail) }}" alt="museum" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            <!-- Bagian Gambar -->
            <div>
                <!-- Thumbnail utama -->
                <div class="rounded-xl overflow-hidden shadow-sm mb-4">
                    <img src="{{ asset('storage/' . $collection->thumbnail) }}" alt="{{ $collection->name }}"
                        class="w-full h-[300px] object-cover object-center">
                </div>

                <!-- Gambar tambahan -->
                <div class="grid grid-cols-4 gap-3">
                    @foreach ($collection->images as $images)
                        <div class="rounded-lg overflow-hidden shadow-sm">
                            <img src="{{ asset('storage/' . $images->image) }}" alt="Thumb {{ $loop->iteration }}"
                                class="w-full h-20 object-cover object-center hover:scale-105 transition-transform duration-300">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Bagian Detail -->
            <div class="flex flex-col gap-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $collection->name }}</h2>

                <div class="text-gray-700 space-y-1">
                    <p><span class="font-medium">No. Inv:</span> {{ $collection->no_inv }}</p>
                    <p><span class="font-medium">Klasifikasi Koleksi:</span> {{ $collection->category->name }}</p>
                </div>

                <!-- Ukuran -->
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">Ukuran</h3>
                    <div class="overflow-hidden rounded-lg border border-gray-200">
                        <table class="w-full text-sm text-gray-700">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">Panjang</th>
                                    <th class="px-4 py-2 text-left">Lebar</th>
                                    <th class="px-4 py-2 text-left">Tinggi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="divide-x divide-gray-200">
                                    <td class="px-4 py-2">{{ $collection->length }} cm</td>
                                    <td class="px-4 py-2">{{ $collection->width }} cm</td>
                                    <td class="px-4 py-2">{{ $collection->height }} cm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-gray-700 space-y-1">
                    <p><span class="font-medium">Bahan:</span> {{ $collection->material }}</p>
                    <p><span class="font-medium">Warna:</span> {{ $collection->color }}</p>
                    <p><span class="font-medium">Cara Perolehan:</span> {{ $collection->acquisition_method }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800 mb-1">Deskripsi</h3>
                    <p class="text-gray-600">{{ $collection->description }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800 mb-1">Fungsi</h3>
                    <p class="text-gray-600">{{ $collection->function }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
