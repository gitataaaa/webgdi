{{-- =====================================================================
     Timeline Jadwal Kegiatan — (Uji Coba / Dinamis)
     =====================================================================
     Data bersifat dinamis: tambah/ubah kartu cukup dengan menambah item
     pada array $defaultTimeline di bawah, lalu nantinya bisa dialihkan
     ke backend dengan melewatkan variabel berikut dari controller:
       - $timelineItems : array kartu timeline
       - $timelineVideo : array [ 'title' => .., 'embed_url' => .. ]
       - $timelineFaq   : array [ ['question'=>.., 'answer'=>..], .. ]

     Status per kartu (key 'status'):
       - 'selesai'   => badge "Selesai"
       - 'aktif'     => badge "Berlangsung" (node berdenyut)
       - 'mendatang' => badge "Mendatang"
     ===================================================================== --}}
@php
    $defaultTimeline = [
        [
            'date'        => '28 JUNI - 05 JULI 2026',
            'title'       => 'Pendaftaran Peserta (Tahap 1 & 2)',
            'description' => 'Isi formulir online secara praktis di sistem kami ini atau melalui tautan resmi.',
            'status'      => 'selesai',
            'status_note' => 'Silakan isi data lengkap peserta dan unggah bukti pembayaran. Pendaftaran Tahap 1 & 2 telah ditutup.',
            'icon'        => 'register',
        ],
        [
            'date'        => '08 - 09 JULI 2026',
            'title'       => 'Pendaftaran Peserta (Tahap 3)',
            'description' => 'Isi formulir online secara praktis di sistem kami ini atau melalui tautan resmi.',
            'status'      => 'aktif',
            'status_note' => 'Silakan isi data lengkap peserta dan unggah bukti pembayaran. Pendaftaran Tahap 3 resmi dibuka!',
            'icon'        => 'register3',
        ],
        [
            'date'        => '09 JULI 2026',
            'title'       => 'Penutupan Pendaftaran Tahap 3',
            'description' => 'Batas akhir pendaftaran online dan pelunasan administrasi Tahap 3.',
            'status'      => 'mendatang',
            'status_note' => 'Pendaftaran akan ditutup otomatis pada pukul 23:59 WIB.',
            'icon'        => 'deadline',
        ],
        [
            'date'        => '10 JULI 2026',
            'title'       => 'Pengumuman Lolos Administrasi',
            'description' => 'Cek pengumuman di Instagram @event.grahadhuafa atau langsung di tab status pendaftaran.',
            'status'      => 'mendatang',
            'status_note' => 'Berlaku untuk semua cabang lomba.',
            'icon'        => 'announcement',
        ],
        [
            'date'        => '10 JULI 2026',
            'title'       => 'Technical Meeting & Finalis Video',
            'description' => 'Briefing daring via Zoom & pengumuman 5 finalis terbaik untuk Lomba Menyanyi, Pantomim, dan Pildacil.',
            'status'      => 'mendatang',
            'status_note' => 'Tautan Zoom akan dibagikan di grup WhatsApp resmi peserta.',
            'icon'        => 'meeting',
        ],
        [
            'date'        => '10 JULI 2026',
            'title'       => 'Babak Penyisihan Lomba Tahfiz (Offline)',
            'description' => 'Pelaksanaan babak seleksi penyisihan offline untuk seluruh peserta Lomba Tahfiz Juz 30.',
            'status'      => 'mendatang',
            'status_note' => 'Tempat babak penyisihan dilaksanakan di Masjid Pandan Bandung.',
            'icon'        => 'tahfiz',
        ],
        [
            'date'        => '11 JULI 2026 (SABTU)',
            'title'       => 'Penyisihan & Final Day 1 (Offline)',
            'description' => 'Babak Penyisihan & Final Cerdas Cermat, serta Grand Final Lomba Pantomim & Menyanyi Solo.',
            'status'      => 'mendatang',
            'status_note' => 'Penyisihan LCC (09:00 - 11:30), Final LCC & Pantomim (13:00 - 15:00), Final Menyanyi (15:00 - 16:30).',
            'icon'        => 'final',
        ],
        [
            'date'        => '12 JULI 2026 (MINGGU)',
            'title'       => 'Lomba & Awarding Day 2 (Offline)',
            'description' => 'Pelaksanaan Lomba Menggambar, Pildacil, Tahfiz, Santunan Yatim, serta Pengumuman Pemenang seluruh lomba.',
            'status'      => 'mendatang',
            'status_note' => 'Menggambar (08:30 - 10:00), Pildacil (10:00 - 10:45), Tahfiz (10:45 - 11:30), Pengumuman Pemenang & Penyerahan Hadiah (13:00 - 14:15).',
            'icon'        => 'awarding',
        ],
    ];

    $timeline = isset($timelineItems) && is_array($timelineItems) ? $timelineItems : $defaultTimeline;

    // Kumpulan ikon SVG bersih (stroke, style feather) utk node timeline
    $timelineIcons = [
        'register' => '<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>',
        'register3' => '<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/>',
        'deadline' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
        'announcement' => '<polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>',
        'meeting' => '<polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>',
        'tahfiz' => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
        'final' => '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
        'awarding' => '<polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>',
    ];

    $defaultVideo = [
        'title'     => 'Zoorney With Anak Yatim Dan Dhuafa | Kebun Binatang Bandung',
        'embed_url' => 'https://www.youtube.com/embed/sLf7wPMENnc',
    ];
    $video = isset($timelineVideo) && is_array($timelineVideo) ? $timelineVideo : $defaultVideo;
    $videoSrc = $video['embed_url'];
    $videoSrc .= (strpos($videoSrc, '?') !== false ? '&' : '?') . 'enablejsapi=1&playsinline=1&rel=0&modestbranding=1';

    $defaultFaq = [
        [
            'question' => 'Bagaimana cara mendaftar sebagai peserta?',
            'answer'   => 'Isi formulir online melalui tautan resmi yang tersedia, lengkapi data peserta, lalu unggah bukti pembayaran.',
        ],
        [
            'question' => 'Apakah pendaftaran Tahap 3 masih dibuka?',
            'answer'   => 'Ya, pendaftaran Tahap 3 resmi dibuka mulai tanggal 08 - 09 Juli 2026 dan akan ditutup otomatis pada pukul 23:59 WIB.',
        ],
        [
            'question' => 'Apa saja cabang lomba yang diadakan?',
            'answer'   => 'Cabang lomba meliputi Lomba Menyanyi Solo, Pantomim, Pildacil, Cerdas Cermat, Menggambar, dan Tahfiz Juz 30.',
        ],
        [
            'question' => 'Apakah pelaksanaan lomba dilakukan secara online atau offline?',
            'answer'   => 'Beberapa cabang lomba memiliki babak penyisihan online/daring (seperti Menyanyi, Pantomim, dan Pildacil), sedangkan babak penyisihan Tahfiz dan acara final dilaksanakan secara offline.',
        ],
        [
            'question' => 'Di mana saya bisa mendapatkan informasi/pengumuman resmi terkait lomba?',
            'answer'   => 'Pengumuman resmi dapat dicek melalui akun Instagram @event.grahadhuafa, grup WhatsApp resmi peserta, atau langsung pada halaman status pendaftaran di website ini.',
        ],
    ];
    $faq = isset($timelineFaq) && is_array($timelineFaq) ? $timelineFaq : $defaultFaq;
@endphp

<!-- ====== Timeline Jadwal Kegiatan ====== -->
<section class="gdi-timeline">
    <div class="container">
        <div class="gdi-timeline__header">
            <p class="gdi-timeline__tagline">JADWAL KEGIATAN</p>
            <h2 class="gdi-timeline__title">Timeline Penting</h2>
            <p class="gdi-timeline__desc">
                Yuk catat baik-baik tanggal penting di bawah ini agar adik-adik
                tidak melewatkan kesempatan emas ini!
            </p>
        </div>

        @php
                    $halfCount = (int) ceil(count($timeline) / 2);
                    $leftItems = array_slice($timeline, 0, $halfCount);
                    $rightItems = array_slice($timeline, $halfCount);
                    $timelineRows = [];
                    foreach ($leftItems as $k => $item) {
                        $timelineRows[] = [
                            'left'  => $item,
                            'right' => isset($rightItems[$k]) ? $rightItems[$k] : null,
                        ];
                    }
                @endphp
        <div class="gdi-timeline__list">
            @forelse($timelineRows as $rowIndex => $row)
                <div class="gdi-timeline__row">
                    @foreach(['left', 'right'] as $side)
                        @if(isset($row[$side]) && $row[$side])
                            @php
                                $item = $row[$side];
                                $globalI = ($rowIndex * 2) + ($side === 'right' ? 1 : 0);
                                $status = isset($item['status']) ? strtolower($item['status']) : 'mendatang';
                                $statusKey = in_array($status, ['selesai', 'aktif']) ? $status : 'mendatang';
                                $statusLabel = ['selesai' => 'Selesai', 'aktif' => 'Berlangsung', 'mendatang' => 'Mendatang'][$statusKey];
                                $iconKey = isset($item['icon']) && isset($timelineIcons[$item['icon']]) ? $item['icon'] : 'register';
                                $delay = ($globalI % 4) * 100;
                            @endphp
                            <div class="gdi-timeline__item gdi-timeline__item--{{ $side }} gdi-timeline__item--{{ $statusKey }} wow fadeInUp" data-wow-delay="{{ $delay }}ms">
                                <div class="gdi-timeline__node gdi-timeline__node--{{ $statusKey }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        {!! $timelineIcons[$iconKey] !!}
                                    </svg>
                                </div>
                                <div class="gdi-timeline__card">
                                    <div class="gdi-timeline__card-top">
                                        <span class="gdi-timeline__date">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $item['date'] }}
                                        </span>
                                        <span class="gdi-timeline__badge gdi-timeline__badge--{{ $statusKey }}">
                                            @if($statusKey === 'aktif')
                                                <span class="gdi-timeline__badge-dot"></span>
                                            @endif
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                    <h3 class="gdi-timeline__card-title">{{ $item['title'] }}</h3>
                                    <p class="gdi-timeline__card-desc">{{ $item['description'] }}</p>
                                    @if(isset($item['status_note']) && $item['status_note'])
                                        <div class="gdi-timeline__note gdi-timeline__note--{{ $statusKey }}">
                                            <i class="fas fa-info-circle"></i>
                                            {{ $item['status_note'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @empty
                <div class="gdi-timeline__empty">Belum ada jadwal kegiatan untuk ditampilkan.</div>
            @endforelse
        </div>
    </div>
</section>
<!-- ====== End Timeline ====== -->

<!-- ====== Placeholder: FAQ Accordion ====== -->
<section class="gdi-faq">
    <div class="container">
        <div class="gdi-faq__header text-center">
            <p class="gdi-faq__tagline">TANYA JAWAB</p>
            <h2 class="gdi-faq__title">FAQ</h2>
        </div>
        <div class="gdi-faq__accordion accordion" id="gdiFaqAccordion">
            @forelse($faq as $i => $q)
                @php $open = ($i === 0); @endphp
                <div class="accordion-item gdi-faq__item">
                    <h2 class="accordion-header" id="gdiFaqHead{{ $i }}">
                        <button
                            class="accordion-button {{ $open ? '' : 'collapsed' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#gdiFaqCollapse{{ $i }}"
                            aria-expanded="{{ $open ? 'true' : 'false' }}"
                            aria-controls="gdiFaqCollapse{{ $i }}">
                            {{ $q['question'] }}
                        </button>
                    </h2>
                    <div
                        id="gdiFaqCollapse{{ $i }}"
                        class="accordion-collapse collapse {{ $open ? 'show' : '' }}"
                        aria-labelledby="gdiFaqHead{{ $i }}"
                        data-bs-parent="#gdiFaqAccordion">
                        <div class="accordion-body gdi-faq__body">{{ $q['answer'] }}</div>
                    </div>
                </div>
            @empty
                <div class="gdi-faq__empty">Belum ada pertanyaan yang sering diajukan.</div>
            @endforelse
        </div>
    </div>
</section>
<!-- ====== End FAQ ====== -->

<!-- ====== Placeholder: Video Youtube Embedded ====== -->
<section class="gdi-video">
    <div class="container">
        <div class="gdi-video__inner">
            <p class="gdi-video__tagline">VIDEO INFORMASI</p>
            <h2 class="gdi-video__title">{{ $video['title'] }}</h2>
            <p class="gdi-video__sub">Saksikan momen kebahagiaan adik-adik dalam kegiatan rekreasi dan edukasi bersama.</p>

            <div class="gdi-video__stage">
                <div class="gdi-video__glow" aria-hidden="true"></div>
                <div class="gdi-video__frame">
                    <iframe
                        id="gdiVideoFrame"
                        src="{{ $videoSrc }}"
                        title="{{ $video['title'] }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                        loading="lazy"></iframe>
                    <div class="gdi-video__overlay" id="gdiVideoOverlay">
                        <button type="button" class="gdi-video__play" id="gdiVideoPlay" aria-label="Putar video">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M8 5.14v13.72c0 .9.97 1.46 1.75 1.01l11-6.86a1.19 1.19 0 0 0 0-2.01l-11-6.86A1.2 1.2 0 0 0 8 5.14z"/>
                            </svg>
                            <span class="gdi-video__play-text">Putar Video</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====== End Video ====== -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    var overlay = document.getElementById('gdiVideoOverlay');
    var btn = document.getElementById('gdiVideoPlay');
    var frame = document.getElementById('gdiVideoFrame');
    if (!overlay || !btn || !frame) return;

    var player = null;
    var apiReady = false;
    var pendingPlay = false;

    function loadAPI() {
        if (apiReady || window.YT) { apiReady = true; return; }
        var tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        document.head.appendChild(tag);
    }

    window.onYouTubeIframeAPIReady = function () {
        apiReady = true;
        player = new YT.Player('gdiVideoFrame', {
            events: {
                onStateChange: function (e) {
                    if (e.data === YT.PlayerState.PLAYING) {
                        overlay.classList.add('is-playing');
                    } else if (e.data === YT.PlayerState.ENDED) {
                        overlay.classList.remove('is-playing');
                    }
                }
            }
        });
        if (pendingPlay && player) {
            pendingPlay = false;
            player.playVideo();
        }
    };

    btn.addEventListener('click', function () {
        if (!window.YT) {
            pendingPlay = true;
            loadAPI();
            return;
        }
        if (!player) {
            player = new YT.Player('gdiVideoFrame', {
                events: {
                    onStateChange: function (e) {
                        if (e.data === YT.PlayerState.PLAYING) overlay.classList.add('is-playing');
                        else if (e.data === YT.PlayerState.ENDED) overlay.classList.remove('is-playing');
                    }
                }
            });
        }
        player.playVideo();
    });

    loadAPI();
});
</script>

<style>
/* ================= Timeline ================= */
.gdi-timeline {
    position: relative;
    padding: 56px 0 40px;
    background-color: #f6fbf8;

    /* Pola dot grid halus (subtle dot pattern) */
    background-image: radial-gradient(rgba(0, 135, 90, 0.10) 1.2px, transparent 1.2px);
    background-size: 24px 24px;
}

.gdi-timeline__header {
    text-align: center;
    margin-bottom: 36px;
}

.gdi-timeline__tagline {
    display: inline-block;
    color: #00875A;
    font-weight: 700;
    letter-spacing: 0.16em;
    font-size: 14px;
    text-transform: uppercase;
    background: rgba(0, 135, 90, 0.08);
    border: 1px solid rgba(0, 135, 90, 0.18);
    padding: 7px 18px;
    border-radius: 999px;
    margin-bottom: 14px;
}

.gdi-timeline__title {
    font-size: 32px;
    font-weight: 800;
    color: #143a2c;
    margin-bottom: 10px;
}

.gdi-timeline__desc {
    max-width: 660px;
    margin: 0 auto;
    color: #5b6b66;
    line-height: 1.7;
}

/* Alur tengah: 1 garis vertikal tunggal di tengah halaman */
.gdi-timeline__list {
    position: relative;
    max-width: 1180px;
    margin: 0 auto;
}

.gdi-timeline__list::before {
    content: "";
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 3px;
    border-radius: 999px;
    transform: translateX(-50%);
    background: linear-gradient(to bottom, #bff0dc, #00875A 55%, rgba(0, 135, 90, 0));
}

/* Baris kartu kiri-kanan sejajar (pair grid).
   --gdi-gap: lebar "jalur tengah" antara kolom kiri & kanan tempat
   lingkaran ikon diletakkan. Node tidak menyentuh bingkai kartu. */
.gdi-timeline__row {
    --gdi-gap: 110px;
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: var(--gdi-gap);
    align-items: stretch;
    margin-bottom: 34px;
}

.gdi-timeline__row:last-child {
    margin-bottom: 0;
}

.gdi-timeline__item {
    position: relative;
    min-width: 0;
}

/* -------- Node / Ikon (SVG) --------
   Node di-anchor ke ITEM (kolom kiri/kanan) tetapi digeser dengan
   calc() agar JATUH TEPAT DI GARIS VERTIKAL TENGAH (di antara kedua
   kolom), sehingga tidak pernah menutupi teks/tajuk di dalam kartu.
   Node kiri = atas baris, node kanan = bawah baris (tidak bertumpuk). */
.gdi-timeline__node {
    position: absolute;
    width: 54px;
    height: 54px;
    z-index: 2;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #ffffff;
    box-shadow: 0 8px 18px rgba(0, 135, 90, 0.35);
}

.gdi-timeline__item--left > .gdi-timeline__node {
    left: calc(100% + (var(--gdi-gap) / 2));
    top: 44px;
}

.gdi-timeline__item--right > .gdi-timeline__node {
    left: calc(-1 * (var(--gdi-gap) / 2));
    bottom: 44px;
}

.gdi-timeline__node svg {
    width: 24px;
    height: 24px;
}

/* Gradient hijau halus (default: aktif) */
.gdi-timeline__node--aktif {
    background: linear-gradient(135deg, #2dd4a7, #00875A);
    animation: gdi-pulse 2s ease-in-out infinite;
}

.gdi-timeline__node--selesai {
    background: linear-gradient(135deg, #a9f2d3, #10b981);
    color: #065f46;
    box-shadow: 0 8px 18px rgba(16, 185, 129, 0.30);
}

.gdi-timeline__node--mendatang {
    background: #eafaf1;
    color: #00875A;
    border: 2px solid #bfe8d4;
    box-shadow: 0 6px 14px rgba(0, 135, 90, 0.15);
}

@keyframes gdi-pulse {
    0%   { box-shadow: 0 0 0 0 rgba(0, 135, 90, 0.45); }
    70%  { box-shadow: 0 0 0 14px rgba(0, 135, 90, 0); }
    100% { box-shadow: 0 0 0 0 rgba(0, 135, 90, 0); }
}

/* -------- Kartu -------- */
.gdi-timeline__card {
    background: #ffffff;
    border: 1px solid #e5eef0;
    border-top: 4px solid transparent;
    border-radius: 16px;
    padding: 18px 20px;
    box-shadow: 0 6px 18px rgba(20, 58, 44, 0.06);
    transition: transform 0.30s ease, box-shadow 0.30s ease, border-color 0.30s ease;
    position: relative;
    height: 100%;
}

.gdi-timeline__item--aktif .gdi-timeline__card {
    border-top-color: #00875A;
    border-color: #bfe8d4;
}

.gdi-timeline__item--selesai .gdi-timeline__card {
    border-top-color: #10b981;
}

/* Lift-up + soft glow hijau saat hover */
.gdi-timeline__card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 34px rgba(0, 135, 90, 0.18);
    border-color: #9adfc2;
}

.gdi-timeline__card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: nowrap;
    gap: 8px;
    margin-bottom: 10px;
}

.gdi-timeline__card-top .gdi-timeline__badge {
    margin-left: auto;
    white-space: nowrap;
}

.gdi-timeline__date {
    display: inline-flex;
    align-items: center;
    font-size: 13px;
    font-weight: 700;
    color: #00875A;
    letter-spacing: 0.04em;
    background: #eafaf1;
    border-radius: 8px;
    padding: 5px 12px;
}

.gdi-timeline__date i {
    margin-right: 8px;
    color: #10b981;
}

/* -------- Badge status (pojok kanan atas) -------- */
.gdi-timeline__badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 999px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.gdi-timeline__badge--selesai {
    color: #065f46;
    background: linear-gradient(135deg, #d4f7e6, #a9f2d3);
}

.gdi-timeline__badge--aktif {
    color: #ffffff;
    background: linear-gradient(135deg, #12b76a, #00875A);
    box-shadow: 0 4px 12px rgba(0, 135, 90, 0.35);
}

.gdi-timeline__badge--mendatang {
    color: #9a6700;
    background: linear-gradient(135deg, #fff4d6, #ffe3a3);
}

.gdi-timeline__badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #ffffff;
    animation: gdi-blink 1.2s ease-in-out infinite;
}

@keyframes gdi-blink {
    0%, 100% { opacity: 1; }
    50%      { opacity: 0.25; }
}

.gdi-timeline__card-title {
    font-size: 17px;
    font-weight: 700;
    color: #1d2b26;
    line-height: 1.4;
    margin-bottom: 6px;
    overflow-wrap: break-word;
}

.gdi-timeline__card-desc {
    color: #5b6b66;
    line-height: 1.65;
    margin-bottom: 10px;
    overflow-wrap: break-word;
}

.gdi-timeline__note {
    font-size: 14px;
    line-height: 1.6;
    border-radius: 10px;
    padding: 10px 14px;
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.gdi-timeline__note i {
    margin-top: 3px;
    flex-shrink: 0;
}

.gdi-timeline__note--selesai {
    color: #4b5563;
    background: #f3f6f8;
    border-left: 3px solid #9ca3af;
}

.gdi-timeline__note--aktif {
    color: #065f46;
    background: #eafaf1;
    border-left: 3px solid #00875A;
}

.gdi-timeline__note--mendatang {
    color: #7c5a00;
    background: #fff8e8;
    border-left: 3px solid #f5b93a;
}

.gdi-timeline__empty {
    text-align: center;
    color: #8a9a94;
    padding: 30px 0;
}

/* Kolom tunggal di layar tablet ke bawah: garis di kiri, node di kiri */
@media (max-width: 991px) {
    .gdi-timeline__list::before {
        left: 25px;
        transform: none;
        background: linear-gradient(to bottom, #bff0dc, #00875A);
    }

    .gdi-timeline__row {
        display: block;
        margin-bottom: 22px;
    }

    .gdi-timeline__item--left,
    .gdi-timeline__item--right {
        padding-left: 66px;
        text-align: left;
    }

    /* Node kembali di-gutter kiri milik masing-masing kartu */
    .gdi-timeline__item--left > .gdi-timeline__node,
    .gdi-timeline__item--right > .gdi-timeline__node {
        left: 25px;
        top: 30px;
        bottom: auto;
    }
}

@media (max-width: 575px) {
    .gdi-timeline__list::before {
        left: 21px;
    }

    .gdi-timeline__item--left,
    .gdi-timeline__item--right {
        padding-left: 60px;
    }

    .gdi-timeline__item--left > .gdi-timeline__node,
    .gdi-timeline__item--right > .gdi-timeline__node {
        left: 21px;
        top: 28px;
        bottom: auto;
        width: 44px;
        height: 44px;
    }

    .gdi-timeline__node svg {
        width: 20px;
        height: 20px;
    }

    .gdi-timeline__card {
        padding: 16px 18px;
    }
}

/* ================= Video ================= */
.gdi-video {
    padding: 60px 0 80px;
    background-color: #ffffff;
    border-top: 1px solid #eef4f1;
}

.gdi-video__inner {
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}

/* -------- Badge Glassmorphism -------- */
.gdi-video__tagline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #065f46;
    font-weight: 800;
    letter-spacing: 0.16em;
    font-size: 13px;
    text-transform: uppercase;
    background: linear-gradient(135deg, rgba(210, 249, 233, 0.55), rgba(0, 135, 90, 0.12));
    border: 1px solid rgba(0, 135, 90, 0.28);
    -webkit-backdrop-filter: blur(8px);
    backdrop-filter: blur(8px);
    padding: 10px 24px;
    border-radius: 999px;
    margin-bottom: 18px;
    box-shadow: 0 8px 22px rgba(0, 135, 90, 0.14);
}

.gdi-video__tagline i {
    font-size: 12px;
    color: #00875A;
}

/* -------- Judul + garis bawah gradien -------- */
.gdi-video__title {
    font-size: 32px;
    font-weight: 800;
    color: #10231c;
    line-height: 1.35;
    letter-spacing: -0.01em;
    max-width: 760px;
    margin: 0 auto 0;
}

.gdi-video__title::after {
    content: "";
    display: block;
    width: 68px;
    height: 4px;
    border-radius: 999px;
    margin: 14px auto 0;
    background: linear-gradient(90deg, #bff0dc, #00875A, #2dd4a7);
    box-shadow: 0 2px 8px rgba(0, 135, 90, 0.35);
}

/* -------- Deskripsi singkat -------- */
.gdi-video__sub {
    max-width: 560px;
    margin: 18px auto 34px;
    color: #5b6b66;
    font-size: 16px;
    line-height: 1.7;
}

/* -------- Panggung video + ambient glow -------- */
.gdi-video__stage {
    position: relative;
}

.gdi-video__glow {
    position: absolute;
    inset: 12% -8% -10%;
    z-index: 0;
    border-radius: 50%;
    background: radial-gradient(50% 50% at 50% 50%, rgba(45, 212, 167, 0.30), rgba(0, 135, 90, 0.12) 60%, transparent 100%);
    -webkit-filter: blur(24px);
    filter: blur(24px);
    pointer-events: none;
}

/* -------- Bingkai cinematic / theater mockup -------- */
.gdi-video__frame {
    position: relative;
    z-index: 1;
    width: 100%;
    padding-top: 56.25%;
    border-radius: 16px;
    overflow: hidden;
    background: #0b1f19;
    border: 1px solid rgba(0, 135, 90, 0.35);
    box-shadow:
        0 24px 60px rgba(0, 135, 90, 0.28),
        0 12px 34px rgba(20, 58, 44, 0.18);
    transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
}

.gdi-video__frame:hover,
.gdi-video__frame:focus-within {
    transform: translateY(-6px);
    box-shadow:
        0 40px 90px rgba(0, 135, 90, 0.40),
        0 18px 44px rgba(20, 58, 44, 0.24);
    border-color: #2dd4a7;
}

.gdi-video__frame iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

/* -------- Overlay play (pulse) -------- */
.gdi-video__overlay {
    position: absolute;
    inset: 0;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(to top, rgba(3, 25, 18, 0.55), rgba(3, 25, 18, 0.15));
    cursor: pointer;
    transition: opacity 0.4s ease, visibility 0.4s ease;
}

.gdi-video__overlay.is-playing {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

.gdi-video__play {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    background: none;
    border: 0;
    padding: 0;
    cursor: pointer;
    color: #ffffff;
    position: relative;
}

.gdi-video__play::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 88px;
    height: 88px;
    border-radius: 50%;
    background: rgba(45, 212, 167, 0.45);
    transform: translate(-50%, -50%);
    z-index: 0;
    animation: gdi-play-ring 2s ease-out infinite;
}

.gdi-video__play svg {
    position: relative;
    z-index: 1;
    width: 88px;
    height: 88px;
    padding: 22px 24px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2dd4a7, #00875A);
    box-shadow: 0 14px 34px rgba(0, 135, 90, 0.55);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gdi-video__play:hover svg,
.gdi-video__play:focus-visible svg {
    transform: scale(1.08);
    box-shadow: 0 20px 44px rgba(0, 135, 90, 0.70);
}

.gdi-video__play-text {
    position: relative;
    z-index: 1;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #ffffff;
    text-shadow: 0 2px 8px rgba(3, 25, 18, 0.55);
}

@keyframes gdi-play-ring {
    0%   { transform: translate(-50%, -50%) scale(1);   opacity: 0.85; }
    70%  { transform: translate(-50%, -50%) scale(1.7); opacity: 0; }
    100% { transform: translate(-50%, -50%) scale(1.7); opacity: 0; }
}

@media (max-width: 575px) {
    .gdi-video__title {
        font-size: 24px;
    }

    .gdi-video__play svg {
        width: 68px;
        height: 68px;
        padding: 17px 18px;
    }

    .gdi-video__play::before {
        width: 68px;
        height: 68px;
    }
}

/* ================= FAQ ================= */
.gdi-faq {
    padding: 20px 0 60px;
    background: #f6fbf8;
}

.gdi-faq__header {
    margin-bottom: 30px;
}

.gdi-faq__tagline {
    color: #00875A;
    font-weight: 700;
    letter-spacing: 0.14em;
    font-size: 14px;
    margin-bottom: 6px;
}

.gdi-faq__title {
    font-size: 30px;
    font-weight: 800;
    color: #143a2c;
}

.gdi-faq__accordion {
    max-width: 860px;
    margin: 0 auto;
}

.gdi-faq__item {
    border: 1px solid #e5eef0;
    border-radius: 12px !important;
    margin-bottom: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.gdi-faq__item .accordion-button {
    font-weight: 600;
    color: #1d2b26;
    background: #ffffff;
    box-shadow: none;
}

.gdi-faq__item .accordion-button:not(.collapsed) {
    color: #00875A;
    background: #eafaf1;
}

.gdi-faq__item .accordion-button:focus {
    box-shadow: none;
}

.gdi-faq__body {
    color: #5b6b66;
    line-height: 1.7;
}

.gdi-faq__empty {
    text-align: center;
    color: #8a9a94;
    padding: 20px 0;
}
</style>