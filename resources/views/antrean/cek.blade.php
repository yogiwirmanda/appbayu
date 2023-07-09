@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Cek Data Antrean</h3>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/pasien/choose/{{$id}}" class="btn btn-primary mb-4">Input Baru</a>
                            </div>
                        </div>
                        <table class="table table-flush" id="table-antrean" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Nik</th>
                                    <th>Nama KK</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPasien as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->no_ktp }}</td>
                                    <td>{{ $item->kepala_keluarga }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td><a href='{{"/antrean/choose-pasien/" . $id . "/" . $item->id}}'
                                            class="btn btn-sm btn-success m-r-10">Pilih Pasien</a></td>
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