@extends('layout.admin.app')

@section('title', 'Account')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-4">Edit Profile</h5>
                        <form action="{{ route('account.updateProfile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Foto Profil -->
                            <div class="mb-3 text-center">
                                <img src="{{ Auth::user()->profile ? asset('storage/' . Auth::user()->profile) : asset('./images/profile/user-1.jpg') }}"
                                    alt="Profile" class="rounded-circle mb-3"
                                    style="width: 100px; height: 100px; object-fit: cover;">

                                <div>
                                    <input type="file" name="profile" class="form-control">
                                    @error('profile')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                    class="form-control" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                    class="form-control" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-4">Ubah Password</h5>
                        <form action="{{ route('account.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Password Lama -->
                            <div class="mb-3">
                                <label class="form-label">Password Lama</label>
                                <input type="password" name="current_password" class="form-control" required>
                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Password Baru -->
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-warning">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('successDelete'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-danger border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successDelete') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session('successAdd'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successAdd') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session('successUpdate'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successUpdate') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

@endsection
