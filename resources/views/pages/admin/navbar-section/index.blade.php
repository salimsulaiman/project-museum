@extends('layout.admin.app')
@section('title', 'Navbar Section')
@section('content')
    <div>
        <div class="gap-2 mb-4 d-flex align-items-center">
            <img src="{{ $navbarSection->logo ? asset('storage/' . $navbarSection->logo) : asset('images/logo.png') }}"
                class="" style="width: 250px" alt="Logo">
            <button class="p-2 btn btn-success rounded-circle d-flex align-items-center justify-content-center"
                data-bs-toggle="modal" data-bs-target="#updateNavTitle{{ $navbarSection->id }}">
                <i class="text-white ti ti-pencil fs-5"></i>
            </button>
            <div class="modal fade" id="updateNavTitle{{ $navbarSection->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Edit Navigasi
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.navbar-section.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="px-4 modal-body">
                                <input type="hidden" name="id" value="{{ $navbarSection->id }}">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Logo</label>
                                    @if ($navbarSection->logo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $navbarSection->logo) }}" alt="Preview"
                                                style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
                                        </div>
                                    @endif
                                    <input type="file" id="image" name="image" class="form-control"
                                        accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti
                                        logo.</small>
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
        <button type="button" class="mb-4 btn btn-success" data-bs-toggle="modal" data-bs-target="#addNavigation">Tambah
            Navigasi +</button>
        <div class="modal fade" id="addNavigation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Navigasi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.navbar-links.store') }}">
                        @csrf
                        <div class="px-4 modal-body">

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
                @foreach ($navbarSection->links as $index => $link)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $link->navigation }}</td>
                        <td>{{ $link->href }}</td>
                        <td>
                            <div class="gap-2 d-flex">
                                <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#updateNavigation{{ $link->id }}">Edit</button>
                                <div class="modal fade" id="updateNavigation{{ $link->id }}" tabindex="-1"
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
                                            <form method="POST" action="{{ route('admin.navbar-links.update') }}">
                                                @csrf
                                                @method('put')
                                                <div class="px-4 modal-body">
                                                    <input type="hidden" name="id" value="{{ $link->id }}">
                                                    <div class="mb-3">
                                                        <label for="navigation" class="form-label">Navigasi</label>
                                                        <input type="text" required id="navigation" name="navigation"
                                                            value="{{ $link->navigation }}" class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="href" class="form-label">URL</label>
                                                        <input type="text" required id="href" name="href"
                                                            value="{{ $link->href }}" class="form-control">
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
                                    data-bs-target="#deleteNavigation{{ $link->id }}">Hapus</button>
                                <div class="modal fade" id="deleteNavigation{{ $link->id }}" tabindex="-1"
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
                                            <form method="POST" action="{{ route('admin.navbar-links.remove') }}">
                                                @csrf
                                                @method('delete')
                                                <div class="px-4 modal-body">
                                                    <p class="py-4">Apakah anda yakin akan menghapus data ini?</p>
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $link->id }}">
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
        <div class="bottom-0 p-3 position-fixed end-0" style="z-index: 11">
            <div id="toast" class="text-white border-0 toast align-items-center bg-danger show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successDelete') }}
                    </div>
                    <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session('successAdd'))
        <div class="bottom-0 p-3 position-fixed end-0" style="z-index: 11">
            <div id="toast" class="text-white border-0 toast align-items-center bg-success show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successAdd') }}
                    </div>
                    <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session('successUpdate'))
        <div class="bottom-0 p-3 position-fixed end-0" style="z-index: 11">
            <div id="toast" class="text-white border-0 toast align-items-center bg-success show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('successUpdate') }}
                    </div>
                    <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="bottom-0 p-3 position-fixed end-0" style="z-index: 11">
            <div id="toast" class="text-white border-0 toast align-items-center bg-danger show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                    <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
@endsection
