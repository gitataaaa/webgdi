@extends('layout.app', ['active' => $active])
@section('title', ($pageTitle ?? 'CMS'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="bi-house"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Program</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
@endsection

@section('content')
<div class="container" style="margin-bottom: 20px">
    <h5>Detail Program</h5>
    <a href="/admin/program" class="btn btn-primary"><i class="bi-arrow-left-square"></i> Kembali</a>
    <hr/>

    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="mb-3 row row-plaintext" style="">
                    <label class="col-sm-3 col-form-label">Judul Program</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">: {{ @$detail->title }}</p>
                    </div>
                </div>
                <div class="mb-3 row row-plaintext">
                    <label class="col-sm-3 col-form-label">Target Pencapaian</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">: {{ number_format(@$detail->target_nominal) }}</p>
                    </div>
                </div>
                <div class="mb-3 row row-plaintext">
                    <label class="col-sm-3 col-form-label">Waktu Program</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">: {{ (@$detail->date_start ? \App\Helper::dateFormat(@$detail->date_start) : '').(@$detail->date_end ? ' s/d '.\App\Helper::dateFormat(@$detail->date_end) : '') }}</p>
                    </div>
                </div>
                <div class="mb-3 row row-plaintext">
                    <label class="col-sm-3 col-form-label">Penanggung Jawab</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">: {{ @$detail->pic }}</p>
                    </div>
                </div>
                <div class="mb-3 row row-plaintext">
                    <label class="col-sm-3 col-form-label">Kontak</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">: {{ @$detail->contact }}</p>
                    </div>
                </div>
                <div class="mb-3 row row-plaintext">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">: {{ ucfirst(@$detail->status).(@$detail->date_publish ? ' [Tanggal: '.date('d-m-Y', strtotime(@$detail->date_publish)).']' : '') }}</p>
                    </div>
                </div>
                <div class="mb-3 row row-plaintext">
                    <label class="col-sm-3 col-form-label">Kategori</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">: {{ @$detail->category }}</p>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Deskripsi :</label>
                <div style="margin-top: 5px; border: 1px solid #ddd; padding: 10px 10px; height: 250px; overflow: auto">{!! @$detail->description !!}</div>
            </div>
        </div>
    </div>
    
</div>
<hr/>
<div class="container">
    <h5>Daftar Realisasi Program</h5>
    <a href="/admin/program/realisasi/{{ @$detail->id }}/add" class="btn btn-primary"><i class="bi-plus-square"></i> Tambah Data Realisasi</a>
    <hr/>

    <table id="datatable" class="table" style="width:100%">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Tanggal Realisasi</th>
                <th>Penanggung Jawab</th>
                <th>Judul Kegiatan</th>
                <!--<th>Lokasi</th>-->
                <th>Status Publish</th>
                <th width="10%">&nbsp;</th>
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
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ '/admin/program/realisasi/'.@$detail->id.'/table' }}",
            columns: [
                { 
                    data: 'DT_RowIndex',
                    orderable: false, searchable: false
                },{
                    data: 'date_realisasi',
                    render: function(data, type, row, meta){
                        return dateFormat(data);
                    }
                },{
                    data: 'pelaksana'
                },{
                    data: 'title'
                },
                {
                    data: 'status',
                    render: function(data, type, row, meta){
                        return (data == 'draft' ? 'Draft' : 'Published');
                    }
                },{
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
                    $.get('/admin/program/realisasi/'+id+'/delete', function(){
                        table.ajax.reload(false, null);
                        swal('Berhasil!', 'Data telah dihapus!', 'success');
                    });
                }
            });
        })
    });
</script>
@endpush
