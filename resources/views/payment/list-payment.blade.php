@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Zakat</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Zakat</h5>
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Rentang Waktu</label>
                    <div class="col-sm-6">
                        <input type="text" name="dates" class="form-control daterange-input" value=""/>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Program</label>
                    <div class="col-sm-6">
                        <select class="form-select" name="type">
                            <option value="">Semua Program</option>
                            <option value="profesi">Zakat Profesi</option>
                            <option value="maal">Zakat Maal</option>
                            <option value="fitrah">Zakat Fitrah</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Payment Status</label>
                    <div class="col-sm-6">
                        <select class="form-select" name="status">
                            <option value="">Semua</option>
                            <option value="pending">Menunggu Pembayaran</option>
                            <option value="on_confirm">Sedang Diproses</option>
                            <option value="complete">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Bank/E-Money</label>
                    <div class="col-sm-6">
                        <select class="form-select" name="bank_id">
                            <option value="">Semua</option>
                            @if(@$bank)
                            @foreach($bank as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->bank_name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Kode Donasi</label>
                    <div class="col-sm-9">
                        <input type="text" name="transcode" class="form-control"/>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-9">
                        <button type="button" class="btn btn-primary btn-search"><i class="bi-search"></i> Filter Data</button>
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
                <th>Tanggal</th>
                <th>Kode Donasi</th>
                <th>Nama</th>
                <th>Program</th>
                <th>Nominal</th>
                <th>Kode Unik</th>
                <th>Bank/E-Money</th>
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
        var str = new Date(date)
        var month = str.getMonth() + 1
        var newFormat = str.getDate() + '/' + month + '/' + str.getFullYear() + ' ' + str.getHours() + ':' + str.getMinutes();
        return newFormat
    }
    $(document).ready(function(){
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ '/admin/zakat/table' }}",
            ajax: {
                url: "{{ '/admin/zakat/table' }}",
                type: 'post',
                data: function(e){
                    e._token = header;
                    e.type = $('[name=type]').val();
                    e.status = $('[name=status]').val();
                    e.transcode = $('[name=transcode]').val();
                    e.dates = $('[name=dates]').val();
                    e.bank_id = $('[name=bank_id]').val();
                }
            },
            columns: [
                { 
                    data: 'DT_RowIndex',
                    orderable: false, searchable: false
                },
                { 
                    data: 'created_at',
                    render: function(data, type, row, meta){
                        return dateFormat(data)
                    }
                },
                { data: 'transcode' },
                { data: 'name' },
                { 
                    data: 'type',
                    render: function(data, type, row, meta){
                        var program
                        switch(data){
                            case 'profesi':
                                program = 'Zakat Profesi'
                                break;
                            case 'maal':
                                program = 'Zakat Maal';
                                break;
                            case 'fitrah':
                                program = 'Zakat Fitrah';
                                break;
                        }

                        return program;
                    }
                },{
                    data: 'nominal',
                    render: function(data, type, row, meta){
                        return (new Intl.NumberFormat('en-US').format(data));
                    }
                },
                { 
                    data: 'digit',
                    render: function(data, type, row, meta){
                        return (data.length == 1 ? '00'+data : (data.length == 2 ? '0'+data : data))
                    }
                },
                { data: 'bank_name'},
                {
                    data: 'status',
                    render: function(data, type, row, meta){
                        var status
                        switch(data){
                            case 'pending':
                                status = 'Menunggu Pembayaran'
                                break;
                            case 'on_confirm':
                                status = 'Sedang Diproses'
                                break;
                            case 'complete':
                                status = 'Selesai'
                                break;
                        }

                        return status
                    }
                },
                { 
                    data: 'action',
                    orderable: false, searchable: false
                },
            ],
        });

        $(document).on('click', '.btn-update', function(){
            const id = $(this).data('id');

            swal({
                title: "Payment Complete",
                text: "Pembayaran selesai untuk transaksi berikut?",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.get('/admin/zakat/'+id+'/update', function(){
                        table.ajax.reload(false, null);
                        swal('Berhasil!', 'Pembayaran selesai', 'success');
                    });
                }
            });
        })

        $('.btn-search').click(function(){
            table.ajax.reload();
        })
    })
</script>
@endpush
