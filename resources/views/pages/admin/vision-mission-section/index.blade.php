@extends('layout.admin.app')
@section('title', 'Vision & Mission Section')
@section('content')
    <div>
        <div class="d-flex flex-column gap-2 mb-4 w-100 p-4 shadow rounded-4">
            <div>{!! $visionMissionSection->content !!}</div>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#updateService{{ $visionMissionSection->id }}">Ubah
            Section</button>
        <div class="modal fade" id="updateService{{ $visionMissionSection->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Section</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.vision-mission-section.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body px-4">
                            <input type="hidden" name="id" value="{{ $visionMissionSection->id }}">

                            <div class="mb-3">
                                <label for="content" class="form-label">Konten</label>
                                <div class="quill-editor" style="height: 250px;" data-target="content-update">
                                    {!! old('content', $visionMissionSection->content) !!}
                                </div>
                                <input type="hidden" name="content" id="content-update"
                                    value="{{ old('content', $visionMissionSection->content) }}">
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

            // Set initial content
            if (hiddenInput && hiddenInput.value) {
                quill.root.innerHTML = hiddenInput.value;
            }

            quillEditors.push({
                quill: quill,
                target: hiddenInput
            });
        });

        // Saat form submit, isi hidden input sesuai konten Quill
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
