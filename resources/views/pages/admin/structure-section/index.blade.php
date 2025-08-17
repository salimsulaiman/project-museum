@extends('layout.admin.app')
@section('title', 'Vision & Mission Section')
@section('content')
    <div>
        <div class="d-flex flex-column gap-4 mb-4 w-100">
            <h2>{{ $structureSection->title }}</h2>
            <img src="{{ $structureSection->image ? asset('storage/' . $structureSection->image) : asset('images/strukturorganisasi.jpg') }}"
                alt="Struktur Organisasi" class="w-100">
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#updateService{{ $structureSection->id }}">Ubah
            Section</button>
        <div class="modal fade" id="updateService{{ $structureSection->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Section</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.structure-section.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body px-4">
                            <input type="hidden" name="id" value="{{ $structureSection->id }}">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title', $structureSection->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                @if ($structureSection->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $structureSection->image) }}" alt="Preview"
                                            style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
                                    </div>
                                @endif
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti
                                    gambar.</small>
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
