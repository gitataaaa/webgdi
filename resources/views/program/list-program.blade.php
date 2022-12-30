@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kelola Program</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Program</h5>
    <a href="/admin/program/add" class="btn btn-primary"><i class="bi-plus-square"></i> Tambah Program</a>
    <hr/>

    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Poster</th>
                <th>Judul Besar</th>
                <th>Target Pencapaian</th>
                <th>Waktu</th>
                <!-- hidd -->
                <th>Date End</th>
                <th>Kontak</th>
                <!-- ---- -->
                <th>PIC/Kontak</th>
                <th>Kategori</th>
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
        function dateFormat(date){
            var d = date.split('-');
            return d[2]+'-'+d[1]+'-'+d[0];
        }
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ '/admin/program/table' }}",
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    { 
                        data: 'image_upload',
                        render: function(data, type, row, meta){
                            var path = data.replace('public','storage');
                            return '<img src="{{ asset('') }}'+path+'" width="150px"/>';
                        }
                    },
                    { data: 'title' },
                    { 
                        data: 'target_nominal',
                        render: function(data, type, row, meta){
                            return Intl.NumberFormat('en-US').format(data);
                        }
                    },
                    { 
                        data: 'date_start',
                        render: function(data, type, row, meta){
                            return dateFormat(data)+' s/d '+dateFormat(row.date_end);
                        }
                    },
                    { 
                        data: 'date_end',
                        visible: false
                        
                    },
                    { 
                        data: 'contact',
                        visible: false
                    },
                    { 
                        data: 'pic',
                        render: function(data, type, row, meta){
                            return data +' ('+row.contact+')';
                        }
                    },
                    { data: 'category'},
                    {
                        data: 'status',
                        render: function(data, type, row, meta){
                            return (data == 'draft' ? 'Draft' : 'Publish');
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
                        $.get('/admin/program/'+id+'/delete', function(){
                            table.ajax.reload(false, null);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
