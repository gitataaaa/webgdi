@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Widget</a></li>
        <li class="breadcrumb-item"><a href="/admin/widget/slider">Slider</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Form {{ $mode }} Slider</h5>
    <a href="/admin/widget/slider" class="btn btn-primary"><i class="bi-arrow-left-square"></i> Kembali</a>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/user/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <input type="hidden" name="type" value="slider"/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul *</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" required name="title" value="{{ @$detail->title }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Sub Judul</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="subtitle" value="{{ @$detail->subtitle }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" value="{{ @$detail->description }}">
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Image Upload *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="image_upload" required value="{{ @$detail->image_upload }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Posisi Image</label>
                    <div class="col-sm-3">
                        <select class="form-select" name="image_position" required>
                            <option value="right" {{ @$detail->image_position == 'right' ? 'selected' : '' }}>Kanan</option>
                            <option value="left" {{ @$detail->image_position == 'left' ? 'selected' : '' }}>Kiri</option>
                        </select>
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tombol (Jika Ada)</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="button" value="{{ @$detail->button }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Rich text (temp)</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="redactor"></textarea>
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status</label>
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
            $('#flexCheckChecked').click(function(){
                var ch = $(this).prop('checked');
                if(ch == true){
                    $('#showPass').show();
                    $('[name=password]').attr('required', 'required');
                }else{
                    $('#showPass').hide();
                    $('[name=password]').removeAttr('required');
                }
            })
        })
    </script>
@endpush
