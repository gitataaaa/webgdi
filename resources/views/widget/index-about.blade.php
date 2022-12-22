@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Widget</a></li>
        <li class="breadcrumb-item active" aria-current="page">Selayang Pandang</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Selayang Pandang</h5>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/widget/about/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <input type="hidden" name="type" value="about"/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Besar *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="title" value="{{ @$detail->title }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Sub Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subtitle" value="{{ @$detail->subtitle }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Deskripsi/Konten *</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="redactor">{{ @$detail->description }}</textarea>
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Gambar Pendukung</label>
                    @php
                        $imgUrl_1 = $imgUrl_2 = asset('admin/assets/img/setting/_img.jpg');
                        $imgTemp_1 = $imgTemp_2 = '';
                        if(@$detail->image_upload){
                            $image = json_decode($detail->image_upload);
                            if($image){
                                foreach($image as $im){
                                    if($im->path){
                                        if($im->id == '1'){
                                            $imgUrl_1 = asset(str_replace('public', 'storage', @$im->path));
                                            $imgTemp_1 = $im->path;
                                        }else{
                                            $imgUrl_2 = asset(str_replace('public', 'storage', @$im->path));
                                            $imgTemp_2 = $im->path;
                                        }
                                    }
                                    
                                }
                            }
                        }
                        
                    @endphp
                    <div class="col-sm-5">
                        <input type="hidden" name="image_upload_temp_1" value="{{ @$imgTemp_1 }}"/>
                        <input type="hidden" name="image_upload_temp_t1" value="{{ @$imgTemp_1 }}"/>
                        <div class="preview-slider-img">
                            <img id="image_upload_1" src="{{ $imgUrl_1 }}"/>
                        </div>
                        <input type="file" name="image_upload_1" style="display: none" id="img-1"/>
                        <label class="btn btn-primary btn-upload-1" for="img-1"><i class="bi-upload"></i> Upload</label>
                        <button type="button" class="btn btn-danger btn-upload-del" data-id="1"><i class="bi-trash"></i> Hapus</button>
                    </div>
                    <div class="col-sm-5">
                        <input type="hidden" name="image_upload_temp_2" value="{{ @$imgTemp_2 }}"/>
                        <input type="hidden" name="image_upload_temp_t2" value="{{ @$imgTemp_2 }}"/>
                        <div class="preview-slider-img">
                            <img id="image_upload_2" src="{{ $imgUrl_2 }}"/>
                        </div>
                        <input type="file" name="image_upload_2" style="display: none" id="img-2"/>
                        <label class="btn btn-primary btn-upload" for="img-2"><i class="bi-upload"></i> Upload</label>
                        <button type="button" class="btn btn-danger btn-upload-del" data-id="2"><i class="bi-trash"></i> Hapus</button>
                    </div>
                </div>
                <hr/>
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
            $('input[name="image_upload_1"]').change(function(){
                readImageUrl(this, 'image_upload_1', function(response){
                    //$('input[name="picture"]').val(response);
                });
            });
            $('input[name="image_upload_2"]').change(function(){
                readImageUrl(this, 'image_upload_2', function(response){
                    //$('input[name="picture"]').val(response);
                });
            });

            $('.btn-upload-del').click(function(){
                var id = $(this).data('id');
                swal({
                    title: "Peringatan!",
                    text: "Anda yakin akan menghapus background iklan berikut?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('[name=image_upload_temp_'+id+']').val("");
                        $('#image_upload_'+id).attr('src', '{{ asset("admin/assets/img/setting/_img.jpg") }}');
                    }
                });
            });
        })
    </script>
@endpush
