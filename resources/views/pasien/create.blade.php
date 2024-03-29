@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Tambah Pasien</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="/pasien">Pasien</a></li>
                    <li class="breadcrumb-item active">Tambah Pasien</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <form class="form theme-form" action="{{route('save_pasien')}}" id="form-pasien" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kategori" id="input-kategori">
                    <input type="hidden" name="wilayah" id="input-wilayah">
                    <input type="hidden" name="kode-usia" id="kode-usia">
                    <input type="hidden" name="kode-daerah" id="kode-daerah">
                    <input type="hidden" name="id_selected" id="idSelected">
                    <input type="hidden" name="noRm" id="noRm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="form-group col-md-2 align-items-center">
                                <input type="checkbox" name="pendatang" class="input-pendatang input-type-pasien mr-2"
                                    value="1">
                                <label class="col-form-label">Pendatang</label>
                            </div>
                            {{-- <div class="form-group col-md-2 align-items-center">
                                <input type="checkbox" name="suratSehat"
                                    class="input-surat-sehat input-type-pasien mr-2" value="1">
                                <label class="col-form-label">Surat Sehat</label>
                            </div> --}}
                            <div class="form-group col-md-4 align-items-center">
                                <a href="javascript:;" class="btn btn-pill btn-primary btn-cari-data">Cari Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row input-nama-kk not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Nama KK</label>
                                            <input type="text" name="kepala_keluarga" id="kepalaKeluarga"
                                                class="form-control input-form-kepala_keluarga"
                                                placeholder="Nama Kepala Keluarga">
                                            <div class="invalid-feedback">Nama KK wajib di isi</div>
                                        </div>
                                    </div>
                                </div>
                                <div id="loadNama">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">No KTP</label>
                                                <input type="text" name="no_ktp" id="noKtp" class="form-control"
                                                    placeholder="NIK KTP" maxlength="16">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Nama</label>
                                                <input type="text" name="nama" id="nama"
                                                    class="form-control input-form-nama" placeholder="Nama">
                                                <div class="invalid-feedback">Nama Pasien wajib di isi</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempatLahir"
                                                class="form-control " placeholder="Tempat Lahir"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Tanggal Lahir</label>
                                            <div class="d-flex justify-content-evenly">
                                                <input type="date" name="tgl_lahir" id="tglLahir"
                                                    class="form-control mr-2 input-form-tgl_lahir">
                                                <input type="text" name="umur" id="umur" class="form-control" value="0"
                                                    readonly>
                                            </div>
                                            <div class="invalid-feedback">Tanggal Lahir wajib di isi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Jenis Kelamin</label>
                                            <select class="form-control input-form-jk select2" name="jk" id="jk">
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <div class="invalid-feedback">Jenis Kelamin wajib di isi</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">No HP</label>
                                            <input type="text" name="no_hp" id="noHp" class="form-control"
                                                placeholder="No HP">
                                        </div>
                                    </div>
                                </div>
                                <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Agama</label>
                                            <select name="agama" id="agama" class="form-control select2">
                                                <option value="-" selected>-</option>
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
                                <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Status Perkawinan</label>
                                            <select name="status_kawin" id="status_kawin" class="form-control select2">
                                                <option value="tidak-memilih">Tidak Memilih</option>
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
                                                <option value="{{$pekerjaan->id}}">{{$pekerjaan->pekerjaan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Kewarganegaraan</label>
                                            <select name="warganegara" id="warganegara" class="form-control">
                                                <option value="WNI">WNI</option>
                                                <option value="WNA">WNA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Gol Darah</label>
                                            <select name="gol_darah" id="gol_darah" class="form-control">
                                                <option value="-">-</option>
                                                <option value="A">A</option>
                                                <option value="AB">AB</option>
                                                <option value="B">B</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Cara Bayar</label>
                                            <select name="cara_bayar" id="caraBayar" class="form-control select2">
                                                <option value="UMUM">UMUM</option>
                                                <option value="BPJS">BPJS</option>
                                                <option value="UKS">UKS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-none not-ss" id="noBPJS">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">No BPJS</label>
                                            <input type="text" name="no_bpjs" id="noBpjs" value=""
                                                class="form-control input-form-no_bpjs" placeholder="No BPJS"
                                                maxlength="13">
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
                                            <label class="col-form-label">Alamat KTP</label>
                                            <textarea name="alamat" id="alamat" class="form-control input-form-alamat"
                                                cols="30" rows="2" autocomplete="new-text"
                                                placeholder="Alamat KTP"></textarea>
                                            <div class="invalid-feedback">Alamat wajib di isi</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">RT / RW</label>
                                            <div class="d-flex">
                                                <input type="text" name="rt" id="rt" class="form-control mr-2"
                                                    placeholder="RT">
                                                <input type="text" name="rw" id="rw" class="form-control"
                                                    placeholder="RW">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Alamat Domisii</label>
                                            <textarea name="alamat_dom" id="alamat_dom" class="form-control" cols="30"
                                                rows="2" placeholder="Alamat Domisili"
                                                autocomplete="new-text"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row not-ss">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="checkbox" name="same_as_alamat" class="btn-same-address mr-2">
                                            <label class="col-form-label">Sama Seperti Alamat KTP</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 not-ss">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Provinsi</label>
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
                                            <label class="col-form-label">Kota</label>
                                            <select class="form-control select2" name="city" id="select-city" disabled>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Kecamatan</label>
                                            <select class="form-control select2" name="district" id="select-district"
                                                disabled>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Kelurahan</label>
                                            <select class="form-control select2 input-form-villages" name="villages"
                                                id="select-villages" disabled>
                                            </select>
                                            <div class="invalid-feedback">Kelurahan wajib di isi</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="reset" class="btn btn-pill btn-danger btn-batal-pasien">Batal</button>
                        <button type="submit"
                            class="btn btn-pill btn-primary pull-right btn-simpan-form">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="modal-cari-data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cari Data</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" id="form-cari-data" class="form form-theme">
                    <div class="form-group mb-3">
                        <input class="form-control" name="noRm" placeholder="No RM" type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="namaKK" placeholder="Nama KK" type="text">
                    </div>
                    <div class="text-left">
                        <button type="button" class="btn btn-primary btn-cari-data my-4">Cari</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-flush table-cari-data" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>No RM</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="modal-pilih-rm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="submit" class="btn btn-pill btn-primary pull-right btn-not-choice-rm">Tidak
                    Memilih</button>
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Umum</h5>
                            <table class="table table-flush table-pilih-rm-umum" id="datatable-basic-umum">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>No RM</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Lansia</h5>
                            <table class="table table-flush table-pilih-rm-lansia" id="datatable-basic-lansia">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>No RM</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
    $('input').attr('autocomplete', 'off');
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
                                $('#namaPasien').html(
                                    '<input type="text" name="nama" class="form-control">'
                                );
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
                                    success: function (
                                        response) {
                                        var getResponse =
                                            jQuery
                                            .parseJSON(
                                                response);
                                        console.log(
                                            getResponse);
                                        $('#namaPasien')
                                            .val(getResponse
                                                .nama);
                                        $('#alamat').val(
                                            getResponse
                                            .alamat);
                                        $('#tglLahir').val(
                                            getResponse
                                            .tgl_lahir);
                                        $('#umur').val(
                                            getResponse
                                            .umur);
                                        $('#noKtp').val(
                                            getResponse
                                            .no_ktp);
                                        $('#pekerjaan').val(
                                            getResponse
                                            .pekerjaan);
                                        $('#noHp').val(
                                            getResponse
                                            .no_hp);
                                        $('#noBpjs').val(
                                            getResponse
                                            .no_bpjs);
                                        $('#input-kategori')
                                            .val(getResponse
                                                .kategori);
                                        $('#input-wilayah')
                                            .val(getResponse
                                                .wilayah);
                                        $('#agama').val(
                                            getResponse
                                            .agama);
                                        $('#jk').val(
                                            getResponse
                                            .jk);
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

    $('#caraBayar').change(function () {
        var getValue = $(this).val();
        if (getValue === 'UMUM' || getValue === 'UKS') {
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

    $('.btn-cari-data').click(function (e) {
        let form = $('#form-cari-data');
        let tbody = $('.table-cari-data').find('tbody');
        $.ajax({
            url: '{{route("cari_data_pasien")}}',
            method: 'GET',
            dataType: 'json',
            data: form.serialize(),
            success: function (response) {
                tbody.html('');
                response.forEach(element => {
                    let tr = $('<tr>');
                    let td1 = $('<td>', {
                        text: '1'
                    });
                    let td2 = $('<td>', {
                        text: element.no_rm
                    });
                    let td3 = $('<td>', {
                        text: element.kepala_keluarga
                    });
                    let td4 = $('<td>', {
                        text: element.alamat
                    });
                    let td5 = $('<td>');
                    let action = $('<a>', {
                        href: 'javascript:;',
                        text: 'Pilih',
                        class: 'btn btn-sm btn-pill btn-primary btn-pilih-member',
                        member_id: element.id
                    });
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    tr.append(td4);
                    td5.append(action);
                    tr.append(td5);
                    tbody.append(tr);
                });
            }
        });
    });

    $('.btn-simpan-form').click(function (e) {
        e.preventDefault();
        let getKelurahan = $('#select-villages').val();
        let tbodyumum = $('.table-pilih-rm-umum').find('tbody');
        let tbodylansia = $('.table-pilih-rm-lansia').find('tbody');
        $.ajax({
            url: '/pasien/check-available-rm-by-wilayah/' + getKelurahan,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                tbodyumum.html('');
                tbodylansia.html('');
                response.umum.forEach((value, index) => {
                    let tr = $('<tr>');
                    let td1 = $('<td>', {
                        text: index + 1
                    });
                    let td2 = $('<td>', {
                        text: value
                    });
                    let td3 = $('<td>');
                    let action = $('<a>', {
                        href: 'javascript:;',
                        text: 'Pilih',
                        class: 'btn btn-sm btn-pill btn-primary btn-pilih-rm',
                        no_rm: value
                    });
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    td3.append(action);
                    tbodyumum.append(tr);
                });

                response.lansia.forEach((value, index) => {
                    let tr = $('<tr>');
                    let td1 = $('<td>', {
                        text: index + 1
                    });
                    let td2 = $('<td>', {
                        text: value
                    });
                    let td3 = $('<td>');
                    let action = $('<a>', {
                        href: 'javascript:;',
                        text: 'Pilih',
                        class: 'btn btn-sm btn-pill btn-primary btn-pilih-rm',
                        no_rm: value
                    });
                    tr.append(td1);
                    tr.append(td2);
                    tr.append(td3);
                    td3.append(action);
                    tbodylansia.append(tr);
                });
                $('#modal-pilih-rm').modal('show');
            }
        });
    });

    function setVillage(villageId, disabled = false) {
        $("#select-villages").val(villageId).trigger('change');
        if (disabled){
            $("#select-villages").attr('disabled', 'disabled');
        }
        HoldOn.close();
    }

    function setDistrict(districtId, villageId, disabled = false) {
        $("#select-district").val(districtId).trigger('change');
        if (disabled){
            $("#select-district").attr('disabled', 'disabled');
        }
        setTimeout(function () {
            setVillage(villageId, disabled);
        }, 1000)
    }

    function setCity(regencyId, districtId, villageId, disabled = false) {
        $("#select-city").val(regencyId).trigger('change');
        if (disabled){
            $("#select-city").attr('disabled', 'disabled');
        }
        setTimeout(function () {
            setDistrict(districtId, villageId, disabled);
        }, 1000)
    }

    function setProvince(provinceId, regencyId, districtId, villageId, disabled = false) {
        $("#select-province").val(provinceId).trigger('change');
        if (disabled){
            $("#select-province").attr('disabled', 'disabled');
        }
        setTimeout(function () {
            setCity(regencyId, districtId, villageId, disabled);
        }, 1000)
    }

    $(document).on('click', '.btn-pilih-member', function (e) {
        e.preventDefault();
        let memberId = $(this).attr('member_id');
        $.ajax({
            url: '{{route("get_from_kepala_keluarga")}}',
            method: 'GET',
            dataType: 'json',
            data: {
                memberId: memberId
            },
            success: function (response) {
                var options = {
                    theme: "sk-bounce",
                    message: 'Mohon tunggu, sedang memproses data...',
                    backgroundColor: "#5e72e4",
                    textColor: "#ffffff"
                };

                HoldOn.open(options);

                $('#idSelected').val(response.id);
                $('#kepalaKeluarga').val(response.kepala_keluarga);
                $('#kepalaKeluarga').attr('readonly', 'readonly');
                $('#noRm').val(response.no_rm);
                $('#alamat').text(response.alamat);
                $('#alamat').attr('readonly', 'readonly');
                $('#rt').val(response.rt);
                $('#rt').attr('readonly', 'readonly');
                $('#rw').val(response.rw);
                $('#rw').attr('readonly', 'readonly');
                $('#alamat_dom').text(response.alamat_dom);
                $('#alamat_dom').attr('readonly', 'readonly');
                if (response.alamat == response.alamat_dom) {
                    $('.btn-same-address').prop('checked', true);
                }
                setProvince(response.province, response.regency, response.district, response
                    .village, true);
                $('#modal-cari-data').modal('hide');
            }
        });
    })

    $('.input-pendatang').change(function (e) {
        if ($(this).is(':checked')) {
            $('.input-nama-kk').addClass('d-none');
        } else {
            $('.input-nama-kk').removeClass('d-none');
        }
    });

    $('.input-surat-sehat').change(function (e) {
        if ($(this).is(':checked')) {
            $('.not-ss').addClass('d-none');
        } else {
            $('.not-ss').removeClass('d-none');
        }
    });

    $('#form-pasien').submit(function (e) {
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/kunjungan/create', true);
    });

    $('.btn-cari-data').click(function (e) {
        $('#modal-cari-data').modal('show');
    });

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

    let timeoutId;

    function handleKeyupWithDelay() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            getDataFromNIK($('#noKtp').val())
        }, 500);
    }

    $('#noKtp').on('keyup', handleKeyupWithDelay);

    $(document).on('click', '.btn-pilih-rm', function(e){
        getNoRm = $(this).attr('no_rm');
        $('#noRm').val(getNoRm);
        $('#modal-pilih-rm').modal('hide');
        $('#form-pasien').submit();
    })

    $('.btn-not-choice-rm').click(function(e){
        $('#modal-pilih-rm').modal('hide');
        $('#form-pasien').submit();
    })

</script>
@endsection