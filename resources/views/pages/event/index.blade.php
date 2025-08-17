@extends('layout.app')

@section('title', 'kegiatan')

@section('content')

    <div class="container py-4" style="max-width: 1400px;">

        {{-- Jumbotron --}}
        <div class="jumbotron text-center py-5 mb-4">
            <h1 class="display-4 fw-bold">Kegiatan</h1>
            <p class="lead">Selamat datang di halaman kegiatan Museum Nasional</p>
        </div>

        {{-- Judul --}}
        <h3 class="fw-bold mb-1">EVENT</h3>
        <p class="text-muted mb-4">Museum Maritim</p>

        {{-- Slider Event --}}
        <div class="row g-3 mb-4">
            @foreach ($topEvents as $topEvent)
                <div class="col-md-4">
                    <a href="{{ route('activity.show', $topEvent->slug) }}">
                        <div class="card border-0 text-white" style="height: 200px; overflow: hidden; position: relative;">
                            <img src="{{ asset('storage/' . $topEvent->thumbnail) }}" class="w-100 h-100"
                                style="object-fit: cover;">
                            <div
                                style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
                            </div>
                            <div style="position:absolute; bottom:0; left:0; padding:15px;">
                                <span class="badge bg-warning text-dark mb-1">EVENT</span>
                                <h6 class="mb-0 fw-bold">{{ $topEvent->title }}</h6>
                                <small class="text-light">{{ $topEvent->created_at }}</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Konten Utama --}}
        <div class="row">
            {{-- Kolom Kiri (Daftar Event) --}}
            <div class="col-lg-8">
                {{-- Event Utama --}}
                @foreach ($events as $item)
                    <div class="card border-0 mb-4 shadow-sm ">
                        <div class="card-img-wrapper" style="height: 200px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-100 h-100"
                                style="object-fit: cover; object-position: center;" alt="{{ $item->title }}">
                        </div>
                        <div class="card-body p-3">
                            <h5 class="fw-bold">{{ $item->title }}</h5>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('F d, Y') }}
                            </small>
                            <p class="mt-2 mb-3 text-muted">
                                {!! Str::limit($item->summary ?? $item->content, 80, '...') !!}
                            </p>
                            <a href="{{ route('activity.show', $item->slug) }}" class="btn btn-sm btn-secondary">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4 d-flex justify-content-center">
                    {{ $events->links() }}
                </div>

            </div>

            {{-- Kolom Kanan (Sidebar) --}}
            <div class="col-lg-4">

                {{-- Latest News --}}
                <h6 class="fw-bold border-bottom pb-2">LATEST NEWS</h6>
                @foreach ($latestNews as $item)
                    <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="flex-shrink-0" style="width: 80px; height: 60px; object-fit: cover;">
                            <div class="ms-2">
                                <small class="fw-bold text-dark">{{ $item->title }}</small><br>
                                <small class="text-muted">{{ $item->created_at }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
                <a href="{{ route('news') }}" class="btn btn-outline-secondary btn-sm w-100">Muat Lebih</a>
            </div>
        </div>
    </div>
@endsection
