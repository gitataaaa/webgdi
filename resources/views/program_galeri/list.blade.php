@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Galeri {{ $dokumentasiLabel ?: 'Program ' . $programLabel }}</li>
    </ol>
@endsection

@section('content')
@php
    $formatBytes = function ($bytes) {
        $bytes = max(0, (int) $bytes);
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1, ',', '.') . ' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 0, ',', '.') . ' KB';
        }
        return $bytes . ' B';
    };
    $totalSize = $totalSize ?? 0;
    $galeriCount = $galeri->count();
@endphp
<div class="container">
    @include('program_partials.header', [
        'heading' => 'Galeri ' . ($dokumentasiLabel ? 'Kegiatan ' . $dokumentasiLabel : 'Program ' . $programLabel),
        'activeTab' => 'galeri',
    ])

    <div class="card galeri-card">
        <div class="card-body">
            {{-- Ringkasan galeri --}}
            <div class="galeri-head">
                <div>
                    <h6 class="galeri-head__title">Galeri Foto</h6>
                    <p class="galeri-head__sub">
                        Foto yang diunggah di sini tampil pada halaman
                        {{ $dokumentasiLabel ? 'kegiatan' : 'program' }} terkait.
                    </p>
                </div>
                <div class="galeri-stats">
                    <div class="galeri-stat">
                        <span class="galeri-stat__icon"><i class="bi bi-images"></i></span>
                        <div>
                            <span class="galeri-stat__value" id="galeriCount">{{ $galeriCount }}</span>
                            <span class="galeri-stat__label">Jumlah Foto</span>
                        </div>
                    </div>
                    <div class="galeri-stat">
                        <span class="galeri-stat__icon galeri-stat__icon--alt"><i class="bi bi-hdd-stack"></i></span>
                        <div>
                            <span class="galeri-stat__value" id="galeriSize">{{ $formatBytes($totalSize) }}</span>
                            <span class="galeri-stat__label">Total Ukuran</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Area drag & drop --}}
            <div class="galeri-dropzone" id="galeriDropzone">
                <input type="file" id="galeriInput" accept="image/png,image/jpeg,image/jpg,image/gif,image/webp" multiple hidden/>

                <span class="galeri-dropzone__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 18a4.5 4.5 0 0 1-.5-8.97A6 6 0 0 1 18.1 9.6 4.2 4.2 0 0 1 18 18h-1"/>
                        <path d="M12 12v7"/>
                        <path d="m9 15 3-3 3 3"/>
                    </svg>
                </span>

                <p class="galeri-dropzone__text">
                    Drag &amp; Drop your files here or <span class="galeri-browse">Browse Files</span>
                </p>
                <p class="galeri-dropzone__hint">Min size 150 x 150. Max filesize 5MB.</p>

                <div class="galeri-dropzone__formats">
                    <span class="galeri-format">JPG</span>
                    <span class="galeri-format">PNG</span>
                    <span class="galeri-format">GIF</span>
                    <span class="galeri-format">WEBP</span>
                </div>
                <p class="galeri-dropzone__note">
                    Foto yang dipilih masuk daftar pratinjau dulu. Tekan <strong>Simpan</strong> di bagian bawah untuk mengunggahnya, lalu klik <strong>Edit</strong> pada foto untuk mengisi keterangan &amp; alt text.
                </p>

                {{-- progress unggah --}}
                <div class="galeri-progress" id="galeriProgress" aria-hidden="true">
                    <span class="galeri-progress__bar" id="galeriProgressBar"></span>
                </div>
                <p class="galeri-status" id="galeriStatus" aria-live="polite"></p>
            </div>

            {{-- Foto baru yang menunggu disimpan --}}
            <div class="galeri-pending" id="galeriPending" hidden>
                <div class="galeri-pending__head">
                    <h6 class="mb-0">Foto Siap Disimpan</h6>
                    <span class="badge bg-light text-dark border"><span id="galeriPendingCount">0</span> foto dipilih</span>
                </div>
                <div class="galeri-pending__grid" id="galeriPendingGrid"></div>
            </div>

            {{-- Daftar thumbnail --}}
            <div class="galeri-toolbar">
                <h6 class="mb-0">Foto Galeri</h6>
                <span class="galeri-toolbar__hint"><i class="bi bi-info-circle"></i> Klik foto untuk melihat ukuran penuh &middot; tombol Edit untuk keterangan</span>
            </div>

            <div class="galeri-grid" id="galeriGrid">
                @foreach($galeri as $g)
                    @php
                        $filePath = $g->gambar_url ? public_path($g->gambar_url) : null;
                        $fileSize = $filePath && is_file($filePath) ? filesize($filePath) : 0;
                    @endphp
                    <div class="galeri-thumb" data-id="{{ $g->id }}" data-size="{{ $fileSize }}"
                         data-keterangan="{{ $g->keterangan }}" data-alt="{{ $g->alt_text }}">
                        <a href="{{ asset($g->gambar_url) }}" target="_blank" rel="noopener" class="galeri-thumb__link"
                           style="animation-delay: {{ min($loop->index, 14) * 35 }}ms" title="Lihat foto">
                            <img src="{{ asset($g->gambar_url) }}" loading="lazy"
                                 alt="{{ $g->alt_text ?: ($g->keterangan ?: 'Foto galeri') }}"/>
                            <span class="galeri-thumb__overlay"><i class="bi bi-arrows-fullscreen"></i> Lihat foto</span>
                            <span class="galeri-thumb__size">{{ $formatBytes($fileSize) }}</span>
                            @if($g->keterangan)
                                <span class="galeri-thumb__caption">{{ $g->keterangan }}</span>
                            @endif
                        </a>
                        <button type="button" class="galeri-thumb__edit btn-edit-photo" data-id="{{ $g->id }}"
                                title="Edit keterangan &amp; alt text"><i class="bi bi-pencil"></i><span>Edit</span></button>
                        <button type="button" class="galeri-thumb__remove btn-del-photo" data-id="{{ $g->id }}" title="Hapus foto">&times;</button>
                    </div>
                @endforeach
            </div>

            <div class="galeri-empty" id="galeriEmpty" @if($galeriCount) style="display:none" @endif>
                <i class="bi bi-images"></i>
                <p class="mb-2">Belum ada foto untuk {{ $dokumentasiLabel ? 'kegiatan ini' : 'program ini' }}. Unggah foto melalui area di atas.</p>
                <button type="button" class="galeri-empty__cta">
                    <i class="bi bi-cloud-arrow-up"></i> Pilih Foto
                </button>
            </div>

            {{-- Tombol simpan di bagian bawah --}}
            <div class="galeri-savebar">
                <p class="galeri-savebar__info" id="galeriSaveInfo">
                    <i class="bi bi-info-circle"></i> Belum ada foto baru dipilih.
                </p>
                <button type="button" class="btn btn-success px-4" id="galeriSaveBtn" disabled>
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>

    {{-- Modal edit keterangan & alt text --}}
    <div class="modal fade" id="galeriEditModal" tabindex="-1" aria-labelledby="galeriEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content galeri-modal">
                <form id="galeriEditForm">
                    <div class="modal-header">
                        <h6 class="modal-title" id="galeriEditLabel"><i class="bi bi-pencil-square"></i> Edit Info Foto</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="galeri-modal__preview">
                            <img id="galeriEditPreview" src="" alt="Pratinjau foto"/>
                        </div>

                        <input type="hidden" id="galeriEditId"/>

                        <div class="mb-3">
                            <label class="form-label" for="galeriEditKeterangan">Keterangan <span class="text-muted fw-normal">(caption)</span></label>
                            <input type="text" class="form-control" id="galeriEditKeterangan" maxlength="255"
                                   placeholder="Contoh: Penyaluran bantuan sembako"/>
                            <div class="galeri-modal__hint">Tampil sebagai caption pada foto di halaman program.</div>
                        </div>

                        <div>
                            <label class="form-label" for="galeriEditAlt">Alt text</label>
                            <input type="text" class="form-control" id="galeriEditAlt" maxlength="255"
                                   placeholder="Deskripsi singkat foto untuk pembaca layar"/>
                            <div class="galeri-modal__hint">Dipakai untuk aksesibilitas dan SEO gambar.</div>
                        </div>

                        <p class="galeri-modal__error" id="galeriEditError" hidden></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success px-4" id="galeriEditSubmit">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .galeri-card {
            border: 1px solid #e9ecef;
            border-radius: 16px;
            box-shadow: 0 2px 14px rgba(16, 24, 40, .05);
        }
        .galeri-card .card-body {
            padding: 1.5rem;
        }

        /* ============ Ringkasan ============ */
        .galeri-head {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .galeri-head__title {
            color: #143a2c;
            font-weight: 800;
            margin: 0 0 3px;
        }
        .galeri-head__sub {
            color: #78838f;
            font-size: 13px;
            margin: 0;
        }
        .galeri-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .galeri-stat {
            align-items: center;
            background: #f8fafc;
            border: 1px solid #eef2f5;
            border-radius: 12px;
            display: flex;
            gap: 10px;
            min-width: 138px;
            padding: 8px 14px;
        }
        .galeri-stat__icon {
            align-items: center;
            background: #e7f5ee;
            border-radius: 10px;
            color: #198754;
            display: flex;
            font-size: 16px;
            height: 34px;
            justify-content: center;
            width: 34px;
        }
        .galeri-stat__icon--alt {
            background: #eef4ff;
            color: #3563e9;
        }
        .galeri-stat__value {
            color: #143a2c;
            display: block;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.15;
        }
        .galeri-stat__label {
            color: #8a94a6;
            display: block;
            font-size: 11px;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        /* ============ Dropzone ============ */
        .galeri-dropzone {
            background: linear-gradient(180deg, #f3fbf7 0%, #eef9f3 100%);
            border: 2px dashed #a7dcc0;
            border-radius: 16px;
            cursor: pointer;
            padding: 34px 24px;
            text-align: center;
            transition: background .2s ease, border-color .2s ease, box-shadow .2s ease;
        }
        .galeri-dropzone:hover,
        .galeri-dropzone.is-dragover {
            background: linear-gradient(180deg, #eaf8f1 0%, #e0f4e9 100%);
            border-color: #34a56f;
            box-shadow: 0 0 0 4px rgba(52, 165, 111, .12);
        }
        .galeri-dropzone.is-uploading {
            cursor: progress;
            pointer-events: none;
        }
        .galeri-dropzone__icon {
            align-items: center;
            background: #d9f2e5;
            border-radius: 50%;
            color: #198754;
            display: flex;
            height: 58px;
            justify-content: center;
            margin: 0 auto 16px;
            transition: transform .2s ease;
            width: 58px;
        }
        .galeri-dropzone:hover .galeri-dropzone__icon {
            transform: translateY(-2px);
        }
        .galeri-dropzone__icon svg {
            height: 28px;
            width: 28px;
        }
        .galeri-dropzone__text {
            color: #14532d;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 6px;
        }
        .galeri-browse {
            color: #157347;
            font-weight: 800;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .galeri-dropzone__hint {
            color: #7b8794;
            font-size: 13px;
            margin: 0;
        }
        .galeri-dropzone__formats {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: center;
            margin-top: 12px;
        }
        .galeri-format {
            background: #ffffff;
            border: 1px solid #d6ebdf;
            border-radius: 999px;
            color: #157347;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .6px;
            padding: 2px 9px;
        }
        .galeri-dropzone__note {
            color: #8a94a6;
            font-size: 12px;
            margin: 10px 0 0;
        }
        .galeri-progress {
            background: #dcefe4;
            border-radius: 999px;
            display: none;
            height: 8px;
            margin: 16px auto 0;
            max-width: 420px;
            overflow: hidden;
        }
        .galeri-progress.is-active {
            display: block;
        }
        .galeri-progress__bar {
            background: linear-gradient(90deg, #34a56f, #198754);
            border-radius: 999px;
            display: block;
            height: 100%;
            transition: width .18s ease;
            width: 0;
        }
        .galeri-status {
            color: #157347;
            font-size: 13px;
            font-weight: 600;
            margin: 10px 0 0;
            min-height: 18px;
        }

        /* ============ Thumbnail ============ */
        .galeri-toolbar {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: space-between;
            margin: 26px 0 14px;
        }
        .galeri-toolbar h6 {
            color: #143a2c;
            font-weight: 800;
        }
        .galeri-toolbar__hint {
            color: #94a3b8;
            font-size: 12px;
        }
        .galeri-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        }
        .galeri-thumb {
            aspect-ratio: 1 / 1;
            background: #ffffff;
            border: 1px solid #eef2f5;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(16, 24, 40, .06);
            overflow: hidden;
            position: relative;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }
        .galeri-thumb:hover {
            border-color: #cfe9da;
            box-shadow: 0 12px 26px rgba(16, 24, 40, .12);
            transform: translateY(-3px);
        }
        .galeri-thumb__link {
            animation: galeriFade .45s ease both;
            display: block;
            height: 100%;
            position: relative;
            width: 100%;
        }
        @keyframes galeriFade {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .galeri-thumb img {
            display: block;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
            width: 100%;
        }
        .galeri-thumb:hover img {
            transform: scale(1.06);
        }
        .galeri-thumb__overlay {
            align-items: center;
            background: rgba(15, 23, 42, .5);
            color: #ffffff;
            display: flex;
            font-size: 12px;
            font-weight: 700;
            gap: 6px;
            inset: 0;
            justify-content: center;
            opacity: 0;
            position: absolute;
            transition: opacity .2s ease;
        }
        .galeri-thumb:hover .galeri-thumb__overlay {
            opacity: 1;
        }
        .galeri-thumb__size {
            background: rgba(255, 255, 255, .92);
            border-radius: 999px;
            color: #334155;
            font-size: 10px;
            font-weight: 700;
            left: 8px;
            letter-spacing: .2px;
            padding: 2px 8px;
            position: absolute;
            top: 8px;
            z-index: 1;
        }
        .galeri-thumb__caption {
            background: linear-gradient(0deg, rgba(15, 23, 42, .72), rgba(15, 23, 42, 0));
            bottom: 0;
            color: #ffffff;
            font-size: 11px;
            font-weight: 600;
            left: 0;
            overflow: hidden;
            padding: 18px 10px 8px;
            position: absolute;
            right: 0;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .galeri-thumb__edit {
            align-items: center;
            background: #ffffff;
            border: 1px solid #dbe7ff;
            border-radius: 999px;
            box-shadow: 0 2px 8px rgba(16, 24, 40, .18);
            color: #2563eb;
            display: inline-flex;
            font-size: 11px;
            font-weight: 700;
            gap: 4px;
            height: 28px;
            justify-content: center;
            padding: 0 10px;
            position: absolute;
            right: 42px;
            top: 8px;
            transition: background .2s ease, color .2s ease;
            z-index: 2;
        }
        .galeri-thumb__edit:hover {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
        }
        .galeri-thumb__remove {
            align-items: center;
            background: #ffffff;
            border: 1px solid #f1f3f5;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(16, 24, 40, .18);
            color: #dc3545;
            display: flex;
            font-size: 18px;
            font-weight: 700;
            height: 28px;
            justify-content: center;
            line-height: 1;
            padding: 0;
            position: absolute;
            right: 8px;
            top: 8px;
            transition: background .2s ease, color .2s ease;
            width: 28px;
            z-index: 2;
        }
        .galeri-thumb__remove:hover {
            background: #dc3545;
            color: #ffffff;
        }

        .galeri-empty {
            border: 1px dashed #dbe6e0;
            border-radius: 16px;
            color: #94a3b8;
            margin-top: 18px;
            padding: 34px 20px;
            text-align: center;
        }
        .galeri-empty > i {
            display: block;
            font-size: 30px;
            margin-bottom: 8px;
        }
        .galeri-empty p {
            font-size: 14px;
        }
        .galeri-empty__cta i {
            font-size: 13px;
            margin-right: 4px;
        }
        .galeri-empty__cta {
            background: #ffffff;
            border: 1px solid #a7dcc0;
            border-radius: 999px;
            color: #157347;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            padding: 6px 16px;
            transition: background .2s ease, color .2s ease, border-color .2s ease;
        }
        .galeri-empty__cta:hover {
            background: #198754;
            border-color: #198754;
            color: #ffffff;
        }

        /* ============ Modal edit foto ============ */
        .galeri-modal {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }
        .galeri-modal .modal-header {
            border-bottom: 1px solid #eef2f5;
            padding: .95rem 1.25rem;
        }
        .galeri-modal .modal-title {
            color: #143a2c;
            font-weight: 800;
        }
        .galeri-modal .modal-body {
            padding: 1.25rem;
        }
        .galeri-modal__preview {
            align-items: center;
            background: #f8fafc;
            border: 1px solid #eef2f5;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            margin-bottom: 16px;
            overflow: hidden;
        }
        .galeri-modal__preview img {
            display: block;
            height: 130px;
            object-fit: cover;
            width: 100%;
        }
        .galeri-modal .form-label {
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .galeri-modal .form-control {
            border-color: #e2e8f0;
            font-size: 13px;
        }
        .galeri-modal .form-control:focus {
            border-color: #a7dcc0;
            box-shadow: 0 0 0 3px rgba(52, 165, 111, .15);
        }
        .galeri-modal__hint {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 4px;
        }
        .galeri-modal__error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            color: #b91c1c;
            font-size: 12px;
            margin: 12px 0 0;
            padding: 8px 10px;
        }
        .galeri-modal .modal-footer {
            border-top: 1px solid #eef2f5;
            padding: .85rem 1.25rem;
        }

        /* ============ Foto pratinjau (belum disimpan) ============ */
        .galeri-pending {
            margin-top: 18px;
        }
        .galeri-pending__head {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .galeri-pending__head h6 {
            color: #143a2c;
            font-weight: 800;
        }
        .galeri-pending__grid {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        }
        .galeri-pending__item {
            background: #ffffff;
            border: 1px dashed #a7dcc0;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }
        .galeri-pending__item img {
            aspect-ratio: 1 / 1;
            display: block;
            object-fit: cover;
            width: 100%;
        }
        .galeri-pending__meta {
            padding: 6px 8px;
        }
        .galeri-pending__name {
            color: #334155;
            display: block;
            font-size: 11px;
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .galeri-pending__size {
            color: #94a3b8;
            font-size: 10px;
        }
        .galeri-pending__remove {
            align-items: center;
            background: #ffffff;
            border: 1px solid #f1f3f5;
            border-radius: 50%;
            color: #dc3545;
            display: flex;
            font-size: 16px;
            height: 24px;
            justify-content: center;
            line-height: 1;
            padding: 0;
            position: absolute;
            right: 6px;
            top: 6px;
            width: 24px;
        }
        .galeri-pending__remove:hover {
            background: #dc3545;
            color: #ffffff;
        }

        /* ============ Bar simpan ============ */
        .galeri-savebar {
            align-items: center;
            border-top: 1px solid #eef2f5;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: space-between;
            margin-top: 22px;
            padding-top: 16px;
        }
        .galeri-savebar__info {
            color: #94a3b8;
            font-size: 12px;
            margin: 0;
        }
        .galeri-savebar__info.is-ready {
            color: #157347;
            font-weight: 600;
        }

        @media (max-width: 575.98px) {
            .galeri-head {
                align-items: stretch;
            }
            .galeri-stats {
                width: 100%;
            }
            .galeri-stat {
                flex: 1 1 0;
                min-width: 0;
            }
            .galeri-grid {
                gap: 10px;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
            .galeri-thumb__edit {
                padding: 0;
                width: 28px;
            }
            .galeri-thumb__edit span {
                display: none;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function () {
            var dropzone    = document.getElementById('galeriDropzone');
            var input       = document.getElementById('galeriInput');
            var status      = document.getElementById('galeriStatus');
            var grid        = document.getElementById('galeriGrid');
            var empty       = document.getElementById('galeriEmpty');
            var countBadge  = document.getElementById('galeriCount');
            var sizeBadge   = document.getElementById('galeriSize');
            var progress    = document.getElementById('galeriProgress');
            var progressBar = document.getElementById('galeriProgressBar');

            var pendingWrap  = document.getElementById('galeriPending');
            var pendingGrid  = document.getElementById('galeriPendingGrid');
            var pendingCount = document.getElementById('galeriPendingCount');
            var saveInfo     = document.getElementById('galeriSaveInfo');
            var saveBtn      = document.getElementById('galeriSaveBtn');

            var pendingFiles = [];
            var isSaving     = false;

            var editModalEl    = document.getElementById('galeriEditModal');
            var editForm       = document.getElementById('galeriEditForm');
            var editId         = document.getElementById('galeriEditId');
            var editKeterangan = document.getElementById('galeriEditKeterangan');
            var editAlt        = document.getElementById('galeriEditAlt');
            var editPreview    = document.getElementById('galeriEditPreview');
            var editError      = document.getElementById('galeriEditError');
            var editSubmit     = document.getElementById('galeriEditSubmit');

            var uploadUrl   = "{{ url('/admin/program/galeri/upload') }}";
            var deleteBase  = "{{ url('/admin/program/galeri') }}";
            var editBase    = "{{ url('/admin/program/galeri') }}";
            var token       = "{{ csrf_token() }}";
            var program     = "{{ $programSlug }}";
            var dokumentasi = "{{ $dokumentasiId }}";
            var minSize     = 150;
            var maxSize     = 5 * 1024 * 1024;

            if (!dropzone) return;

            /* total ukuran galeri saat ini (byte), dipakai saat foto dihapus */
            var totalBytes = {{ (int) $totalSize }};

            function formatBytes(bytes) {
                bytes = Math.max(0, parseInt(bytes, 10) || 0);
                if (bytes >= 1048576) {
                    return (bytes / 1048576).toFixed(1).replace('.', ',') + ' MB';
                }
                if (bytes >= 1024) {
                    return Math.round(bytes / 1024).toLocaleString('id-ID') + ' KB';
                }
                return bytes + ' B';
            }

            dropzone.addEventListener('click', function () {
                input.click();
            });

            ['dragenter', 'dragover'].forEach(function (evt) {
                dropzone.addEventListener(evt, function (e) {
                    e.preventDefault();
                    dropzone.classList.add('is-dragover');
                });
            });

            ['dragleave', 'dragend'].forEach(function (evt) {
                dropzone.addEventListener(evt, function () {
                    dropzone.classList.remove('is-dragover');
                });
            });

            dropzone.addEventListener('drop', function (e) {
                e.preventDefault();
                dropzone.classList.remove('is-dragover');
                handleFiles(e.dataTransfer.files);
            });

            input.addEventListener('change', function () {
                handleFiles(input.files);
                input.value = '';
            });

            if (empty) {
                empty.addEventListener('click', function (e) {
                    if (e.target.closest('.galeri-empty__cta')) input.click();
                });
            }

            function imageMinSize(file) {
                return new Promise(function (resolve) {
                    var img = new Image();
                    var url = URL.createObjectURL(file);
                    img.onload = function () {
                        URL.revokeObjectURL(url);
                        resolve(img.naturalWidth >= minSize && img.naturalHeight >= minSize);
                    };
                    img.onerror = function () {
                        URL.revokeObjectURL(url);
                        resolve(false);
                    };
                    img.src = url;
                });
            }

            function firstError(data) {
                if (data && data.errors) {
                    var key = Object.keys(data.errors)[0];
                    if (key && data.errors[key].length) return data.errors[key][0];
                }
                return (data && data.message) || 'Upload gagal.';
            }

            function setProgress(percent) {
                if (!progress || !progressBar) return;
                progress.classList.add('is-active');
                progressBar.style.width = percent + '%';
            }

            function resetDropzone() {
                dropzone.classList.remove('is-uploading');
                if (progress) progress.classList.remove('is-active');
                if (progressBar) progressBar.style.width = '0';
                status.textContent = '';
            }

            /* ============ daftar foto yang menunggu disimpan ============ */
            function pendingSize() {
                return pendingFiles.reduce(function (sum, item) {
                    return sum + item.file.size;
                }, 0);
            }

            function renderPending() {
                if (!pendingWrap || !pendingGrid) return;

                pendingGrid.innerHTML = '';

                pendingFiles.forEach(function (item, index) {
                    var card = document.createElement('div');
                    card.className = 'galeri-pending__item';

                    var img = document.createElement('img');
                    img.src = item.preview;
                    img.alt = item.file.name;
                    card.appendChild(img);

                    var meta = document.createElement('div');
                    meta.className = 'galeri-pending__meta';

                    var name = document.createElement('span');
                    name.className = 'galeri-pending__name';
                    name.textContent = item.file.name;
                    name.title = item.file.name;

                    var size = document.createElement('span');
                    size.className = 'galeri-pending__size';
                    size.textContent = formatBytes(item.file.size);

                    meta.appendChild(name);
                    meta.appendChild(size);
                    card.appendChild(meta);

                    var remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'galeri-pending__remove';
                    remove.dataset.index = index;
                    remove.title = 'Batalkan foto ini';
                    remove.innerHTML = '&times;';
                    card.appendChild(remove);

                    pendingGrid.appendChild(card);
                });

                var total = pendingFiles.length;
                pendingWrap.hidden = total === 0;

                if (pendingCount) pendingCount.textContent = total;
                if (saveBtn) saveBtn.disabled = total === 0 || isSaving;

                if (!saveInfo) return;

                if (!total) {
                    saveInfo.classList.remove('is-ready');
                    saveInfo.innerHTML = '<i class="bi bi-info-circle"></i> Belum ada foto baru dipilih.';
                } else {
                    saveInfo.classList.add('is-ready');
                    saveInfo.innerHTML = '<i class="bi bi-check2-circle"></i> ' + total + ' foto siap disimpan (' + formatBytes(pendingSize()) + ').';
                }
            }

            function addPending(files) {
                var added = 0;

                files.forEach(function (file) {
                    var duplicate = pendingFiles.some(function (item) {
                        return item.file.name === file.name && item.file.size === file.size;
                    });
                    if (duplicate) return;

                    pendingFiles.push({ file: file, preview: URL.createObjectURL(file) });
                    added++;
                });

                return added;
            }

            async function handleFiles(fileList) {
                var files = Array.prototype.slice.call(fileList || []);
                if (!files.length || isSaving) return;

                dropzone.classList.add('is-uploading');
                status.textContent = 'Memeriksa ' + files.length + ' file...';

                var valid = [];
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (!file.type || file.type.indexOf('image/') !== 0) {
                        await swal('Format tidak didukung', file.name + ' bukan file gambar.', 'error');
                        continue;
                    }
                    if (file.size > maxSize) {
                        await swal('File terlalu besar', file.name + ' melebihi 5MB.', 'error');
                        continue;
                    }
                    var sizeOk = await imageMinSize(file);
                    if (!sizeOk) {
                        await swal('Ukuran gambar kurang', file.name + ' minimal 150 x 150 px.', 'error');
                        continue;
                    }
                    valid.push(file);
                }

                dropzone.classList.remove('is-uploading');

                if (!valid.length) {
                    status.textContent = '';
                    return;
                }

                var added = addPending(valid);
                renderPending();

                status.textContent = added
                    ? added + ' foto siap disimpan. Tekan Simpan di bagian bawah.'
                    : 'Foto tersebut sudah ada di daftar simpan.';
            }

            /* ============ simpan (unggah) foto yang dipilih ============ */
            function savePending() {
                if (isSaving || !pendingFiles.length) return;

                isSaving = true;
                if (saveBtn) saveBtn.disabled = true;

                dropzone.classList.add('is-uploading');
                setProgress(0);
                status.textContent = 'Mengunggah ' + pendingFiles.length + ' foto... 0%';
                if (saveInfo) {
                    saveInfo.classList.add('is-ready');
                    saveInfo.innerHTML = '<i class="bi bi-cloud-arrow-up"></i> Mengunggah ' + pendingFiles.length + ' foto... 0%';
                }

                var form = new FormData();
                form.append('_token', token);
                form.append('program', program);
                if (dokumentasi) form.append('program_dokumentasi_id', dokumentasi);
                pendingFiles.forEach(function (item) {
                    form.append('files[]', item.file);
                });

                var xhr = new XMLHttpRequest();
                xhr.open('POST', uploadUrl, true);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                xhr.upload.addEventListener('progress', function (e) {
                    if (!e.lengthComputable) return;
                    var percent = Math.min(99, Math.round((e.loaded / e.total) * 100));
                    setProgress(percent);
                    status.textContent = 'Mengunggah ' + pendingFiles.length + ' foto... ' + percent + '%';
                    if (saveInfo) {
                        saveInfo.innerHTML = '<i class="bi bi-cloud-arrow-up"></i> Mengunggah... ' + percent + '%';
                    }
                });

                xhr.onload = function () {
                    var data = {};
                    try { data = JSON.parse(xhr.responseText) || {}; } catch (err) { data = {}; }

                    if (xhr.status >= 200 && xhr.status < 300) {
                        setProgress(100);
                        status.textContent = 'Tersimpan! Memuat ulang galeri...';
                        if (saveInfo) saveInfo.innerHTML = '<i class="bi bi-check2-circle"></i> Tersimpan! Memuat ulang galeri...';
                        window.location.reload();
                        return;
                    }

                    isSaving = false;
                    resetDropzone();
                    if (saveInfo) saveInfo.classList.remove('is-ready');
                    renderPending();
                    swal('Gagal menyimpan', firstError(data), 'error');
                };

                xhr.onerror = function () {
                    isSaving = false;
                    resetDropzone();
                    if (saveInfo) saveInfo.classList.remove('is-ready');
                    renderPending();
                    swal('Gagal menyimpan', 'Terjadi kesalahan saat mengunggah.', 'error');
                };

                xhr.send(form);
            }

            if (saveBtn) {
                saveBtn.addEventListener('click', savePending);
            }

            if (pendingGrid) {
                pendingGrid.addEventListener('click', function (e) {
                    var btn = e.target.closest('.galeri-pending__remove');
                    if (!btn || isSaving) return;

                    var index = parseInt(btn.dataset.index, 10);
                    if (isNaN(index) || !pendingFiles[index]) return;

                    URL.revokeObjectURL(pendingFiles[index].preview);
                    pendingFiles.splice(index, 1);
                    renderPending();

                    status.textContent = pendingFiles.length
                        ? pendingFiles.length + ' foto siap disimpan. Tekan Simpan di bagian bawah.'
                        : '';
                });
            }

            window.addEventListener('beforeunload', function (e) {
                if (pendingFiles.length && !isSaving) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            renderPending();

            /* ============ edit keterangan & alt text ============ */
            var editModal = (editModalEl && window.bootstrap) ? new bootstrap.Modal(editModalEl) : null;

            function applyPhotoInfo(thumb, keterangan, altText) {
                thumb.dataset.keterangan = keterangan;
                thumb.dataset.alt = altText;

                var img = thumb.querySelector('img');
                if (img) img.alt = altText || keterangan || 'Foto galeri';

                var link = thumb.querySelector('.galeri-thumb__link');
                if (!link) return;

                var caption = link.querySelector('.galeri-thumb__caption');
                if (keterangan) {
                    if (!caption) {
                        caption = document.createElement('span');
                        caption.className = 'galeri-thumb__caption';
                        link.appendChild(caption);
                    }
                    caption.textContent = keterangan;
                } else if (caption) {
                    caption.remove();
                }
            }

            function openEditModal(thumb) {
                if (!thumb || !editModal) return;

                editId.value = thumb.dataset.id || '';
                editKeterangan.value = thumb.dataset.keterangan || '';
                editAlt.value = thumb.dataset.alt || '';
                editError.hidden = true;
                editError.textContent = '';

                var img = thumb.querySelector('img');
                if (img && editPreview) {
                    editPreview.src = img.getAttribute('src') || '';
                    editPreview.alt = img.getAttribute('alt') || 'Pratinjau foto';
                }

                editModal.show();
            }

            grid.addEventListener('click', function (e) {
                var editBtn = e.target.closest('.galeri-thumb__edit');
                if (!editBtn) return;
                e.preventDefault();
                openEditModal(editBtn.closest('.galeri-thumb'));
            });

            if (editForm) {
                editForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    if (!editId.value) return;

                    var payload = new FormData();
                    payload.append('_token', token);
                    payload.append('program', program);
                    if (dokumentasi) payload.append('program_dokumentasi_id', dokumentasi);
                    payload.append('keterangan', editKeterangan.value.trim());
                    payload.append('alt_text', editAlt.value.trim());

                    var submitHtml = editSubmit.innerHTML;
                    editSubmit.disabled = true;
                    editSubmit.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
                    editError.hidden = true;

                    fetch(editBase + '/' + editId.value + '/update', {
                        method: 'POST',
                        headers: { 'Accept': 'application/json' },
                        body: payload
                    })
                    .then(function (res) {
                        return res.json().catch(function () { return {}; }).then(function (data) {
                            if (!res.ok) throw new Error(firstError(data));
                            return data;
                        });
                    })
                    .then(function (data) {
                        var thumb = grid.querySelector('.galeri-thumb[data-id="' + editId.value + '"]');
                        if (thumb) applyPhotoInfo(thumb, data.keterangan || '', data.alt_text || '');
                        if (editModal) editModal.hide();
                        swal('Berhasil!', 'Keterangan foto telah diperbarui.', 'success');
                    })
                    .catch(function (err) {
                        editError.textContent = err.message || 'Gagal menyimpan perubahan.';
                        editError.hidden = false;
                    })
                    .finally(function () {
                        editSubmit.disabled = false;
                        editSubmit.innerHTML = submitHtml;
                    });
                });
            }

            grid.addEventListener('click', function (e) {
                var btn = e.target.closest('.galeri-thumb__remove');
                if (!btn) return;
                e.preventDefault();

                swal({
                    title: "Hapus foto?",
                    text: "Foto akan dihapus dari galeri ini.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then(function (willDelete) {
                    if (!willDelete) return;

                    fetch(deleteBase + '/' + btn.dataset.id + '/delete', {
                        headers: { 'Accept': 'application/json' }
                    })
                    .then(function (res) {
                        return res.json().catch(function () { return {}; }).then(function (data) {
                            if (!res.ok) throw new Error(firstError(data));
                            return data;
                        });
                    })
                    .then(function () {
                        var card = btn.closest('.galeri-thumb');
                        var removedBytes = card ? parseInt(card.dataset.size, 10) || 0 : 0;
                        if (card) card.remove();

                        var total = grid.querySelectorAll('.galeri-thumb').length;
                        if (countBadge) countBadge.textContent = total;
                        if (sizeBadge) {
                            totalBytes = Math.max(0, totalBytes - removedBytes);
                            sizeBadge.textContent = formatBytes(totalBytes);
                        }
                        if (!total && empty) empty.style.display = '';
                    })
                    .catch(function () {
                        swal('Gagal', 'Foto gagal dihapus.', 'error');
                    });
                });
            });
        })();
    </script>
@endpush
