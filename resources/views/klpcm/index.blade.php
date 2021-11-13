@extends('master.main')
@section('content')
@php
    $dataDiagnosa = json_decode($dataKunjungan->diagnosa);
@endphp
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('klpcms')}}" id="formKLPCM">
                        @csrf
                        <input type="hidden" name="idKunjungan" value="{{$idKunjungan}}">
                        <input type="hidden" name="jmlLengkap" id="jmlLengkap" value="">
                        <input type="hidden" name="jmlLengkapDaftar" id="jmlLengkapDaftar" value="">
                        <input type="hidden" name="jmlLengkapPoli" id="jmlLengkapPoli" value="">
                        <div class="row">
                            <div class="col-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>No RM</label>
                                            <input type="text" class="form-control" id="noRm"
                                                value="{{$dataKunjungan->no_rm}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" id="name" class="form-control"
                                                value="{{$dataKunjungan->nama_pasien}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" id="tempatLahir" class="form-control"
                                                value="{{$dataKunjungan->tempat_lahir}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tglLahir" id="tglLahir" class="form-control"
                                                value="{{$dataKunjungan->tgl_lahir}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Umur</label>
                                            <input type="text" id="umur" class="form-control" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Rujukan</label>
                                            <select name="status_rujukan" id="status_rujukan" class="form-control select2" disabled>
                                                <option value="1" <?php echo($dataKLPCM->status_rujukan == 1) ? 'selected' : '' ?>>Dirujuk</option>
                                                <option value="0" <?php echo($dataKLPCM->status_rujukan == 0) ? 'selected' : '' ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row rujukan-form <?php echo($dataKLPCM->status_rujukan == 1) ? '' : 'd-none' ?>">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Poli Rujukan</label>
                                            <input type="text" name="poli_rujukan" id="poli_rujukan" class="form-control" value="{{$dataKLPCM->poli_rujukan}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row rujukan-form <?php echo($dataKLPCM->status_rujukan == 1) ? '' : 'd-none' ?>">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>RS Rujukan</label>
                                            <input type="text" name="rs_rujukan" id="rs_rujukan" class="form-control" value="{{$dataKLPCM->rs_rujukan}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Poli</label>
                                            <input type="text" class="form-control" id="poli"
                                                value="{{$dataKunjungan->namaPoli}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tanggal Kunjungan</label>
                                            <input type="text" id="tglKunjungan" class="form-control"
                                                value="{{$dataKunjungan->tanggal}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea id="alamat" class="form-control" cols="30" rows="10"
                                                readonly>{{$dataKunjungan->alamat}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <h5>Diagnosa</h5>
                                    </div>
                                </div>
                                <div id="load-diagnosa-list">
                                    <div class="row my-3">
                                        <div class="col-12">
                                            @foreach($dataDiagnosa as $data)
                                            <div class="row row-diagnosa mb-2">
                                                <div class="col-3 col-md-3 col-sm-3">
                                                    <input type="text" name="kodeIcd" class="form-control" value="{{$data->kode_icd}}" readonly>
                                                </div>
                                                <div class="col-6 col-md-6 col-sm-6">
                                                    <input type="text" name="diagnosa" class="form-control" value="{{$data->diagnosa}}" readonly>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-6 col-sm-6">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Kategori</th>
                                        <th>Lengkap</th>
                                        <th>Tidak Lengkap</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>NAMA</td>
                                            <td><input type="radio" name="klnama" value="1"></td>
                                            <td><input type="radio" name="klnama" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>NO RM</td>
                                            <td><input type="radio" name="klnorm" value="1"></td>
                                            <td><input type="radio" name="klnorm" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>TGL LAHIR</td>
                                            <td><input type="radio" name="kltglLahir" value="1"></td>
                                            <td><input type="radio" name="kltglLahir" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>JK</td>
                                            <td><input type="radio" name="kljk" value="1"></td>
                                            <td><input type="radio" name="kljk" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><input type="radio" name="klalamat" value="1"></td>
                                            <td><input type="radio" name="klalamat" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>NO BPJS</td>
                                            <td><input type="radio" name="klnoBpjs" value="1"></td>
                                            <td><input type="radio" name="klnoBpjs" value="0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 col-md-6 col-sm-6">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Kategori</th>
                                        <th>Lengkap</th>
                                        <th>Tidak Lengkap</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>S</td>
                                            <td><input type="radio" name="kls" value="1"></td>
                                            <td><input type="radio" name="kls" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>O</td>
                                            <td><input type="radio" name="klo" value="1"></td>
                                            <td><input type="radio" name="klo" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>A</td>
                                            <td><input type="radio" name="kla" value="1"></td>
                                            <td><input type="radio" name="kla" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>P</td>
                                            <td><input type="radio" name="klp" value="1"></td>
                                            <td><input type="radio" name="klp" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>KIE</td>
                                            <td><input type="radio" name="klkie" value="1"></td>
                                            <td><input type="radio" name="klkie" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>DX</td>
                                            <td><input type="radio" name="kldx" value="1"></td>
                                            <td><input type="radio" name="kldx" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>KODE DY</td>
                                            <td><input type="radio" name="kldy" value="1"></td>
                                            <td><input type="radio" name="kldy" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Petugas</td>
                                            <td><input type="radio" name="namaPetugas" value="1"></td>
                                            <td><input type="radio" name="namaPetugas" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>TTD Petugas</td>
                                            <td><input type="radio" name="ttdPetugas" value="1"></td>
                                            <td><input type="radio" name="ttdPetugas" value="0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var klnama = "<?php echo $dataKLPCM->klnama ?>";
    var klnorm = "<?php echo $dataKLPCM->klnorm ?>";
    var kltgllahir = "<?php echo $dataKLPCM->kltgl_lahir ?>";
    var kljk = "<?php echo $dataKLPCM->kljk ?>";
    var klalamat = "<?php echo $dataKLPCM->klalamat ?>";
    var klnoBpjs = "<?php echo $dataKLPCM->klno_bpjs ?>";
    var kls = "<?php echo $dataKLPCM->kls ?>";
    var klo = "<?php echo $dataKLPCM->klo ?>";
    var kla = "<?php echo $dataKLPCM->kla ?>";
    var klp = "<?php echo $dataKLPCM->klp ?>";
    var klkie = "<?php echo $dataKLPCM->klkie ?>";
    var kldx = "<?php echo $dataKLPCM->kldx ?>";
    var kldy = "<?php echo $dataKLPCM->kldy ?>";
    var klnamaPetugas = "<?php echo $dataKLPCM->klnama_petugas ?>";
    var klttdPetugas = "<?php echo $dataKLPCM->klttd_petugas ?>";
    $("input[type='radio']").attr('disabled', 'true');
    $("input[name='klnama'][value='" + klnama + "']").prop('checked', true);
    $("input[name='klnorm'][value='" + klnorm + "']").prop('checked', true);
    $("input[name='kltglLahir'][value='" + kltgllahir + "']").prop('checked', true);
    $("input[name='kljk'][value='" + kljk + "']").prop('checked', true);
    $("input[name='klalamat'][value='" + klalamat + "']").prop('checked', true);
    $("input[name='klnoBpjs'][value='" + klnoBpjs + "']").prop('checked', true);
    $("input[name='kls'][value='" + kls + "']").prop('checked', true);
    $("input[name='klo'][value='" + klo + "']").prop('checked', true);
    $("input[name='kla'][value='" + kla + "']").prop('checked', true);
    $("input[name='klp'][value='" + klp + "']").prop('checked', true);
    $("input[name='klkie'][value='" + klkie + "']").prop('checked', true);
    $("input[name='kldx'][value='" + kldx + "']").prop('checked', true);
    $("input[name='kldy'][value='" + kldy + "']").prop('checked', true);
    $("input[name='namaPetugas'][value='" + klnamaPetugas + "']").prop('checked', true);
    $("input[name='ttdPetugas'][value='" + klttdPetugas + "']").prop('checked', true);

</script>
@endsection
