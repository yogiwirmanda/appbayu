@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan KLPCM</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Laporan KLPCM</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <input type="hidden" name="type" id="type" value="{{$type}}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <div class="col-6 d-flex justify-content-around">
                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                    value="{{$tanggal}}">
                                <a href="javascript:;" class="btn btn-info btn-fill pull-right btn-submit-filter m-l-10">Filter</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-basic-with-export"
                                    style="text-transform: uppercase;">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Ruang</th>
                                        <th>Lengkap</th>
                                        <th>Tidak Lengkap</th>
                                    </thead>
                                    <tbody>
                                        @foreach($dataLaporan as $key => $data)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{'POLI '.$data['namaPoli']}}</td>
                                            <td>{{$data['totalPasienLengkap'].'%'}}</td>
                                            <td>{{$data['totalPasienTidakLengkap'].'%'}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    $('.btn-submit-filter').click(function (e) {
        e.preventDefault();
        let tanggal = $('#tanggal').val();
        let type = $('#type').val();
        window.location.href = '/laporan/klpcm/' + type + '/' + tanggal;
    });

</script>
@endsection
