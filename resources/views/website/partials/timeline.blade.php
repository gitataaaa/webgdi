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
        ],
        [
            'date'        => '08 - 09 JULI 2026',
            'title'       => 'Pendaftaran Peserta (Tahap 3)',
            'description' => 'Isi formulir online secara praktis di sistem kami ini atau melalui tautan resmi.',
            'status'      => 'aktif',
            'status_note' => 'Silakan isi data lengkap peserta dan unggah bukti pembayaran. Pendaftaran Tahap 3 resmi dibuka!',
        ],
        [
            'date'        => '09 JULI 2026',
            'title'       => 'Penutupan Pendaftaran Tahap 3',
            'description' => 'Batas akhir pendaftaran online dan pelunasan administrasi Tahap 3.',
            'status'      => 'mendatang',
            'status_note' => 'Pendaftaran akan ditutup otomatis pada pukul 23:59 WIB.',
        ],
        [
            'date'        => '10 JULI 2026',
            'title'       => 'Pengumuman Lolos Administrasi',
            'description' => 'Cek pengumuman di Instagram @event.grahadhuafa atau langsung di tab status pendaftaran.',
            'status'      => 'mendatang',
            'status_note' => 'Berlaku untuk semua cabang lomba.',
        ],
        [
            'date'        => '10 JULI 2026',
            'title'       => 'Technical Meeting & Finalis Video',
            'description' => 'Briefing daring via Zoom & pengumuman 5 finalis terbaik untuk Lomba Menyanyi, Pantomim, dan Pildacil.',
            'status'      => 'mendatang',
            'status_note' => 'Tautan Zoom akan dibagikan di grup WhatsApp resmi peserta.',
        ],
        [
            'date'        => '10 JULI 2026',
            'title'       => 'Babak Penyisihan Lomba Tahfiz (Offline)',
            'description' => 'Pelaksanaan babak seleksi penyisihan offline untuk seluruh peserta Lomba Tahfiz Juz 30.',
            'status'      => 'mendatang',
            'status_note' => 'Tempat babak penyisihan dilaksanakan di Masjid Pandan Bandung.',
        ],
        [
            'date'        => '11 JULI 2026 (SABTU)',
            'title'       => 'Penyisihan & Final Day 1 (Offline)',
            'description' => 'Babak Penyisihan & Final Cerdas Cermat, serta Grand Final Lomba Pantomim & Menyanyi Solo.',
            'status'      => 'mendatang',
            'status_note' => 'Penyisihan LCC (09:00 - 11:30), Final LCC & Pantomim (13:00 - 15:00), Final Menyanyi (15:00 - 16:30).',
        ],
        [
            'date'        => '12 JULI 2026 (MINGGU)',
            'title'       => 'Lomba & Awarding Day 2 (Offline)',
            'description' => 'Pelaksanaan Lomba Menggambar, Pildacil, Tahfiz, Santunan Yatim, serta Pengumuman Pemenang seluruh lomba.',
            'status'      => 'mendatang',
            'status_note' => 'Menggambar (08:30 - 10:00), Pildacil (10:00 - 10:45), Tahfiz (10:45 - 11:30), Pengumuman Pemenang & Penyerahan Hadiah (13:00 - 14:15).',
        ],
    ];

    $timeline = isset($timelineItems) && is_array($timelineItems) ? $timelineItems : $defaultTimeline;

    $defaultVideo = [
        'title'     => 'Zoorney With Anak Yatim Dan Dhuafa | Kebun Binatang Bandung',
        'embed_url' => 'https://www.youtube.com/embed/sLf7wPMENnc',
    ];
    $video = isset($timelineVideo) && is_array($timelineVideo) ? $timelineVideo : $defaultVideo;
    $videoSrc = $video['embed_url'];
    $videoSrc .= (strpos($videoSrc, '?') !== false ? '&' : '?') . 'enablejsapi=1&playsinline=1&rel=0&modestbranding=1';

    /* Carousel video kegiatan (mis. halaman Wakaf & Hibah):
       slide berisi teks keterangan kegiatan di kiri + video YouTube di kanan.
       Jika controller tidak mengirim $videoSlides, tampil video tunggal seperti sebelumnya. */
    $videoSlides = isset($videoSlides) && is_array($videoSlides) && count($videoSlides) ? $videoSlides : null;

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

@if(!empty($videoSlides))
<!-- ====== Video Kegiatan — Carousel: teks keterangan kiri + video kanan ====== -->
<section class="gdi-videocar">
    <div class="swiper-container thm-swiper__slider gdi-videocar__swiper" data-swiper-options='{
        "slidesPerView": 1,
        "loop": false,
        "speed": 650,
        "grabCursor": true,
        "navigation": {
            "nextEl": ".gdi-videocar__next",
            "prevEl": ".gdi-videocar__prev"
        }
    }'>
        <div class="swiper-wrapper">
            @foreach($videoSlides as $vs)
                <div class="swiper-slide gdi-videocar__slide">
                    <div class="gdi-videocar__text">
                        <p class="gdi-videocar__tagline">Video Kegiatan</p>
                        <h3 class="gdi-videocar__title">{{ $vs['title'] }}</h3>
                        <ul class="gdi-videocar__points">
                            @foreach($vs['points'] as $p)
                                <li>
                                    <span class="gdi-videocar__num">{{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span>{{ $p }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="gdi-videocar__media">
                        <div class="gdi-videocar__frame">
                            <iframe
                                src="{{ $vs['embed_url'] }}{{ strpos($vs['embed_url'], '?') !== false ? '&' : '?' }}enablejsapi=1&playsinline=1&rel=0&modestbranding=1"
                                title="{{ $vs['title'] }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                loading="lazy"></iframe>
                            <div class="gdi-videocar__overlay">
                                <button type="button" class="gdi-videocar__play" aria-label="Putar video">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M8 5.14v13.72c0 .9.97 1.46 1.75 1.01l11-6.86a1.19 1.19 0 0 0 0-2.01l-11-6.86A1.2 1.2 0 0 0 8 5.14z"/>
                                    </svg>
                                    <span>Putar Video</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Panah navigasi di tepi kiri & kanan (vertikal tengah, seperti referensi) -->
    <button type="button" class="gdi-videocar__arrow gdi-videocar__prev" aria-label="Video sebelumnya">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button type="button" class="gdi-videocar__arrow gdi-videocar__next" aria-label="Video berikutnya">
        <i class="fas fa-chevron-right"></i>
    </button>
</section>
@else
<!-- ====== Video Youtube Embedded (di atas Jadwal Kegiatan) ====== -->
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
@endif
<!-- ====== End Video ====== -->

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
            $timelineCount = count($timeline);
        @endphp

        <div class="gdi-timeline__frame">
            <div class="gdi-timeline__clock" title="Jumlah agenda">
                <span class="gdi-timeline__clock-dot" aria-hidden="true"></span>
                <span class="gdi-timeline__clock-num">{{ str_pad($timelineCount, 2, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="gdi-timeline__list">
                @forelse($timeline as $i => $item)
                    @php
                        $status = isset($item['status']) ? strtolower($item['status']) : 'mendatang';
                        $statusKey = in_array($status, ['selesai', 'aktif']) ? $status : 'mendatang';
                        $statusLabel = ['selesai' => 'Selesai', 'aktif' => 'Berlangsung', 'mendatang' => 'Mendatang'][$statusKey];
                        $side = ($i % 2 === 0) ? 'right' : 'left';
                        $delay = ($i % 4) * 100;
                    @endphp
                    <div class="gdi-timeline__item gdi-timeline__item--{{ $side }} gdi-timeline__item--{{ $statusKey }} wow fadeInUp" data-wow-delay="{{ $delay }}ms">
                        <div class="gdi-timeline__card">
                            <span class="gdi-timeline__year">{{ $item['date'] }}</span>
                            <div class="gdi-timeline__panel gdi-timeline__panel--main">
                                <h3 class="gdi-timeline__card-title">{{ $item['title'] }}</h3>
                                <p class="gdi-timeline__card-desc">{{ $item['description'] }}</p>
                                @if(!empty($item['status_note']))
                                    <p class="gdi-timeline__note gdi-timeline__note--{{ $statusKey }}">
                                        <i class="fas fa-info-circle"></i>
                                        {{ $item['status_note'] }}
                                    </p>
                                @endif
                            </div>
                            <div class="gdi-timeline__panel gdi-timeline__panel--side">
                                <span class="gdi-timeline__side-label">Status</span>
                                <span class="gdi-timeline__side-value gdi-timeline__side-value--{{ $statusKey }}">
                                    @if($statusKey === 'aktif')
                                        <span class="gdi-timeline__badge-dot" aria-hidden="true"></span>
                                    @endif
                                    {{ $statusLabel }}
                                </span>
                            </div>
                        </div>
                        <span class="gdi-timeline__node gdi-timeline__node--{{ $statusKey }}" aria-hidden="true"></span>
                    </div>
                @empty
                    <div class="gdi-timeline__empty">Belum ada jadwal kegiatan untuk ditampilkan.</div>
                @endforelse

                <div class="gdi-timeline__flow" aria-hidden="true">
                    <span class="gdi-timeline__flow-line"></span>
                    <span class="gdi-timeline__flow-chip"><i class="fas fa-chevron-down"></i> Lanjut ke Tanya Jawab</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====== End Timeline ====== -->
<!-- ====== End Timeline ====== -->

{{-- Slot konten tambahan tepat di bawah timeline (mis. section penghargaan) --}}
@yield('after_timeline')

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

<script>
/* Carousel video kegiatan: pause semua video saat slide bergeser + tombol putar custom */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.gdi-videocar').forEach(function (root) {
        var swEl = root.querySelector('.gdi-videocar__swiper');
        if (!swEl) return;

        function pauseAllVideos() {
            root.querySelectorAll('.gdi-videocar__frame iframe').forEach(function (f) {
                try {
                    f.contentWindow.postMessage(JSON.stringify({ event: 'command', func: 'pauseVideo', args: [] }), '*');
                } catch (e) {}
            });
            root.querySelectorAll('.gdi-videocar__overlay').forEach(function (o) {
                o.classList.remove('is-playing');
            });
        }

        root.querySelectorAll('.gdi-videocar__overlay').forEach(function (ov) {
            var btn = ov.querySelector('.gdi-videocar__play');
            if (!btn) return;
            btn.addEventListener('click', function () {
                var frame = ov.parentElement.querySelector('iframe');
                if (!frame) return;
                try {
                    frame.contentWindow.postMessage(JSON.stringify({ event: 'command', func: 'playVideo', args: [] }), '*');
                } catch (e) {}
                ov.classList.add('is-playing');
            });
        });

        /* Pasang hook slideChange setelah qrowd.js menginisialisasi Swiper */
        (function bindSwiper() {
            if (swEl.swiper) {
                swEl.swiper.on('slideChange', pauseAllVideos);
            } else {
                setTimeout(bindSwiper, 250);
            }
        })();
    });
});
</script>

<style>
/* ================= Video Kegiatan (carousel teks kiri + video kanan) ================= */
.gdi-videocar {
    position: relative;
    padding: 60px 0;
    background: #ffffff;
    overflow: hidden;
}

.gdi-videocar__swiper {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 15px;
}

.gdi-videocar__slide {
    display: grid;
    grid-template-columns: minmax(0, 5fr) minmax(0, 7fr);
    align-items: center;
    gap: 48px;
    padding: 0 92px; /* ruang panah di tepi */
}

/* Kolom teks keterangan kegiatan */
.gdi-videocar__text {
    min-width: 0;
}

.gdi-videocar__tagline {
    text-align: center;
    color: #2f7d3b;
    font-size: 12.5px;
    font-weight: 800;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.gdi-videocar__title {
    text-align: center;
    font-size: clamp(24px, 3vw, 38px);
    font-weight: 800;
    color: #20242b;
    line-height: 1.3;
    margin-bottom: 24px;
}

.gdi-videocar__points {
    list-style: none;
    margin: 0;
    padding: 0;
    display: grid;
    gap: 16px;
}

.gdi-videocar__points li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    color: #46534c;
    font-size: 15px;
    line-height: 1.75;
}

.gdi-videocar__num {
    flex: 0 0 auto;
    min-width: 28px;
    font-weight: 800;
    color: #1a8b4c;
}

/* Kolom video */
.gdi-videocar__media {
    min-width: 0;
}

.gdi-videocar__frame {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    background: #0b1f16;
    box-shadow: 0 26px 60px rgba(20, 58, 44, 0.20);
    aspect-ratio: 16 / 9;
}

.gdi-videocar__frame iframe {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

.gdi-videocar__overlay {
    position: absolute;
    inset: 0;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(6, 30, 20, 0.30);
    transition: opacity 0.3s ease;
}

.gdi-videocar__overlay.is-playing {
    opacity: 0;
    pointer-events: none;
}

.gdi-videocar__play {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 28px;
    border: none;
    border-radius: 999px;
    background: #e02f2f;
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 14px 34px rgba(0, 0, 0, 0.35);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.gdi-videocar__play:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 44px rgba(0, 0, 0, 0.45);
}

.gdi-videocar__play svg {
    width: 20px;
    height: 20px;
}

/* Panah navigasi bundar abu di tepi kiri & kanan (seperti referensi) */
.gdi-videocar__arrow {
    position: absolute;
    top: 50%;
    z-index: 30;
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    border: none;
    border-radius: 50%;
    background: #4b5350;
    color: #ffffff;
    font-size: 14px;
    cursor: pointer;
    box-shadow: 0 10px 24px rgba(20, 58, 44, 0.25);
    transform: translateY(-50%);
    transition: background 0.3s ease, transform 0.3s ease;
}

.gdi-videocar__arrow:hover {
    background: #1a8b4c;
    transform: translateY(-50%) scale(1.06);
}

.gdi-videocar__arrow.gdi-videocar__prev {
    left: 20px;
}

.gdi-videocar__arrow.gdi-videocar__next {
    right: 20px;
}

@media (max-width: 991px) {
    .gdi-videocar {
        padding: 48px 0;
    }

    .gdi-videocar__slide {
        grid-template-columns: 1fr;
        gap: 30px;
        padding: 0 60px;
    }

    .gdi-videocar__points li {
        font-size: 14.5px;
    }

    .gdi-videocar__arrow {
        width: 36px;
        height: 36px;
        font-size: 12px;
    }

    .gdi-videocar__arrow.gdi-videocar__prev {
        left: 10px;
    }

    .gdi-videocar__arrow.gdi-videocar__next {
        right: 10px;
    }
}

/* ================= Timeline ================= */
.gdi-timeline {
    position: relative;
    padding: 52px 0 64px;
    background-color: #f6fbf8;

    /* Pola dot grid halus (subtle dot pattern) */
    background-image: radial-gradient(rgba(0, 135, 90, 0.10) 1.2px, transparent 1.2px);
    background-size: 24px 24px;
}

.gdi-timeline__header {
    text-align: center;
    margin-bottom: 30px;
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

/* -------- Bingkai gradien hijau (tempat garis & kartu) -------- */
.gdi-timeline__frame {
    --tl-ink: #143a2c;
    --tl-ink-soft: #5b6b66;
    --tl-year-bg: #f2d391;
    --tl-year-ink: #4a3a12;
    position: relative;
    max-width: 1120px;
    margin: 0 auto;
    padding: 30px 34px 34px;
    border-radius: 28px;
    background:
        radial-gradient(120% 90% at 8% 0%, rgba(255, 255, 255, 0.55), transparent 55%),
        linear-gradient(140deg, #f2faf5 0%, #dcefe4 50%, #b6d8c5 100%);
    box-shadow: 0 24px 50px -34px rgba(6, 74, 46, 0.28);
    overflow: hidden;
}

/* -------- Penghitung agenda di kiri atas -------- */
.gdi-timeline__clock {
    position: absolute;
    top: 22px;
    left: 26px;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 11px 18px;
    border-radius: 14px;
    background: linear-gradient(135deg, #04231a 0%, #06301f 55%, #0a4a2e 100%);
    box-shadow:
        0 10px 22px -12px rgba(3, 25, 18, 0.9),
        inset 0 1px 0 rgba(255, 255, 255, 0.12);
}

.gdi-timeline__clock-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #e0776f;
    box-shadow: 0 0 0 3px rgba(224, 119, 111, 0.16), 0 0 8px 1px rgba(224, 119, 111, 0.45);
    animation: gdi-tl-blink 1.6s ease-in-out infinite;
}

.gdi-timeline__clock-num {
    font-family: ui-monospace, "SFMono-Regular", Consolas, monospace;
    font-size: 30px;
    line-height: 1;
    font-weight: 600;
    letter-spacing: 0.12em;
    color: #ffffff;
    font-variant-numeric: tabular-nums;
}

/* -------- Garis putus-putus vertikal di tengah -------- */
.gdi-timeline__list {
    position: relative;
    margin-top: 84px;
}

.gdi-timeline__list::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 2px;
    transform: translateX(-50%);
    background-image: linear-gradient(to bottom, rgba(6, 92, 62, 0.28) 55%, transparent 55%);
    background-size: 2px 14px;
    background-repeat: repeat-y;
}

/* -------- Item kiri / kanan (bergantian) -------- */
.gdi-timeline__item {
    position: relative;
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 76px;
    align-items: center;
    margin-bottom: 44px;
}

.gdi-timeline__item:last-of-type {
    margin-bottom: 0;
}

.gdi-timeline__item--left > .gdi-timeline__card {
    grid-column: 1;
}

.gdi-timeline__item--right > .gdi-timeline__card {
    grid-column: 2;
}

/* -------- Simpul belah ketupat di garis tengah -------- */
.gdi-timeline__node {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 11px;
    height: 11px;
    border-radius: 2px;
    background: #ffffff;
    transform: translate(-50%, -50%) rotate(45deg);
    box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.55), 0 3px 8px rgba(6, 74, 46, 0.18);
    z-index: 2;
}

.gdi-timeline__node--aktif {
    animation: gdi-tl-node 2s ease-in-out infinite;
}

@keyframes gdi-tl-node {
    0%, 100% { box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.55), 0 3px 8px rgba(6, 74, 46, 0.18); }
    70%      { box-shadow: 0 0 0 12px rgba(6, 92, 62, 0), 0 3px 8px rgba(6, 74, 46, 0.18); }
}

/* -------- Kartu: dua panel + bayangan peach berlapis -------- */
.gdi-timeline__card {
    position: relative;
    display: flex;
    align-items: stretch;
    gap: 7px;
    padding: 8px;
    border-radius: 14px;
    background: #ffffff;
    box-shadow:
        -9px 9px 0 0 #f4ddd3,
        -17px 17px 0 -1px rgba(255, 245, 240, 0.7),
        0 18px 30px -22px rgba(20, 58, 44, 0.35);
}

/* Badge tanggal di pojok kiri atas kartu */
.gdi-timeline__year {
    position: absolute;
    top: -10px;
    left: 14px;
    z-index: 2;
    max-width: calc(100% - 28px);
    padding: 2px 9px;
    border-radius: 5px;
    background: var(--tl-year-bg);
    color: var(--tl-year-ink);
    font-size: 0.72rem;
    font-weight: 700;
    line-height: 1.5;
    letter-spacing: 0.02em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    box-shadow: 0 3px 6px -3px rgba(80, 60, 20, 0.28);
}

.gdi-timeline__panel {
    border-radius: 10px;
    padding: 18px 16px 16px;
}

.gdi-timeline__panel--main {
    flex: 1 1 auto;
    min-width: 0;
}

.gdi-timeline__panel--side {
    flex: 0 0 34%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: linear-gradient(180deg, #ffffff 0%, #fbf1ec 100%);
    border: 1px solid #f3e7e0;
}

.gdi-timeline__card-title {
    font-size: 17px;
    font-weight: 700;
    line-height: 1.3;
    color: var(--tl-ink);
    margin-bottom: 5px;
    overflow-wrap: break-word;
}

.gdi-timeline__card-desc {
    margin: 0;
    font-size: 12.5px;
    line-height: 1.55;
    color: var(--tl-ink-soft);
    overflow-wrap: break-word;
}

/* -------- Catatan status di dalam kartu -------- */
.gdi-timeline__note {
    margin: 10px 0 0;
    padding: 8px 10px;
    border-radius: 8px;
    font-size: 11.5px;
    line-height: 1.55;
    display: flex;
    align-items: flex-start;
    gap: 6px;
}

.gdi-timeline__note i {
    margin-top: 2px;
    flex-shrink: 0;
}

.gdi-timeline__note--selesai {
    color: #4b5563;
    background: #f3f6f8;
    border-left: 3px solid #c3ccd4;
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

/* -------- Panel status (kanan kartu) -------- */
.gdi-timeline__side-label {
    display: block;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #5f7169;
    margin-bottom: 4px;
}

.gdi-timeline__side-value {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14.5px;
    font-weight: 700;
    line-height: 1.3;
    color: var(--tl-ink);
}

.gdi-timeline__side-value--selesai {
    color: #7a8a80;
}

.gdi-timeline__side-value--aktif {
    color: #00875A;
}

.gdi-timeline__side-value--mendatang {
    color: #a06a00;
}

.gdi-timeline__badge-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: currentColor;
    animation: gdi-tl-blink 1.2s ease-in-out infinite;
}

@keyframes gdi-tl-blink {
    0%, 100% { opacity: 1; }
    50%      { opacity: 0.25; }
}

.gdi-timeline__empty {
    text-align: center;
    color: #f2fbf6;
    padding: 40px 0;
}

/* -------- Penghubung ke Tanya Jawab -------- */
.gdi-timeline__flow {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 7px;
    margin-top: 40px;
}

.gdi-timeline__flow-line {
    width: 2px;
    height: 22px;
    border-radius: 999px;
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0.1));
}

.gdi-timeline__flow-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #00875A;
    background: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.9);
    padding: 8px 16px;
    border-radius: 999px;
    box-shadow: 0 6px 16px rgba(16, 44, 70, 0.18);
    white-space: nowrap;
}

.gdi-timeline__flow-chip i {
    animation: gdi-flow-bounce 1.6s ease-in-out infinite;
}

@keyframes gdi-flow-bounce {
    0%, 100% { transform: translateY(0); opacity: 1; }
    50%      { transform: translateY(3px); opacity: 0.5; }
}

/* -------- Tablet & mobile: satu kolom, garis di kiri -------- */
@media (max-width: 991px) {
    .gdi-timeline__frame {
        padding: 22px 20px 28px;
        border-radius: 22px;
    }

    .gdi-timeline__clock {
        top: 18px;
        left: 18px;
        padding: 9px 15px;
    }

    .gdi-timeline__clock-num {
        font-size: 26px;
    }

    .gdi-timeline__list {
        margin-top: 76px;
    }

    .gdi-timeline__list::before {
        left: 21px;
        transform: none;
    }

    .gdi-timeline__item,
    .gdi-timeline__item--left,
    .gdi-timeline__item--right {
        grid-template-columns: 1fr;
        column-gap: 0;
        padding-left: 52px;
        margin-bottom: 38px;
    }

    .gdi-timeline__item--left > .gdi-timeline__card,
    .gdi-timeline__item--right > .gdi-timeline__card {
        grid-column: 1 / -1;
    }

    .gdi-timeline__node,
    .gdi-timeline__item--left > .gdi-timeline__node,
    .gdi-timeline__item--right > .gdi-timeline__node {
        left: 21px;
        top: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .gdi-timeline__card {
        box-shadow:
            -7px 7px 0 0 #f4ddd3,
            -13px 13px 0 -1px rgba(255, 245, 240, 0.7),
            0 16px 26px -20px rgba(20, 58, 44, 0.32);
    }
}

@media (max-width: 575px) {
    .gdi-timeline__frame {
        padding: 18px 14px 24px;
        border-radius: 18px;
    }

    .gdi-timeline__clock {
        top: 14px;
        left: 14px;
        gap: 8px;
        padding: 8px 13px;
        border-radius: 11px;
    }

    .gdi-timeline__clock-num {
        font-size: 22px;
    }

    .gdi-timeline__list {
        margin-top: 66px;
    }

    .gdi-timeline__list::before {
        left: 15px;
    }

    .gdi-timeline__item,
    .gdi-timeline__item--left,
    .gdi-timeline__item--right {
        padding-left: 42px;
        margin-bottom: 32px;
    }

    .gdi-timeline__node,
    .gdi-timeline__item--left > .gdi-timeline__node,
    .gdi-timeline__item--right > .gdi-timeline__node {
        left: 15px;
        width: 10px;
        height: 10px;
    }

    .gdi-timeline__card {
        flex-direction: column;
        gap: 6px;
        padding: 7px;
    }

    .gdi-timeline__year {
        white-space: normal;
        font-size: 0.68rem;
    }

    .gdi-timeline__panel {
        padding: 15px 13px 13px;
    }

    .gdi-timeline__panel--side {
        flex: 1 1 auto;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        text-align: left;
        padding: 10px 13px;
    }

    .gdi-timeline__side-label {
        margin-bottom: 0;
    }

    .gdi-timeline__card-title {
        font-size: 15.5px;
    }

    .gdi-timeline__card-desc {
        font-size: 12px;
    }

    .gdi-timeline__flow-chip {
        max-width: 100%;
        white-space: normal;
        text-align: center;
        font-size: 11px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .gdi-timeline__clock-dot,
    .gdi-timeline__badge-dot,
    .gdi-timeline__node--aktif,
    .gdi-timeline__flow-chip i {
        animation: none;
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