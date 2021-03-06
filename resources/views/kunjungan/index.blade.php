@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Kunjungan Pasien</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Pasien</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-6 d-flex justify-content-around m-b-20">
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="">
                        <a href="javascript:;"
                            class="btn btn-info btn-fill pull-right btn-submit-filter m-l-15">Filter</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-kunjungan">
                            <thead>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Nama</th>
                                <th>Nama Poli</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    function loadTable(tanggal){
        $('#table-kunjungan').dataTable().fnClearTable();
        $('#table-kunjungan').dataTable().fnDestroy();
        var table = $('#table-kunjungan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax_load_kunjungan') }}",
                type: "GET",
                data: function(d){
                    d.tanggal = tanggal;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_rm',
                    name: 'no_rm'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'namaPoli',
                    name: 'namaPoli'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    }
    loadTable('{{$tanggal}}');
    $('.btn-submit-filter').click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var tanggal = $('#tanggal').val();
        loadTable(tanggal);
    });
</script>
@endsection