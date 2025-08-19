@extends('layout.admin.app')
@section('title', 'Event')
@section('content')
    <div>
        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addEvent">Tambah
            Event +</button>
        <div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Event</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body px-4">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Gambar</label>
                                <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="event_category_id" class="form-label">Kategori</label>
                                <select id="event_category_id" name="event_category_id" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('event_category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="event_location_id" class="form-label">Lokasi</label>
                                <select id="event_location_id" name="event_location_id" class="form-control" required>
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach ($locations as $loc)
                                        <option value="{{ $loc->id }}"
                                            {{ old('event_location_id') == $loc->id ? 'selected' : '' }}>
                                            {{ $loc->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="location_detail" class="form-label">Detail Lokasi</label>
                                <input type="text" id="location_detail" name="location_detail" class="form-control"
                                    value="{{ old('location_detail') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Konten</label>
                                <div class="quill-editor" style="height: 250px;" data-target="content"></div>
                                <input type="hidden" name="content" id="content" value="{{ old('content') }}">
                            </div>

                            <div class="border-top border-bottom p-3 mb-3 border-secondary">
                                <p class="text-muted mb-3"><em>Field berikut bersifat opsional:</em></p>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="standing" class="form-label">Standing</label>
                                        <input type="number" id="standing" name="standing" class="form-control"
                                            value="{{ old('standing') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="classroom" class="form-label">Classroom</label>
                                        <input type="number" id="classroom" name="classroom" class="form-control"
                                            value="{{ old('classroom') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="round_table" class="form-label">Round Table</label>
                                        <input type="number" id="round_table" name="round_table" class="form-control"
                                            value="{{ old('round_table') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="u_shape" class="form-label">U-Shape</label>
                                        <input type="number" id="u_shape" name="u_shape" class="form-control"
                                            value="{{ old('u_shape') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="length" class="form-label">Panjang (m)</label>
                                    <input type="number" step="0.01" id="length" name="length"
                                        class="form-control" value="{{ old('length') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="width" class="form-label">Lebar (m)</label>
                                    <input type="number" step="0.01" id="width" name="width"
                                        class="form-control" value="{{ old('width') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="facility" class="form-label">Fasilitas</label>
                                <input type="text" id="facility" name="facility" class="form-control"
                                    value="{{ old('facility') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="max_participant" class="form-label">Maksimal Peserta</label>
                                <input type="number" id="max_participant" name="max_participant" class="form-control"
                                    value="{{ old('max_participant') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="contact" class="form-label">Kontak</label>
                                <input type="text" id="contact" name="contact" class="form-control"
                                    value="{{ old('contact') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="pic" class="form-label">PIC</label>
                                <input type="text" id="pic" name="pic" class="form-control"
                                    value="{{ old('pic') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="starting_date" class="form-label">Tanggal Mulai</label>
                                <input type="datetime-local" id="starting_date" name="starting_date"
                                    class="form-control" value="{{ old('starting_date') }}">
                            </div>

                            <div class="mb-3">
                                <label for="ending_date" class="form-label">Tanggal Berakhir</label>
                                <input type="datetime-local" id="ending_date" name="ending_date" class="form-control"
                                    value="{{ old('ending_date') }}">
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" id="status" name="status" class="form-check-input"
                                    value="1" {{ old('status') ? 'checked' : '' }}>
                                <label for="status" class="form-check-label">Aktif</label>
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
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Tanggal Mulai</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($events as $index => $event)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->category->name ?? '-' }}</td>
                        <td>
                            <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 8px;">
                                <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </td>
                        <td>{{ $event->starting_date ? $event->starting_date->format('d M Y H:i') : '-' }}</td>
                        <td>
                            @if ($event->status)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#updateEvent{{ $event->id }}">Edit</button>
                                <div class="modal fade" id="updateEvent{{ $event->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Edit Koleksi
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.events.update') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body px-4">
                                                    <input type="hidden" name="id" value="{{ $event->id }}">

                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Judul</label>
                                                        <input type="text" id="title" name="title"
                                                            class="form-control"
                                                            value="{{ old('title', $event->title) }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="thumbnail" class="form-label">Gambar</label>
                                                        @if ($event->thumbnail)
                                                            <div class="mb-2">
                                                                <img src="{{ asset('storage/' . $event->thumbnail) }}"
                                                                    alt="Preview"
                                                                    style="width:100px; height:100px; object-fit:cover; border-radius:8px;">
                                                            </div>
                                                        @endif
                                                        <input type="file" id="thumbnail" name="thumbnail"
                                                            class="form-control" accept="image/*">
                                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti
                                                            gambar.</small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="event_category_id" class="form-label">Kategori</label>
                                                        <select id="event_category_id" name="event_category_id"
                                                            class="form-control" required>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}"
                                                                    {{ old('event_category_id', $event->event_category_id) == $cat->id ? 'selected' : '' }}>
                                                                    {{ $cat->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="event_location_id" class="form-label">Lokasi</label>
                                                        <select id="event_location_id" name="event_location_id"
                                                            class="form-control" required>
                                                            @foreach ($locations as $loc)
                                                                <option value="{{ $loc->id }}"
                                                                    {{ old('event_location_id', $event->event_location_id) == $loc->id ? 'selected' : '' }}>
                                                                    {{ $loc->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="location_detail" class="form-label">Detail
                                                            Lokasi</label>
                                                        <input type="text" id="location_detail" name="location_detail"
                                                            class="form-control"
                                                            value="{{ old('location_detail', $event->location_detail) }}"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="content" class="form-label">Konten</label>
                                                        <div class="quill-editor" style="height: 250px;"
                                                            data-target="content-update">
                                                            {!! old('content', $event->content) !!}
                                                        </div>
                                                        <input type="hidden" name="content" id="content-update"
                                                            value="{{ old('content', $event->content) }}">
                                                    </div>

                                                    <div class="border-top border-bottom p-3 mb-3 border-secondary">
                                                        <p class="text-muted mb-3"><em>Field berikut bersifat
                                                                opsional:</em></p>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="standing" class="form-label">Standing</label>
                                                                <input type="number" id="standing" name="standing"
                                                                    class="form-control"
                                                                    value="{{ old('standing', $event->standing) }}">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="classroom"
                                                                    class="form-label">Classroom</label>
                                                                <input type="number" id="classroom" name="classroom"
                                                                    class="form-control"
                                                                    value="{{ old('classroom', $event->classroom) }}">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="round_table" class="form-label">Round
                                                                    Table</label>
                                                                <input type="number" id="round_table" name="round_table"
                                                                    class="form-control"
                                                                    value="{{ old('round_table', $event->round_table) }}">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="u_shape" class="form-label">U-Shape</label>
                                                                <input type="number" id="u_shape" name="u_shape"
                                                                    class="form-control"
                                                                    value="{{ old('u_shape', $event->u_shape) }}">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="length" class="form-label">Panjang (m)</label>
                                                            <input type="number" step="0.01" id="length"
                                                                name="length" class="form-control"
                                                                value="{{ old('length', $event->length) }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="width" class="form-label">Lebar (m)</label>
                                                            <input type="number" step="0.01" id="width"
                                                                name="width" class="form-control"
                                                                value="{{ old('width', $event->width) }}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="facility" class="form-label">Fasilitas</label>
                                                        <input type="text" id="facility" name="facility"
                                                            class="form-control"
                                                            value="{{ old('facility', $event->facility) }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="max_participant" class="form-label">Maksimal
                                                            Peserta</label>
                                                        <input type="number" id="max_participant" name="max_participant"
                                                            class="form-control"
                                                            value="{{ old('max_participant', $event->max_participant) }}"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="contact" class="form-label">Kontak</label>
                                                        <input type="text" id="contact" name="contact"
                                                            class="form-control"
                                                            value="{{ old('contact', $event->contact) }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="pic" class="form-label">PIC</label>
                                                        <input type="text" id="pic" name="pic"
                                                            class="form-control" value="{{ old('pic', $event->pic) }}"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="description" class="form-label">Deskripsi</label>
                                                        <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $event->description) }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="starting_date" class="form-label">Tanggal
                                                            Mulai</label>
                                                        <input type="datetime-local" id="starting_date"
                                                            name="starting_date" class="form-control"
                                                            value="{{ old('starting_date', $event->starting_date ? \Carbon\Carbon::parse($event->starting_date)->format('Y-m-d\TH:i') : '') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="ending_date" class="form-label">Tanggal
                                                            Berakhir</label>
                                                        <input type="datetime-local" id="ending_date" name="ending_date"
                                                            class="form-control"
                                                            value="{{ old('ending_date', $event->ending_date ? \Carbon\Carbon::parse($event->ending_date)->format('Y-m-d\TH:i') : '') }}">
                                                    </div>

                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" id="status" name="status"
                                                            class="form-check-input" value="1"
                                                            {{ old('status', $event->status) ? 'checked' : '' }}>
                                                        <label for="status" class="form-check-label">Aktif</label>
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
                                    data-bs-target="#deleteEvent{{ $event->id }}">Hapus</button>
                                <div class="modal fade" id="deleteEvent{{ $event->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Hapus Event
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.events.remove') }}">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body px-4">
                                                    <p class="py-4">Apakah anda yakin akan menghapus data ini?</p>
                                                    <input type="hidden" name="id" id="id"
                                                        value="{{ $event->id }}">
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
@section('script')
    <script>
        var toolbarOptions = [
            [{
                header: [1, 2, 3, false]
            }],
            ['bold', 'italic', 'underline'],
            [{
                list: 'ordered'
            }, {
                list: 'bullet'
            }],
            ['link'],
            ['clean']
        ];

        var quillEditors = [];

        document.querySelectorAll('.quill-editor').forEach(function(el) {
            var hiddenInput = el.parentElement.querySelector('input[type="hidden"]');

            var quill = new Quill(el, {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: toolbarOptions
                    }
                }
            });


            if (hiddenInput && hiddenInput.value) {
                quill.root.innerHTML = hiddenInput.value;
            }

            quillEditors.push({
                quill: quill,
                target: hiddenInput
            });
        });


        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                quillEditors.forEach(function(item) {
                    if (item.target) {
                        item.target.value = item.quill.root.innerHTML;
                    }
                });
            });
        });
    </script>
@endsection
