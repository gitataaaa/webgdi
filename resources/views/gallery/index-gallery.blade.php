@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Navigasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Galeri</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Galeri</h5>

    <form method="post" id="formUpload" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image_upload[]" multiple id="img" style="display: none"/>
        <label class="btn btn-primary" for="img"><i class="bi-upload"></i> Upload Gambar</label>
        <button type="button" class="btn btn-danger btn-del" style="display: none"><i class="bi-trash"></i> Hapus</button>
    </form>
    <div class="box-gallery">
        @if(@$files)
            @foreach($files as $val)
                @php
                    $file = new SplFileInfo($val);
                    $val = 'images/gallery/'.$file->getFilename();
                @endphp
                <img src="{{ asset($val) }}" data-path="{{ $val }}"/>
            @endforeach
        @endif
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function shiftHandle(e){
            shiftHeld = e.shiftkey;
        }
        document.addEventListener("keydown", shiftHandle, true);
        document.addEventListener("keyup", shiftHandle, true);
        console.log(document.addEventListener("keyup", shiftHandle, true))
        
        $(document).ready(function(){
            $(document).on('change', 'input[name="image_upload[]"]', function(){  
                var fd = new FormData(); 
                var input = document.getElementById('img');
                
                fd.append('_token', header);
                for (var index = 0; index < input.files.length; index++) {
                    fd.append("image_upload[]", document.getElementById('img').files[index]);
                }

                $.ajax({
                    url:"/admin/gallery/save",
                    method:"POST",
                    data: fd,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data){
                        if(data){
                            $.each(data, function(i, item){
                                $('.box-gallery').prepend('<img src="'+item.file+'" data-path="'+item.path+'"/>')
                            })
                        }
                    }
                })
                
            });

            $(document).on('click', '.box-gallery > img', function(event){
                $('.box-gallery > img').removeAttr('style');
                $(this).css({
                    'border-color': '#0E3EDA',
                    'opacity': 0.7
                });
                $('.btn-del').attr('data-id', $(this).data('path')).show();
            })

            $(document).on('click', '.btn-del', function(){
                const id = $(this).attr('data-id');

                swal({
                    title: "Peringatan!",
                    text: "Anda yakin akan menghapus data berikut?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post('/admin/gallery/delete', {'path':id, '_token':header}, function(){
                            $('.btn-del').attr('data-id', '').hide();
                            $('img[data-path="'+id+'"]').remove();
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
