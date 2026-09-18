@extends('layout.payment-layout', ['title' => 'Kalkulator Zakat'])

@section('content')
<div class="oc-card">
    <form>
        <input type="hidden" name="zakat_type" value="profesi"/>
        <input type="hidden" id="opsi_nisab" value="emas"/>
        <div class="oc-card-section oc-card-header oc-back oc-cursor" data-url="{{ url('app/zakat') }}"><i class="bi-arrow-left"></i> Kalkulator Zakat</div>
        <div class="oc-card-section">
            <div class="form-group">
                <label class="oc-text-title">Pilihan Zakat</label>
                <p>Kalkulator zakat membuat Anda menjadi lebih mudah dalam mengetahui status wajib zakat, dan memudahkan dalam menghitung nominal zakat yang wajib dikeluarkan.</p>
                <div class="oc-container">
                    <nav class="nav nav-pills nav-justified">
                        <a class="nav-link active get-zakat-type" data-value="profesi" aria-current="page" href="#profesi">Zakat Profesi</a>
                        <a class="nav-link get-zakat-type" data-value="maal" href="#maal">Zakat Maal</a>
                        <!--<a class="nav-link get-zakat-type" data-value="fitrah" href="#fitrah">Zakat Fitrah</a>-->
                    </nav>
                </div>
            </div>
        </div>

        <div class="oc-card-divider"></div>

        <div class="oc-card-section">
            <div class="form-group">
                <div class="nishab-profesi">
                    <label class="oc-text-title">Nishab</label>
                    <ul>
                        <li>Nishab adalah batas minimal pendapatan wajib zakat</li>
                        <li>Nishab zakat profesi sebesar 85 gram emas/tahun atau seperduabelas dari 85 gram emas/bulan (Fatwa MUI no. 3 tahun 2003)</li>
                    </ul>
                </div>
                <div class="nishab-maal" style="display: none">
                    <label class="oc-text-title">Nishab dan Haul</label>
                    <ul id="nishab-maal">
                        <li>Nishab adalah batas minimal pendapatan wajib zakat</li>
                        <li>Haul merupakan kepemilikan harta yang telah mencapai 1 tahun</li>
                        <li>Nishab zakat profesi sebesar 85 gram emas/tahun atau seperduabelas dari 85 gram emas/bulan (Fatwa MUI no. 3 tahun 2003)</li>
                    </ul>
                </div>
                
                <div class="form-group custom-input">
                    <label class="oc-text-grey">Harga Emas per Gram saat ini</label>
                    <div class="oc-input-group-sm mb-3">
                        <span class="input-group-text text-placeholder">Rp</span>
                        <input type="text" class="form-control money" inputmode="numeric" id="harga_emas" data-value="" onkeyup="nisab_emas(); hitung_zakat()" name="gold_price" required placeholder="0" >
                    </div>
                </div>
                <div class="form-group custom-input">
                    <label class="oc-text-grey">Nilai Nishab</label>
                    <div class="oc-input-group-sm mb-3">
                        <span class="input-group-text text-placeholder">Rp</span>
                        <input type="text" class="form-control money disabled" inputmode="numeric" data-value="" id="nisab" readonly name="nilai_nishab" required placeholder="0" >
                        <input type="hidden" id="nisab_float" value="" />
                    </div>
                    <small><i>Perhitungan nishab per tahun</i></small>
                </div>
            </div>
        </div>

        <div class="oc-card-divider"></div>

        <div class="oc-card-section">
            <div class="form-group">
                <label class="oc-text-title">Perhitungan Zakat</label>
                <p class="desc-profesi">Zakat profesi yang dikeluarkan dihitung dari 2,5% dari penghasilan yang sudah mencapai nishab</p>
                <p class="desc-maal" style="display: none">Zakat maal yang dikeluarkan dihitung dari 2,5% dari penghasilan yang sudah mencapai nishab dan haul</p>
                
                <div class="form-maal" style="display: none">
                    <div class="form-group custom-input">
                        <label class="oc-text-grey">Nilai harta dalam bentuk emas</label>
                        <div class="oc-input-group-sm mb-3">
                            <span class="input-group-text text-placeholder">Rp</span>
                            <input type="text" class="form-control money" inputmode="numeric" name="value_treasure_gold" onkeyup="hitung_zakat()" data-value="" required placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group custom-input">
                        <label class="oc-text-grey">Nilai harta dalam bentuk tabungan</label>
                        <div class="oc-input-group-sm mb-3">
                            <span class="input-group-text text-placeholder">Rp</span>
                            <input type="text" class="form-control money" inputmode="numeric" name="value_treasure_saving" onkeyup="hitung_zakat()" data-value="" required placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group custom-input">
                        <label class="oc-text-grey">Nilai harta dalam bentuk lainnya (properti, kendaraan, koleksi)</label>
                        <div class="oc-input-group-sm mb-3">
                            <span class="input-group-text text-placeholder">Rp</span>
                            <input type="text" class="form-control money" inputmode="numeric" name="value_treasure_other" onkeyup="hitung_zakat()" data-value="" required placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group custom-input">
                        <label class="oc-text-grey">Nilai hutang/cicilan jatuh tempo saat membayar zakat</label>
                        <div class="oc-input-group-sm mb-3">
                            <span class="input-group-text text-placeholder">Rp</span>
                            <input type="text" class="form-control money" inputmode="numeric" name="value_treasure_debt" onkeyup="hitung_zakat()" data-value="" required placeholder="0" >
                        </div>
                    </div>
                </div>

                <div class="form-profesi">
                    <div class="form-group custom-input">
                        <label class="oc-text-grey">Penghasilan per Bulan</label>
                        <div class="oc-input-group-sm mb-3">
                            <span class="input-group-text text-placeholder">Rp</span>
                            <input type="text" class="form-control money" inputmode="numeric" name="value_income" onkeyup="hitung_zakat()" data-value="" required placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group custom-input">
                        <label class="oc-text-grey">Penghasilan Tambahan (Bonus, Lain-lain)</label>
                        <div class="oc-input-group-sm mb-3">
                            <span class="input-group-text text-placeholder">Rp</span>
                            <input type="text" class="form-control money" inputmode="numeric" name="value_bonus" onkeyup="hitung_zakat()" data-value="" required placeholder="0" >
                        </div>
                    </div>
                    <div class="form-group custom-input">
                        <label class="oc-text-grey">Cicilan/Hutang</label>
                        <div class="oc-input-group-sm mb-3">
                            <span class="input-group-text text-placeholder">Rp</span>
                            <input type="text" class="form-control money" inputmode="numeric" name="value_debt" onkeyup="hitung_zakat()" data-value="" required placeholder="0" >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="oc-card-divider"></div>

        <div class="oc-card-section">
            <div id="zakat-alert"></div>
            <div class="alert alert-success">
                <div class="mb-3">Kewajiban Anda membayar zakat sebesar</div>
                <div class="oc-text-big" id="zakat-total" data-value="">Rp </div>
            </div>
        </div>
        
        <div class="oc-card-divider"></div>

        <div class="oc-card-section d-grid">
            <button type="button" class="btn btn-success btn-lg btn-confirm" onclick="next()">Tunaikan Zakat</button>
        </div>
    </form>
</div>
<div id="payment-modal"></div>
@endsection

@push('script')
<!--
<script src="{{ asset('website/assets/vendors/calcZakat/elsyifa.js') }}"></script>
<script src="{{ asset('website/assets/vendors/calcZakat/main.js') }}"></script>
-->

<script src="{{ asset('website/assets/js/payment.js') }}"></script>
<script src="{{ asset('website/assets/js/calc.zakat.js') }}"></script>
<script>
    function next(){
        var jenis = document.getElementsByName('zakat_type')[0].value
        var zakat = document.getElementById('zakat-total').dataset.value
        window.location.href = '/app/zakat/tunaikan?jenis='+jenis+'&nominal='+zakat
    }
    
    $(function(){
        $('.oc-back').click(function(){
            window.location.href = $(this).data('url')
        })
    })
</script>
@endpush