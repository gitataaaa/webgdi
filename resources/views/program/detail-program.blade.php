@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Program</h5>
    <a href="/admin/program" class="btn btn-primary"><i class="bi-arrow-left-square"></i> Kembali</a>
    <a href="/admin/program/realisasi/add" class="btn btn-success"><i class="bi-plus-square"></i> Tambah Data Realisasi</a>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Program</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ @$detail->title }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Target Pencapaian</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ number_format(@$detail->target_nominal) }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Waktu Program</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ (@$detail->date_start ? date('d-m-Y', strtotime(@$detail->date_start)) : '').(@$detail->date_end ? ' s/d '.date('d-m-Y', strtotime(@$detail->date_end)) : '') }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Penanggung Jawab</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ @$detail->pic }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ @$detail->contact }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ ucfirst(@$detail->status).(@$detail->date_publish ? ' [Tanggal: '.date('d-m-Y', strtotime(@$detail->date_publish)).']' : '') }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">{{ @$detail->category }}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection

@push('scripts')
@endpush
