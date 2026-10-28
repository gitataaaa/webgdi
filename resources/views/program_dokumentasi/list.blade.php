@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dokumentasi Program</li>
    </ol>
@endsection

@section('content')
@php
    $programList     = $programs;
    $programLogos    = $programLogos ?? [];
    $selectedProgram = request('program');
    $programLabel    = $programList[$selectedProgram] ?? null;
    $counts          = $counts ?? collect();
@endphp
<div class="container">
    @if($programLabel)
        @include('program_partials.header', [
            'heading' => 'Dokumentasi ' . $programLabel,
            'activeTab' => 'dokumentasi',
            'programSlug' => $selectedProgram,
        ])

        <div class="mb-3">
            <a href="/admin/program/dokumentasi/add?program={{ $selectedProgram }}" class="btn btn-sm btn-primary">
                <i class="bi-plus-lg"></i> Tambah Dokumentasi
            </a>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-sm table-hover align-middle dokumentasi-table" style="width:100%">
                <thead>
                    <tr>
                        <th width="4%">No</th>
                        <th width="9%">Foto</th>
                        <th>Judul Kegiatan</th>
                        <th width="7%">Tautan</th>
                        <th width="6%">Urutan</th>
                        <th width="9%">Kelola Statistik</th>
                        <th width="8%">Kelola FAQ</th>
                        <th width="8%">Kelola Manfaat</th>
                        <th width="8%">Kelola Galeri</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    @else
        <div class="mb-3">
            <h5 class="mb-1">Kelola Dokumentasi</h5>
            <p class="text-muted mb-0">Pilih program untuk melihat dan mengelola dokumentasinya.</p>
        </div>

        <div class="row g-3">
            @foreach($programList as $slug => $label)
                <div class="col-md-4">
                    @php
                        $logoPath = $programLogos[$slug] ?? null;
                        if (!$logoPath || !file_exists(public_path($logoPath))) {
                            $logoPath = file_exists(public_path('website/assets/images/custom/' . $slug . '.png'))
                                ? 'website/assets/images/custom/' . $slug . '.png'
                                : 'admin/assets/img/setting/_img.jpg';
                        }
                    @endphp
                    <a href="/admin/program/dokumentasi?program={{ $slug }}" class="card program-card h-100 text-decoration-none">
                        <div class="card-body d-flex align-items-center gap-3">
                            <img src="{{ asset($logoPath) }}" class="program-card-logo" alt="{{ $label }}">
                            <div>
                                <h6 class="mb-1 text-dark">{{ $label }}</h6>
                                <small class="text-muted">{{ $counts[$slug] ?? 0 }} dokumentasi</small>
                            </div>
                            <i class="bi-chevron-right ms-auto text-muted"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('styles')
    <style>
        .program-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            transition: border-color .15s ease, box-shadow .15s ease;
        }
        .program-card:hover {
            border-color: #198754;
            box-shadow: 0 4px 12px rgba(16, 24, 40, .06);
        }
        .program-card-logo {
            width: 56px;
            height: 56px;
            object-fit: contain;
        }
        .dokumentasi-table thead th {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            color: #495057;
            font-size: .85rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .dokumentasi-table tbody td {
            padding: .65rem .5rem;
        }
        .dokumentasi-table .dokumentasi-thumb {
            width: 72px;
            height: 48px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }
        /* kolom kelola per fitur: jarak dan pemisah yang jelas dari kolom Aksi */
        .dokumentasi-table .dokumentasi-kelola {
            padding-left: .35rem;
            padding-right: .35rem;
            white-space: nowrap;
        }
        .dokumentasi-table .dokumentasi-kelola + .dokumentasi-kelola {
            border-left: 1px solid #f1f3f5;
        }
        .dokumentasi-table .dokumentasi-aksi {
            border-left: 1px solid #e9ecef;
            padding-left: .75rem;
            white-space: nowrap;
        }
    </style>
@endpush

@if($programLabel)
    @push('scripts')
        <script>
            $(document).ready(function(){
                var table = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ '/admin/program/dokumentasi/table?program=' . $selectedProgram }}",
                    columns: [
                        { data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false },
                        { data: 'gambar', name: 'gambar_url', orderable: false, searchable: false },
                        { data: 'judul', name: 'judul_kegiatan' },
                        { data: 'tautan', name: 'tautan', orderable: false, searchable: false },
                        { data: 'urutan', name: 'urutan' },
                        { data: 'kelola_statistik', name: 'kelola_statistik', orderable: false, searchable: false },
                        { data: 'kelola_faq', name: 'kelola_faq', orderable: false, searchable: false },
                        { data: 'kelola_manfaat', name: 'kelola_manfaat', orderable: false, searchable: false },
                        { data: 'kelola_galeri', name: 'kelola_galeri', orderable: false, searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    columnDefs: [
                        { className: 'align-middle', targets: '_all' },
                        { className: 'text-center', targets: [0, 3, 4] },
                        { className: 'text-center dokumentasi-kelola', targets: [5, 6, 7, 8] },
                        { className: 'text-center dokumentasi-aksi', targets: 9 },
                    ]
                });

                $(document).on('click', '.btn-del', function(){
                    const id = $(this).data('id');

                    swal({
                        title: "Peringatan!",
                        text: "Dokumentasi yang dihapus akan hilang dari halaman program terkait. Anda yakin akan menghapus data yang bersangkutan?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.get('/admin/program/dokumentasi/'+id+'/delete', function(){
                                table.ajax.reload(null, false);
                                swal('Berhasil!', 'Data telah dihapus!', 'success');
                            });
                        }
                    });
                })
            })
        </script>
    @endpush
@endif
