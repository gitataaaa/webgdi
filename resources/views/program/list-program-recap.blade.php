@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/program">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rekapitulasi</li>
    </ol>
@endsection

@section('content')
<div class="container">
    <h5>Rekapitulasi Program Donasi</h5>
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
                        <a href="/admin/program/rekapitulasi/donatur" class="btn btn-warning">Daftar Donatur <i class="bi-arrow-right-square"></i> </a>
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
    <h5>
        Grafik Pencapaian Donasi Berdasarkan Program
        <p id="waktuText"></p>
    </h5>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <hr/>
    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Program</th>
                <th>Target Pencapaian</th>
                <th>Total Donasi</th>
                <th>Status Publish</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@push('scripts')
    <script>
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

        $.post('/admin/program/rekapitulasi/chart', {'_token':header, 'program':'all'}, function(result){
            updateChart(barChart, result.program, result.donasi);
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
                    url: "{{ '/admin/program/rekapitulasi/table' }}",
                    type: 'post',
                    data: function(e){
                        e._token = header;
                        e.program = $('[name=program]').val();
                        e.dates = $('[name=dates]').val();
                    }
                },
                paging: false,
                columns: [
                    { 
                        data: 'DT_RowIndex',
                        orderable: false, searchable: false
                    },
                    { data: 'title' },
                    { 
                        data: 'target_nominal',
                        render: function(data, type, row, meta){
                            return Intl.NumberFormat('en-US').format(data);
                        }
                    },
                    { 
                        data: 'total_donasi',
                        render: function(data, type, row, meta){
                            return Intl.NumberFormat('en-US').format(data);
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row, meta){
                            return (data == 'draft' ? 'Draft' : 'Publish');
                        }
                    },
                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
        
                    // Total over all pages
                    target = api
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    donasi = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
        
                    // Update footer
                    $(api.column(2).footer()).html(Intl.NumberFormat('en-US').format(target));
                    $(api.column(3).footer()).html(Intl.NumberFormat('en-US').format(donasi));
                },
            });

            $('.btn-search').click(function(){
                var data = {
                    '_token': header,
                    'program': $('[name=program]').val(),
                    'dates': $('[name=dates]').val()
                };
                $.post('/admin/program/rekapitulasi/chart', data, function(result){
                    updateChart(barChart, result.program, result.donasi);
                    $('#totalFilterDisplay').html('Rp. '+Intl.NumberFormat('en-US').format(result.total));
                    $('#waktuText').html(result.range);
                }, 'json');
                table.ajax.reload(false, null);
            })
        })
    </script>
@endpush
