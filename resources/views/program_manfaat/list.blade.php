@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manfaat {{ $dokumentasiLabel ?: 'Program ' . $programLabel }}</li>
    </ol>
@endsection

@section('content')
@php
    $contextQuery = '?program=' . urlencode($programSlug) . ($dokumentasiId ? '&dokumentasi=' . (int) $dokumentasiId : '');
    $contextHeading = 'Manfaat ' . ($dokumentasiLabel ? 'Kegiatan ' . $dokumentasiLabel : 'Program ' . $programLabel);
@endphp
<div class="container">
    @include('program_partials.header', [
        'heading' => $contextHeading,
        'activeTab' => 'manfaat',
    ])

    <div class="mb-3">
        <a href="/admin/program/manfaat/add{{ $contextQuery }}" class="btn btn-sm btn-primary">
            <i class="bi-plus-square"></i> Tambah Manfaat
        </a>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Judul Manfaat</th>
                    <th width="32%">Deskripsi</th>
                    <th width="9%">YouTube</th>
                    <th width="16%">Kegiatan</th>
                    <th width="8%">Urutan</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: @json('/admin/program/manfaat/table' . $contextQuery),
                order: [[5, 'asc']],
                columns: [
                    { data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false },
                    { data: 'judul', name: 'judul' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'youtube', name: 'youtube_url', orderable: false, searchable: false },
                    { data: 'kegiatan', name: 'kegiatan', orderable: false, searchable: false },
                    { data: 'urutan', name: 'urutan' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                columnDefs: [{ className: 'align-middle', targets: '_all' }]
            });

            $(document).on('click', '.btn-del', function(){
                const id = $(this).data('id');
                swal({
                    title: "Peringatan!",
                    text: "Manfaat yang dihapus akan hilang dari halaman program. Anda yakin?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('/admin/program/manfaat/'+id+'/delete', function(){
                            table.ajax.reload(null, false);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
