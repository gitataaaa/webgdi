@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Widget</a></li>
        <li class="breadcrumb-item active" aria-current="page">Slider</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Gambar Slider</h5>
    <a href="/admin/widget/slider/add" class="btn btn-primary"><i class="bi-plus-square"></i> Tambah Slider</a>
    <hr/>

    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Image</th>
                <th>Title/Subtitle/Desc</th>
                <th>Button</th>
                <th>Status</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ '/admin/widget/slider/table' }}",
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    { data: 'image_upload' },
                    { data: 'title' },
                    { data: 'button' },
                    {
                        data: 'status',
                        render: function(data, type, row, meta){
                            return (data == 'A' ? 'Aktif' : 'Non Aktif');
                        }
                    },
                    { 
                        data: 'action',
                        orderable: false, searchable: false
                    },
                ],
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
