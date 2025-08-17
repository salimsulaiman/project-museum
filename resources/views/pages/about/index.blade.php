@extends('layout.app')

@section('title', 'Tentang Kami')

@section('content')


    {{-- Hero Section --}}
    <div class="foto">
        {{-- <div class="card"> --}}
        <img src="{{ asset('images/museum.jpg') }}" class="card-img-top" alt="museum">
        {{-- </div> --}}
    </div>
    {{-- Main Content --}}
    <div class="container content my-5 d-flex gap-4">
        {{-- Sidebar --}}
        <div class="sidebar">
            <a href="profil" class="btn btn-outline-primary w-100 mb-2">Profil</a>
            <a href="/tentang-kami" class="btn btn-primary w-100 mb-2">Visi dan Misi</a>
            <a href="struktur" class="btn btn-outline-primary w-100 mb-2">Struktur Organisasi</a>
        </div>

        {{-- Visi Misi --}}
        <div class="main-content flex-grow-1">
            {!! $visionMission->content !!}
        </div>
    </div>


@endsection
