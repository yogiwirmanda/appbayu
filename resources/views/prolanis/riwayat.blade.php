@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Riwayat Kunjungan Prolanis</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Prolanis</li>
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
                    <h4>Pasien : {{$pasien->nama}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-riwayat-prolanis" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>No RM</th>
                                    <th>Nama</th>
                                    <th>Kunjungan</th>
                                    <th>Diagnosa</th>
                                </tr>
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
    function loadTable(){
        $('#table-riwayat-prolanis').dataTable().fnClearTable();
        $('#table-riwayat-prolanis').dataTable().fnDestroy();
        var table = $('#table-riwayat-prolanis').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax_load_prolanis_riwayat') }}",
                type: "GET",
                data: function(d){
                    d.pasienId = '{{$pasienId}}';
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
                    data: 'tgl_kunjungan',
                    name: 'tgl_kunjungan'
                },
                {
                    data: 'diagnosa_show',
                    name: 'diagnosa_show'
                },
            ]
        });
    }

    loadTable();

</script>
@endsection
