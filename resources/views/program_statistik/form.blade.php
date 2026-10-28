@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@php
    $contextQuery = '?program=' . urlencode($programSlug) . ($dokumentasiId ? '&dokumentasi=' . (int) $dokumentasiId : '');
    $formScope = $dokumentasiLabel ? 'Kegiatan ' . $dokumentasiLabel : 'Program ' . $programLabel;
@endphp

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/statistik{{ $contextQuery }}">Kelola Statistik</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }} {{ $formScope }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Form {{ $mode }} Statistik {{ $formScope }}</h5>
        <a href="/admin/program/statistik{{ $contextQuery }}" class="btn btn-outline-secondary"><i class="bi-arrow-left"></i> Kembali</a>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/program/statistik/add" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <input type="hidden" name="program" value="{{ old('program', $programSlug) }}"/>
                <input type="hidden" name="program_dokumentasi_id" value="{{ old('program_dokumentasi_id', $dokumentasiId) }}"/>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="bi-exclamation-triangle"></i> Data gagal disimpan. Periksa kembali:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Icon / Emoji</label>
                    <div class="col-sm-9">
                        <small class="text-muted d-block mb-2">Pilih emoji cepat, ketik emoji lain, atau upload gambar icon (PNG/SVG).</small>
                        @php
                            $currentIcon = old('icon', @$detail->icon);
                            $isImage = $currentIcon && strpos($currentIcon, '/') !== false;
                            $currentEmoji = $isImage ? '❤️' : ($currentIcon ?: '❤️');
                        @endphp
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div id="icon-preview-box" style="width:64px;height:64px;display:flex;align-items:center;justify-content:center;background:#f8f9fa;border:1px solid #dee2e6;border-radius:12px;font-size:34px;">
                                @if($isImage && file_exists(public_path(@$detail->icon)))
                                    <img id="icon-preview-img" src="{{ asset(@$detail->icon) }}" alt="icon" style="max-width:48px;max-height:48px;"/>
                                @else
                                    <span id="icon-preview-emoji">{{ $currentEmoji }}</span>
                                @endif
                            </div>
                            <div>
                                <input type="file" name="icon_file" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml,image/webp" style="display: none" id="iconFile"/>
                                <label class="btn btn-sm btn-outline-primary btn-upload" for="iconFile"><i class="bi-upload"></i> Upload Gambar Icon</label>
                                <div class="form-text">Upload hanya dipakai jika dipilih. Kosongkan untuk memakai emoji.</div>
                            </div>
                        </div>
                        <div class="mb-2 d-flex flex-wrap gap-1" id="emoji-quick">
                            @foreach(array_unique(['❤️','🤲','🙏','🕌','🎁','🌱','💚','✨','📚','🏫','🕋','💰','🤝','⭐','∞']) as $em)
                                <button type="button" class="btn btn-sm btn-outline-secondary emoji-pick" data-emoji="{{ $em }}">{{ $em }}</button>
                            @endforeach
                        </div>
                        <input type="text" class="form-control" name="icon" id="iconInput" value="{{ $currentEmoji }}" maxlength="255" placeholder="eg. ❤️ / 🕌 / 🎁 / 🌱"/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Angka / Nilai <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required name="angka_nilai" value="{{ old('angka_nilai', @$detail->angka_nilai) }}" placeholder="eg. 1000+ / 3+ / 100+ / ∞"/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Label / Judul <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required name="label_judul" value="{{ old('label_judul', @$detail->label_judul) }}" placeholder="eg. WAKIF &amp; DONATUR"/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Urutan Posisi</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="urutan" min="0" value="{{ old('urutan', @$detail->urutan) }}"/>
                        <small class="text-muted">Semakin kecil, semakin awal tampil.</small>
                    </div>
                </div>

                <hr class="mt-4"/>
                <button type="submit" class="btn btn-success"><i class="bi-save"></i> Simpan Statistik</button>
                <a href="/admin/program/statistik{{ $contextQuery }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function setIconPreview(emoji){
            $('#icon-preview-img').remove();
            if(!$('#icon-preview-emoji').length){
                $('#icon-preview-box').append('<span id="icon-preview-emoji"></span>');
            }
            $('#icon-preview-emoji').text(emoji);
        }
        $(document).on('click', '.emoji-pick', function(){
            var em = $(this).data('emoji');
            $('#iconInput').val(em);
            setIconPreview(em);
        });
        $('#iconInput').on('input', function(){
            setIconPreview($(this).val() || '⭐');
        });
        $('#iconFile').change(function(){
            const file = this.files[0];
            if(file){
                $('#icon-preview-emoji').remove();
                if(!$('#icon-preview-img').length){
                    $('#icon-preview-box').append('<img id="icon-preview-img" alt="icon" style="max-width:48px;max-height:48px;"/>');
                }
                $('#icon-preview-img').attr('src', URL.createObjectURL(file));
            }
        });
    </script>
@endpush
