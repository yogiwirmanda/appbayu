@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Edit Pasien</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="/pasien">Pasien</a></li>
                    <li class="breadcrumb-item active">Edit Pasien</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4">
        <form class="form theme-form" action="{{route('save_edit_pasien')}}" id="form-pasien" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idPasien" id="idPasien" value="{{$pasiens->id}}">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Nama KK</label>
                                    <input type="text" name="kepala_keluarga" id="kepalaKeluarga"
                                        class="form-control input-form-kepala_keluarga"
                                        placeholder="Nama Kepala Keluarga" value="{{$pasiens->kepala_keluarga}}">
                                    <div class="invalid-feedback">Nama KK wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="form-label">No RM</label>
                                    <input type="text" name="norm" id="norm" class="form-control input-form-norm"
                                        placeholder="Nomor RM" value="{{$pasiens->no_rm}}" required>
                                    <div class="invalid-feedback">Nomor RM wajib di isi</div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <a href="javascript:;" class="btn btn-xs btn-primary btn-cek-manual-rm">Cek No RM</a>
                            </div>
                        </div>
                        <div id="loadNama">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">No KTP</label>
                                        <input type="text" name="no_ktp" id="noKtp" class="form-control"
                                            placeholder="NIK KTP" value="{{$pasiens->no_ktp}}" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control input-form-nama"
                                            placeholder="Nama" value="{{$pasiens->nama}}">
                                        <div class="invalid-feedback">Nama wajib di isi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <div class="d-flex">
                                        <input type="date" name="tgl_lahir" id="tglLahir" class="form-control"
                                            value="{{$pasiens->tgl_lahir}}">
                                        <input type="text" name="umur" id="umur" class="form-control" readonly>
                                    </div>
                                    <div class="invalid-feedback">Tanggal Lahir wajib di isi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select class="form-control select2" name="jk" id="jk">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">No HP</label>
                                    <input type="text" name="no_hp" id="noHp" class="form-control" placeholder="No HP"
                                        value="{{$pasiens->no_hp}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Agama</label>
                                    <select name="agama" id="agama" class="form-control select2">
                                        <option value="-" selected>Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Status Perkawinan</label>
                                    <select name="status_kawin" id="status_kawin" class="form-control select2">
                                        <option value="tidak-memilih">Pilih Status</option>
                                        <option value="kawin">Kawin</option>
                                        <option value="belum">Belum Kawin</option>
                                        <option value="cerai-hidup">Cerai Hidup</option>
                                        <option value="cerai-mati">Cerai Mati</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Pekerjaan</label>
                                    <select name="pekerjaan" id="pekerjaan" class="form-control select2">
                                        <option value="tidak-memilih">Tidak Bekerja</option>
                                        @foreach($dataPekerjaan as $pekerjaan)
                                        <option value="{{$pekerjaan->id}}" {{($pekerjaan->id == $pasiens->pekerjaan) ?
                                            'selected' : ''}}>{{$pekerjaan->pekerjaan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Kewarganegaraan</label>
                                    <select name="warganegara" id="warganegara" class="form-control">
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Gol Darah</label>
                                    <select name="gol_darah" id="gol_darah" class="form-control">
                                        <option value="-">-</option>
                                        <option value="A">A</option>
                                        <option value="AB">AB</option>
                                        <option value="B">B</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Cara Bayar</label>
                                    <select name="cara_bayar" id="caraBayar" class="form-control select2">
                                        <option value="UMUM">UMUM</option>
                                        <option value="BPJS">BPJS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none row-bpjs" id="noBPJS">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">No BPJS</label>
                                    <input type="text" name="no_bpjs" id="noBpjs" value=""
                                        class="form-control input-form-no_bpjs" placeholder="No BPJS" maxlength="13">
                                    <div class="invalid-feedback">No BPJS wajib di isi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Alamat KTP</label>
                                    <textarea name="alamat" id="alamat" class="form-control input-form-alamat" cols="30"
                                        rows="2" autocomplete="off"
                                        placeholder="Alamat KTP">{{$pasiens->alamat}}</textarea>
                                    <div class="invalid-feedback">Alamat wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">RT / RW</label>
                                    <div class="d-flex">
                                        <input type="text" name="rt" id="rt" class="form-control col mr-2"
                                            placeholder="RT" value="{{$pasiens->rt}}">
                                        <input type="text" name="rw" id="rw" class="form-control col" placeholder="RW"
                                            value="{{$pasiens->rw}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Alamat Domisii</label>
                                    <textarea name="alamat_dom" id="alamat_dom" class="form-control" cols="30" rows="2"
                                        placeholder="Alamat Domisili">{{$pasiens->alamat_dom}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group align-items-center">
                                    <input type="checkbox" name="same_as_alamat" class="btn-same-address mr-2" @php
                                        echo(strlen($pasiens->alamat_dom) > 0) ? 'checked' : '' @endphp>
                                    <label class="form-label">Sama Seperti Alamat KTP</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Provinsi</label>
                                    <select class="form-control select2" name="province" id="select-province">
                                        @foreach($dataProvince as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Kota</label>
                                    <select class="form-control select2" name="city" id="select-city">
                                        @foreach($dataCity as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Kecamatan</label>
                                    <select class="form-control select2" name="district" id="select-district">
                                        @foreach($dataDistrict as $district)
                                        <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Kelurahan</label>
                                    <select class="form-control select2" name="villages" id="select-villages">
                                        @foreach($dataVillages as $villages)
                                        <option value="{{$villages->id}}">{{$villages->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-10 invalid-feedback">Kelurahan wajib di isi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="reset" class="btn btn-pill btn-danger btn-batal-pasien">Batal</button>
                <button type="submit" class="btn btn-info btn-pill pull-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    $(document).ready(function () {
        var getDate = $('#tglLahir').val();
        var getSplit = getDate.split('-');
        var date = new Date();
        var getYear = date.getFullYear();
        var age = parseInt(getYear - getSplit[0]);
        var provinceSelected = '{{$pasiens->province}}';
        var citySelected = '{{$pasiens->regency}}';
        var districtSelected = '{{$pasiens->district}}';
        var villageSelected = '{{$pasiens->village}}';
        var caraBayar = '{{$pasiens->cara_bayar}}';
        var statusKawin = '{{$pasiens->status_kawin}}';
        var agama = '{{$pasiens->agama}}';
        var jk = '{{$pasiens->jk}}';
        var golDarah = '{{$pasiens->gol_darah}}';
        var warganegara = '{{$pasiens->kewarganegaraan}}';
        var noBPJS = '{{$pasiens->no_bpjs}}';

        if (noBPJS.length > 0){
            $('.row-bpjs').removeClass('d-none');
        }

        $('#select-province').val(provinceSelected);
        $('#select-city').val(citySelected);
        $('#select-district').val(districtSelected);
        $('#select-villages').val(villageSelected);
        $('#gol_darah').val(golDarah);
        $('#warganegara').val(warganegara);
        $('#caraBayar').val(caraBayar);
        $('#status_kawin').val(statusKawin);
        $('#agama').val(agama);
        $('#jk').val(jk);
        $('#umur').val(age);
        $('#noBpjs').val(noBPJS);

        calculateAge($('#tglLahir').val())
    });

    $('.btn-batal-pasien').click(function (e) {
        e.preventDefault();
        window.location.href = "{{route('daftar_pasien')}}";
    });

    $('#klasifikasi').change(function (e) {
        var getValue = $(this).val();
        if (getValue === '1') {
            $('#noRm').val();
            $('#noRm').attr('readonly', 'false');
        }
    });

    $('.btn-save-modal').click(function (e) {
        var wilayah = $('#modal-wilayah').val();
        var kategori = $('#modal-kategori').val();
        $.ajax({
            url: '{{route("cek_no_rm")}}',
            type: 'GET',
            data: {
                wilayah: wilayah,
                kategori: kategori
            },
            success: function (response) {
                $('#noRm').val(response);
                $('#noRm').attr('readonly', 'true');
                $('#input-kategori').val(kategori);
                $('#input-wilayah').val(wilayah);
                $('#modalPasien').modal('hide');
            }

        })
    });

    $('#tglLahir').change(function (e) {
        var getDate = $(this).val();
        var getSplit = getDate.split('-');
        var date = new Date();
        var getYear = date.getFullYear();
        var age = parseInt(getYear - getSplit[0]);
        $('#umur').val(age);

        if (age < 60) {
            $('#kode-usia').val('U');
        } else {
            $('#kode-usia').val('L');
        }
    })

    $('#caraBayar').change(function () {
        var getValue = $(this).val();
        if (getValue === 'UMUM') {
            $('#noBPJS').addClass('d-none');
        } else {
            $('#noBPJS').removeClass('d-none');
        }
    });
    $('.btn-save-form').click(function (e) {
        e.preventDefault();
        $('#formKunjungan').submit();
    });

    $('#formKunjungan').submit(function (e) {
        e.preventDefault();
        var frm = $(this);
        $.ajax({
            url: frm.attr('action'),
            type: 'GET',
            data: frm.serialize(),
            success: function (response) {
                console.log(response);
                window.location.href = '{{route("daftar_pasien")}}';
            }
        })
    })

    $('#select-province').change(function () {
        let getVal = $(this).val();
        $.ajax({
            url: "{{route('load_data_city')}}",
            method: 'get',
            dataType: 'json',
            data: {
                provinceId: getVal
            },
            success: function (response) {
                let dataCity = response;
                let elmSelectCity = $('#select-city');
                elmSelectCity.html('');
                dataCity.forEach(data => {
                    let option = $('<option>', {
                        value: data.id,
                        text: data.name
                    });
                    elmSelectCity.append(option);
                });
                elmSelectCity.removeAttr('disabled');
            }
        });
    })

    $('#select-city').change(function () {
        let getVal = $(this).val();
        $.ajax({
            url: "{{route('load_data_district')}}",
            method: 'get',
            dataType: 'json',
            data: {
                cityId: getVal
            },
            success: function (response) {
                let dataCity = response;
                let elmSelectDistrict = $('#select-district');
                elmSelectDistrict.html('');
                dataCity.forEach(data => {
                    let option = $('<option>', {
                        value: data.id,
                        text: data.name
                    });
                    elmSelectDistrict.append(option);
                });
                elmSelectDistrict.removeAttr('disabled');
            }
        });
    })

    $('#select-district').change(function () {
        let getVal = $(this).val();
        $.ajax({
            url: "{{route('load_data_villages')}}",
            method: 'get',
            dataType: 'json',
            data: {
                districtId: getVal,
            },
            success: function (response) {
                let dataVillages = response;
                let elmSelectVillages = $('#select-villages');
                elmSelectVillages.html('');
                dataVillages.forEach(data => {
                    let option = $('<option>', {
                        value: data.id,
                        text: data.name
                    });
                    elmSelectVillages.append(option);
                });
                elmSelectVillages.removeAttr('disabled');
            }
        });
    });

    $('.btn-same-address').change(function () {
        let getPropChecked = $(this).prop('checked');
        let getKTPAddress = $('#alamat').val();

        if (getPropChecked == true) {
            if (getKTPAddress.length == 0) {
                swal({
                    title: 'Warning',
                    text: 'Form Alamat KTP masih kosong',
                    type: 'warning',
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-warning'
                });
                $(this).prop('checked', false);
            } else {
                $('#alamat_dom').val(getKTPAddress);
            }
        }
    });

    $('#form-pasien').submit(function (e) {
        if ($('#norm').val().length == 0){
            swal({
                title: 'Warning',
                text: 'No RM harus di isi',
                type: 'warning',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-warning'
            });
        }
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/pasien');
    });

    function checkNoRM(norm, idPasien){
        $.ajax({
            url : '/pasien/check-available-rm',
            dataType : 'JSON',
            method: 'GET',
            data : {norm : norm, idPasien : idPasien},
            success : function(response){
                if (response == true){
                    swal({
                        title: 'Warning',
                        text: 'No RM telah digunakan pada data lainya',
                        type: 'warning',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-warning'
                    });
                } else {
                    swal({
                        title: 'Available',
                        text: 'No RM dapat digunakan',
                        type: 'success',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-primary'
                    });
                }
            }
        })
    }

    function calculateAge(getDate){
        var getSplit = getDate.split('-');
        var date = new Date();
        var getYear = date.getFullYear();
        var age = parseInt(getYear - getSplit[0]);
        $('#umur').val(age);

        if (age < 60) {
            $('#kode-usia').val('U');
        } else {
            $('#kode-usia').val('L');
        }
    }

    $('#tglLahir').change(function (e) {
        var getDate = $(this).val();
        calculateAge(getDate)
    })

    let timeoutId;

    function handleKeyupWithDelay() {
        console.log('tes tes')
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            checkNoRM($('#norm').val(), $('#idPasien').val())
        }, 1000);
    }

    $('#norm').on('keyup', handleKeyupWithDelay);

    function setVillage(villageId) {
        $("#select-villages").val(villageId).trigger('change');
        HoldOn.close();
    }

    function setDistrict(districtId, villageId) {
        $("#select-district").val(districtId).trigger('change');
        setTimeout(function () {
            setVillage(villageId);
        }, 1000)
    }

    function setCity(regencyId, districtId, villageId) {
        $("#select-city").val(regencyId).trigger('change');
        setTimeout(function () {
            setDistrict(districtId, villageId);
        }, 1000)
    }

    function setProvince(provinceId, regencyId, districtId, villageId) {
        $("#select-province").val(provinceId).trigger('change');
        setTimeout(function () {
            setCity(regencyId, districtId, villageId);
        }, 1000)
    }

    function getDataFromNIK(nik){
        $.ajax({
            url : '/pasiens/check/nik/' + nik,
            method : "GET",
            dataType : 'JSON',
            success : function(response){
                $("#jk").val(response.jk).trigger('change');
                $('#tglLahir').val(response.tglLahir);
                calculateAge(response.tglLahir)
                setProvince(response.provinsi, response.kota, response.kec, 0);
            }
        })
    }

    let timeoutKtp;

    function handleKeyupWithDelayKtp() {
        clearTimeout(timeoutKtp);
        timeoutKtp = setTimeout(function() {
            getDataFromNIK($('#noKtp').val())
        }, 500);
    }

    $('#noKtp').on('keyup', handleKeyupWithDelayKtp);

    $('.btn-cek-manual-rm').click(function(e){
        checkNoRM($('#norm').val(), $('#idPasien').val());
    })

</script>
@endsection