@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/galeri">Kelola Galeri</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Form {{ $mode }} Foto Galeri</h5>
        <a href="/admin/program/galeri" class="btn btn-outline-secondary"><i class="bi-arrow-left"></i> Kembali</a>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/program/galeri/add" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ @$detail->id }}"/>

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
                    <label class="col-sm-3 col-form-label">Foto <span class="text-danger">{{ @$detail->id ? '' : '*' }}</span></label>
                    <div class="col-sm-9">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            @php
                                $imgUrl = @$detail->gambar_url && file_exists(public_path(@$detail->gambar_url)) ? asset(@$detail->gambar_url) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="galeri-preview" src="{{ $imgUrl }}" style="max-width:160px;border:1px solid #dee2e6;border-radius:6px;"/>
                            <div>
                                <input type="file" name="gambar_url" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml,image/webp" style="display: none" id="galeri-file"/>
                                <label class="btn btn-sm btn-outline-primary" for="galeri-file"><i class="bi-upload"></i> Pilih Foto</label>
                                <div class="form-text">Kosongkan saat edit jika tidak ingin mengganti foto.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Keterangan (Caption)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan', @$detail->keterangan) }}" placeholder="eg. Penyaluran manfaat wakaf"/>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Alt Text</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="alt_text" value="{{ old('alt_text', @$detail->alt_text) }}" placeholder="eg. Penyaluran manfaat wakaf untuk masyarakat"/>
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
                <button type="submit" class="btn btn-success"><i class="bi-save"></i> Simpan Foto Galeri</button>
                <a href="/admin/program/galeri" class="btn btn-outline-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $('#galeri-file').change(function(){
            var file = this.files[0];
            if(file){ $('#galeri-preview').attr('src', URL.createObjectURL(file)); }
        });
    </script>
@endpush
