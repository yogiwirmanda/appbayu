@extends('master.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary d-flex justify-content-between">
                <div class="header-pasien">
                    <h4 class="card-title ">Data Laporan Pasien Retensi</h4>
                    <p class="card-category"> Here is a subtitle for this table</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatable-export">
                        <thead class=" text-primary">
                            <th>No</th>
                            <th>No RM</th>
                            <th>Nama Pasien</th>
                            <th>Nama KK</th>
                            <th>Tgl Kunjungan</th>
                            <th>Diagnosa</th>
                            <th>Keterangan</th>
                        </thead>
                        <tbody>
                            @foreach($dataPasien as $key => $pasien)
                                @php
                                $diagnosaGet = json_decode($pasien->diagnosa);
                                @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pasien->no_rm}}</td>
                                <td>{{$pasien->nama_pasien}}</td>
                                <td>{{$pasien->nama_kk}}</td>
                                <td>{{$pasien->tgl_kunjungan}}</td>
                                <td>
                                    @if (is_array($diagnosaGet))
                                        @foreach($diagnosaGet as $item)
                                            {{$item->diagnosa . ', '}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{$pasien->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
