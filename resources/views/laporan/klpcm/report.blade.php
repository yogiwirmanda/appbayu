@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Daftar Tidak Lengkap</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Daftar Tidak Lengkap</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Total Kunjungan : {{$totalTransaksi}}</h2></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-basic-with-export"
                            style="text-transform: uppercase;">
                            <thead>
                                <th>Kategori</th>
                                <th>Jumlah Tidak Lengkap</th>
                            </thead>
                            <tbody>
                                @foreach($dataReport as $key => $data)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$data}}</td>
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
@endsection