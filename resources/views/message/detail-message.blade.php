@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Navigasi</a></li>
        <li class="breadcrumb-item"><a href="/admin/message">Pesan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Detail Pesan</h5>

    <div class="row">
        <div class="col-md-8">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10"><p class="form-control-plaintext">{{ date('d-m-Y H:i', strtotime(@$detail->date_send)) }}</p></div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Pengirim</label>
                <div class="col-sm-10"><p class="form-control-plaintext">{{ @$detail->sender }}</p></div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Subjek Pesan</label>
                <div class="col-sm-10"><p class="form-control-plaintext">{{ @$detail->subject }}</p></div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Pesan</label>
                <div class="col-sm-10"><p class="form-control-plaintext">{{ @$detail->content }}</p></div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10">
                    <a href="/admin/message" class="btn btn-primary"><i class="bi-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
        })
    </script>
@endpush
