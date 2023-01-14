@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rekapitulasi</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Rekapitulasi Program Donasi</h5>
    <div class="row">
        <div class="col-md-8">
            <form>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Program</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="program">
                            <option value="all">Semua Program</option>
                            @if(@$program)
                                @foreach($program as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Rentang Waktu</label>
                    <div class="col-sm-6">
                        <input type="text" name="dates" class="form-control"/>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary"><i class="bi-search"></i> Filter Laporan</button>
                        <a href="#" class="btn btn-warning">Rekapitulasi Donatur <i class="bi-arrow-right-square"></i> </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
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
            $('[name=dates]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' s/d ' + picker.endDate.format('DD-MM-YYYY'));
            });
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
