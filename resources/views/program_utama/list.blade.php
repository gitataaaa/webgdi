@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/implementasi">Program Implementasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Program Utama</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h5 class="mb-1">Program Utama</h5>
            <p class="text-muted mb-0">Daftar program induk (logo &amp; nama) yang digunakan pada Kelola Dokumentasi.</p>
        </div>
        <a href="/admin/program/implementasi" class="btn btn-sm btn-outline-secondary">
            <i class="bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="mb-3">
        <a href="/admin/program/utama/add" class="btn btn-sm btn-primary">
            <i class="bi-plus-lg"></i> Tambah Program Utama
        </a>
    </div>

    <table id="datatable" class="table table-sm table-hover align-middle" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Logo</th>
                <th>Nama Program</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('styles')
    <style>
        .program-utama-logo {
            width: 56px;
            height: 56px;
            object-fit: contain;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ '/admin/program/utama/table' }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false },
                    { data: 'logo', name: 'logo_image', orderable: false, searchable: false },
                    { data: 'nama_program', name: 'nama_program' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                columnDefs: [
                    { className: 'align-middle', targets: '_all' },
                    { className: 'text-center', targets: [0, 1, 3] },
                ]
            });

            $(document).on('click', '.btn-del', function(){
                const id = $(this).data('id');

                swal({
                    title: "Peringatan!",
                    text: "Program utama yang dihapus juga akan menghapus dokumentasi di dalamnya. Anda yakin?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('/admin/program/utama/'+id+'/delete', function(){
                            table.ajax.reload(null, false);
                            swal('Berhasil!', 'Program utama telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
