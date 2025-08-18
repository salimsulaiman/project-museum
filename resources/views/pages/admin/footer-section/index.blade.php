@extends('layout.admin.app')
@section('title', 'Footer Section')
@section('content')
    <div>
        <div class="d-flex align-items-start flex-column gap-4 mb-4">
            <div class="d-flex align-items-center gap-2">
                <h2 class="">{{ $footerSection->title }}</h2>
                <button class="btn btn-success rounded-circle p-2 d-flex align-items-center justify-content-center"
                    data-bs-toggle="modal" data-bs-target="#updateNavTitle{{ $footerSection->id }}">
                    <i class="ti ti-pencil fs-5 text-white"></i>
                </button>
            </div>

            <img src="{{ $footerSection->logo ? asset('storage/' . $footerSection->logo) : asset('images/logo.png') }}"
                alt="Logo {{ $footerSection->title }}" class="img-fluid" style="max-height: 60px;">

            <p class="text-muted">{{ $footerSection->address }}</p>

            <div class="modal fade" id="updateNavTitle{{ $footerSection->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Edit Navigasi
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.footer-section.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body px-4">
                                <input type="hidden" name="id" value="{{ $footerSection->id }}">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Footer</label>
                                    <input type="text" required id="title" name="title"
                                        value="{{ $footerSection->title }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    @if ($footerSection->logo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $footerSection->logo) }}" alt="Preview"
                                                style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
                                        </div>
                                    @endif
                                    <input type="file" id="logo" name="logo" class="form-control"
                                        accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti
                                        logo.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea id="address" name="address" rows="3" class="form-control">{{ $footerSection->address }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addNavigation">Tambah
            Navigasi +</button>
        <div class="modal fade" id="addNavigation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Navigasi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.footer-links.store') }}">
                        @csrf
                        <div class="modal-body px-4">

                            <div class="mb-3">
                                <label for="navigation" class="form-label">Navigasi</label>
                                <input type="text" required id="navigation" name="navigation" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="href" class="form-label">URL</label>
                                <input type="text" required id="href" name="href" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Navigation</th>
                    <th>Url</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($footerSection->details as $index => $detail)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $detail->navigation }}</td>
                        <td>{{ $detail->href }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#updateNavigation{{ $detail->id }}">Edit</button>
                                <div class="modal fade" id="updateNavigation{{ $detail->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Edit Navigasi
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.footer-links.update') }}">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body px-4">
                                                    <input type="hidden" name="id" value="{{ $detail->id }}">
                                                    <div class="mb-3">
                                                        <label for="navigation" class="form-label">Navigasi</label>
                                                        <input type="text" required id="navigation" name="navigation"
                                                            value="{{ $detail->navigation }}" class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="href" class="form-label">URL</label>
                                                        <input type="text" required id="href" name="href"
                                                            value="{{ $detail->href }}" class="form-control">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteNavigation{{ $detail->id }}">Hapus</button>
                                <div class="modal fade" id="deleteNavigation{{ $detail->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Hapus Navigasi
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.footer-links.remove') }}">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body px-4">
                                                    <p class="py-4">Apakah anda yakin akan menghapus data ini?</p>
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $detail->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

    @if ($errors->any())
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toast" class="toast align-items-center text-white bg-danger border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
@endsection
