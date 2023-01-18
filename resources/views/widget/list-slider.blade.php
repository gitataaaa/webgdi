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
                <!-- hidd -->
                <th>Subtitle</th>
                <th>Desc</th>
                <!-- ---- -->
                <th>Tombol</th>
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
                    { 
                        data: 'image_upload',
                        render: function(data, type, row, meta){
                            return '<img src="{{ asset('') }}'+data.replace('public', 'storage')+'" width="200px"/>';
                        }
                    },
                    { 
                        data: 'title',
                        render: function(data, type, row, meta){
                            var desc = '<h5>'+data+(row.subtitle ? '<br/><small><i>'+row.subtitle+'</i></small>' : '')+'</h5>';
                            if(row.description){
                                desc += '<p>'+row.description+'</p>';
                            }

                            return desc;
                        }
                    },
                    { 
                        data: 'subtitle',
                        visible: false
                    },
                    {
                        data: 'description',
                        visible: false
                    },
                    { 
                        data: 'button',
                        render: function(data, type, row, meta){
                            return (data ? 'Ada' : 'Tidak Ada');
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row, meta){
                            return (data == 'A' ? '<span class="badge bg-primary">Aktif</span>' : '<span class="badge bg-secondary">Non Aktif</span>');
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
                        $.get('/admin/widget/slider/'+id+'/delete', function(){
                            table.ajax.reload(false, null);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
