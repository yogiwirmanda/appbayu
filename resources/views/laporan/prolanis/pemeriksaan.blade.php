@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <input type="hidden" name="type" id="type" value="{{$type}}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Filter Tanggal</h3>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="col-6 d-flex justify-content-around">
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$tanggal}}">
                        <a href="javascript:;" class="btn btn-info btn-fill pull-right btn-submit-filter ml-2">Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8 text-left">
                            <h3 class="mb-0">Pemeriksaan Prolanis</h3>
                            <p class="text-sm mb-0">
                                This is an exmaple of datatable using the well known datatables.net plugin.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic-with-export" style="text-transform: uppercase;">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">No RM</th>
                                <th rowspan="2">Nama Pasien</th>
                                <th colspan="2">DM</th>
                                <th colspan="2">HT</th>
                            </tr>
                            <tr>
                                <th>GPD</th>
                                <th>HBA1C</th>
                                <th>Kontrol</th>
                                <th>Kimia Darah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataLaporan as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{'POLI '.$data['no_rm']}}</td>
                                <td>{{$data['nama']}}</td>
                                <td>{{(strlen($data['gdp']) > 0 ? $data['gdp'] : '')}}</td>
                                <td>{{(strlen($data['hba1c']) > 0 ? $data['hba1c'] : '')}}</td>
                                <td>{{(strlen($data['kontrol']) > 0 ? $data['kontrol'] : '')}}</td>
                                <td>{{(strlen($data['kimia_darah']) > 0 ? $data['kimia_darah'] : '')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.btn-submit-filter').click(function (e) {
        e.preventDefault();
        let tanggal = $('#tanggal').val();
        let type = $('#type').val();
        window.location.href = '/laporan/klpcm/'+type+'/'+tanggal;
    });
</script>
@endsection