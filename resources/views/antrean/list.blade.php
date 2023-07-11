@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Data Antrean</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Antrean</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label w-25">Tanggal</label>
                                <input type="date" name="tanggal" id="tgl" class="form-control" placeholder="Tanggal">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-antrean" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Antrean</th>
                                    <th>Nama</th>
                                    <th>Nik</th>
                                    <th>Poli</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
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
    function loadData(tgl = ''){
        $('#table-antrean').dataTable().fnClearTable();
        $('#table-antrean').dataTable().fnDestroy();
        var table = $('#table-antrean').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{{ route('ajax_load_antrean') }}",
                data: function(d){
                    d.tgl = tgl;
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nik',
                    name: 'nik'
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
                    name: 'action'
                }
            ]
        });
    }

    loadData()

    $('#tgl').change(function(e){
        e.preventDefault();
        loadData($(this).val());
    })
</script>
@endsection