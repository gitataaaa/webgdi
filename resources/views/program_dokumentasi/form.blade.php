@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/dokumentasi">Dokumentasi Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Program Implementasi {{ $programLabel }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h5 class="mb-0">Program Implementasi {{ $programLabel }}</h5>
        <a href="/admin/program/dokumentasi?program={{ urlencode($programSlug) }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card dokumentasi-form-card">
        <div class="card-body">
            <form id="formDokumentasi" method="post" action="/admin/program/dokumentasi/add" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <input type="hidden" name="program" value="{{ old('program', $programSlug) }}"/>

                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <strong>Data gagal disimpan:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 1. Judul kegiatan --}}
                <div class="mb-3">
                    <label class="form-label" for="judul_kegiatan">Judul Kegiatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control {{ (isset($errors) && $errors->has('judul_kegiatan')) ? 'is-invalid' : '' }}" required id="judul_kegiatan" name="judul_kegiatan" value="{{ old('judul_kegiatan', @$detail->judul_kegiatan) }}" placeholder="eg. Wakaf &amp; Hibah">
                    @if(isset($errors) && $errors->has('judul_kegiatan'))<div class="invalid-feedback">{{ $errors->first('judul_kegiatan') }}</div>@endif
                </div>

                {{-- 2. Foto kegiatan: preview utuh, tidak terpotong --}}
                <div class="mb-3">
                    <label class="form-label" for="gambarImg">Foto Kegiatan <span class="text-danger">*</span></label>
                    @php
                        $fallbackProgram = in_array($programSlug, ['budaya', 'cinta', 'senyum']) ? $programSlug : 'budaya';
                        $imgUrl = @$detail->gambar_url && file_exists(public_path(@$detail->gambar_url))
                            ? asset(@$detail->gambar_url)
                            : asset('website/assets/images/custom/' . $fallbackProgram . '.png');
                    @endphp
                    <div class="dokumentasi-foto-field">
                        <div class="dokumentasi-preview-box">
                            <img id="gambar_preview" src="{{ $imgUrl }}" alt="Preview foto kegiatan"/>
                        </div>
                        <div class="dokumentasi-foto-actions">
                            <div class="dokumentasi-foto-hint">Rasio 3:2, maks 4MB. Foto tampil utuh tanpa terpotong.</div>
                            <input type="file" name="gambar_url" accept="image/png,image/jpeg,image/jpg,image/gif,image/svg+xml,image/webp" style="display: none" id="gambarImg"/>
                            <label class="btn btn-sm btn-outline-primary" for="gambarImg"><i class="bi-upload"></i> Pilih Foto</label>
                        </div>
                    </div>
                </div>

                {{-- 3. Link detail --}}
                <div class="mb-3">
                    <label class="form-label" for="link_detail">Link Detail</label>
                    <input type="url" class="form-control" id="link_detail" name="link_detail" value="{{ old('link_detail', @$detail->link_detail) }}" placeholder="https://example.com/kegiatan">
                </div>

                {{-- 4. Urutan --}}
                <div class="mb-3">
                    <label class="form-label" for="urutan">Urutan</label>
                    <input type="number" class="form-control" id="urutan" name="urutan" value="{{ old('urutan', @$detail->urutan ?? 0) }}" min="0" placeholder="0">
                    <div class="form-text">Semakin kecil tampil paling depan.</div>
                </div>

                <hr class="my-4"/>

                {{-- 3 kotak terpisah: Tujuan, Sasaran, Ashnaf --}}
                <h6 class="dokumentasi-section-title mb-3">Tujuan, Sasaran &amp; Ashnaf</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="dokumentasi-subcard">
                            <label class="form-label" for="tujuan">Tujuan</label>
                            <textarea class="form-control" id="tujuan" name="tujuan" rows="4" placeholder="Tuliskan tujuan kegiatan...">{{ old('tujuan', @$detail->tujuan) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dokumentasi-subcard">
                            <label class="form-label" for="sasaran">Sasaran</label>
                            <textarea class="form-control" id="sasaran" name="sasaran" rows="4" placeholder="Tuliskan sasaran kegiatan...">{{ old('sasaran', @$detail->sasaran) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dokumentasi-subcard">
                            <label class="form-label" for="ashnaf">Ashnaf</label>
                            @php
                                $ashnafOptions = ['Fakir', 'Miskin', 'Amil', 'Mualaf', 'Riqab', 'Gharim', 'Fisabilillah', 'Ibnu Sabil'];
                            @endphp
                            <input type="text" class="form-control" id="ashnaf" name="ashnaf" list="ashnafOptions" value="{{ old('ashnaf', @$detail->ashnaf) }}" placeholder="Pilih ashnaf...">
                            <datalist id="ashnafOptions">
                                @foreach($ashnafOptions as $asnaf)
                                    <option value="{{ $asnaf }}"></option>
                                @endforeach
                            </datalist>
                            <div class="form-text">Bisa dipilih dari daftar atau diketik manual.</div>
                        </div>
                    </div>
                </div>

                <hr class="my-4"/>

                <h6 class="dokumentasi-section-title mb-3">Informasi Tambahan</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="kategori_badge">Kategori (Badge)</label>
                        <input type="text" class="form-control" id="kategori_badge" name="kategori_badge" value="{{ old('kategori_badge', @$detail->kategori_badge) }}" placeholder="eg. WAKAF, QURBAN, DAKWAH">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="youtube_url">Link YouTube</label>
                        <input type="url" class="form-control" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', @$detail->youtube_url) }}" placeholder="https://www.youtube.com/watch?v=xxxxxxxxxxx">
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="deskripsi_video">Deskripsi Video</label>
                        <textarea class="form-control" id="deskripsi_video" name="deskripsi_video" rows="3" placeholder="Keterangan singkat tentang video YouTube...">{{ old('deskripsi_video', @$detail->deskripsi_video) }}</textarea>
                    </div>
                </div>

                {{-- Tombol aksi sejajar di bawah form --}}
                <div class="dokumentasi-form-actions">
                    <a href="/admin/program/dokumentasi?program={{ urlencode($programSlug) }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-success"><i class="bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .dokumentasi-form-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 1px 6px rgba(16, 24, 40, .05);
        }
        .dokumentasi-form-card .card-body {
            padding: 1.5rem;
        }
        .dokumentasi-form-card .form-label {
            font-size: .875rem;
            font-weight: 600;
            margin-bottom: .35rem;
        }
        .dokumentasi-form-card .form-text {
            font-size: .78rem;
        }
        .dokumentasi-section-title {
            color: #6b7a75;
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        /* kotak preview foto: rasio tetap, gambar tampil utuh (tidak terpotong) */
        .dokumentasi-foto-field {
            align-items: flex-start;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .dokumentasi-preview-box {
            align-items: center;
            aspect-ratio: 3 / 2;
            background: #ffffff;
            border: 1px solid #e6ebe8;
            border-radius: 12px;
            box-shadow: 0 1px 5px rgba(23, 58, 42, .08);
            display: flex;
            justify-content: center;
            max-width: 280px;
            overflow: hidden;
            padding: 10px;
            width: 100%;
        }
        .dokumentasi-preview-box img {
            display: block;
            height: 100%;
            object-fit: contain;
            width: 100%;
        }
        .dokumentasi-foto-actions {
            align-items: flex-start;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .dokumentasi-foto-hint {
            color: #6b7a75;
            font-size: .78rem;
        }

        /* 3 kotak terpisah untuk Tujuan, Sasaran, Ashnaf */
        .dokumentasi-subcard {
            background: #fbfcfb;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            height: 100%;
            padding: 1rem;
        }
        .dokumentasi-subcard textarea {
            resize: vertical;
        }

        /* tombol Simpan/Batal sejajar di bagian bawah form */
        .dokumentasi-form-actions {
            align-items: center;
            border-top: 1px solid #e9ecef;
            display: flex;
            gap: .5rem;
            justify-content: flex-end;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){
            /* preview foto sebelum diunggah */
            $('#gambarImg').change(function(){
                const file = this.files[0];
                if(file){
                    $('#gambar_preview').attr('src', URL.createObjectURL(file));
                }
            });
        });
    </script>
@endpush
