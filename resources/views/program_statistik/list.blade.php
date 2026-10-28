@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Statistik Program {{ $programLabel }}</li>
    </ol>
@endsection

@section('content')
@php
    $contextQuery = '?program=' . urlencode($programSlug) . ($dokumentasiId ? '&dokumentasi=' . (int) $dokumentasiId : '');
    $contextHeading = 'Statistik ' . ($dokumentasiLabel ? 'Kegiatan ' . $dokumentasiLabel : 'Program ' . $programLabel);
@endphp
<div class="container">
    @include('program_partials.header', [
        'heading' => $contextHeading,
        'activeTab' => 'statistik',
    ])

    <div class="mb-3">
        <a href="/admin/program/statistik/add{{ $contextQuery }}" class="btn btn-sm btn-primary">
            <i class="bi-plus-square"></i> Tambah Statistik Baru
        </a>
    </div>

    <div class="table-responsive">
        <table id="datatable" class="table" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="12%">Icon / Preview</th>
                    <th>Angka / Nilai</th>
                    <th>Label / Judul</th>
                    <th width="18%">Kegiatan</th>
                    <th width="10%">Urutan</th>
                    <th width="12%">&nbsp;</th>
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
                ajax: @json('/admin/program/statistik/table' . $contextQuery),
                order: [[5, 'asc']],
                columns: [
                    { data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false },
                    { data: 'icon_preview', name: 'icon', orderable: false, searchable: false },
                    { data: 'angka_nilai', name: 'angka_nilai' },
                    { data: 'label_judul', name: 'label_judul' },
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
                    text: "Data statistik yang dihapus akan menghilangkan kotak tersebut dari halaman program. Anda yakin?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.get('/admin/program/statistik/'+id+'/delete', function(){
                            table.ajax.reload(null, false);
                            swal('Berhasil!', 'Data telah dihapus!', 'success');
                        });
                    }
                });
            })
        })
    </script>
@endpush
