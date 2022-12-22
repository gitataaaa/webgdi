@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Widget</a></li>
        <li class="breadcrumb-item active" aria-current="page">Deskripsi Singkat</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Deskripsi Singkat</h5>

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/widget/desc/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <input type="hidden" name="type" value="general"/>
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
                        <textarea name="description" class="form-control" id="redactor">{{ @$detail->description }}</textarea>
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Link Tombol (Jika Ada)</label>
                    <div class="col-sm-10">
                        @php
                            $btnText = null;
                            $btnUrl = null;
                            $btnClass = null;
                            if(@$detail->button){
                                $button = json_decode($detail->button);
                                if($button){
                                    foreach($button as $bt){
                                        $btnText = $bt->text;
                                        $btnUrl = $bt->url;
                                        $btnClass = $bt->classname;
                                    }
                                }
                            }
                        @endphp
                        <!-- just in case need more button -->
                        <div class="group-btn">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Teks Tombol</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-text[]" value="{{ $btnText }}" placeholder="eg. Info Selanjutnya">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-url[]" value="{{ $btnUrl }}" placeholder="eg. https://example.com/link">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Class Name (Jika ada)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-class[]" value="{{ $btnClass }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Gambar Pendukung *</label>
                    <div class="col-sm-5">
                        <input type="hidden" name="image_upload_temp" value="{{ @$detail->image_upload }}"/>
                        <div class="preview-slider-img">
                            @php
                                $imgUrl = @$detail->image_upload ? asset(str_replace('public', 'storage', @$detail->image_upload)) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="image_upload" src="{{ $imgUrl }}"/>
                        </div>
                        <input type="file" name="image_upload" style="display: none" id="img"/>
                        <label class="btn btn-primary btn-upload" for="img"><i class="bi-upload"></i> Upload</label>
                        <button type="button" class="btn btn-danger btn-upload-del"><i class="bi-trash"></i> Hapus Background</button>
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
            $('input[name="image_upload"]').change(function(){
                readImageUrl(this, 'image_upload', function(response){
                    //$('input[name="picture"]').val(response);
                });
            });

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
        })
    </script>
@endpush
