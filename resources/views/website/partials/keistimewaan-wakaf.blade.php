{{-- =====================================================================
     Keistimewaan Wakaf & Hibah — (Uji Coba / Dinamis)
     =====================================================================
     Dipakai di bawah section "Timeline Penting" (setelah timeline,
     sebelum FAQ) melalui @yield('after_timeline') di partial timeline.

     Data bersifat dinamis: cukup ubah array $defaultPoin di bawah,
     atau kirim dari controller:
       - $keistimewaanItems : array [ 'emoji' => .., 'label' => .., 'text' => .. ]
     ===================================================================== --}}
@php
    $defaultPoin = [
        ['emoji' => '📜', 'label' => 'Pahala Berkelanjutan', 'text' => 'Manfaatnya terus mengalir, pahalanya pun terus berjalan sebagai amal jariyah.'],
        ['emoji' => '🤝', 'label' => 'Amanah & Transparan', 'text' => 'Setiap penyaluran dikelola secara profesional, amanah, dan transparan.'],
        ['emoji' => '🕌', 'label' => 'Menopang Dakwah', 'text' => 'Wakaf & hibah Anda menopang operasional program dakwah Graha Dhuafa Indonesia.'],
        ['emoji' => '🏫', 'label' => 'Mendukung Sosial', 'text' => 'Tepat sasaran untuk pengembangan program sosial bagi masyarakat dhuafa.'],
        ['emoji' => '🌱', 'label' => 'Manfaat Berkelanjutan', 'text' => 'Nikmatnya terus dirasakan masyarakat dari waktu ke waktu tanpa terputus.'],
    ];
    $poin = isset($keistimewaanItems) && is_array($keistimewaanItems) ? $keistimewaanItems : $defaultPoin;
@endphp

<!-- ====== Keistimewaan Wakaf & Hibah ====== -->
<section class="gdi-keistimewaan">
    <div class="gdi-keistimewaan__inner">
        <p class="gdi-keistimewaan__tagline">KEISTIMEWAAN</p>
        <h2 class="gdi-keistimewaan__title">Keistimewaan Wakaf &amp; Hibah! <span aria-hidden="true">✨</span></h2>
        <p class="gdi-keistimewaan__desc">
            Setiap rupiah wakaf &amp; hibah Anda menjadi amal jariyah dengan manfaat
            dan pahala yang terus mengalir!
        </p>

        <div class="gdi-keistimewaan__grid">
            @forelse($poin as $i => $p)
                <div class="gdi-keistimewaan__card wow fadeInUp" data-wow-delay="{{ ($i % 5) * 100 }}ms">
                    <span class="gdi-keistimewaan__emoji" aria-hidden="true">{{ $p['emoji'] }}</span>
                    <h3 class="gdi-keistimewaan__label">{{ $p['label'] }}</h3>
                    <p class="gdi-keistimewaan__text">{{ $p['text'] }}</p>
                </div>
            @empty
                <div class="gdi-keistimewaan__empty">Belum ada daftar keistimewaan.</div>
            @endforelse
        </div>
    </div>
</section>
<!-- ====== End Keistimewaan ====== -->

<style>
/* ================= Keistimewaan Wakaf & Hibah ================= */
.gdi-keistimewaan {
    position: relative;
    overflow: hidden;
    padding: 70px 0 80px;
    text-align: center;
    background-color: #356e20;
    color: #ffffff;
}

/* Pola dot grid halus (subtle dot pattern) */
.gdi-keistimewaan::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.09) 1.2px, transparent 1.2px);
    background-size: 26px 26px;
    pointer-events: none;
}

.gdi-keistimewaan__inner {
    position: relative;
    z-index: 1;
    max-width: 1180px;
    margin: 0 auto;
    padding: 0 20px;
}

.gdi-keistimewaan__tagline {
    display: inline-block;
    color: #a3e635;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    margin-bottom: 12px;
}

.gdi-keistimewaan__title {
    font-size: clamp(30px, 4vw, 44px);
    font-weight: 800;
    line-height: 1.25;
    color: #ffffff;
    margin-bottom: 16px;
}

.gdi-keistimewaan__desc {
    max-width: 560px;
    margin: 0 auto;
    font-size: 16.5px;
    line-height: 1.75;
    color: rgba(255, 255, 255, 0.88);
}

.gdi-keistimewaan__grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
    margin-top: 46px;
    text-align: center;
}

.gdi-keistimewaan__card {
    background: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.65);
    border-radius: 14px;
    padding: 26px 18px 22px;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.18);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gdi-keistimewaan__card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 44px rgba(0, 0, 0, 0.26);
}

.gdi-keistimewaan__emoji {
    display: block;
    font-size: 36px;
    line-height: 1;
    margin-bottom: 14px;
}

.gdi-keistimewaan__label {
    font-size: 16.5px;
    font-weight: 800;
    color: #2f7d3b;
    margin-bottom: 8px;
}

.gdi-keistimewaan__text {
    font-size: 13.5px;
    line-height: 1.65;
    color: #4b5563;
    margin-bottom: 0;
    overflow-wrap: break-word;
}

.gdi-keistimewaan__empty {
    grid-column: 1 / -1;
    text-align: center;
    color: rgba(255, 255, 255, 0.75);
    padding: 30px 0;
}

@media (max-width: 991px) {
    .gdi-keistimewaan {
        padding: 60px 0 70px;
    }

    .gdi-keistimewaan__grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 36px;
    }
}

@media (max-width: 575px) {
    .gdi-keistimewaan__grid {
        grid-template-columns: 1fr;
    }
}
</style>
