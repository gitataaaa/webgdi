@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Navigasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Menu</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Menu Website</h5>
    <a href="/admin/menu/add" class="btn btn-primary"><i class="bi-plus-square"></i> Tambah Menu</a>
    <hr/>

    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Menu</th>
                <th>Parent</th>
                <th>Page Type</th>
                <th>Menu Type</th>
                <th>Footer Display</th>
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
                ajax: "{{ '/admin/menu/table' }}",
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    { data: 'title' },
                    { data: 'parent_id' }, //sementara -> nanti diganti sama title menu yang menjadi parentnya, jika tidak punya parent_id, maka dikosongkan saja/null
                    { data: 'page_type' },
                    { data: 'menu_type' },
                    { 
                        data: 'footer_display',
                        render: function(data, type, row, meta){
                            return (data == 'A' ? 'Ya' : 'Tidak');
                        }
                    },
                    {
                        data: 'status_display',
                        render: function(data, type, row, meta){
                            return '<span class="badge rounded-pill bg-primary">'+data+'</span>';
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
                    text: "Menghapus data berikut akan berdampak pada fungsi lainnya. Anda yakin akan menghapus data yang bersangkutan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('/admin/menu/'+id+'/delete', function(){
                            table.ajax.reload(false, null);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
