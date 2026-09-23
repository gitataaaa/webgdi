{{-- ============================================================ --}}
{{-- Section Berita / Blog Homepage                                --}}
{{-- Grid kartu berita (kiri) + sidebar Popular posts (kanan, sticky) --}}
{{-- Pagination (Prev / nomor halaman / Next) di bawah grid --}}
{{-- ============================================================ --}}

@php
    /* ---- Format tanggal Indonesia singkat, contoh: 25 Apr 2026 ---- */
    $bulanPendek = [
        '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
        '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
        '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des',
    ];
    $formatTanggal = function ($tanggal) use ($bulanPendek) {
        if (empty($tanggal)) {
            return '';
        }
        return date('d', strtotime($tanggal)) . ' '
            . ($bulanPendek[date('m', strtotime($tanggal))] ?? '') . ' '
            . date('Y', strtotime($tanggal));
    };

    /* ---- Ringkasan (excerpt) singkat dari konten berita ---- */
    $potongExcerpt = function ($teks, $panjang = 130) {
        $bersih = trim(preg_replace('/\s+/', ' ', strip_tags($teks ?? '')));
        if ($bersih === '') {
            return '';
        }
        return mb_strlen($bersih) > $panjang ? mb_substr($bersih, 0, $panjang) . '...' : $bersih;
    };

    /* ---- Data demo bertema Islami/donasi (melengkapi bila data DB kurang) ---- */
    $beritaDemo = collect([
        (object) [
            'title'        => 'Program Pemberdayaan Desa Binaan',
            'slug'         => null,
            'featured_img' => 'images/blog/sedekah-ramadhan.jpg',
            'kategori'     => 'Program',
            'date_publish' => '2026-04-25',
            'content'      => 'Pelatihan keterampilan dan pemberian modal usaha mikro bagi keluarga dhuafa di desa binaan agar mampu berdiri sendiri secara ekonomi.',
        ],
        (object) [
            'title'        => 'Laporan Penyaluran Zakat',
            'slug'         => null,
            'featured_img' => 'images/blog/panas.jpg',
            'kategori'     => 'Berita',
            'date_publish' => '2026-04-18',
            'content'      => 'Transparansi penyaluran zakat, infak, dan sedekah para donatur kepada delapan asnaf di berbagai wilayah sepanjang triwulan ini.',
        ],
        (object) [
            'title'        => 'Santunan Anak Yatim & Dhuafa',
            'slug'         => null,
            'featured_img' => 'images/blog/2e10e7a278d7e5b7b0bf939a2399f97a.jpg',
            'kategori'     => 'Donasi',
            'date_publish' => '2026-04-10',
            'content'      => 'Program santunan rutin untuk anak yatim dan dhuafa sebagai wujud kepedulian bersama dalam merangkul serta meringankan beban saudara kita.',
        ],
        (object) [
            'title'        => 'Kajian: Zakat Penghapus Dosa',
            'slug'         => null,
            'featured_img' => 'images/blog/qiyamullail.jpg',
            'kategori'     => 'Kajian',
            'date_publish' => '2026-04-05',
            'content'      => 'Membahas hikmah zakat dan kedudukannya sebagai pembersih harta sekaligus penghapus dosa dalam menumbuhkan ketenangan jiwa.',
        ],
        (object) [
            'title'        => 'Ekspedisi Tebar Al-Quran untuk Pedalaman',
            'slug'         => null,
            'featured_img' => 'images/blog/rice-learnreliggions-com.jpg',
            'kategori'     => 'Program',
            'date_publish' => '2026-03-30',
            'content'      => 'Menyalurkan ratusan mushaf Al-Quran ke wilayah pedalaman sebagai langkah menumbuhkan generasi Quran yang tinggi ilmu dan akhlaknya.',
        ],
        (object) [
            'title'        => 'Wakaf Sumur Bersih untuk Desa Tercisolasi',
            'slug'         => null,
            'featured_img' => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg',
            'kategori'     => 'Donasi',
            'date_publish' => '2026-03-21',
            'content'      => 'Wakaf sumur bor memberikan akses air bersih bagi warga desa terpencil, memudahkan ibadah sekaligus memenuhi kebutuhan harian.',
        ],
        (object) [
            'title'        => 'Jumat Berkah: Berbagi 500 Nasi Kotak',
            'slug'         => null,
            'featured_img' => 'images/blog/cat.jpg',
            'kategori'     => 'Program',
            'date_publish' => '2026-03-14',
            'content'      => 'Setiap Jumat, relawan membagikan nasi kotak gratis kepada kaca dan pemulung di sekitar kota sebagai amal jariah yang berkesinambungan.',
        ],
        (object) [
            'title'        => 'Beasiswa Pendidikan Anak Yatim',
            'slug'         => null,
            'featured_img' => 'images/blog/download (4).jpeg',
            'kategori'     => 'Edukasi',
            'date_publish' => '2026-03-07',
            'content'      => 'Program beasiswa pendidikan dari jenjang SD hingga SMA bagi anak yatim berprestasi agar tetap semangat meraih cita-cita tinggi.',
        ],
        (object) [
            'title'        => 'Qurban Tahunan: Daging Sampai ke Pelosok',
            'slug'         => null,
            'featured_img' => 'images/blog/wow.jpeg',
            'kategori'     => 'Berita',
            'date_publish' => '2026-02-28',
            'content'      => 'Penyaluran daging qurban ke desa-desa terpencil yang jarang mendapat jatah qurban, dibagikan tepat pada hari raya idul adha.',
        ],
        (object) [
            'title'        => 'Pembangunan Mushaf Al-Quran Desa',
            'slug'         => null,
            'featured_img' => 'images/blog/qiyamullail.jpg',
            'kategori'     => 'Edukasi',
            'date_publish' => '2026-02-20',
            'content'      => 'Pembangunan mushala dan tpa untuk menghidupkan kembali semangat belajar Al-Quran di lingkungan desa binaan yayasan.',
        ],
        (object) [
            'title'        => 'Pelatihan Menjahit untuk Ibu Rumah Tangga',
            'slug'         => null,
            'featured_img' => 'images/blog/sedekah-ramadhan.jpg',
            'kategori'     => 'Program',
            'date_publish' => '2026-02-12',
            'content'      => 'Pelatihan keterampilan menjahit bagi ibu-ibu dhuafa agar mampu menghasilkan pemasukan tambahan bagi keluarga di rumah.',
        ],
        (object) [
            'title'        => 'Donasi Alat Tulis ke Sekolah Dhuafa',
            'slug'         => null,
            'featured_img' => 'images/blog/rice-learnreliggions-com.jpg',
            'kategori'     => 'Donasi',
            'date_publish' => '2026-02-05',
            'content'      => 'Pengadaan buku, alat tulis, dan tas sekolah bagi siswa-siswi dhuafa agar semangat belajar mereka tidak pernah padam.',
        ],
        (object) [
            'title'        => 'Kajian Bulanan: Sabar dan Syukur',
            'slug'         => null,
            'featured_img' => 'images/blog/qiyamullail.jpg',
            'kategori'     => 'Kajian',
            'date_publish' => '2026-01-28',
            'content'      => 'Kajian rutin bulanan membedah makna sabar dan syukur sebagai kunci ketenangan hati dalam menghadapi lika-liku kehidupan.',
        ],
        (object) [
            'title'        => 'Buka Puasa Bersama Anak Yatim',
            'slug'         => null,
            'featured_img' => 'images/blog/cat.jpg',
            'kategori'     => 'Program',
            'date_publish' => '2026-01-20',
            'content'      => 'Menghadirkan kebersamaan berbuka puasa dan tausiyah hangat bersama anak-anak yatim binaan di bulan penuh berkah.',
        ],
        (object) [
            'title'        => 'Lomba Tahfiz Anak Berprestasi',
            'slug'         => null,
            'featured_img' => 'images/blog/download (4).jpeg',
            'kategori'     => 'Edukasi',
            'date_publish' => '2026-01-13',
            'content'      => 'Ajang kompetisi hafalan Al-Quran juz 30 bagi anak-anak dalam rangka memotivasi generasi cinta Al-Quran.',
        ],
        (object) [
            'title'        => 'Hidroponik untuk Ketahanan Pangan',
            'slug'         => null,
            'featured_img' => 'images/blog/wow.jpeg',
            'kategori'     => 'Program',
            'date_publish' => '2026-01-06',
            'content'      => 'Pembuatan kebun hidroponik sederhana untuk keluarga dhuafa sebagai sumber sayur sehat dan nilai ekonomi baru.',
        ],
        (object) [
            'title'        => 'Bantuan Korban Bencana Alam',
            'slug'         => null,
            'featured_img' => 'images/blog/8a0b575bfeb8b0ea7a2cf1fc2eecec38.jpg',
            'kategori'     => 'Donasi',
            'date_publish' => '2025-12-29',
            'content'      => 'Respon cepat penyaluran bantuan logistik, sandang, dan layanan dapur umum bagi warga terdampak bencana.',
        ],
        (object) [
            'title'        => 'Ambulance Gratis 24 Jam',
            'slug'         => null,
            'featured_img' => 'images/blog/panas.jpg',
            'kategori'     => 'Program',
            'date_publish' => '2025-12-21',
            'content'      => 'Layanan ambulance gratis siap sedia 24 jam untuk memudahkan akses kesehatan bagi masyarakat yang membutuhkan.',
        ],
    ]);

    /* ---- Semua berita: DB (terbaru) + demo, total 18 kartu ----
       Pagination standard: setiap halaman menampilkan $perHalaman kartu
       berdampingan (mis. halaman 1 = kartu 1-6, halaman 2 = kartu 7-12,
       halaman 3 = kartu 13-18). Prev/Next & nomor halaman sinkron. */
    $semuaBerita = collect(@$blogHome ?? [])->take(18)->values();
    if ($semuaBerita->count() < 18) {
        $semuaBerita = $semuaBerita->merge($beritaDemo->take(18 - $semuaBerita->count()));
    }
    $perHalaman = 6;  /* jumlah kartu per halaman */
    $totalBerita = $semuaBerita->count();
    $totalHalaman = max(1, (int) ceil($totalBerita / $perHalaman));
    $halamanAktif = (int) (@$_GET['halaman'] ?? 1);
    $halamanAktif = min(max(1, $halamanAktif), $totalHalaman);
    /* Rentang indeks kartu pada halaman aktif (untuk slicing tampilan) */
    $mulaiData = ($halamanAktif - 1) * $perHalaman;
    $akhirData = min($mulaiData + $perHalaman, $totalBerita);
    /* Teks informasi halaman: "Menampilkan X - Y dari Z berita" */
    $dariTampil = $totalBerita > 0 ? $mulaiData + 1 : 0;
    $sampaiTampil = $totalBerita > 0 ? $akhirData : 0;

    /* ---- Sidebar: Popular posts (fallback ke data demo bila DB kosong) ---- */
    $beritaPopuler = collect(@$blogHomePopular ?? (@$blogHome ?? []));
    if ($beritaPopuler->isEmpty()) {
        $beritaPopuler = $beritaDemo;
    }
    $beritaPopuler = $beritaPopuler->take(5);
@endphp

<section class="blog-section" id="berita-blog-homepage">
    <div class="container">

        <!-- Heading Section -->
        <div class="blog-section__heading">
            <span class="blog-section__tagline">Berita</span>
            <h2 class="blog-section__title">Kabar Kebaikan dan Inspirasi</h2>
            <p class="blog-section__desc">
                Ikuti perkembangan informasi zakat, infak, sedekah, wakaf, kajian, serta program sosial
                Yayasan Graha Dhuafa Indonesia.
            </p>
        </div>

        <!-- Layout: Kiri (grid berita) + Kanan (sidebar Popular posts) -->
        <div class="blog-layout">
            <!-- ======= Bagian Kiri: Grid kartu berita besar (2 kolom per baris) =======
                 Mengalir normal mengikuti scroll halaman (natural flow). -->
            <div class="blog-layout__main">
                <div class="blog-layout__main-sticky">
                    <div class="news-grid" id="news-grid">
                    @foreach($semuaBerita as $dt)
                        @php
                            $urlDetail = !empty($dt->slug) ? '/blog/' . $dt->slug : '/blog';
                            $excerpt = $potongExcerpt($dt->content ?? '');
                            $idxBerita = $loop->index;
                            /* Kartu di luar rentang halaman aktif disembunyikan (ditampilkan via JS saat pindah halaman) */
                            $diLuarHalaman = $idxBerita < $mulaiData || $idxBerita >= $akhirData;
                        @endphp
                        <article class="news-card{{ $diLuarHalaman ? ' news-card--hidden' : '' }}" data-news-index="{{ $idxBerita }}">
                            <a href="{{ $urlDetail }}" class="news-card__image">
                                <img src="{{ asset($dt->featured_img) }}" alt="{{ $dt->title }}" loading="lazy">
                            </a>
                            <div class="news-card__body">
                                <h3 class="news-card__title">
                                    <a href="{{ $urlDetail }}">{{ $dt->title }}</a>
                                </h3>
                                <div class="news-card__meta">
                                    <span>{{ $formatTanggal($dt->date_publish) }}</span>
                                    <span class="news-card__dot"></span>
                                    <span>{{ $dt->kategori ?? 'Berita' }}</span>
                                </div>
                                <p class="news-card__excerpt">
                                    {{ $excerpt !== '' ? $excerpt : 'Baca selengkapnya kabar kebaikan program zakat, infak, sedekah, dan wakaf bersama Yayasan Graha Dhuafa Indonesia.' }}
                                </p>
                                <a href="{{ $urlDetail }}" class="news-card__btn">
                                    View Detail <span class="news-card__btn-icon">&#10142;</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                    </div>

                    <!-- Penghitung jumlah berita tampil (berubah tiap Next/Prev) -->
                    <p class="news-counter" id="news-counter">Menampilkan <strong>{{ $dariTampil }} - {{ $sampaiTampil }}</strong> dari {{ $totalBerita }} berita</p>

                    <!-- Pagination: Prev / nomor halaman / Next -->
                    @if($totalHalaman > 1)
                        @php
                            /* Kumpulan query string saat ini (mis. ?search=...) agar tetap terbawa saat pindah halaman */
                            $qs = array_merge($_GET, []);
                            $urlHalaman = function ($no) use ($qs) {
                                $qs['halaman'] = $no;
                                /* #berita-blog-homepage: setelah pindah halaman, halaman langsung
                                   diposisikan ke section berita (bukan kembali ke atas) */
                                return '?' . http_build_query($qs) . '#berita-blog-homepage';
                            };
                            /* Jendela nomor halaman: maksimal 5 nomor, selalu memuat halaman aktif */
                            $mulai = max(1, $halamanAktif - 2);
                            $akhir = min($totalHalaman, $mulai + 4);
                            $mulai = max(1, $akhir - 4);
                        @endphp
                        <nav class="blog-pagination" aria-label="Navigasi halaman berita">
                            <ul class="blog-pagination__list">
                                <li class="blog-pagination__item{{ $halamanAktif <= 1 ? ' blog-pagination__item--disabled' : '' }}">
                                    <a class="blog-pagination__link" data-page="prev" href="{{ $urlHalaman($halamanAktif - 1) }}"
                                       aria-label="Halaman sebelumnya"{{ $halamanAktif <= 1 ? ' tabindex="-1"' : '' }}>&#10094; Prev</a>
                                </li>
                                @if($mulai > 1)
                                    <li class="blog-pagination__item">
                                        <a class="blog-pagination__link" data-page="1" href="{{ $urlHalaman(1) }}">1</a>
                                    </li>
                                    <li class="blog-pagination__item blog-pagination__item--gap"><span>...</span></li>
                                @endif
                                @for($no = $mulai; $no <= $akhir; $no++)
                                    <li class="blog-pagination__item{{ $no === $halamanAktif ? ' blog-pagination__item--active' : '' }}">
                                        <a class="blog-pagination__link" data-page="{{ $no }}" href="{{ $urlHalaman($no) }}"{{ $no === $halamanAktif ? ' aria-current="page"' : '' }}>{{ $no }}</a>
                                    </li>
                                @endfor
                                @if($akhir < $totalHalaman)
                                    <li class="blog-pagination__item blog-pagination__item--gap"><span>...</span></li>
                                    <li class="blog-pagination__item">
                                        <a class="blog-pagination__link" data-page="{{ $totalHalaman }}" href="{{ $urlHalaman($totalHalaman) }}">{{ $totalHalaman }}</a>
                                    </li>
                                @endif
                                <li class="blog-pagination__item{{ $halamanAktif >= $totalHalaman ? ' blog-pagination__item--disabled' : '' }}">
                                    <a class="blog-pagination__link" data-page="next" href="{{ $urlHalaman($halamanAktif + 1) }}"
                                       aria-label="Halaman berikutnya"{{ $halamanAktif >= $totalHalaman ? ' tabindex="-1"' : '' }}>Next &#10095;</a>
                                </li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>

            <!-- ======= Bagian Kanan: Sidebar (sticky + area scroll sendiri) ======= -->
            <aside class="blog-layout__sidebar">
                <!-- Popular posts -->
                <div class="sidebar-box">
                    <h3 class="sidebar-box__title">Popular posts</h3>
                    <div class="popular-posts">
                        @foreach($beritaPopuler as $dt)
                            @php
                                $urlDetailPopuler = !empty($dt->slug) ? '/blog/' . $dt->slug : '/blog';
                            @endphp
                            <div class="popular-post">
                                <a href="{{ $urlDetailPopuler }}" class="popular-post__image">
                                    <img src="{{ asset($dt->featured_img) }}" alt="{{ $dt->title }}" loading="lazy">
                                </a>
                                <div class="popular-post__content">
                                    <h4><a href="{{ $urlDetailPopuler }}">{{ $dt->title }}</a></h4>
                                    <div class="popular-post__meta">
                                        <span>{{ $formatTanggal($dt->date_publish) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<script>
/* ===== Pagination tanpa reload (mode standard) =====
   Semua kartu sudah ada di DOM. currentPage menentukan rentang kartu
   yang ditampilkan (6 kartu per halaman). Klik nomor / Prev / Next
   mengubah currentPage lalu menyinkronkan: tampilan kartu, teks
   penghitung "Menampilkan X - Y dari Z berita", highlight angka aktif,
   dan status disabled Prev/Next. Posisi scroll halaman tidak bergerak. */
(function () {
    var grid = document.getElementById('news-grid');
    var nav = document.querySelector('.blog-pagination');
    var counter = document.getElementById('news-counter');
    if (!grid || !nav || !counter) return;

    var perHalaman = {{ $perHalaman }};
    var total = grid.querySelectorAll('.news-card').length;
    var totalHalaman = Math.max(1, Math.ceil(total / perHalaman));

    function clamp(no, min, max) {
        return Math.min(Math.max(no, min), max);
    }

    /* State halaman aktif — satu sumber kebenaran untuk semua pembaruan */
    var currentPage = clamp(parseInt((window.location.search.match(/halaman=(\d+)/) || [])[1], 10) || 1, 1, totalHalaman);

    function tampilHalaman(no) {
        /* Update state dulu, baru sinkronkan seluruh tampilan */
        currentPage = clamp(no, 1, totalHalaman);
        var mulai = (currentPage - 1) * perHalaman;
        var akhir = Math.min(mulai + perHalaman, total);

        /* 1) Tampilkan kartu dalam rentang halaman aktif */
        grid.querySelectorAll('.news-card').forEach(function (card) {
            var idx = parseInt(card.getAttribute('data-news-index'), 10);
            var tampil = (idx >= mulai && idx < akhir);
            card.classList.toggle('news-card--hidden', !tampil);
            if (tampil) {
                card.classList.remove('news-card--show');
                void card.offsetWidth; /* restart animasi CSS */
                card.classList.add('news-card--show');
            } else {
                card.classList.remove('news-card--show');
            }
        });

        /* 2) Perbarui teks penghitung "Menampilkan X - Y dari Z berita" */
        var dariN = total > 0 ? mulai + 1 : 0;
        var sampaiN = total > 0 ? akhir : 0;
        counter.innerHTML = 'Menampilkan <strong>' + dariN + ' - ' + sampaiN + '</strong> dari ' + total + ' berita';

        /* 3) Highlight angka halaman aktif */
        nav.querySelectorAll('.blog-pagination__link').forEach(function (a) {
            var li = a.closest('.blog-pagination__item');
            if (!li) return;
            if (a.getAttribute('data-page') === String(currentPage) && li.classList.contains('blog-pagination__item--gap') === false) {
                li.classList.add('blog-pagination__item--active');
                a.setAttribute('aria-current', 'page');
            } else {
                li.classList.remove('blog-pagination__item--active');
                a.removeAttribute('aria-current');
            }
        });

        /* 4) Prev/Next nonaktif di ujung halaman */
        nav.querySelectorAll('.blog-pagination__link[data-page="prev"], .blog-pagination__link[data-page="next"]').forEach(function (a) {
            var li = a.closest('.blog-pagination__item');
            if (!li) return;
            var nonaktif = a.getAttribute('data-page') === 'prev' ? currentPage <= 1 : currentPage >= totalHalaman;
            li.classList.toggle('blog-pagination__item--disabled', nonaktif);
            if (nonaktif) a.setAttribute('tabindex', '-1');
            else a.removeAttribute('tabindex');
        });

        /* 5) Perbarui URL tanpa reload (?halaman=N) */
        if (window.history && history.pushState) {
            var url = new URL(window.location.href);
            url.searchParams.set('halaman', currentPage);
            history.pushState({}, '', url);
        }
    }

    /* Satu delegasi event untuk SELURUH tombol pagination */
    nav.addEventListener('click', function (e) {
        var a = e.target.closest('a.blog-pagination__link');
        if (!a) return;
        var li = a.closest('.blog-pagination__item');
        if (li && li.classList.contains('blog-pagination__item--disabled')) return;

        e.preventDefault(); /* cegah reload & lompatan anchor */

        var page = a.getAttribute('data-page');
        if (page === 'prev') {
            tampilHalaman(currentPage - 1);
        } else if (page === 'next') {
            tampilHalaman(currentPage + 1);
        } else {
            tampilHalaman(parseInt(page, 10));
        }
    });

    /* Dukung tombol back/forward browser: baca dari URL */
    window.addEventListener('popstate', function () {
        var m = window.location.search.match(/halaman=(\d+)/);
        tampilHalaman(m ? parseInt(m[1], 10) : 1);
    });

    /* Sinkronkan keadaan awal (jika URL membawa ?halaman=N, mis. saat refresh) */
    tampilHalaman(currentPage);
})();
</script>

<style>
/* ===== Section ===== */
.blog-section {
    padding: 70px 0 90px;
    background-color: #f7f7f7;
    /* Offset saat lompat anchor (#berita-blog-homepage) agar tidak tertutup header */
    scroll-margin-top: 90px;
}

.blog-section__heading {
    text-align: center;
    margin-bottom: 50px;
}

.blog-section__tagline {
    display: inline-block;
    color: #FF6B35;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.blog-section__title {
    color: #00C89D;
    font-size: 2.2rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 12px;
}

.blog-section__desc {
    color: #6b7280;
    font-size: 0.95rem;
    max-width: 640px;
    margin: 0 auto;
}

/* ===== Layout utama: kiri (grid) + kanan (sidebar) ===== */
.blog-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 40px;
    align-items: start;
}

/* Kolom kiri: mengalir NORMAL mengikuti scroll halaman (tanpa sticky,
   tanpa scroll internal) supaya scroll terasa natural seperti section lain. */
.blog-layout__main {
    min-width: 0;
}

/* Wrapper isi kolom kiri: tanpa perilaku khusus — hanya penanda struktur.
   (Dulu sticky + scroll internal, kini normal agar scroll halaman mengalir.) */
.blog-layout__main-sticky {
    /* natural flow */
}

/* Sidebar: menempel (sticky) DIAM di tempat saat halaman di-scroll.
   top: 120px = jarak aman di bawah navbar; berganti ke 90px saat scroll
   (navbar homepage mengecil). Angka harus lebih kecil dari tinggi viewport
   dikurangi tinggi sidebar agar sticky punya ruang bergerak. */
.blog-layout__sidebar {
    position: sticky;
    top: 120px;
}

/* ===== Grid berita 2 kolom ===== */
.news-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

/* Kartu di luar halaman pagination aktif disembunyikan (ditampilkan via JS).
   !important WAJIB: rule .news-card (display:flex) ditulis setelah rule ini,
   tanpa !important dia akan menimpa display:none-nya (specificity sama). */
.news-card--hidden {
    display: none !important;
}

/* Penghitung jumlah berita tampil */
.news-counter {
    text-align: center;
    color: #6b7280;
    font-size: 0.9rem;
    margin-top: 28px;
    margin-bottom: 4px;
}

.news-counter strong {
    color: #00C89D;
}

/* Animasi halus saat kartu muncul ketika berpindah halaman pagination */
.news-card--show {
    animation: newsCardFadeIn 0.45s ease both;
}

@keyframes newsCardFadeIn {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== Kartu berita ===== */
.news-card {
    background: #fff;
    border: 1px solid #eef1f5;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 14px rgba(0, 0, 0, 0.07);
    transition: box-shadow 0.3s ease, transform 0.3s ease, opacity 0.4s ease;
    display: flex;
    flex-direction: column;
    opacity: 1;
}

.news-card:hover {
    box-shadow: 0 14px 34px rgba(0, 0, 0, 0.14);
    transform: translateY(-4px);
}

/* Gambar utama di atas dengan sudut tumpul (border-radius: 8px) */
.news-card__image {
    display: block;
    overflow: hidden;
    aspect-ratio: 16 / 10;
    border-radius: 8px 8px 0 0;
}

.news-card__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.news-card:hover .news-card__image img {
    transform: scale(1.06);
}

.news-card__body {
    padding: 22px 24px 26px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.news-card__title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #1e2a3a;
    margin-bottom: 10px;
    line-height: 1.4;
}

.news-card__title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.news-card__title a:hover {
    color: #00C89D;
}

/* Tanggal & kategori di bawah judul */
.news-card__meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.78rem;
    color: #8a94a6;
    margin-bottom: 14px;
}

.news-card__dot {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: #00C89D;
    display: inline-block;
}

.news-card__excerpt {
    font-size: 0.9rem;
    color: #6b7280;
    line-height: 1.7;
    margin-bottom: 20px;
    flex: 1;
}

/* Tombol "View Detail" outlined (garis tepi tipis) */
.news-card__btn {
    align-self: flex-start;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border: 1px solid #1e2a3a;
    border-radius: 5px;
    color: #1e2a3a;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.news-card__btn-icon {
    font-size: 0.8rem;
    line-height: 1;
}

.news-card__btn:hover {
    background: #00C89D;
    border-color: #00C89D;
    color: #fff;
}

/* ===== Pagination (Prev / nomor halaman / Next) ===== */
.blog-pagination {
    margin-top: 44px;
}

.blog-pagination__list {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.blog-pagination__link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 14px;
    background: #fff;
    border: 1px solid #1e2a3a;
    border-radius: 30px;
    color: #1e2a3a;
    font-size: 0.9rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-pagination__link:hover {
    background: #00C89D;
    border-color: #00C89D;
    color: #fff;
    box-shadow: 0 10px 24px rgba(0, 200, 157, 0.35);
}

.blog-pagination__item--active .blog-pagination__link {
    background: #00C89D;
    border-color: #00C89D;
    color: #fff;
}

.blog-pagination__item--disabled .blog-pagination__link {
    opacity: 0.45;
    pointer-events: none;
}

.blog-pagination__item--gap span {
    display: inline-block;
    padding: 0 4px;
    color: #8a94a6;
    font-weight: 700;
}

/* ===== Sidebar box (Popular posts) ===== */
.sidebar-box {
    background: #fff;
    border: 1px solid #eef1f5;
    border-radius: 12px;
    padding: 24px 26px;
    box-shadow: 0 2px 14px rgba(0, 0, 0, 0.07);
    margin-bottom: 30px;
}

.sidebar-box:last-child {
    margin-bottom: 0;
}

.sidebar-box__title {
    font-size: 1.15rem;
    font-weight: 800;
    color: #1e2a3a;
    margin-bottom: 16px;
    padding-bottom: 14px;
    border-bottom: 2px solid #eef1f5;
    position: relative;
}

.sidebar-box__title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 46px;
    height: 2px;
    background: #00C89D;
}

/* ===== Popular posts: thumbnail kecil kiri + judul & tanggal kanan ===== */
.popular-post {
    display: flex;
    align-items: center;
    gap: 16px;
}

.popular-post + .popular-post {
    margin-top: 20px;
}

.popular-post__image {
    flex: 0 0 78px;
    width: 78px;
    height: 62px;
    border-radius: 8px;
    overflow: hidden;
}

.popular-post__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.popular-post__content h4 {
    font-size: 0.92rem;
    font-weight: 700;
    margin-bottom: 6px;
    line-height: 1.4;
}

.popular-post__content h4 a {
    color: #1e2a3a;
    text-decoration: none;
    transition: color 0.3s ease;
}

.popular-post__content h4 a:hover {
    color: #00C89D;
}

.popular-post__meta {
    font-size: 0.76rem;
    color: #8a94a6;
}

/* ===== Responsive ===== */
@media (max-width: 1199px) {
    .blog-layout {
        grid-template-columns: minmax(0, 1fr) 300px;
        gap: 30px;
    }
}

@media (max-width: 991px) {
    .blog-layout {
        grid-template-columns: 1fr;
        gap: 36px;
    }

    /* Sidebar tidak menempel di layar kecil (menumpuk normal) */
    .blog-layout__sidebar {
        position: static;
    }

    .news-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
    }
}

@media (max-width: 575px) {
    .news-grid {
        grid-template-columns: 1fr;
    }

    .blog-section__title {
        font-size: 1.7rem;
    }
}
</style>
