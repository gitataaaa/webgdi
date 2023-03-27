@extends('layout.payment-layout', ['title' => 'Pembayaran Zakat'])

@section('content')
<div class="oc-card">
    <form>
        <div class="oc-card-section oc-card-header">Detail Zakat</div>
        <div class="oc-card-section">
            <div class="form-group">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status
                        <span style="color: #DF2E38">Sedang Diproses</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kode
                        <span>2023032701987</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tanggal
                        <span>23 Maret 2023 16:04</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Program
                        <span>Zakat Profesi</span>
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
                        <span>Transfer Bank</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Nominal
                        <span>100,000</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kode Unik
                        <span>897</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total Donasi
                        <span>100,897</span>
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