@extends('layout.app', ['active' => $active])
@section('meta')
    <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}" />
@endsection
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
                        <button type="button" class="btn btn-primary btn-search"><i class="bi-search"></i> Filter Laporan</button>
                        <a href="#" class="btn btn-warning">Rekapitulasi Donatur <i class="bi-arrow-right-square"></i> </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <hr/>

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
    </table>
</div>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
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
                ajax: {
                    url: "{{ '/admin/program/rekapitulasi/table' }}",
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
            });

            $('.btn-search').click(function(){
                table.ajax.reload(false, null);
            })
        })
    </script>
@endpush
