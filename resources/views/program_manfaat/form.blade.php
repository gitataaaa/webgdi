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
        <li class="breadcrumb-item"><a href="/admin/program/manfaat{{ $contextQuery }}">Kelola Manfaat</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }} {{ $formScope }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Form {{ $mode }} Manfaat {{ $formScope }}</h5>
        <a href="/admin/program/manfaat{{ $contextQuery }}" class="btn btn-outline-secondary"><i class="bi-arrow-left"></i> Kembali</a>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/program/manfaat/add">
                @csrf
                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <input type="hidden" name="program" value="{{ old('program', $programSlug) }}"/>
                <input type="hidden" name="program_dokumentasi_id" value="{{ old('program_dokumentasi_id', $dokumentasiId) }}"/>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="bi bi-exclamation-triangle"></i> Data gagal disimpan. Periksa kembali:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Judul Manfaat <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" required name="judul" value="{{ old('judul', @$detail->judul) }}" placeholder="eg. Pahala Jariyah Berkelanjutan"/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" required name="deskripsi" rows="5" placeholder="Penjelasan manfaat...">{{ old('deskripsi', @$detail->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Link YouTube</label>
                    <div class="col-sm-9">
                        <input type="url" class="form-control" name="youtube_url" value="{{ old('youtube_url', @$detail->youtube_url) }}" placeholder="eg. https://www.youtube.com/watch?v=xxxxxxxxxxx"/>
                        <small class="text-muted">URL video YouTube terkait manfaat ini. Kosongkan bila belum ada.</small>
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
                <button type="submit" class="btn btn-success"><i class="bi-save"></i> Simpan Manfaat</button>
                <a href="/admin/program/manfaat{{ $contextQuery }}" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
