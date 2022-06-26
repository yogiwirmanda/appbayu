@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan Prolanis</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Pasien</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-laporan-prolanis" style="text-transform: uppercase;">
                            <thead>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Nama Pasien</th>
                                <th>Tgl Kunjungan Terakhir</th>
                            </thead>
                            <tbody>
                            </tbody>
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
        var table = $('#table-laporan-prolanis').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax_load_laporan_prolanis')}}",
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
                    data: 'last_kunjungan_prolanis',
                    name: 'last_kunjungan_prolanis',
                },
            ]
        });
    }

    loadTable('{{$tanggal}}');

    // $('.btn-submit-filter').click(function (e) {
    //     e.preventDefault();
    //     let tanggal = $('#tanggal').val();
    //     let type = $('#type').val();
    //     loadTable(type, tanggal);
    // });
</script>
@endsection