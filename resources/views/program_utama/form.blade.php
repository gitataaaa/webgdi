@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/implementasi">Program Implementasi</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/utama">Program Utama</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h5 class="mb-0">Form {{ $mode }} Program Utama</h5>
        <a href="/admin/program/utama" class="btn btn-sm btn-outline-secondary">
            <i class="bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <form method="post" action="/admin/program/utama/add" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ @$detail->id }}"/>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Data gagal disimpan:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Nama Program <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="nama_program" value="{{ old('nama_program', @$detail->nama_program) }}" placeholder="eg. Budaya">
                    @if(@$detail->slug)
                        <div class="form-text">Slug: <code>{{ $detail->slug }}</code> (dipakai untuk dokumentasi program).</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    @php
                        $logoUrl = @$detail->logo_image && file_exists(public_path(@$detail->logo_image))
                            ? asset(@$detail->logo_image)
                            : asset('admin/assets/img/setting/_img.jpg');
                    @endphp
                    <div class="d-flex align-items-center gap-3">
                        <img id="logo_preview" src="{{ $logoUrl }}" class="program-utama-preview" alt="logo"/>
                        <div>
                            <input type="file" name="logo_image" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml,image/webp" style="display: none" id="logoFile"/>
                            <label class="btn btn-sm btn-outline-primary" for="logoFile"><i class="bi-upload"></i> Pilih Logo</label>
                            <div class="form-text">PNG/SVG disarankan, maks 2MB.</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success"><i class="bi-save"></i> Simpan</button>
                    <a href="/admin/program/utama" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .program-utama-preview {
            width: 96px;
            height: 96px;
            object-fit: contain;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 6px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('#logoFile').change(function(){
            const file = this.files[0];
            if(file){
                $('#logo_preview').attr('src', URL.createObjectURL(file));
            }
        });
    </script>
@endpush
