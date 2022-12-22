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
            <form method="post" action="/admin/widget/slider/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <input type="hidden" name="type" value="slider"/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Image Upload *</label>
                    <div class="col-sm-10">
                        <div>Ukuran yang disarankan: 1894 x 781 px</div>
                        <div class="preview-slider-img">
                            @php
                                $imgUrl = @$detail->image_upload ? asset(str_replace('public', 'storage', @$detail->image_upload)) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="image_upload" src="{{ $imgUrl }}"/>
                        </div>
                        <input type="file" name="image_upload" style="display: none" id="img"/>
                        <label class="btn btn-primary btn-upload" for="img"><i class="bi-upload"></i> Upload</label>
                    </div>
                </div>
                <hr/>
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
                
                
                <!--
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Posisi Image</label>
                    <div class="col-sm-3">
                        <select class="form-select" name="image_position" required>
                            <option value="right" {{ @$detail->image_position == 'right' ? 'selected' : '' }}>Kanan</option>
                            <option value="left" {{ @$detail->image_position == 'left' ? 'selected' : '' }}>Kiri</option>
                        </select>
                    </div>
                </div>
                -->
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tombol (Jika Ada)</label>
                    <div class="col-sm-10">
                        @php
                            $button = [];
                            if(@$detail->button){
                                $button = json_decode($detail->button);
                            }
                        @endphp
                        @if($button)
                        <!-- just in case need more button -->
                        @foreach($button as $btn)
                        <div class="group-btn">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Teks Tombol</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-text[]" value="{{ $btn->text }}" placeholder="eg. Registrasi">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-url[]" value="{{ $btn->url }}" placeholder="eg. https://example.com/link">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Class Name (Jika ada)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-class[]" value="{{ $btn->classname }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="group-btn">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Teks Tombol</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-text[]" value="" placeholder="eg. Registrasi">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">URL</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-url[]" value="" placeholder="eg. https://example.com/link">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Class Name (Jika ada)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="btn-class[]" value="">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!--
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Rich text (temp)</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="redactor"></textarea>
                    </div>
                </div>
                -->
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
            $('input[name="image_upload"]').change(function(){
                readImageUrl(this, 'image_upload', function(response){
                    //$('input[name="picture"]').val(response);
                });
            })
        })
    </script>
@endpush
