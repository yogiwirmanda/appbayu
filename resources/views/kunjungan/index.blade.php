@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Filter</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="col-6 d-flex justify-content-around">
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$tanggal}}">
                        <a href="javascript:;"
                            class="btn btn-info btn-fill pull-right btn-submit-filter ml-2">Filter</a>
                    </div>
                </div>
            </div>
            <div class="card strpied-tabled-with-hover">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead>
                                <th>No RM</th>
                                <th>Nama</th>
                                <th>Nama Poli</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($dataKunjungan as $kunjungan)
                                <tr>
                                    <td>{{$kunjungan->no_rm}}</td>
                                    <td>{{$kunjungan->nama}} @if ($kunjungan->status_prolanis == 1)<span class="ml-1 badge badge-success">Prolanis</span>@endif</td>
                                    <td>{{$kunjungan->namaPoli}}</td>
                                    <td>{{$kunjungan->tanggal}}</td>
                                    <td>
                                        @if($kunjungan->is_edit === 0)
                                        <a href="/kunjungans/klpcm/{{$kunjungan->kunjunganId}}"
                                            class="btn btn-primary btn-fill" ui-toggle-class="">Kelengkapan</a>
                                        @else
                                        <a href="/klpcms/index/{{$kunjungan->kunjunganId}}"
                                            class="btn btn-success btn-fill" ui-toggle-class="">Detail</a>
                                        @endif
                                    </td>
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
<script>
    $('.btn-submit-filter').click(function () {
        var tanggal = $('#tanggal').val();
        window.location.href = '/kunjungans/harian/' + tanggal;
    });
</script>
@endsection