@extends('layout.payment-layout', ['title' => 'Pembayaran Zakat'])

@section('content')
<div class="oc-card">
    <form>
        <div class="oc-card-section oc-card-header"><i class="bi-arrow-left"></i> Lembar Pembayaran</div>
        <div class="oc-card-section">
            <div class="alert alert-warning">
                Mohon tunaikan zakat Anda sebelum tanggal <strong>27 Maret 2023 Pukul 24.00</strong> atau ajuan zakat Anda akan dibatalkan
            </div>

            <div class="form-group">
                <label class="oc-text-title">Zakat Anda</label>

                <div class="oc-container oc-bank d-flex justify-content-between align-items-center">
                    <span class="oc-nominal-big">
                        Rp 100,987
                    </span>
                    <span class="oc-cursor" title="Salin" onclick="copy('100987')"><i class="bi-clipboard"></i></span>
                </div>
            </div>
            <div class="alert alert-success">
                Pembayaran harus disertakan kode unik (tiga digit terakhir)
            </div>

            <div class="form-group">
                <label class="oc-text-title">Nomor Rekening</label>

                <div class="d-flex oc-bank oc-container justify-content-between">
                    <span id="payment-method">
                        <img src="https://th.bing.com/th/id/R.d6eae25c9708399938667fea629da0cc?rik=c2f8mTUO64HEGA&riu=http%3a%2f%2flogos-download.com%2fwp-content%2fuploads%2f2017%2f03%2fBCA_logo_Bank_Central_Asia.png&ehk=EOBw9%2bqvYV27uMcsxGBTpYhSWM1E423ML4neZEgJQV0%3d&risl=&pid=ImgRaw&r=0" width="60px"/>
                        <span class="oc-text-header d-flex" style="padding-top: 10px">
                            111 1111 111 1 111<br/>
                            An. Yayasan Graha Dhuafa Indonesia
                        </span>
                    </span>
                    <span class="oc-cursor" title="Salin" onclick="copy('1111111111111')"><i class="bi-clipboard"></i> </span>
                </div>
            </div>
        </div>

        <div class="oc-card-divider"></div>

        <div class="oc-card-section">
            <div class="form-group">
                <label>Kode Pembayaran</label>

                <div class="d-flex oc-bank oc-container justify-content-between align-items-center">
                    <span class="oc-nominal-medium">
                        #2023032701987
                    </span>
                    <span class="oc-cursor" title="Salin" onclick="copy('2023032701987')"><i class="bi-clipboard"></i></span>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Rincian Zakat Anda
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <p class="oc-text-header">Ocha Iskandar *<br/><small>Anda memutuskan untuk Anonim</small></p>
                            </div>
                            <div class="form-group">
                                <label>Nomor Whatsapp/Email</label>
                                <p class="oc-text-header">rosafloriananda@gmail.com</p>
                            </div>
                            <div class="form-group">
                                <label>Jenis Zakat</label>
                                <p class="oc-text-header">Zakat Maal</p>
                            </div>
                            <div class="form-group">
                                <label>Nominal Zakat</label>
                                <p class="oc-text-header">Rp 100,000</p>
                            </div>
                            <div class="form-group">
                                <label>Waktu</label>
                                <p class="oc-text-header">27 Maret 2023 Pukul 15.45</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-success text-center niat-non-fitrah mt-3">
                <div class="oc-text-title">Doa Niat Zakat Maal/Profesi</div>

                <p class="arabic mt-3">نَوَيْتُ أَنْ اُخْرِجَ زَكَاتَ مَالِي فَرْضًا لِلَّهِ تَعَالَ</p>
                <p><i>Nawaitu an ukhrija zakata maali fardha llillahi ta’aala.</i></p>
                <p>"Saya berniat mengeluarkan zakat harta milikku karena Allah Ta’ala"</p>
            </div>
            <div class="alert alert-success text-center niat-fitrah mt-3" style="display: none">
                <div class="oc-text-title">Doa Niat Zakat Fitrah</div>

                <p class="arabic mt-3">نَوَيْتُ أَنْ اُخْرِجَ زَكَاتَلْ ِفتْرِلِنَفِْس فَرْضًا لِلَّهِ تَعَالَ</p>
                <p><i>Nawaitu an ukhrija zakatal fitri linafsi fardha llillaahi ta’aala.</i></p>
                <p>"Saya berniat mengeluarkan zakat fitrah untuk diri saya karena Allah Ta’ala"</p>
            </div>
        </div>

        <div class="oc-card-divider"></div>

        <div class="oc-card-section d-grid">
            <button type="button" class="btn btn-success btn-lg">Konfirmasi Pembayaran</button>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
    function copy(value){
        document.execCommand(value);
        navigator.clipboard.writeText(value)
    }
</script>
@endpush