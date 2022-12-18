@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Lain-lain</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil Anda</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Profil Anda</h5>
    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/user/add">
                @csrf

                <input type="hidden" name="id" value="{{ @$detail->id }}"/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" required name="name" value="{{ @$detail->name }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{ @$detail->email }}">
                    </div>
                </div>
                <hr/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" required name="username" value="{{ @$detail->username }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-6">
                        @if(@$detail->id)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="Y" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">Check untuk mengubah password</label>
                        </div>
                        <div id="showPass" style="margin-top: 10px; display: none">
                            <label style="margin-bottom: 5px">Password Baru</label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>
                        @else
                            <input type="password" class="form-control" required name="password" value="">
                        @endif
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
