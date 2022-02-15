@extends('master.main')
@section('content')
<style>
    .card-body{
        font-size: 12px;
    }
    .form-group{
        margin-bottom: 10px;
    }
    input, textarea, select{
        text-transform: uppercase;
    }
</style>
<div class="container-fluid mt--6">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="mb-0">Edit Pasien</h3>
        </div>
        <div class="card-body">
            <form action="{{route('save_edit_pasien')}}" id="form-pasien" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idPasien" value="{{$pasiens->id}}">
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Nama KK</label>
                                    <input type="text" name="kepala_keluarga" id="kepalaKeluarga" class="form-control col-8 input-form-kepala_keluarga" placeholder="Nama Kepala Keluarga" value="{{$pasiens->kepala_keluarga}}">
                                    <div class="offset-md-4 col-10 invalid-feedback">Nama KK wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div id="loadNama">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">No KTP</label>
                                    <input type="text" name="no_ktp" id="noKtp" class="form-control col-8" placeholder="NIK KTP" value="{{$pasiens->no_ktp}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Nama</label>
                                        <input type="text" name="nama" id="nama" class="form-control col-8 input-form-nama" placeholder="Nama" value="{{$pasiens->nama}}">
                                        <div class="offset-md-4 col-10 invalid-feedback">Nama wajib di isi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempatLahir" class="form-control col-8" placeholder="Tempat Lahir" value="{{$pasiens->tempat_lahir}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" id="tglLahir" class="form-control col-5 mr-2" value="{{$pasiens->tgl_lahir}}">
                                    <input type="text" name="umur" id="umur" class="form-control col" readonly>
                                    <div class="offset-md-4 col-10 invalid-feedback">Tanggal Lahir wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Jenis Kelamin</label>
                                    <select class="form-control col-8" name="jk" id="jk">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">No HP</label>
                                    <input type="text" name="no_hp" id="noHp" class="form-control col-8" placeholder="No HP" value="{{$pasiens->no_hp}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Agama</label>
                                    <select name="agama" id="agama" class="form-control col-8">
                                        <option value="0" selected>Pilih Agama</option>
                                        <option value="1">Islam</option>
                                        <option value="2">Katolik</option>
                                        <option value="3">Kristen</option>
                                        <option value="4">Buddha</option>
                                        <option value="5">Hindu</option>
                                        <option value="6">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Status Perkawinan</label>
                                    <select name="status_kawin" id="status_kawin" class="form-control col-8">
                                        <option value="kawin">Kawin</option>
                                        <option value="belum">Belum Kawin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control col-8" value="{{$pasiens->pekerjaan}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Kewarganegaraan</label>
                                    <select name="warganegara" id="warganegara" class="form-control col-8">
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Gol Darah</label>
                                    <select name="gol_darah" id="gol_darah" class="form-control col-8">
                                        <option value="A">A</option>
                                        <option value="AB">AB</option>
                                        <option value="B">B</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Cara Bayar</label>
                                    <select name="cara_bayar" id="caraBayar" class="form-control col-8">
                                        <option value="UMUM">UMUM</option>
                                        <option value="BPJS">BPJS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="noBPJS">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">No BPJS</label>
                                    <input type="text" name="no_bpjs" id="noBpjs" value="" class="form-control col-8 input-form-no_bpjs" placeholder="No BPJS">
                                    <div class="offset-md-4 col-10 invalid-feedback">No BPJS wajib di isi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Alamat KTP</label>
                                    <textarea name="alamat" id="alamat" class="form-control col-8 input-form-alamat" cols="30" rows="2" autocomplete="off" placeholder="Alamat KTP">{{$pasiens->alamat}}</textarea>
                                    <div class="offset-md-4 col-10 invalid-feedback">Alamat wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">RT / RW</label>
                                    <input type="text" name="rt" id="rt" class="form-control col mr-2" placeholder="RT" value="{{$pasiens->rt}}">
                                    <input type="text" name="rw" id="rw" class="form-control col" placeholder="RW" value="{{$pasiens->rw}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Alamat Domisii</label>
                                    <textarea name="alamat_dom" id="alamat_dom" class="form-control col-8" cols="30"
                                    rows="2" placeholder="Alamat Domisili">{{$pasiens->alamat_dom}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 offset-md-4">
                                <div class="form-group row align-items-center">
                                    <input type="checkbox" name="same_as_alamat" class="btn-same-address mr-2" @php echo(strlen($pasiens->alamat_dom) > 0) ? 'checked' : '' @endphp>
                                    <label class="col-form-label">Sama Seperti Alamat KTP</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Provinsi</label>
                                    <div class="col-8">
                                        <select class="form-control select2" name="province" id="select-province">
                                            @foreach($dataProvince as $province)
                                                <option value="{{$province->id}}">{{$province->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Kota</label>
                                    <div class="col-8">
                                        <select class="form-control select2" name="city" id="select-city">
                                            @foreach($dataCity as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Kecamatan</label>
                                    <div class="col-8">
                                        <select class="form-control select2" name="district" id="select-district">
                                            @foreach($dataDistrict as $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Kelurahan</label>
                                    <div class="col-8">
                                        <select class="form-control col-8 select2" name="villages" id="select-villages">
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
                <div class="row">
                    <div class="col-md-12 text-right mt-3">
                        <button type="reset" class="btn btn-fill btn-danger btn-batal-pasien">Batal</button>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
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
    });
    $('.btn-batal-pasien').click(function (e) {
        e.preventDefault();
        window.location.href = "{{route('daftar_pasien')}}";
    });

    $('#klasifikasi').change(function (e) {
        var getValue = $(this).val();
        if (getValue === '1') {
            $('#noRm').val();
            $('#noRm').attr('readonly','false');
        }
    });

    $('#noRm').change(function () {
        var getValue = $(this).val();
        $.ajax({
            url: '{{route("cek_status_pasien")}}',
            type: 'GET',
            data: {
                noRm: getValue
            },
            success: function (response) {
                $('#loadKepalaKeluarga').html('');
                $('#loadKepalaKeluarga').html(response);

                $('#kepalaKeluarga').change(function () {
                    $.ajax({
                        url: '{{route("get_from_kepala_keluarga")}}',
                        type: 'GET',
                        data: {
                            noRm: getValue,
                            nama: $(this).val()
                        },
                        success: function (response) {
                            $('#loadNama').html('');
                            $('#loadNama').html(response);
                            $('.btnNewPasien').click(function () {
                                $('#namaPasien').html('');
                                $('#namaPasien').html('<input type="text" name="nama" class="form-control col-8">');
                                $('#alamat').val('');
                                $('#tglLahir').val('');
                                $('#umur').val('');
                                $('#noKtp').val('');
                                $('#pekerjaan').val('');
                                $('#noHp').val('');
                                $('#noBpjs').val('');
                            })

                            $('#select-nama').change(function (e) {
                                var getSelectNama = $(this).val();
                                $.ajax({
                                    url: '{{route("get_detail_pasien")}}',
                                    type: 'GET',
                                    data: {
                                        id: getSelectNama,
                                    },
                                    success : function (response) {
                                        var getResponse = jQuery.parseJSON(response);
                                        console.log(getResponse);
                                        $('#namaPasien').val(getResponse.nama);
                                        $('#alamat').val(getResponse.alamat);
                                        $('#tglLahir').val(getResponse.tgl_lahir);
                                        $('#umur').val(getResponse.umur);
                                        $('#noKtp').val(getResponse.no_ktp);
                                        $('#pekerjaan').val(getResponse.pekerjaan);
                                        $('#noHp').val(getResponse.no_hp);
                                        $('#noBpjs').val(getResponse.no_bpjs);
                                        $('#input-kategori').val(getResponse.kategori);
                                        $('#input-wilayah').val(getResponse.wilayah);
                                        $('#agama').val(getResponse.agama);
                                        $('#jk').val(getResponse.jk);
                                    }
                                })
                            })

                        }
                    })
                });
            }
        });
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

        if (age < 60){
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

    $('#select-province').change(function(){
        let getVal = $(this).val();
        $.ajax({
            url : "{{route('load_data_city')}}",
            method : 'get',
            dataType : 'json',
            data : {provinceId: getVal },
            success : function(response){
                let dataCity = response;
                let elmSelectCity = $('#select-city');
                elmSelectCity.html('');
                dataCity.forEach(data => {
                    let option = $('<option>', {value:data.id, text:data.name});
                    elmSelectCity.append(option);
                });
                elmSelectCity.removeAttr('disabled');
            }
        });
    })

    $('#select-city').change(function(){
        let getVal = $(this).val();
        $.ajax({
            url : "{{route('load_data_district')}}",
            method : 'get',
            dataType : 'json',
            data : {cityId: getVal },
            success : function(response){
                let dataCity = response;
                let elmSelectDistrict = $('#select-district');
                elmSelectDistrict.html('');
                dataCity.forEach(data => {
                    let option = $('<option>', {value:data.id, text:data.name});
                    elmSelectDistrict.append(option);
                });
                elmSelectDistrict.removeAttr('disabled');
            }
        });
    })

    $('#select-district').change(function(){
        let getVal = $(this).val();
        $.ajax({
            url : "{{route('load_data_villages')}}",
            method : 'get',
            dataType : 'json',
            data : {districtId: getVal,},
            success : function(response){
                let dataVillages = response;
                let elmSelectVillages = $('#select-villages');
                elmSelectVillages.html('');
                dataVillages.forEach(data => {
                    let option = $('<option>', {value:data.id, text:data.name});
                    elmSelectVillages.append(option);
                });
                elmSelectVillages.removeAttr('disabled');
            }
        });
    });

    $('.btn-same-address').change(function(){
        let getPropChecked = $(this).prop('checked');
        let getKTPAddress = $('#alamat').val();

        if (getPropChecked == true){
            if (getKTPAddress.length == 0){
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

    $('#form-pasien').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/pasien');
    });
</script>
@endsection