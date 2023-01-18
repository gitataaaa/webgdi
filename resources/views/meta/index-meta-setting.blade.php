@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Meta</a></li>
        <li class="breadcrumb-item active" aria-current="page">Identitas Instansi</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Identitas Instansi</h5>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/meta/identitas-instansi/add" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Logo Instansi *</label>
                    <div class="col-sm-5">
                        <input type="hidden" name="INST_LOGO" value="{{ @$detail['instLogo'] }}"/>
                        <div class="preview-slider-img">
                            @php
                                $imgUrl = @$detail['instLogo'] ? asset(str_replace('public', 'storage', @$detail['instLogo'])) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="image_upload" src="{{ $imgUrl }}"/>
                        </div>
                        <input type="file" name="image_upload" style="display: none" id="img"/>
                        <label class="btn btn-primary btn-upload" for="img"><i class="bi-upload"></i> Upload</label>
                        <!--<button type="button" class="btn btn-danger btn-upload-del"><i class="bi-trash"></i> Hapus Background</button>-->
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama Instansi *</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" required name="INST_NAME" value="{{ @$detail['instName'] }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Alamat *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="INST_ADDR" value="{{ @$detail['instAddr'] }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Google Map *</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" required name="GOO_MAP" rows="5">{{ @$detail['gooMap'] }}</textarea>
                        <small>Embedded link google map alamat instansi</small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">No. Telp *</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" required name="INST_TELP" value="{{ @$detail['instTelp'] }}">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Email *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="INST_EMAIL" value="{{ @$detail['instEmail'] }}">
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
            $('input[name="image_upload"]').change(function(){
                readImageUrl(this, 'image_upload', function(response){
                    //$('input[name="picture"]').val(response);
                });
            });

            /*
            $('.btn-upload-del').click(function(){
                swal({
                    title: "Peringatan!",
                    text: "Anda yakin akan menghapus background iklan berikut?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('[name=image_upload_temp]').val("");
                        $('#image_upload').attr('src', '{{ asset("admin/assets/img/setting/_img.jpg") }}');
                    }
                });
            });
            */
        })
    </script>
@endpush
