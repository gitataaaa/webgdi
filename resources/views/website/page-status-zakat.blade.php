@extends('layout.payment-layout', ['title' => 'Pembayaran Zakat'])

@section('content')
<div class="oc-card">
    <form>
        <div class="oc-card-section oc-card-header oc-back oc-cursor" data-url="{{ url('app/zakat') }}">Detail Zakat</div>
        <div class="oc-card-section">
            <div class="form-group">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status
                        @php
                            switch($detail->status){
                                case 'pending':
                                    echo '<span style="color: #DC8449" class="oc-text-header">Menunggu Pembayaran</span>';
                                    break;
                                case 'on_confirm':
                                    echo '<span style="color: #EA5455" class="oc-text-header">Sedang Diproses</span>';
                                    break;
                                case 'complete':
                                    echo '<span style="color: #539165" class="oc-text-header">Selesai</span>';
                                    break;
                            }
                        @endphp
                        
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kode
                        <span class="oc-text-header">{{ $detail->transcode }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tanggal
                        <span class="oc-text-header">{{ $created }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Program
                        <span class="oc-text-header">
                            @php
                                switch($detail->type){
                                    case 'profesi':
                                        echo 'Zakat Profesi';
                                        break;
                                    case 'maal':
                                        echo 'Zakat Maal';
                                        break;
                                    case 'fitrah':
                                        echo 'Zakat Fitrah';
                                        break;
                                }
                            @endphp
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="oc-card-divider"></div>

        <div class="oc-card-section">
            <div class="form-group">
                <label class="oc-text-header">Rincian Zakat</label>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Metode Pembayaran
                        <span class="oc-text-header">Transfer Bank</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nominal
                        <span class="oc-text-header">{{ number_format($detail->nominal) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kode Unik
                        <span class="oc-text-header">{{ str_pad($detail->digit, 3, '0', STR_PAD_LEFT) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Donasi
                        <span class="oc-text-header">{{ number_format($detail->nominal + $detail->digit) }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="oc-card-divider"></div>

        <div class="oc-card-section d-grid">
            <button type="button" class="btn btn-outline-success">Bantuan</button>
        </div>

        <div class="text-center mt-5 mb-5">
            &copy; www.grahadhuafa.org {{ date('Y') }}
        </div>
    </form>
</div>

@endsection

@push('script')
<script>
    $(function(){
        $('.oc-back').click(function(){
            window.location.href = $(this).data('url')
        })
    })
</script>
@endpush