{{-- ====== Section: Berdampak Lebih Luas (statistik + peta oranye) ====== --}}
<section class="peta-dampak">
  <div class="container">

    {{-- Semua teks & statistik ditempatkan di atas peta full-width, seperti layout referensi --}}
    <div class="peta-dampak__map-wrap">
      <img src="{{ asset('website/assets/images/custom/peta_sebaran_orange.svg') }}"
           class="peta-dampak__map" alt="Peta sebaran manfaat Graha Dhuafa Indonesia">

      <div class="peta-dampak__overlay">
        <h2 class="peta-dampak__title">Berdampak Lebih Luas</h2>
        <p class="peta-dampak__subtitle">
          Berikut Laporan Donasi yang anda titipkan kepada Rumah<br class="d-none d-lg-block" />
          Zakat Selama Tahun 2025 .
        </p>
        <p class="peta-dampak__highlight">Dari Indonesia Hingga Penjuru Dunia</p>
      </div>
    </div>

    {{-- Statistik: baris terpisah DI BAWAH peta, tidak menimpa peta/teks lain --}}
    <div class="peta-dampak__stats">
        <div class="peta-dampak__stat">
          <div class="peta-dampak__number">468,013M</div>
          <div class="peta-dampak__label">Dana Tersalurkan</div>
          <p class="peta-dampak__desc">Merupakan total jumlah dana tahun 2025 yang disalurkan ke program ini</p>
        </div>
        <div class="peta-dampak__stat">
          <div class="peta-dampak__number">3.300.887</div>
          <div class="peta-dampak__label">Penerima Layanan Masyarakat</div>
          <p class="peta-dampak__desc">Jumlah total penerima manfaat dari layanan manfaat seperti ambulan, dll</p>
        </div>
        <div class="peta-dampak__stat">
          <div class="peta-dampak__number">1.896.896</div>
          <div class="peta-dampak__label">Penerima Manfaat</div>
          <p class="peta-dampak__desc">Jumlah total penerima bantuan atau manfaat dari berbagai asnaf</p>
        </div>
        <div class="peta-dampak__stat">
          <div class="peta-dampak__number">1.751</div>
          <div class="peta-dampak__label">Desa &amp; Kelurahan</div>
          <p class="peta-dampak__desc">Jumlah desa binaan dimana program pemberdayaan berbasis wilayah dilaksanakan</p>
        </div>
      </div>
  </div>
</section>

<style>
.peta-dampak {
  padding: 4rem 0;
  background: #fff;
}

/* Wrapper: overflow hidden agar peta yang digeser ke kanan tidak memunculkan scrollbar */
.peta-dampak__map-wrap {
  position: relative;
  overflow: hidden;
}

/* Peta: sedikit ke tengah (tidak terlalu mepet kanan), warna merahnya diredam */
.peta-dampak__map {
  width: 88%;
  height: auto;
  display: block;
  margin-left: auto;    /* dorong peta ke kanan */
  margin-right: -3%;
  filter: saturate(0.55) opacity(0.8);  /* redam warna merah/oranye peta */
  pointer-events: none;
}

/* Judul + deskripsi: kiri atas, TRANSPARAN — peta di belakangnya tetap terlihat.
   Keterbacaan dijaga dengan text-shadow halus, bukan latar kotak */
.peta-dampak__overlay {
  position: absolute;
  top: 12%;
  left: 1%;
  width: 34%;
  max-width: 420px;
  text-align: center;
  background: transparent;
  padding: 1.25rem 1rem;
}

.peta-dampak__title {
  font-size: 2.2rem;
  font-weight: 700;
  color: #1e2b38;
  text-shadow: 0 1px 8px rgba(255, 255, 255, 0.9), 0 1px 3px rgba(255, 255, 255, 0.8);
  margin-bottom: 1rem;
  font-family: 'Poppins', sans-serif;
}

.peta-dampak__subtitle {
  font-size: 1rem;
  font-weight: 600;
  color: #33475b;
  text-shadow: 0 1px 6px rgba(255, 255, 255, 0.9), 0 1px 3px rgba(255, 255, 255, 0.8);
  margin-bottom: 0.6rem;
  line-height: 1.65;
}

.peta-dampak__highlight {
  font-size: 0.9rem;
  font-weight: 700;
  color: #d94f16;
  text-shadow: 0 1px 6px rgba(255, 255, 255, 0.9), 0 1px 3px rgba(255, 255, 255, 0.8);
  margin-bottom: 0;
}

/* Statistik: baris normal di bawah peta — tidak absolut, jadi tidak pernah numpuk */
.peta-dampak__stats {
  display: flex;
  flex-wrap: wrap;
  gap: 1.25rem 0.5rem;
  margin-top: 2.5rem;
}

.peta-dampak__stat {
  flex: 1 1 0;
  min-width: 0;
  text-align: center;
  padding: 0 2.25rem;
}

.peta-dampak__number {
  font-size: 1.9rem;
  font-weight: 700;
  color: #1e2b38;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 0.4rem;
}

.peta-dampak__label {
  font-size: 1.05rem;
  font-weight: 700;
  color: #2c3e50;
  margin-bottom: 0.55rem;
  line-height: 1.45;
}

.peta-dampak__desc {
  font-size: 0.85rem;
  color: #55677a;
  margin: 0 auto;
  max-width: 240px;
  line-height: 1.6;
}

/* Tablet/HP: teks & statistik ditumpuk di bawah peta agar tetap terbaca */
@media (max-width: 991px) {
  .peta-dampak__map {
    width: 100%;
    margin: 0;   /* di layar kecil peta kembali full-width */
    filter: saturate(0.55) opacity(0.8);
  }

  .peta-dampak__overlay {
    position: static;
    width: auto;
    max-width: 480px;
    margin: 0 auto 1.25rem;
  }

  .peta-dampak__title {
    font-size: 1.7rem;
  }

  .peta-dampak__stats {
    margin-top: 1.75rem;
  }

  .peta-dampak__stat {
    flex: 1 1 50%;
    padding: 0 1.5rem;
  }

  .peta-dampak__number {
    font-size: 1.4rem;
  }

  .peta-dampak__label {
    font-size: 0.95rem;
  }
}

@media (max-width: 575px) {
  .peta-dampak__stat {
    flex: 1 1 100%;
  }
}
</style>
