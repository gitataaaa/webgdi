{{-- =====================================================================
     CTA Wakaf & Hibah — kartu ajakan menyalurkan wakaf
     =====================================================================
     Dipakai di bawah section "Keistimewaan Wakaf & Hibah" (masih di
     slot @yield('after_timeline') partial timeline).

     Data dinamis: kirim dari controller
       - $wakafCta : [
             'tagline'  => ..,
             'title'    => ..,
             'desc'     => ..,
             'badge'    => ..,
             'primary'  => ['text' => .., 'url' => ..],
             'secondary'=> ['text' => .., 'url' => ..],
             'footer'   => ['text' => .., 'wa_number' => .., 'wa_text' => ..],
         ]
     ===================================================================== --}}
@php
    $defaultCta = [
        'tagline'   => 'YUK, SALURKAN!',
        'title'     => 'Ingin Menyalurkan Wakaf & Hibah Terbaik Anda?',
        'desc'      => 'Tim Graha Dhuafa Indonesia siap membantu Anda menyalurkan wakaf dan hibah secara amanah, transparan, dan tepat sasaran — untuk menopang program dakwah & sosial.',
        'badge'     => '💰 Nominal Bebas — Sesuai Kemampuan & Niat Baik Anda',
        'primary'   => ['text' => 'Salurkan Wakaf & Hibah', 'url' => url('/app/zakat/informasi')],
        'secondary' => ['text' => 'Hubungi Kami', 'url' => url('/app/zakat/informasi')],
        'footer'    => ['text' => 'Butuh informasi atau bantuan penyaluran? Hubungi WhatsApp:', 'wa_number' => '0882-1259-8855', 'wa_text' => 'Halo, saya ingin bertanya tentang Wakaf & Hibah Graha Dhuafa Indonesia.'],
    ];
    $cta = isset($wakafCta) && is_array($wakafCta) ? array_merge($defaultCta, $wakafCta) : $defaultCta;

    $waNumberRaw = preg_replace('/[^0-9]/', '', $cta['footer']['wa_number']);
    if (strpos($waNumberRaw, '0') === 0) {
        $waNumberRaw = '62' . substr($waNumberRaw, 1);
    }
    $waLink = 'https://wa.me/' . $waNumberRaw . '?text=' . rawurlencode($cta['footer']['wa_text']);
@endphp

<!-- ====== CTA Wakaf & Hibah ====== -->
<section class="gdi-wakaf-cta-wrap">
    <div class="gdi-wakaf-cta">
        <span class="gdi-wakaf-cta__deco-circle" aria-hidden="true"></span>

        <p class="gdi-wakaf-cta__tagline">{{ $cta['tagline'] }}</p>
        <h2 class="gdi-wakaf-cta__title">{!! $cta['title'] !!}</h2>
        <p class="gdi-wakaf-cta__desc">{{ $cta['desc'] }}</p>

        <span class="gdi-wakaf-cta__badge">
            <span class="gdi-wakaf-cta__badge-dot" aria-hidden="true"></span>
            {{ $cta['badge'] }}
        </span>

        <div class="gdi-wakaf-cta__actions">
            <a href="{{ $cta['primary']['url'] }}" class="gdi-wakaf-cta__btn gdi-wakaf-cta__btn--primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
                {{ $cta['primary']['text'] }}
            </a>
            <a href="{{ $cta['secondary']['url'] }}" class="gdi-wakaf-cta__btn gdi-wakaf-cta__btn--ghost">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                </svg>
                {{ $cta['secondary']['text'] }}
            </a>
        </div>

        <p class="gdi-wakaf-cta__footer">
            {{ $cta['footer']['text'] }}
            <a href="{{ $waLink }}" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                {{ $cta['footer']['wa_number'] }}
            </a>
        </p>
    </div>
</section>
<!-- ====== End CTA Wakaf & Hibah ====== -->

<style>
/* ================= CTA Wakaf & Hibah ================= */
.gdi-wakaf-cta-wrap {
    position: relative;
    z-index: 1;
    max-width: 1180px;
    margin: 0 auto;
    padding: 48px 20px 80px;
}

.gdi-wakaf-cta {
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    padding: 56px 48px 50px;
    text-align: center;
    color: #ffffff;
    background:
        radial-gradient(rgba(255, 255, 255, 0.07) 1.2px, transparent 1.2px) 0 0 / 26px 26px,
        radial-gradient(420px 240px at 88% 0%, rgba(163, 230, 53, 0.14), transparent 60%),
        linear-gradient(140deg, #2c5e1a 0%, #356e20 55%, #274f16 100%);
    box-shadow: 0 30px 70px rgba(20, 58, 44, 0.30);
}

/* Lingkaran dekoratif di pojok kanan atas */
.gdi-wakaf-cta__deco-circle {
    position: absolute;
    top: -70px;
    right: -60px;
    width: 220px;
    height: 220px;
    border: 2px solid rgba(163, 230, 53, 0.30);
    border-radius: 50%;
    pointer-events: none;
}

.gdi-wakaf-cta__tagline {
    color: #a3e635;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    margin-bottom: 14px;
}

.gdi-wakaf-cta__title {
    max-width: 640px;
    margin: 0 auto 18px;
    font-size: clamp(28px, 3.6vw, 40px);
    font-weight: 800;
    line-height: 1.25;
    color: #ffffff;
}

.gdi-wakaf-cta__desc {
    max-width: 560px;
    margin: 0 auto 24px;
    font-size: 16.5px;
    line-height: 1.75;
    color: rgba(255, 255, 255, 0.88);
}

/* Badge status (pill) */
.gdi-wakaf-cta__badge {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 10px 22px;
    border-radius: 999px;
    background: rgba(124, 45, 18, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.18);
    color: #fecaca;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 30px;
}

.gdi-wakaf-cta__badge-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #f87171;
    box-shadow: 0 0 0 4px rgba(248, 113, 113, 0.25);
}

/* Tombol aksi */
.gdi-wakaf-cta__actions {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 30px;
}

.gdi-wakaf-cta__btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 34px;
    border-radius: 999px;
    font-size: 15.5px;
    font-weight: 800;
    text-decoration: none !important;
    transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
}

.gdi-wakaf-cta__btn svg {
    width: 19px;
    height: 19px;
    flex-shrink: 0;
}

.gdi-wakaf-cta__btn--primary {
    background: linear-gradient(90deg, #ff8a3d, #ff6600);
    color: #ffffff !important;
    box-shadow: 0 14px 34px rgba(255, 102, 0, 0.38);
}

.gdi-wakaf-cta__btn--primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 44px rgba(255, 102, 0, 0.48);
    color: #ffffff !important;
}

.gdi-wakaf-cta__btn--ghost {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.45);
    color: #ffffff !important;
}

.gdi-wakaf-cta__btn--ghost:hover {
    background: rgba(255, 255, 255, 0.14);
    transform: translateY(-3px);
    color: #ffffff !important;
}

/* Footer WhatsApp */
.gdi-wakaf-cta__footer {
    margin-bottom: 0;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.78);
}

.gdi-wakaf-cta__footer a {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #a3e635;
    font-weight: 800;
    text-decoration: none;
    margin-left: 6px;
}

.gdi-wakaf-cta__footer a:hover {
    text-decoration: underline;
}

.gdi-wakaf-cta__footer svg {
    width: 15px;
    height: 15px;
}

@media (max-width: 575px) {
    .gdi-wakaf-cta-wrap {
        padding: 36px 20px 60px;
    }

    .gdi-wakaf-cta {
        padding: 42px 24px 38px;
        border-radius: 22px;
    }

    .gdi-wakaf-cta__btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
