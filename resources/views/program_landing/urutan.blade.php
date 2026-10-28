@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/landing">Hero Landing</a></li>
        <li class="breadcrumb-item active" aria-current="page">Atur Urutan</li>
    </ol>
@endsection

@push('styles')
<style>
    /* ====== Halaman Atur Urutan Hero Landing ====== */
    .urutan-head {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 4px;
    }

    .urutan-sub {
        color: #6b7a75;
        font-size: 14px;
        margin-bottom: 18px;
    }

    .urutan-sub i {
        color: #1a8b4c;
    }

    #list-urutan {
        max-width: 880px;
    }

    /* kartu program */
    .urutan-card {
        position: relative;
        background: #fff;
        border: 1px solid #e6ebe8;
        border-radius: 16px;
        padding: 18px 20px 16px;
        margin-bottom: 16px;
        box-shadow: 0 1px 4px rgba(23, 58, 42, .06);
        overflow: hidden;
        transition: box-shadow .18s ease, transform .18s ease, border-color .18s ease;
    }

    /* pita aksen di bagian atas kartu */
    .urutan-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: #e6ebe8;
        transition: background .18s ease;
    }

    .urutan-card:hover {
        box-shadow: 0 10px 26px rgba(23, 58, 42, .12);
        transform: translateY(-2px);
    }

    /* item pertama (tampil paling atas di website) diberi aksen hijau */
    .urutan-card.is-first {
        border-color: #cfe9db;
        box-shadow: 0 6px 20px rgba(26, 139, 76, .10);
    }

    .urutan-card.is-first::before {
        background: linear-gradient(90deg, #14532d 0%, #1a8b4c 45%, #5ac18a 100%);
    }

    /* baris kepala: judul di kiri, logo di pojok kanan */
    .urutan-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
    }

    .urutan-head-main {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    /* nomor urut (pil di depan nama program) */
    .urutan-no {
        flex-shrink: 0;
        min-width: 40px;
        height: 40px;
        padding: 0 11px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 15px;
        background: #eaf6ef;
        color: #1a8b4c;
        border: 1px solid #cfe9db;
    }

    .urutan-card.is-first .urutan-no {
        background: #1a8b4c;
        color: #fff;
        border-color: #1a8b4c;
    }

    .urutan-title {
        font-weight: 800;
        font-size: 18px;
        line-height: 1.25;
        color: #1f3129;
        margin: 0;
        letter-spacing: -.2px;
    }

    .urutan-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
        margin-top: 7px;
    }

    .badge-urutan-status {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 999px;
    }

    .badge-urutan-aktif {
        background: #e7f6ed;
        color: #177a43;
    }

    .badge-urutan-nonaktif {
        background: #f1f3f2;
        color: #7a8680;
    }

    .badge-urutan-slug {
        font-size: 11px;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 999px;
        background: #f4f6f5;
        border: 1px solid #e6ebe8;
        color: #5b6b66;
    }

    /* logo kecil di pojok kanan atas */
    .urutan-logo-wrap {
        flex-shrink: 0;
        width: 58px;
        height: 58px;
        padding: 4px;
        border-radius: 14px;
        background: #f6faf8;
        border: 1px solid #e6ebe8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .urutan-logo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        background: #fff;
    }

    /* garis pemisah di bawah nama program */
    .urutan-line {
        height: 2px;
        border: 0;
        margin: 14px 0 12px;
        background: linear-gradient(90deg, #1a8b4c 0%, #9bd6b5 22%, #eef2f0 60%, rgba(238, 242, 240, 0) 100%);
    }

    .urutan-tagline {
        color: #1a8b4c;
        font-weight: 600;
        font-size: 13.5px;
        margin-bottom: 6px;
    }

    .urutan-info {
        margin: 0;
        font-size: 13.5px;
        color: #5b6b66;
        line-height: 1.68;
    }

    /* label kecil di atas daftar kartu */
    .urutan-items-title {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 10.5px;
        letter-spacing: .09em;
        text-transform: uppercase;
        font-weight: 700;
        color: #93a29c;
        margin: 16px 0 8px;
    }

    /* kartu-kartu info tambahan */
    .urutan-items {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 10px;
    }

    .urutan-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #f8fdf9;
        border: 1px solid #e3f0e8;
        border-radius: 12px;
        padding: 11px 12px;
        transition: background .16s ease, border-color .16s ease, transform .16s ease;
    }

    .urutan-item:hover {
        background: #f1faf4;
        border-color: #cfe9db;
        transform: translateY(-1px);
    }

    .urutan-item__icon {
        flex-shrink: 0;
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(26, 139, 76, .12);
        color: #1a8b4c;
        font-size: 15px;
    }

    .urutan-item__title {
        font-weight: 700;
        font-size: 13px;
        color: #22332c;
        line-height: 1.35;
    }

    .urutan-item__desc {
        font-size: 12px;
        color: #5b6b66;
        line-height: 1.5;
        margin-top: 2px;
    }

    /* baris kaki: tombol aksi + label urutan */
    .urutan-foot {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px dashed #e6ebe8;
    }

    .urutan-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .urutan-order-label {
        font-size: 11.5px;
        color: #93a29c;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-move {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 9px;
        font-size: 15px;
    }

    .btn-move:not(:disabled):hover {
        background: #1a8b4c;
        border-color: #1a8b4c;
        color: #fff;
    }

    .btn-move:disabled {
        opacity: .35;
        cursor: not-allowed;
    }

    .urutan-card.is-busy {
        opacity: .55;
        pointer-events: none;
    }

    /* flash kecil setelah pindah */
    .urutan-hint {
        position: fixed;
        bottom: 22px;
        right: 22px;
        z-index: 1050;
        background: #173a2a;
        color: #fff;
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 13.5px;
        box-shadow: 0 8px 22px rgba(0, 0, 0, .25);
        opacity: 0;
        transform: translateY(8px);
        transition: opacity .2s ease, transform .2s ease;
        pointer-events: none;
    }

    .urutan-hint.show {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .urutan-head {
            align-items: center;
        }

        .urutan-logo-wrap {
            width: 48px;
            height: 48px;
        }

        .urutan-foot {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="urutan-head">
        <h5 class="mb-0"><i class="bi-sort-down me-1" style="color:#1a8b4c"></i> Atur Urutan Hero Landing Program</h5>
        <a href="/admin/program/landing" class="btn btn-outline-secondary btn-sm"><i class="bi-arrow-left"></i> Kembali</a>
    </div>
    <p class="urutan-sub">
        Gunakan tombol <i class="bi-arrow-up-circle-fill"></i> / <i class="bi-arrow-down-circle-fill"></i> untuk
        menaikkan atau menurunkan posisi program. Urutan ini dipakai di halaman website.
    </p>

    <div id="list-urutan">
        @forelse($items as $item)
            @php
                $logoPath = $item->logo_image && file_exists(public_path($item->logo_image))
                    ? asset($item->logo_image)
                    : asset('admin/assets/img/setting/_img.jpg');

                $infoItems = $item->info_items;
                if (is_string($infoItems) && $infoItems !== '') {
                    $decoded = json_decode($infoItems, true);
                    $infoItems = is_array($decoded) ? $decoded : [];
                }
                if (!is_array($infoItems)) {
                    $infoItems = [];
                }

                /* deskripsi utama: pakai info_text, fallback ke description */
                $deskripsi = $item->info_text ?: $item->description;
            @endphp
            <div class="urutan-card {{ $loop->first ? 'is-first' : '' }}" data-id="{{ $item->id }}">

                {{-- kepala: nama program + logo di pojok --}}
                <div class="urutan-head">
                    <div class="urutan-head-main">
                        <span class="urutan-no" title="Urutan tampil ke-{{ $item->order }}">{{ $loop->iteration }}</span>
                        <div style="min-width:0">
                            <h6 class="urutan-title">{{ $item->title }}</h6>
                            <div class="urutan-meta">
                                <span class="badge-urutan-status {{ $item->status == 'A' ? 'badge-urutan-aktif' : 'badge-urutan-nonaktif' }}">
                                    {{ $item->status == 'A' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                                @if($item->slug)
                                    <span class="badge-urutan-slug"><i class="bi-link-45deg"></i> /{{ $item->slug }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="urutan-logo-wrap">
                        <img class="urutan-logo" src="{{ $logoPath }}" alt="Logo {{ $item->title }}"/>
                    </div>
                </div>

                {{-- garis pemisah di bawah nama program --}}
                <hr class="urutan-line"/>

                {{-- deskripsi / informasi --}}
                @if($item->tagline)
                    <div class="urutan-tagline">{{ $item->tagline }}</div>
                @endif

                @if($deskripsi)
                    <p class="urutan-info">{!! nl2br(e($deskripsi)) !!}</p>
                @endif

                {{-- kartu tambahan (mis. poin unggulan ala program utama wakaf) --}}
                @if(!empty($infoItems))
                    <div class="urutan-items-title">
                        <i class="bi-grid-1x2-fill"></i> Informasi Program
                    </div>
                    <div class="urutan-items">
                        @foreach($infoItems as $infoItem)
                            @if(is_array($infoItem))
                                <div class="urutan-item">
                                    <span class="urutan-item__icon">
                                        <i class="bi {{ $icons[$infoItem['icon'] ?? ''] ?? 'bi-check-circle-fill' }}"></i>
                                    </span>
                                    <div>
                                        <div class="urutan-item__title">{{ $infoItem['title'] ?? '' }}</div>
                                        <div class="urutan-item__desc">{{ $infoItem['desc'] ?? '' }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- aksi: tombol naik / turun / lihat halaman --}}
                <div class="urutan-foot">
                    <div class="urutan-actions">
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-move" data-id="{{ $item->id }}" data-arah="up" {{ $loop->first ? 'disabled' : '' }} title="Naikkan">
                            <i class="bi-arrow-up"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-move" data-id="{{ $item->id }}" data-arah="down" {{ $loop->last ? 'disabled' : '' }} title="Turunkan">
                            <i class="bi-arrow-down"></i>
                        </button>
                        <a href="{{ $item->slug ? url('/' . $item->slug) : '#' }}" target="_blank" class="btn btn-sm btn-outline-success" style="border-radius: 9px;" title="Lihat halaman {{ $item->title }}">
                            <i class="bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                    <small class="urutan-order-label">Urutan {{ $item->order }}</small>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-5" style="border: 2px dashed #dfe6e2; border-radius: 14px; max-width: 880px;">
                <i class="bi-inbox" style="font-size: 34px; color: #b8c4bf;"></i>
                <div class="mt-2">Belum ada data hero landing.</div>
                <a href="/admin/program/landing/add" class="btn btn-sm btn-success mt-2"><i class="bi-plus-lg"></i> Tambah sekarang</a>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
    <div id="urutan-hint" class="urutan-hint"><i class="bi-check-circle-fill me-1"></i> Urutan diperbarui</div>
    <script>
        /* tampilkan flash kecil di pojok */
        function showHint(msg){
            const el = document.getElementById('urutan-hint');
            if (msg) el.innerHTML = '<i class="bi-check-circle-fill me-1"></i> ' + msg;
            el.classList.add('show');
            setTimeout(function(){ el.classList.remove('show'); }, 1800);
        }

        /* render ulang nomor, label urutan, dan status tombol tanpa reload */
        function refreshList(){
            const cards = $('#list-urutan .urutan-card');
            cards.each(function(i, card){
                const $card = $(card);
                $card.toggleClass('is-first', i === 0);
                $card.find('.urutan-no').text(i + 1);
                $card.find('.urutan-order-label').text('Urutan ' + (i + 1));
                $card.find('.btn-move[data-arah="up"]').prop('disabled', i === 0);
                $card.find('.btn-move[data-arah="down"]').prop('disabled', i === cards.length - 1);
            });
        }

        $(document).on('click', '.btn-move', function(){
            const btn  = $(this);
            const id   = btn.data('id');
            const arah = btn.data('arah');
            const $card = btn.closest('.urutan-card');

            /* kunci semua tombol selama proses agar tidak dobel klik */
            $('.btn-move').prop('disabled', true);
            $card.addClass('is-busy');

            $.post('/admin/program/landing/move', {
                _token: '{{ csrf_token() }}',
                id: id,
                arah: arah
            })
            .done(function(){
                /* pindahkan kartu di layar sesuai arah, lalu segarkan tampilan */
                const $target = arah === 'up' ? $card.prev('.urutan-card') : $card.next('.urutan-card');
                if ($target.length) {
                    if (arah === 'up') { $card.insertBefore($target); } else { $card.insertAfter($target); }
                }
                refreshList();
                showHint('Urutan diperbarui');
            })
            .fail(function(xhr){
                swal('Gagal!', xhr.responseJSON?.message || 'Gagal memindahkan urutan.', 'error');
            })
            .always(function(){
                $card.removeClass('is-busy');
                refreshList(); /* pastikan status tombol benar walau gagal */
            });
        });
    </script>
@endpush
