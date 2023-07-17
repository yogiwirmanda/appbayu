@extends('master.customer.main')
@section('content')
<div class="row py-5">
    <div class="col-8 mx-auto">
        <div class="card my-5">
            <div class="card-body">
                <form action="{{route('save_antrean')}}" id="form-antrean" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Jenis Pasien</label>
                                        <select class="form-control select2" name="pasien_baru">
                                            <option value="0">Lama</option>
                                            <option value="1">Baru</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">No RM</label>
                                        <input type="text" name="norm" id="norm" class="form-control input-form-norm"
                                            placeholder="Nomor Rekam Medis">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control input-form-nik"
                                            placeholder="Nomor Induk Kependudukan">
                                        <div class="invalid-feedback">NIK wajib di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control input-form-nama"
                                            placeholder="Nama Pasien">
                                        <div class="invalid-feedback">Nama Pasien wajib di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir"
                                            class="form-control input-form-tgl_lahir" placeholder="Tanggal Lahir">
                                        <div class="invalid-feedback">Tanggal Lahir wajib di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Alamat</label>
                                        <input type="text" name="alamat" id="alamat"
                                            class="form-control input-form-alamat" placeholder="Alamat">
                                        <div class="invalid-feedback">Alamat wajib di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Provinsi</label>
                                        <select class="form-control select2" name="provinsi" id="select-province">
                                            @foreach($dataProvince as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Kota</label>
                                        <select class="form-control select2" name="kota" id="select-city" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Kecamatan</label>
                                        <select class="form-control select2" name="kecamatan" id="select-district"
                                            disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Kelurahan</label>
                                        <select class="form-control select2 input-form-villages" name="kelurahan"
                                            id="select-villages" disabled>
                                        </select>
                                        <div class="invalid-feedback">Kelurahan wajib di isi</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Poli</label>
                                        <select class="form-control select2" name="poli" id="select-poli">
                                            @foreach($dataPoli as $poli)
                                            <option value="{{$poli->id}}">{{$poli->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Tanggal Berkunjung</label>
                                        <input type="date" name="tanggal" id="tanggal"
                                            class="form-control input-form-tanggal" placeholder="Tanggal">
                                        <div class="invalid-feedback">Tanggal Berkunjung wajib di isi</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input class="form-check-input" type="checkbox" value="1" name="ceklab"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Cek Lab
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary btn-fill pull-right">Daftar</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection