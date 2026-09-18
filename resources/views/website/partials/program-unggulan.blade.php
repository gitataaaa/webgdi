<section id="program-unggulan" style="padding:4rem 0;background:#f9fafb;position:relative;z-index:1;">
  <div class="container text-center">
    <h2 style="font-size:1.875rem;font-weight:700;color:#1f2937;margin-bottom:2.5rem;font-family:'Poppins',sans-serif;">
      Program Unggulan
    </h2>

    <!-- ====== Program Unggulan ====== -->
    <section id="program-double">
      <div class="program-slider-wrap">
      <div class="program-swiper">
        <div class="swiper-wrapper">

          <!-- Slide 1 (2 foto) -->
          <div class="swiper-slide">
            <div class="program-item">
              <img src="https://www.grahadhuafa.org/images/blog/lazgdi-Ekspedisi-Tebar-Al-Quran-Kabupaten%20-Garut.jpg" class="program-img" alt="Program 1">
              <div class="program-body">
                <p class="program-title">Ekspedisi Tebar Al-Qur'an &amp; Iqro</p>
                <a href="https://f3cljj5t-8000.asse.devtunnels.ms/" class="program-btn">More &rarr;</a>
              </div>
            </div>
            <div class="program-item">
              <img src="https://www.baznasjabar.org/images/campaign/1704956237_659f914de93e1.jpg" class="program-img" alt="Program 2">
              <div class="program-body">
                <p class="program-title">Tebar Sedekah Jumat Berkah</p>
                <a href="#" class="program-btn">More &rarr;</a>
              </div>
            </div>
          </div>

          <!-- Slide 2 (2 foto) -->
          <div class="swiper-slide">
            <div class="program-item">
              <img src="https://cdn.lazismu.org/25352/conversions/KuNdZK2ZayL6qm8CnIM4dSWfP9yxgd-metaV2ViY2FyZCBTZWRla2FoU3VidWgucG5n--thumbnail.jpg" class="program-img" alt="Program 3">
              <div class="program-body">
                <p class="program-title">Sedekah Subuh</p>
                <a href="#" class="program-btn">More &rarr;</a>
              </div>
            </div>
            <div class="program-item">
              <img src="https://dompetdhuafajateng.org/wp-content/uploads/2025/07/Bu-nanti-SMP-kita-bagaimana-ya-1-1.png" class="program-img" alt="Program 4">
              <div class="program-body">
                <p class="program-title">Bantuan Pendidikan Dhuafa</p>
                <a href="#" class="program-btn">More &rarr;</a>
              </div>
            </div>
          </div>

        </div>

      </div>

      <!-- Tombol Navigasi (class sama dengan slider pilar agar tampilan identik) -->
      <button type="button" class="program-slider__btn program-slider__btn--prev" aria-label="Previous">&lsaquo;</button>
      <button type="button" class="program-slider__btn program-slider__btn--next" aria-label="Next">&rsaquo;</button>
      </div>
    </section>
  </div>
</section>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

/* === Wrapper Slide === */
#program-double .swiper-wrapper {
  display: flex;
  transition: transform 0.6s ease-in-out;
}

/* === Slide === */
#program-double .swiper-slide {
  display: flex;
  justify-content: center;
  align-items: stretch;
  gap: 24px;
  flex: 0 0 100%;
  padding: 0 0 20px;
}

/* === Item Program (kartu sama gaya dengan slider pilar) === */
#program-double .program-item {
  flex: 1 1 0;
  min-width: 0;
  display: flex;
  flex-direction: column;
  background: #fff;
  padding: 0;
  border-radius: 14px;
  border: 1px solid #e5e7eb;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
}

#program-double .program-item:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.22);
}

#program-double .program-img {
  width: 100%;
  height: 230px;
  object-fit: cover;
  display: block;
  pointer-events: none;
}

/* === Subtitle + tombol di bawah foto === */
#program-double .program-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  padding: 14px 16px 18px;
}

#program-double .program-title {
  margin: 0;
  font-weight: 600;
  font-size: 1rem;
  color: #333;
  font-family: 'Poppins', sans-serif;
}

#program-double .program-btn {
  display: inline-block;
  background: #00875A;
  color: #fff;
  padding: 0.45rem 1.1rem;
  border-radius: 8px;
  font-weight: 600;
  text-decoration: none;
  transition: background 0.3s;
}
#program-double .program-btn:hover {
  background: #00a06b;
  color: #fff;
}

/* === Tombol Navigasi ===
   Ukuran, warna, hover, dan posisi kiri/kanan diambil otomatis dari CSS slider pilar
   (class .program-slider__btn sama persis). Hanya perlu menyetel posisi vertikal
   agar tombol sejajar dengan tengah foto (tinggi foto 230px). */
#program-double .program-slider__btn {
  top: 115px;
  transform: translateY(-50%);
}

/* Wrap slider: pakai lebar container Bootstrap agar rata dengan slider pilar di atas.
   Posisi relatif TANPA overflow hidden agar tombol di luar kartu tetap terlihat.
   Overflow hidden hanya di .program-swiper (area geser). */
#program-double .program-slider-wrap {
  position: relative;
}

#program-double .program-swiper {
  overflow: hidden;
}

/* === Responsif Mobile (sama dengan slider pilar) === */
@media (max-width: 767px) {
  #program-double .swiper-slide {
    flex-direction: column;
    gap: 20px;
    padding: 0 0 16px;
  }

  #program-double .program-img {
    height: 190px;
  }

  #program-double .program-slider__btn {
    top: 95px;
    transform: translateY(-50%);
  }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const wrapper = document.querySelector("#program-double .swiper-wrapper");
  const slides = document.querySelectorAll("#program-double .swiper-slide");
  const prevBtn = document.querySelector("#program-double .program-slider__btn--prev");
  const nextBtn = document.querySelector("#program-double .program-slider__btn--next");

  let index = 0;

  function updateSlider() {
    const slideWidth = document.querySelector("#program-double .program-swiper").offsetWidth;
    wrapper.style.transform = `translateX(-${index * slideWidth}px)`;
  }

  nextBtn.addEventListener("click", () => {
    index = (index + 1) % slides.length;
    updateSlider();
  });

  prevBtn.addEventListener("click", () => {
    index = (index - 1 + slides.length) % slides.length;
    updateSlider();
  });

  window.addEventListener("resize", updateSlider);
  updateSlider();
});
</script>
