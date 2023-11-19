@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Laporan LB1 Tahun 2023</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Laporan LB1</li>
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
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <div class="col-6 d-flex justify-content-around">
                                <input class="datepicker-here form-control digits" type="text" data-range="true"
                                    data-multiple-dates-separator=" - " data-language="en">
                                <a href="javascript:;"
                                    class="btn btn-info btn-fill pull-right btn-submit-filter m-l-15">Filter</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-flush" id="table-laporan-prolanis"
                                    style="text-transform: uppercase;">
                                    <thead>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Januari</td>
                                            <td><a href="/laporan/lb1Download/1" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Februari</td>
                                            <td><a href="/laporan/lb1Download/2" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Maret</td>
                                            <td><a href="/laporan/lb1Download/3" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>April</td>
                                            <td><a href="/laporan/lb1Download/4" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Mei</td>
                                            <td><a href="/laporan/lb1Download/5" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Juni</td>
                                            <td><a href="/laporan/lb1Download/6" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Juli</td>
                                            <td><a href="/laporan/lb1Download/7" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Agustus</td>
                                            <td><a href="/laporan/lb1Download/8" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>September</td>
                                            <td><a href="/laporan/lb1Download/9" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Oktober</td>
                                            <td><a href="/laporan/lb1Download/10" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>November</td>
                                            <td><a href="/laporan/lb1Download/11" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>Desember</td>
                                            <td><a href="/laporan/lb1Download/12" target="_blank"
                                                    class="btn btn-primary">Download</a></td>
                                        </tr>
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

</script>
@endsection