@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Meta</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rekening Bank</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Rekening Bank dan E-Money</h5>
    <a href="/admin/meta/bank/add" class="btn btn-primary"><i class="bi-plus-square"></i> Tambah Data</a>
    <hr/>

    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Tipe</th>
                <th>Nama Bank/Pelayanan</th>
                <th>No. Rekening/No. HP</th>
                <th>Nama Pengguna</th>
                <th>Status</th>
                <th width="15%">&nbsp;</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('scripts')
    <script>
        function dateFormat(date){
            var d = date.split('-');
            return d[2]+'-'+d[1]+'-'+d[0];
        }
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ '/admin/meta/bank/table' }}",
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    { 
                        data: 'type',
                        render: function(data, type, row, meta){
                            return (data == 'bank' ? 'Bank' : 'E-Money');
                        }
                    },
                    { data: 'bank_name' },
                    { data: 'bank_account' },
                    { data: 'bank_user' },
                    {
                        data: 'status',
                        render: function(data, type, row, meta){
                            return (data == 'NA' ? '<span class="badge bg-secondary">Non Aktif</span>' : '<span class="badge bg-primary">Aktif</span>');
                        }
                    },
                    { 
                        data: 'action',
                        orderable: false, searchable: false
                    }
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
                        $.get('/admin/meta/bank/'+id+'/delete', function(){
                            table.ajax.reload(false, null);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
