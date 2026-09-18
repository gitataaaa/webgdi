@extends('layout.payment-layout', ['title' => 'Tentang Zakat'])

@section('content')
<div class="oc-card">
    <div class="oc-card-section oc-card-header oc-cursor oc-back" data-url="{{ url('app/zakat') }}"><i class="bi-arrow-left"></i> Tentang Zakat</div>

    <div class="oc-card-section">
        <label class="oc-text-title">Zakat</label>
        <p class="mt-3 text-justified highlight">
            Zakat dapat diartikan sebagai penunaian kewajiban pada harta yang khusus, dengan cara yang khusus, dan disyaratkan ketika dikeluarkan telah memenuhi haul (masa satu tahun) dan nisab (ukuran minimal dikenai kewajiban zakat). Zakat pun kadang dimaksudkan untuk harta yang dikeluarkan. Sedangkan muzakki adalah istilah untuk orang yang memiliki harta dan mengeluarkan zakatnya
        </p>
        <p><span>Perintah zakat disebut sebanyak 32 kali dalam Al-Quran.</span> Salah satunya:</p>
        <p class="arabic">وَأَقِيمُوا الصَّلَاةَ وَآتُوا الزَّكَاةَ وَارْكَعُوا مَعَ الرَّاكِعِينَ</p>
        <p><i>"Dan laksanakanlah salat, tunaikanlah zakat, dan rukuklah beserta orang yang rukuk." (QS. Al-Baqarah : 43)</i></p>
    </div>

    <div class="oc-card-divider"></div>

    <div class="oc-card-section">
        <label class="oc-text-title">Zakat Fitrah</label>
        <p class="mt-3 text-justified highlight">
            Wajib untuk semua muslim yang bernyawa. Zakat yang dikeluarkan senilai <span>2,5 kg beras</span>
            dan diberikan pada bulan Ramadhan.
        </p>
    </div>

    <div class="oc-card-section">
        <label class="oc-text-title">Zakat Maal</label>
        <p class="mt-3 text-justified highlight">
            Wajib bagi setiap muslim yang memiliki harta mengendap sebanyak <span>85 gram emas</span> 
            dalam kurun waktu <span>1 tahun</span>. Zakat yang dikeluarkan sebesar <span>2,5%</span> dari 
            jumlah harta yang dimiliki.
        </p>
    </div>

    <div class="oc-card-section">
        <label class="oc-text-title">Zakat Profesi</label>
        <p class="mt-3 text-justified highlight">
            Wajib bagi setiap muslim yang berprofesi apabila penghasilan yang diperoleh senilai dengan 
            <span>520 kg beras</span> saat menerima. Zakat yang dikeluarkan sebesar <span>2,5%</span> 
            dari pendapatan yang didapat.
        </p>
    </div>

    <div class="oc-card-section">
        <label class="oc-text-title">Zakat Ziroah (Hasil Pertanian)</label>
        <p class="mt-3 text-justified highlight">
            Wajib bagi muslim yang bercocok tanam apabila hasil panen sudah mencapai <span>653 kg gabah / 520 kg beras</span>. 
            Zakat yang dikeluarkan sebesar <span>10%</span> bila perairan alami dan <span>5%</span> apabila perairan oleh tenaga manusia.
        </p>
    </div>

    <div class="oc-card-section">
        <label class="oc-text-title">Zakat Tijaroh (Berdagang)</label>
        <p class="mt-3 text-justified highlight">
            Wajib bagi muslim yang berdagang apabila penghasilan sudah mencapai <span>85 gram emas</span> dalam kurun waktu <span>1 tahun</span>. 
            Zakat yang dikeluarkan sebesar <span>2,5%</span> dari penghasilan yang didapat.
        </p>
    </div>

    <div class="oc-card-section">
        <label class="oc-text-title">Fidyah</label>
        <p class="mt-3 text-justified highlight">
            Membayar fidyah adalah memberikan makan kepada orang miskin satu hari sejumlah hari tidak puasa dengan <span>satu/dua mud</span> fidyah <span>makanan pokok</span>.
        </p>
    </div>

    <div class="oc-card-divider"></div>

    <div class="oc-card-section">
        <label class="oc-text-title">Yang Berhak Menerima (Zakat, Infaq, Shodaqoh)</label>
        <p class="mt-5 text-right arabic">
        اِنَّمَا الصَّدَقٰتُ لِلْفُقَرَاۤءِ وَالْمَسٰكِيْنِ وَالْعٰمِلِيْنَ عَلَيْهَا وَالْمُؤَلَّفَةِ قُلُوْبُهُمْ وَفِى الرِّقَابِ وَالْغٰرِمِيْنَ وَفِيْ سَبِيْلِ
        اللّٰهِ وَابْنِ السَّبِيْلِۗ فَرِيْضَةً مِّنَ اللّٰهِ ۗوَاللّٰهُ عَلِيْمٌ حَكِيْمٌ
        </p>
        <p class="text-justified"><i>"Sesungguhnya zakat itu hanyalah untuk orang-orang fakir, orang-orang miskin, para amil zakat, orang-orang yang dilunakkan hatinya (mualaf), untuk (memerdekakan) para hamba sahaya, untuk (membebaskan) orang-orang yang berutang, untuk jalan Allah dan untuk orang-orang yang sedang dalam perjalanan (yang memerlukan pertolongan), sebagai kewajiban dari Allah. Allah Maha Mengetahui lagi Maha Bijaksana." (QS. At-Taubah: 60)</i></p>
        <div class="mt-3">
            <p>Daftar Jenis Mustahiq:</p>
            <ol>
                <li>Fakir</li>
                <li>Miskin</li>
                <li>Amil Zakat</li>
                <li>Muallaf</li>
                <li>Hamba Sahaya</li>
                <li>Terlilit Hutang</li>
                <li>Fii Sabilillah</li>
                <li>Musafir</li>
            </ol>
        </div>
    </div>

    <div class="oc-card-divider"></div>
    <div class="oc-card-section">
        <label class="oc-text-title">Keutamaan Melaksanakan (Zakat, Infaq, Shodaqoh)</label>
        <p class="mt-3">
            <ol>
                <li>Melindungi di Hari Kiamat</li>
                <li>Mengurangi penyakit hati dalam diri</li>
                <li>Akan didoakan oleh para malaikat</li>
                <li>Mendapatkan rezeki yang berlipat ganda</li>
                <li>Menyucikan diri dan harta</li>
                <li>Mendapatkan berkah Illahi</li>
                <li>Sebagai pelindung dari segala macam musibah</li>
                <li>Sebagai obat dari berbagai macam penyakit jasmani dan rohani</li>
            </ol>
        </p>
    </div>
    <div class="oc-card-divider"></div>
    <div class="oc-card-section">
        <div class="alert alert-success">
            <p>Butuh bantuan seputar Zakat, Infaq dan Shodaqoh?</p>

            <div class="d-grid">
                <a href="{{ url('') }}" class="btn btn-success btn-lg text-bg-success">Hubungi Kami</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(function(){
        $('.oc-back').click(function(){
            window.location.href = $(this).data('url');
        })
    })
</script>
@endpush