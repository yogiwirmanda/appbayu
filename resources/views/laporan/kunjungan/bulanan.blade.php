@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan Kunjungan Bulan {{Date('F')}}</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Laporan Kunjungan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-flush text-center">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Tanggal</th>
                                            <th colspan="2"><?php echo "Usia <6 TH" ?></th>
                                            <th colspan="2"><?php echo "Usia 6-55 TH" ?></th>
                                            <th colspan="2"><?php echo "Usia >=60 TH" ?></th>
                                            <th rowspan="2">Total</th>
                                        </tr>
                                        <tr>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataReturn as $key => $val)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$val['below6Male']}}</td>
                                            <td>{{$val['below6Female']}}</td>
                                            <td>{{$val['below6Between55Male']}}</td>
                                            <td>{{$val['below6Between55Female']}}</td>
                                            <td>{{$val['moreThan60Male']}}</td>
                                            <td>{{$val['moreThan60Male']}}</td>
                                            <td>{{$val['total']}}</td>
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
