@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/program/{{ @$program->id }}/detail">Program</a></li>
        <li class="breadcrumb-item"><a href="#">Realisasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Form {{ $mode }} Realisasi Program: {{ @$program->title }}</h5>
    <a href="/admin/program/{{ @$program->id }}/detail" class="btn btn-primary"><i class="bi-arrow-left-square"></i> Kembali</a>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" id="fProgramReal" action="/admin/program/realisasi/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="program_id" value="{{ @$program->id }}"/>
                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Kegiatan *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="title" value="{{ @$detail->title }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Deskripsi Kegiatan *</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="redactor" required>{{ @$detail->description }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Pelaksana *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="pelaksana" value="{{ @$detail->pelaksana }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tgl Kegiatan *</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control date" required name="date_realisasi" placeholder="hh-bb-tttt" value="{{ @$detail->date_realisasi ? date('d-m-Y', strtotime(@$detail->date_realisasi)) : '' }}">
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status Publish *</label>
                    <div class="col-sm-3">
                        <select class="form-select" name="status" required>
                            <option value="draft" {{ @$detail->status_display == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ @$detail->status_display == 'publish' ? 'selected' : '' }}>Publish</option>
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

            $('#fProgramReal').submit(function(e){
                e.preventDefault();

                var el = $(this);
                var data = el.serializeArray();
                var url = el.attr('action');

                // check date
                var dS = dateFormat($('[name=date_realisasi]').val());

                if(dS === false){
                    swal('Peringatan!', 'Format Tanggal pada isian Tanggal Kegiatan SALAH!', 'error');
                    return false;
                }else{
                    $('button[type="submit"]').html('Saving...');
                    $.post(url, data, function(){
                        window.location.href = '/admin/program/{{ @$program->id }}/detail';
                    })
                }
            });
        })

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
