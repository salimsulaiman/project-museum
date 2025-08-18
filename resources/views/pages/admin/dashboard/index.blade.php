@extends('layout.admin.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <div class="row g-4">
            @php
                $colors = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
                $icons = [
                    'Banners' => 'fa-image',
                    'Categories' => 'fa-tags',
                    'Collections' => 'fa-archive',
                    'Events' => 'fa-calendar',
                    'News' => 'fa-file-text',
                    'Publications' => 'fa-book',
                    'Video Streaming' => 'fa-video-camera',
                    'Visitors' => 'fa-users',
                ];

                $routes = [
                    'Banners' => route('admin.banners.index'),
                    'Categories' => route('admin.categories.index'),
                    'Collections' => route('admin.collections.index'),
                    'Events' => route('admin.events.index'),
                    'News' => route('admin.news.index'),
                    'Publications' => route('admin.publications.index'),
                    'Video Streaming' => route('admin.video-streamings.index'),
                ];
            @endphp

            @foreach ($counts as $label => $count)
                @php
                    $color = $colors[$loop->index % count($colors)];
                    $icon = $icons[$label] ?? 'fa-database';
                    $url = $routes[$label] ?? null;
                @endphp

                <div class="col-xl-3 col-md-4 col-sm-6">
                    @if ($url)
                        <a href="{{ $url }}" class="text-decoration-none">
                    @endif

                    <div class="card border-0 shadow-sm h-100 rounded-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span
                                    class="avatar avatar-md d-flex justify-content-center align-items-center rounded-circle bg-{{ $color }} bg-opacity-10 text-{{ $color }}">
                                    <i class="fa {{ $icon }} fa-lg"></i>
                                </span>
                            </div>

                            <div>
                                <h6 class="mb-1 text-muted">{{ $label }}</h6>
                                <h4 class="fw-bold mb-0">{{ $count }}</h4>
                            </div>
                        </div>
                    </div>

                    @if ($url)
                        </a>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
@endsection
