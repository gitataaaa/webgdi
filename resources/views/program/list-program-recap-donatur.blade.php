@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/program">Program</a></li>
        <li class="breadcrumb-item"><a href="/admin/program/rekapitulasi">Rekapitulasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Donatur</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Daftar Donatur</h5>
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Program</label>
                    <div class="col-sm-9">
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
                    <label class="col-sm-3 col-form-label">Rentang Waktu</label>
                    <div class="col-sm-6">
                        <input type="text" name="dates" class="form-control daterange-input"/>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-9">
                        <button type="button" class="btn btn-primary btn-search"><i class="bi-search"></i> Filter Laporan</button>
                        <a href="/admin/program/rekapitulasi" class="btn btn-warning">Rekap Donasi Program <i class="bi-arrow-left-square"></i> </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <div class="alert alert-warning">
                <h6>TOTAL DONASI<br/>KESELURUHAN</h6>
                <div style="font-size: 30px; font-weight: bold" id="totalDisplay">Memuat...</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="alert alert-danger">
                <h6>TOTAL DONASI<br/>(FILTERED)</h6>
                <div style="font-size: 30px; font-weight: bold" id="totalFilterDisplay">Memuat...</div>
            </div>
        </div>
    </div>
    
    <hr/>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="table-tab" data-bs-toggle="tab" data-bs-target="#table-tab-pane" type="button" role="tab" aria-controls="table-tab-pane" aria-selected="true">Daftar Donatur</button>
        </li>
        <!--
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="chart-tab" data-bs-toggle="tab" data-bs-target="#chart-tab-pane" type="button" role="tab" aria-controls="chart-tab-pane" aria-selected="false">Grafik</button>
        </li>
        -->
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="table-tab-pane" role="tabpanel" aria-labelledby="table-tab" tabindex="0">
            <br/>
            <h5>
                Tabel Pencapaian Hasil Donasi
                <p class="waktuText"></p>
            </h5>
            <table id="datatable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="5"><button type="button" class="btn btn-success btn-export">Export to Excel</button></th>
                    </tr>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Donatur</th>
                        <th>Tanggal</th>
                        <th>Donasi</th>
                        <th>Program</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--
        <div class="tab-pane fade" id="chart-tab-pane" role="tabpanel" aria-labelledby="chart-tab" tabindex="0">
            <br/>
            <h5>
                Grafik Pencapaian Hasil Donasi
                <p class="waktuText"></p>
            </h5>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        -->
    </div>
    
    
</div>
@endsection

@push('scripts')
    <script>
        /*
        var ctx = document.getElementById('myChart');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Program Donasi',
                    data: [],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        function updateChart(chart, program, donasi){
            chart.data.labels = program;
            chart.data.datasets[0].data = donasi;
            chart.update();
        }
        */

        $.post('/admin/program/rekapitulasi/chart', {'_token':header, 'program':'all'}, function(result){
            //updateChart(barChart, result.program, result.donasi);
            $('#totalDisplay').html('Rp. '+Intl.NumberFormat('en-US').format(result.total));
            $('#totalFilterDisplay').html('Rp. '+Intl.NumberFormat('en-US').format(result.total));
        }, 'json');
        

        function dateFormat(date){
            var d = date.split('-');
            return d[2]+'-'+d[1]+'-'+d[0];
        }
        $(document).ready(function(){
            
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ '/admin/program/rekapitulasi/donatur/table' }}",
                    type: 'post',
                    data: function(e){
                        e._token = header;
                        e.program = $('[name=program]').val();
                        e.dates = $('[name=dates]').val();
                    }
                },
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    { data: 'donatur' },
                    { data: 'date_donasi'},
                    { 
                        data: 'nominal',
                        render: function(data, type, row, meta){
                            return 'Rp. '+Intl.NumberFormat('en-US').format(data);
                        }
                    },
                    { data: 'program' },
                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
        
                    pageTotal = api
                        .column(3, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    totalAll = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
        
                    // Update footer
                    $(api.column(3).footer()).html('Rp. '+Intl.NumberFormat('en-US').format(pageTotal));
                    $(api.column(4).footer()).html('Total Seluruh: Rp. '+Intl.NumberFormat('en-US').format(totalAll));
                },
            });

            $('.btn-search').click(function(){
                var data = {
                    '_token': header,
                    'program': $('[name=program]').val(),
                    'dates': $('[name=dates]').val()
                };
                $.post('/admin/program/rekapitulasi/chart', data, function(result){
                    //updateChart(barChart, result.program, result.donasi);
                    $('#totalFilterDisplay').html('Rp. '+Intl.NumberFormat('en-US').format(result.total));
                    $('.waktuText').html(result.range);
                }, 'json');
                table.ajax.reload(false, null);
            });

            $('.btn-export').click(function(){
                var program = $('[name=program]').val();
                

                if($('[name=dates]').val()){
                    var dates = $('[name=dates]').val().split(' s/d ');
                    var dStart = dateFormat(dates[0]);
                    var dEnd = dateFormat(dates[1]);
                    window.location.href = '/admin/program/rekapitulasi/donatur/export/excel/'+program+'/'+dStart+'/'+dEnd;
                }else{
                    window.location.href = '/admin/program/rekapitulasi/donatur/export/excel';
                }
            })
        })
    </script>
@endpush
