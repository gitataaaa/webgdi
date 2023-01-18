@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Meta</a></li>
        <li class="breadcrumb-item"><a href="/admin/meta/bank">Rekening Bank</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Form {{ $mode }} Rekening Bank & E-Money</h5>
    <a href="/admin/meta/bank" class="btn btn-primary"><i class="bi-arrow-left-square"></i> Kembali</a>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" id="fProgram" action="/admin/meta/bank/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis *</label>
                    <div class="col-sm-6">
                        <select class="form-select" name="type" required>
                            <option value="">-- Pilih --</option>
                            <option value="bank" {{ @$detail->type == 'bank' ? 'selected' : '' }}>Rekening Bank</option>
                            <option value="emoney" {{ @$detail->type == 'emoney' ? 'selected' : '' }}>Akun E-Money/E-Wallet</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="bank_name" value="{{ @$detail->bank_name }}">
                        <small><i>Nama Bank/Penyedia Layanan E-Money</i></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nomor *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="bank_account" value="{{ @$detail->bank_account }}">
                        <small><i>No. Rekening/No. Ponsel E-Money</i></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Pemilik *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="bank_user" value="{{ @$detail->bank_user }}">
                        <small><i>Pemilik Akun Rekening Bank/E-Money</i></small>
                    </div>
                </div>
                <div class="mb-3 row" id="code" {{ @$detail->code == 'emoney' ? 'style="display: none"':''}}>
                    <label class="col-sm-2 col-form-label">Upload QRCode/Barcode E-Money *</label>
                    <div class="col-sm-5">
                        <div class="preview-slider-img">
                            @php
                                $imgUrl = @$detail->code_image ? asset(@$detail->code_image) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="code_image" src="{{ $imgUrl }}"/>
                        </div>
                        <input type="file" name="code_image" style="display: none" id="img"/>
                        <label class="btn btn-primary btn-upload" for="img"><i class="bi-upload"></i> Upload</label>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status *</label>
                    <div class="col-sm-3">
                        <select class="form-select" name="status" required>
                            <option value="A" {{ @$detail->status == 'A' ? 'selected' : '' }}>Aktif</option>
                            <option value="NA" {{ @$detail->status == 'NA' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary"><i class="bi-save"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('input[name="code_image"]').change(function(){
                readImageUrl(this, 'code_image', function(response){
                    //$('input[name="picture"]').val(response);
                });
            });

            $('select[name="type"]').change(function(){
                var ch = $(this).val();

                if(ch == 'emoney'){
                    $('#code').show();
                }else{
                    $('#code').hide();
                }
            });

        });

        function dateFormat(date){
            var d = date.split('-');
            if(d[1] > 12 || d[0] > 31){
                return false;
            }else{
                return d[2]+'-'+d[1]+'-'+d[0];
            }
        }
    </script>
@endpush
