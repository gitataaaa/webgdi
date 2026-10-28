@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/implementasi">Program Implementasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Form {{ $mode }} Program Implementasi</h5>
    <a href="/admin/program/implementasi" class="btn btn-primary"><i class="bi-arrow-left-square"></i> Kembali</a>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/program/implementasi/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama Program *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" required name="nama_program" value="{{ @$detail->nama_program }}" placeholder="eg. Budaya">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">URL Program</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="url_program" value="{{ @$detail->url_program }}" placeholder="eg. /budaya atau https://...">
                        <small class="text-muted">Halaman tujuan saat tile diklik di homepage (mis. <code>/budaya</code> atau URL lengkap). Kosongkan bila tile tidak diarahkan ke halaman manapun.</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Logo Image *</label>
                    <div class="col-sm-10">
                        {{-- kotak preview: logo tampil utuh (tidak terpotong) --}}
                        <div class="logo-preview-box">
                            @php
                                $imgUrl = @$detail->logo_image ? asset(@$detail->logo_image) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="logo_image" src="{{ $imgUrl }}" alt="Preview Logo"/>
                        </div>

                        {{-- teks rekomendasi + tombol upload tersusun vertikal --}}
                        <div class="logo-upload-actions">
                            <div class="logo-upload-hint">Ukuran yang disarankan: 280 x 280 px (png)</div>
                            <input type="file" name="logo_image" style="display: none" id="logoImg" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml,image/webp"/>
                            <label class="btn btn-primary btn-upload" for="logoImg"><i class="bi-upload"></i> Upload</label>
                        </div>
                    </div>
                </div>

                <hr/>
                <button type="submit" class="btn btn-success"><i class="bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* kotak preview logo: dinamis, fleksibel, logo tampil penuh tanpa terpotong */
    .logo-preview-box {
        width: 100%;
        max-width: 280px;
        aspect-ratio: 1 / 1;
        padding: 16px;
        background: #ffffff;
        border: 1px solid #e6ebe8;
        border-radius: 14px;
        box-shadow: 0 1px 5px rgba(23, 58, 42, .08);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .logo-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }

    /* teks rekomendasi + tombol upload tersusun vertikal dengan jarak proporsional */
    .logo-upload-actions {
        margin-top: 16px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .logo-upload-hint {
        color: #6b7a75;
        font-size: 13px;
    }
</style>
@endpush

@push('scripts')
    <script>
        /* preview gambar saat memilih file (pola sama dengan form slider) */
        $('#logoImg').change(function(){
            const file = this.files[0];
            if(file){
                $('#logo_image').attr('src', URL.createObjectURL(file));
            }
        });
    </script>
@endpush
