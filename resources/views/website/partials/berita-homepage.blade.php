{{-- ============================================================ --}}
{{-- Section Berita / Blog Homepage                                --}}
{{-- Grid kartu berita (kiri) + sidebar Popular posts (kanan, sticky + scroll independen) --}}
{{-- Tombol "Lihat Berita Selanjutnya" di bawah grid (load more 6 kartu per klik) --}}
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
       Tampil bertahap: 4 kartu awal (2 baris) + 6 kartu per klik tombol
       "Lihat Berita Selanjutnya" (3 baris tambahan per klik). */
    $semuaBerita = collect(@$blogHome ?? [])->take(10)->values();
    if ($semuaBerita->count() < 10) {
        $semuaBerita = $semuaBerita->merge($beritaDemo->take(10 - $semuaBerita->count()));
    }
    $tampilkanAwal = 4;    /* awal: 4 kartu (2 kolom x 2 baris) */
    $tampilkanPerKlik = 6; /* per klik: 6 kartu (2 kolom x 3 baris) */

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
                 Wrapper sticky + scroll internal: saat halaman/sidebar di-scroll,
                 grid berita di kiri tetap terkunci di posisinya. -->
            <div class="blog-layout__main">
                <div class="blog-layout__main-sticky">
                    <div class="news-grid" id="news-grid">
                    @foreach($semuaBerita as $dt)
                        @php
                            $index = $loop->index;
                            $urlDetail = !empty($dt->slug) ? '/blog/' . $dt->slug : '/blog';
                            $excerpt = $potongExcerpt($dt->content ?? '');
                        @endphp
                        <article class="news-card{{ $index >= $tampilkanAwal ? ' news-card--hidden' : '' }}"
                                 data-news-index="{{ $index }}">
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

                    <!-- Tombol: Lihat Berita Selanjutnya (menampilkan 6 kartu / 3 baris per klik) -->
                    @if($semuaBerita->count() > $tampilkanAwal)
                        <div class="blog-loadmore">
                            <button type="button" class="blog-loadmore__btn" id="btn-load-more"
                                    data-initial="{{ $tampilkanAwal }}"
                                    data-step="{{ $tampilkanPerKlik }}"
                                    data-total="{{ $semuaBerita->count() }}">
                                Lihat Berita Selanjutnya
                            </button>
                        </div>
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

<style>
/* ===== Section ===== */
.blog-section {
    padding: 70px 0 90px;
    background-color: #f7f7f7;
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

/* ===== Layout utama: kiri (grid) + kanan (sidebar) =====
   align-items: stretch membuat kedua kolom setinggi container grid,
   sehingga masing-masing bisa sticky dan punya scroll internal sendiri. */
.blog-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 40px;
    align-items: stretch;
}

/* Kolom kiri: tetap mengisi tinggi penuh container grid (menentukan
   tinggi baris). Kontennya dibungkus wrapper sticky di bawah ini. */
.blog-layout__main {
    min-width: 0;
    min-height: 100%;
}

/* Wrapper isi kolom kiri: sticky + area scroll sendiri.
   Saat halaman di-scroll ke bawah, grid berita di kiri TIDAK ikut bergeser
   (tetap terkunci di posisinya); isinya di-scroll di dalam wrapper ini.
   Catatan: TANPA overscroll-behavior, sehingga saat scroll internal sudah
   mencapai ujung atas/bawah, scroll berlanjut natural ke halaman —
   halaman tetap bisa naik/turun walau kursor berada di atas kolom. */
.blog-layout__main-sticky {
    position: sticky;
    top: 24px;
    max-height: calc(100vh - 48px);
    overflow-y: auto;
    padding: 4px 14px 20px 4px;
    scrollbar-width: thin;
    scrollbar-color: #1e2a3a #e8eef3;
}

.blog-layout__main-sticky::-webkit-scrollbar {
    width: 6px;
}

.blog-layout__main-sticky::-webkit-scrollbar-track {
    background: #e8eef3;
    border-radius: 8px;
}

.blog-layout__main-sticky::-webkit-scrollbar-thumb {
    background: #1e2a3a;
    border-radius: 8px;
}

/* Sidebar: sticky + area scroll independen (overflow-y: auto).
   Kedua kolom (kiri & kanan) scroll di dalam areanya masing-masing,
   sehingga berita di kiri tidak bergeser saat sidebar di-scroll.
   Scroll chaining dibiarkan aktif agar halaman tetap bisa digulir
   saat scroll internal mencapai ujung. */
.blog-layout__sidebar {
    position: sticky;
    top: 24px;
    max-height: calc(100vh - 48px);
    overflow-y: auto;
    padding-right: 8px;
    scrollbar-width: thin;
    scrollbar-color: #00C89D #e8eef3;
}

.blog-layout__sidebar::-webkit-scrollbar {
    width: 6px;
}

.blog-layout__sidebar::-webkit-scrollbar-track {
    background: #e8eef3;
    border-radius: 8px;
}

.blog-layout__sidebar::-webkit-scrollbar-thumb {
    background: #00C89D;
    border-radius: 8px;
}

/* ===== Grid berita 2 kolom ===== */
.news-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

/* Kartu yang belum ditampilkan ( disembunyikan sampai tombol "Lihat Berita Selanjutnya" diklik) */
.news-card--hidden {
    display: none;
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

.news-card--show {
    animation: newsCardFadeIn 0.45s ease both;
}

@keyframes newsCardFadeIn {
    from {
        opacity: 0;
        transform: translateY(18px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

/* ===== Tombol "Lihat Berita Selanjutnya" ===== */
.blog-loadmore {
    text-align: center;
    margin-top: 44px;
}

.blog-loadmore__btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 13px 34px;
    background: #fff;
    border: 1px solid #1e2a3a;
    border-radius: 30px;
    color: #1e2a3a;
    font-size: 0.95rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
}

.blog-loadmore__btn:hover {
    background: #00C89D;
    border-color: #00C89D;
    color: #fff;
    box-shadow: 0 10px 24px rgba(0, 200, 157, 0.35);
}

.blog-loadmore__btn:disabled {
    opacity: 0.55;
    cursor: not-allowed;
    box-shadow: none;
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

    /* Nonaktifkan sticky + scroll independen di layar kecil
       (grid & sidebar menumpuk normal mengikuti scroll halaman) */
    .blog-layout__main-sticky {
        position: static;
        max-height: none;
        overflow: visible;
        padding: 0;
    }

    .blog-layout__sidebar {
        position: static;
        max-height: none;
        overflow: visible;
        padding-right: 0;
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

<script>
/* ===== Load More: "Lihat Berita Selanjutnya" =====
   Menampilkan 6 kartu (3 baris) tambahan per klik tanpa reload.
   Karena kartu diminta sejak awal (hanya disembunyikan), kartu yang
   sudah muncul tidak bergeser sedikit pun saat kartu baru ditambahkan. */
(function () {
    var btn = document.getElementById('btn-load-more');
    if (!btn) return;

    var initial = parseInt(btn.getAttribute('data-initial'), 10) || 4;
    var step = parseInt(btn.getAttribute('data-step'), 10) || 6;
    var total = parseInt(btn.getAttribute('data-total'), 10) || 0;
    var shown = initial;

    btn.addEventListener('click', function () {
        var berikutnya = Math.min(shown + step, total);
        var terbuka = 0;

        document.querySelectorAll('#news-grid .news-card--hidden').forEach(function (card) {
            var idx = parseInt(card.getAttribute('data-news-index'), 10);
            if (idx >= shown && idx < berikutnya) {
                card.classList.remove('news-card--hidden');
                card.classList.add('news-card--show');
                terbuka++;
            }
        });

        shown = berikutnya;

        /* Gulir area internal kolom kiri ke bawah agar baris baru terlihat
           (hanya menggeser scroll internal, tidak menggeser halaman). */
        if (terbuka > 0) {
            var wrap = document.querySelector('.blog-layout__main-sticky');
            if (wrap && wrap.scrollTo) {
                wrap.scrollTo({ top: wrap.scrollHeight, behavior: 'smooth' });
            }
        }

        if (shown >= total) {
            btn.disabled = true;
            btn.textContent = 'Semua Berita Sudah Tampil';
        }
    });
})();
</script>
