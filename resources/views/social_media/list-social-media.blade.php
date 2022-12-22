@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Meta</a></li>
        <li class="breadcrumb-item active" aria-current="page">Media Sosial</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Media Sosial</h5>
    <div class="row">
        <div class="col-md-8">
            <form method="post" action="/admin/meta/social-media">
                @csrf

                <input type="hidden" name="id" value=""/>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Media Sosial *</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" required readonly name="title" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">URL *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="url" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-3">
                        <select class="form-select" name="status" required>
                            <option value="">-- Pilih --</option>
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
    <hr/>
    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Media Sosial</th>
                <th>URL</th>
                <th>Status</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if(@$result)
                @php
                    $no = 1;
                @endphp
                @foreach($result as $dt)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td><i class="{{ $dt->icon }}"></i> {{ $dt->title }}</td>
                    <td>{{ $dt->url }}</td>
                    <td>{{ $dt->status == 'A' ? 'Aktif' : 'Non Aktif' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary btn-edit" data-id="{{ $dt->id }}"><i class="bi-pencil-square"></i></button>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                order: false,
                paging: false
            });

            $('.btn-edit').click(function(){
                let id = $(this).data('id');

                $.getJSON('/admin/meta/social-media/'+id+'/detail', function(result){
                    $('[name=id]').val(result.id);
                    $('[name=title]').val(result.title);
                    $('[name=url]').val(result.url);
                    $('[name=status]').val(result.status);
                });
            });

            $(document).on('click', '.btn-del', function(){
                const id = $(this).data('id');

                swal({
                    title: "Peringatan!",
                    text: "Menghapus data berikut akan berdampak pada data lainnya. Anda yakin akan menghapus data yang bersangkutan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('/admin/user/'+id+'/delete', function(){
                            table.ajax.reload(false, null);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
