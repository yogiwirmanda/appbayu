@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan Kunjungan {{Date('F Y', strtotime(Date('Y') . '-' . $monthNow . '-01'))}}</h3>
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
                    <div class="row m-b-10">
                        <div class="col-5 d-flex justify-content-around m-b-10">
                            <select name="tahun" id="select-bulan" class="form-control select2">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-5 d-flex justify-content-around m-b-10">
                            <select name="tahun" id="select-tahun" class="form-control select2">
                                <option value="2023" selected>2023</option>
                                <option value="2024" selected>2024</option>
                            </select>
                        </div>
                        <div class="col-2 d-flex justify-content-around m-b-10">
                            <button class="btn btn-primary btn-submit-filter">Filter</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive tableFixHead">
                                <table class="table table-flush text-center table-laporan-kunjungan">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Tanggal</th>
                                            <th colspan="2">Kunjungan Baru</th>
                                            <th colspan="2">Kunjungan Lama</th>
                                            <th colspan="2">
                                                <?php echo "Usia <6 TH" ?>
                                            </th>
                                            <th colspan="2">
                                                <?php echo "Usia 6-55 TH" ?>
                                            </th>
                                            <th colspan="2">
                                                <?php echo "Usia >=60 TH" ?>
                                            </th>
                                            <th rowspan="2">Total</th>
                                            <th colspan="2">
                                                <?php echo "UMUM" ?>
                                            </th>
                                            <th colspan="2">
                                                <?php echo "BPJS" ?>
                                            </th>
                                            <th rowspan="2">Total</th>
                                            <th colspan="2">
                                                <?php echo "UMUM" ?>
                                            </th>
                                            <th colspan="2">
                                                <?php echo "KIA" ?>
                                            </th>
                                            <th colspan="2">
                                                <?php echo "GIGI" ?>
                                            </th>
                                            <th rowspan="2">Total</th>
                                            <th colspan="2">
                                                <?php echo "UMUM" ?>
                                            </th>
                                            <th colspan="2">
                                                <?php echo "KIA" ?>
                                            </th>
                                            <th colspan="2">
                                                <?php echo "GIGI" ?>
                                            </th>
                                            <th rowspan="2">Total</th>
                                            <th rowspan="2">Dirujuk</th>
                                        </tr>
                                        <tr>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>L</th>
                                            <th>P</th>
                                            <th>UMUM</th>
                                            <th>BPJS</th>
                                            <th>UMUM</th>
                                            <th>BPJS</th>
                                            <th>UMUM</th>
                                            <th>BPJS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataReturn as $key => $val)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$val['kunjunganBaruMale']}}</td>
                                            <td>{{$val['kunjunganBaruFemale']}}</td>
                                            <td>{{$val['kunjunganLamaMale']}}</td>
                                            <td>{{$val['kunjunganLamaFemale']}}</td>
                                            <td>{{$val['below6Male']}}</td>
                                            <td>{{$val['below6Female']}}</td>
                                            <td>{{$val['below6Between55Male']}}</td>
                                            <td>{{$val['below6Between55Female']}}</td>
                                            <td>{{$val['moreThan60Male']}}</td>
                                            <td>{{$val['moreThan60Male']}}</td>
                                            <td>{{$val['total']}}</td>
                                            <td>{{$val['umumMale']}}</td>
                                            <td>{{$val['umumFemale']}}</td>
                                            <td>{{$val['bpjsMale']}}</td>
                                            <td>{{$val['bpjsFemale']}}</td>
                                            <td>{{$val['totalCaraBayar']}}</td>
                                            <td>{{$val['poliUmumMale']}}</td>
                                            <td>{{$val['poliUmumFemale']}}</td>
                                            <td>{{$val['poliKiaMale']}}</td>
                                            <td>{{$val['poliKiaFemale']}}</td>
                                            <td>{{$val['poliGigiMale']}}</td>
                                            <td>{{$val['poliGigiFemale']}}</td>
                                            <td>{{$val['totalPoli']}}</td>
                                            <td>{{$val['poliUmumUmum']}}</td>
                                            <td>{{$val['poliUmumBpjs']}}</td>
                                            <td>{{$val['poliKiaUmum']}}</td>
                                            <td>{{$val['poliKiaBpjs']}}</td>
                                            <td>{{$val['poliGigiUmum']}}</td>
                                            <td>{{$val['poliGigiBpjs']}}</td>
                                            <td>{{$val['totalPoliBayar']}}</td>
                                            <td>{{$val['totalRujuk']}}</td>
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
    $(document).ready(function(e){
        $('#select-bulan').val('<?php echo $monthNow ?>');
        $('#select-tahun').val('<?php echo $yearNow ?>');
    })
    $('.btn-submit-filter').click(function (e) {
        e.preventDefault();
        let bulan = $('#select-bulan').val();
        let tahun = $('#select-tahun').val();
        window.location.href = '/laporan/kunjungan/filter/' + bulan + '/' + tahun;
    });
</script>
@endsection