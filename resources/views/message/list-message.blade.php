@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Navigasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pesan</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Pesan</h5>

    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Subjek</th>
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
                ajax: "{{ '/admin/message/table' }}",
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    { 
                        data: 'date_send'
                    },
                    { 
                        data: 'sender'
                    },
                    {
                        data: 'subject',
                    },
                    {
                        data: 'status',
                        render: function(data, type, row, meta){
                            return (data == 'new' ? 'New' : 'Read');
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
                    text: "Anda yakin akan menghapus data yang bersangkutan?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('/admin/message/'+id+'/delete', function(){
                            table.ajax.reload(false, null);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
