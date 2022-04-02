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
                            <h3 class="mb-3">Pemeriksaan Prolanis</h3>
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('laporan_pemeriksaan')}}">DM</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('laporan_pemeriksaan_ht')}}">HT</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush table-bordered" id="datatable-basic-with-export" style="text-transform: uppercase;">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">No RM</th>
                                <th rowspan="2">Nama Pasien</th>
                                <th colspan="2" class="text-center">Jan</th>
                                <th colspan="2" class="text-center">Feb</th>
                                <th colspan="2" class="text-center">Mar</th>
                                <th colspan="2" class="text-center">Apr</th>
                                <th colspan="2" class="text-center">Mei</th>
                                <th colspan="2" class="text-center">Jun</th>
                                <th colspan="2" class="text-center">Jul</th>
                                <th colspan="2" class="text-center">Agu</th>
                                <th colspan="2" class="text-center">Sep</th>
                                <th colspan="2" class="text-center">Okt</th>
                                <th colspan="2" class="text-center">Nov</th>
                                <th colspan="2" class="text-center">Des</th>
                            </tr>
                            <tr>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                                <th>GDP</th>
                                <th>HBA1C</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataLaporanKunjungan as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{'POLI '.$data['no_rm']}}</td>
                                <td>{{$data['nama']}}</td>
                                <td>{{$data['gdp1']}}</td>
                                <td>{{$data['hba1c1']}}</td>
                                <td>{{$data['gdp2']}}</td>
                                <td>{{$data['hba1c2']}}</td>
                                <td>{{$data['gdp3']}}</td>
                                <td>{{$data['hba1c3']}}</td>
                                <td>{{$data['gdp4']}}</td>
                                <td>{{$data['hba1c4']}}</td>
                                <td>{{$data['gdp5']}}</td>
                                <td>{{$data['hba1c5']}}</td>
                                <td>{{$data['gdp6']}}</td>
                                <td>{{$data['hba1c6']}}</td>
                                <td>{{$data['gdp7']}}</td>
                                <td>{{$data['hba1c7']}}</td>
                                <td>{{$data['gdp8']}}</td>
                                <td>{{$data['hba1c8']}}</td>
                                <td>{{$data['gdp9']}}</td>
                                <td>{{$data['hba1c9']}}</td>
                                <td>{{$data['gdp10']}}</td>
                                <td>{{$data['hba1c10']}}</td>
                                <td>{{$data['gdp11']}}</td>
                                <td>{{$data['hba1c11']}}</td>
                                <td>{{$data['gdp12']}}</td>
                                <td>{{$data['hba1c12']}}</td>
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