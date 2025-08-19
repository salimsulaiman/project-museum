@extends('layout.app')

@section('title', 'Detail Event')

@section('content')
    <div class="w-full h-96 overflow-hidden relative">
        <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="museum" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Bagian Kiri (Detail Kegiatan) -->
            <div>
                <h2 class="text-2xl font-bold text-sky-700 mb-4">{{ $event->title }}</h2>
                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm">
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-gray-200">
                            <tr class="bg-sky-50">
                                <th class="px-4 py-2 text-left font-medium text-gray-700 w-1/3">Nama Acara</th>
                                <td class="px-4 py-2">{{ $event->title }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Jenis</th>
                                <td class="px-4 py-2">{{ $event->category->name }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Tempat</th>
                                <td class="px-4 py-2">{{ $event->location->name }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Jumlah Peserta</th>
                                <td class="px-4 py-2">{{ $event->max_participant }} pax</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Kontak</th>
                                <td class="px-4 py-2">{{ $event->contact }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">PIC</th>
                                <td class="px-4 py-2">{{ $event->pic }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Uraian</th>
                                <td class="px-4 py-2">{{ $event->description }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Status</th>
                                <td class="px-4 py-2">
                                    @if ($event->status == 1)
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Terlaksana
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                            Belum Terlaksana
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bagian Kanan (Info Ruangan) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $event->location->name }}</h3>
                <p class="text-gray-600"><strong>Lokasi:</strong> {{ $event->location_detail }}</p>

                @php
                    $hasData = $event->standing || $event->classroom || $event->round_table || $event->u_shape;
                @endphp

                @if ($hasData)
                    <div class="mt-4 overflow-hidden rounded-lg border border-gray-200 shadow-sm">
                        <table class="w-full text-center text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    @if ($event->standing)
                                        <th class="px-4 py-2 font-medium text-gray-700">Standing</th>
                                    @endif
                                    @if ($event->classroom)
                                        <th class="px-4 py-2 font-medium text-gray-700">Classroom</th>
                                    @endif
                                    @if ($event->round_table)
                                        <th class="px-4 py-2 font-medium text-gray-700">Round Table</th>
                                    @endif
                                    @if ($event->u_shape)
                                        <th class="px-4 py-2 font-medium text-gray-700">U-shape</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    @if ($event->standing)
                                        <td class="px-4 py-2">{{ $event->standing }}</td>
                                    @endif
                                    @if ($event->classroom)
                                        <td class="px-4 py-2">{{ $event->classroom }}</td>
                                    @endif
                                    @if ($event->round_table)
                                        <td class="px-4 py-2">{{ $event->round_table }}</td>
                                    @endif
                                    @if ($event->u_shape)
                                        <td class="px-4 py-2">{{ $event->u_shape }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div>
                        <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="Ruang Rapat"
                            class="w-full h-64 object-cover rounded-lg shadow-md">
                    </div>
                    <div class="space-y-2 text-gray-600">
                        <p><strong>Ukuran Ruang:</strong><br>{{ $event->length }}m x {{ $event->width }}m</p>
                        <p><strong>Fasilitas :</strong><br>{{ $event->facility }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Tambahan -->
        <div class="mt-10 prose max-w-none prose-sky">
            {!! $event->content !!}
        </div>
    </div>
@endsection
