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
    ]);

    /* ---- Semua berita: DB (terbaru) + demo, total maksimal 10 kartu ----
       Pagination "berkurang": halaman 1 tampil SEMUA berita, tiap klik Next
       tampilannya berkurang 4 kartu (10 → 6 → 2); Prev menambah kembali.
       Berita teratas (terbaru) selalu tetap tampil. */
    $semuaBerita = collect(@$blogHome ?? [])->take(10)->values();
    if ($semuaBerita->count() < 10) {
        $semuaBerita = $semuaBerita->merge($beritaDemo->take(10 - $semuaBerita->count()));
    }
    $perHalaman = 4;  /* jumlah kartu yang dikurangi per klik Next */
    $totalBerita = $semuaBerita->count();
    $totalHalaman = max(1, (int) ceil($totalBerita / $perHalaman));
    $halamanAktif = (int) (@$_GET['halaman'] ?? 1);
    $halamanAktif = min(max(1, $halamanAktif), $totalHalaman);
    /* Jumlah kartu yang tampil pada halaman aktif */
    $tampilSekarang = max(0, $totalBerita - (($halamanAktif - 1) * $perHalaman));

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
                            /* Kartu di luar jumlah tampil saat ini disembunyikan (ditampilkan via JS saat Prev) */
                            $diLuarHalaman = $idxBerita >= $tampilSekarang;
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
                    <p class="news-counter" id="news-counter">Menampilkan <strong>{{ $tampilSekarang }}</strong> dari {{ $totalBerita }} berita</p>

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
                                    <a class="blog-pagination__link" href="{{ $urlHalaman($halamanAktif - 1) }}"
                                       aria-label="Halaman sebelumnya"{{ $halamanAktif <= 1 ? ' tabindex="-1"' : '' }}>&#10094; Prev</a>
                                </li>
                                @if($mulai > 1)
                                    <li class="blog-pagination__item">
                                        <a class="blog-pagination__link" href="{{ $urlHalaman(1) }}">1</a>
                                    </li>
                                    <li class="blog-pagination__item blog-pagination__item--gap"><span>...</span></li>
                                @endif
                                @for($no = $mulai; $no <= $akhir; $no++)
                                    <li class="blog-pagination__item{{ $no === $halamanAktif ? ' blog-pagination__item--active' : '' }}">
                                        <a class="blog-pagination__link" href="{{ $urlHalaman($no) }}"{{ $no === $halamanAktif ? ' aria-current="page"' : '' }}>{{ $no }}</a>
                                    </li>
                                @endfor
                                @if($akhir < $totalHalaman)
                                    <li class="blog-pagination__item blog-pagination__item--gap"><span>...</span></li>
                                    <li class="blog-pagination__item">
                                        <a class="blog-pagination__link" href="{{ $urlHalaman($totalHalaman) }}">{{ $totalHalaman }}</a>
                                    </li>
                                @endif
                                <li class="blog-pagination__item{{ $halamanAktif >= $totalHalaman ? ' blog-pagination__item--disabled' : '' }}">
                                    <a class="blog-pagination__link" href="{{ $urlHalaman($halamanAktif + 1) }}"
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
/* ===== Pagination tanpa reload (mode "berkurang") =====
   Semua kartu sudah ada di DOM. Halaman 1 = tampil semua; tiap klik Next
   menyembunyikan 4 kartu dari bawah (jumlah tampil berkurang); Prev
   menambahkannya kembali. Posisi scroll halaman TIDAK bergerak. */
(function () {
    var grid = document.getElementById('news-grid');
    var nav = document.querySelector('.blog-pagination');
    if (!grid || !nav) return;

    var perHalaman = {{ $perHalaman }};
    var total = grid.querySelectorAll('.news-card').length;
    var totalHalaman = Math.max(1, Math.ceil(total / perHalaman));
    var counter = document.getElementById('news-counter');

    function tampilHalaman(no) {
        no = Math.min(Math.max(1, no), totalHalaman);
        /* Mode berkurang: halaman 1 = semua, tiap Next mengurangi perHalaman kartu */
        var tampilJumlah = Math.max(0, total - (no - 1) * perHalaman);

        grid.querySelectorAll('.news-card').forEach(function (card) {
            var idx = parseInt(card.getAttribute('data-news-index'), 10);
            var tampil = idx < tampilJumlah;
            card.classList.toggle('news-card--hidden', !tampil);
            /* Animasi fade-in untuk kartu yang baru muncul */
            card.classList.remove('news-card--show');
            if (tampil) {
                void card.offsetWidth; /* restart animasi CSS */
                card.classList.add('news-card--show');
            }
        });

        /* Perbarui penghitung "Menampilkan X dari Y berita" */
        if (counter) {
            counter.innerHTML = 'Menampilkan <strong>' + tampilJumlah + '</strong> dari ' + total + ' berita';
        }

        /* Perbarui nomor halaman aktif */
        nav.querySelectorAll('.blog-pagination__item').forEach(function (li) {
            var a = li.querySelector('a');
            if (!a) return;
            var m = a.getAttribute('href').match(/halaman=(\d+)/);
            var aktif = m && parseInt(m[1], 10) === no;
            li.classList.toggle('blog-pagination__item--active', aktif);
            if (aktif) a.setAttribute('aria-current', 'page');
            else a.removeAttribute('aria-current');
        });

        /* Prev/Next nonaktif di ujung */
        var prev = nav.querySelector('[aria-label="Halaman sebelumnya"]');
        var next = nav.querySelector('[aria-label="Halaman berikutnya"]');
        if (prev) prev.parentElement.classList.toggle('blog-pagination__item--disabled', no <= 1);
        if (next) next.parentElement.classList.toggle('blog-pagination__item--disabled', no >= totalHalaman);

        /* Perbarui URL tanpa reload (?halaman=N) */
        if (window.history && history.pushState) {
            var url = new URL(window.location.href);
            url.searchParams.set('halaman', no);
            history.pushState({}, '', url);
        }
    }

    nav.addEventListener('click', function (e) {
        var a = e.target.closest('a.blog-pagination__link');
        if (!a) return;
        if (a.parentElement.classList.contains('blog-pagination__item--disabled')) return;
        var m = a.getAttribute('href').match(/halaman=(\d+)/);
        if (!m) return;
        e.preventDefault(); /* cegah lompat/lompatan anchor & reload */
        tampilHalaman(parseInt(m[1], 10));
    });

    /* Dukung tombol back/forward browser */
    window.addEventListener('popstate', function () {
        var m = window.location.search.match(/halaman=(\d+)/);
        tampilHalaman(m ? parseInt(m[1], 10) : 1);
    });
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
