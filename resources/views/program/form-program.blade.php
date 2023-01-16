@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/program">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $mode }}</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Form {{ $mode }} Program</h5>
    <a href="/admin/program" class="btn btn-primary"><i class="bi-arrow-left-square"></i> Kembali</a>
    <hr/>

    <div class="row">
        <div class="col-md-8">
            <form method="post" id="fProgram" action="/admin/program/add" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Upload Poster/Flyer *</label>
                    <div class="col-sm-5">
                        <div class="preview-slider-img">
                            @php
                                $imgUrl = @$detail->image_upload ? asset(@$detail->image_upload) : asset('admin/assets/img/setting/_img.jpg');
                            @endphp
                            <img id="image_upload" src="{{ $imgUrl }}"/>
                        </div>
                        <input type="file" name="image_upload" style="display: none" id="img"/>
                        <label class="btn btn-primary btn-upload" for="img"><i class="bi-upload"></i> Upload</label>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Judul Program *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="title" value="{{ @$detail->title }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Slug *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="slug" value="{{ @$detail->slug }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Deskripsi Program *</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="redactor" required>{{ @$detail->description }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nominal Target *</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control money" required name="target_nominal" value="{{ @$detail->target_nominal }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Waktu Pencapaian</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control daterange-input" required name="dates" value="{{ (@$detail->date_start ? date('d-m-Y', strtotime($detail->date_start)) : '').(@$detail->date_end ? ' s/d '.date('d-m-Y', strtotime($detail->date_end)) : '') }}"/>
                        <!--
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Tgl Mulai *</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control date-input" required name="date_start" placeholder="hh-bb-tttt" value="{{ @$detail->date_start ? date('d-m-Y', strtotime(@$detail->date_start)) : ''}}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Tgl Selesai *</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control date-input" required name="date_end" placeholder="hh-bb-tttt" value="{{ @$detail->date_end ? date('d-m-Y', strtotime(@$detail->date_end)) : '' }}">
                            </div>
                        </div>
                        -->
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama Kontak *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="pic" value="{{ @$detail->pic }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">No. Kontak *</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="contact" value="{{ @$detail->contact }}">
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Kategori *</label>
                    <div class="col-sm-4">
                        <select name="category" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @if(@$category)
                                @foreach($category as $dt)
                                <option value="{{ $dt->category }}" {{ (@$detail->category == $dt->category ? 'selected' : '') }}>{{ $dt->category }}</option>
                                @endforeach
                            @endif
                            <option value="_newcat">Kategori Baru...</option>
                        </select>
                    </div>
                    <div class="col-sm-6" id="newcat" style="display: none">
                        <input type="text" class="form-control" name="kategori_baru" value="{{ @$detail->kategori }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jenis Program *</label>
                    <div class="col-sm-8">
                        <select class="form-select" name="program_type" required>
                            <option value="">-- Pilih --</option>
                            <option value="donation" {{ @$detail->program_type == 'donation' ? 'selected' : '' }}>Program Donasi (Fundraising)</option>
                            <option value="non-donation" {{ @$detail->program_type == 'non-donation' ? 'selected' : '' }}>Program Non Donasi (Layanan Amal eg. ZIS, Qurban dll.)</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status Publish *</label>
                    <div class="col-sm-3">
                        <select class="form-select" name="status" required>
                            <option value="draft" {{ @$detail->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ @$detail->status == 'publish' ? 'selected' : '' }}>Publish</option>
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

            $(document).on('keyup', 'input[name="title"]', function(){
                const regex = /\s/ig;
                var text = $(this).val();
                var slug = text.replaceAll(regex, '-').toLowerCase();
                $('input[name="slug"]').val(slug);
            });

            $('select[name="menu_type"]').change(function(){
                var ch = $(this).val();

                if(ch == 'url'){
                    $('input[name="url"]').attr('placeholder', 'Isi link (URL) di sini').focus();
                }else{
                    $('input[name="url"]').removeAttr('placeholder');
                }
            });

            $('[name=category]').change(function(){
                var value = $(this).val();
                if(value == '_newcat'){
                    $('#newcat').show();
                    $('#newcat').find('input').attr('required', 'required').val("").focus();
                }else{
                    $('#newcat').hide();
                    $('#newcat').find('input').removeAttr('required');
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
