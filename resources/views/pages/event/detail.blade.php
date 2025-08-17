@extends('layout.app')

@section('title', 'Detail event')

@section('content')

    <div class="container my-5">
        <div class="row">
            <!-- Bagian Kiri (Detail Kegiatan) -->
            <div class="col-md-6">
                <h5 class="fw-bold mb-3 text-uppercase">{{ $event->title }}</h5>
                <table class="table table-bordered">
                    <tbody>
                        <tr class="table-primary">
                            <th width="30%">Nama Acara</th>
                            <td>{{ $event->title }}</td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td>{{ $event->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td>{{ $event->location->name }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Peserta</th>
                            <td>{{ $event->max_participant }} pax</td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td>{{ $event->contact }}</td>
                        </tr>
                        <tr>
                            <th>PIC</th>
                            <td>{{ $event->pic }}</td>
                        </tr>
                        <tr>
                            <th>Uraian</th>
                            <td>{{ $event->description }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>Belum Terlaksana</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bagian Kanan (Info Ruangan) -->
            <div class="col-md-6">
                <h6 class="fw-bold text-uppercase">{{ $event->location->name }}</h6>
                <p>
                    <strong>Lokasi:</strong> {{ $event->location_detail }}
                </p>
                <p class="mb-1"><strong>Kapasitas :</strong></p>
                @php
                    $hasData = $event->standing || $event->classroom || $event->round_table || $event->u_shape;
                @endphp

                @if ($hasData)
                    <table class="table table-bordered text-center mb-3">
                        <thead class="table-light">
                            <tr>
                                @if ($event->standing)
                                    <th>Standing</th>
                                @endif
                                @if ($event->classroom)
                                    <th>Classroom</th>
                                @endif
                                @if ($event->round_table)
                                    <th>Round Table</th>
                                @endif
                                @if ($event->u_shape)
                                    <th>U-shape</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if ($event->standing)
                                    <td>{{ $event->standing }}</td>
                                @endif
                                @if ($event->classroom)
                                    <td>{{ $event->classroom }}</td>
                                @endif
                                @if ($event->round_table)
                                    <td>{{ $event->round_table }}</td>
                                @endif
                                @if ($event->u_shape)
                                    <td>{{ $event->u_shape }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                @endif


                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="Ruang Rapat"
                            class="img-fluid rounded shadow-sm mb-3">
                    </div>
                    <div class="col-md-6">
                        <p><strong>Ukuran Ruang:</strong><br> {{ $event->length }} meter x {{ $event->width }} meter</p>
                        <p><strong>Fasilitas :</strong><br> {{ $event->facility }}</p>
                    </div>
                </div>
            </div>

            <div class="w-100 mt-4">
                {!! $event->content !!}
            </div>
        </div>
    </div>

@endsection
