@extends('master.main')
@section('content')
@php
$jenisPemeriksaan = ['Kontrol', 'Kimia Darah'];
if ($dataKunjungan->keterangan_prolanis == 'Diabetes Melitus'){
$jenisPemeriksaan = ['GDP', 'HBA1C'];
}
$yearNow = (int) Date('Y');
$yearPasien = (int) Date('Y', strtotime($dataKunjungan->tgl_lahir));
$umur = $yearNow - $yearPasien;
@endphp
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>KLPCM</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"></a></li>
                    <li class="breadcrumb-item">KLPCM</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('save_klpcm')}}" id="formKLPCM">
                        @csrf
                        <input type="hidden" name="idPasien" value="{{$dataKunjungan->id_pasien}}">
                        <input type="hidden" name="idKunjungan" value="{{$idKunjungan}}">
                        <input type="hidden" name="jmlLengkap" id="jmlLengkap" value="">
                        <input type="hidden" name="jmlLengkapDaftar" id="jmlLengkapDaftar" value="">
                        <input type="hidden" name="jmlLengkapPoli" id="jmlLengkapPoli" value="">
                        <div class="row">
                            <div class="col-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">No RM</label>
                                            <input type="text" class="form-control" id="noRm"
                                                value="{{$dataKunjungan->no_rm}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Nama</label>
                                            <input type="text" id="name" class="form-control"
                                                value="{{$dataKunjungan->nama_pasien}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Tempat Lahir</label>
                                            <input type="text" id="tempatLahir" class="form-control"
                                                value="{{$dataKunjungan->tempat_lahir}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="col-form-label">Tanggal Lahir</label>
                                            <input type="date" name="tglLahir" id="tglLahir" class="form-control"
                                                value="{{$dataKunjungan->tgl_lahir}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Umur</label>
                                            <input type="text" id="umur" class="form-control" value="{{$umur}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-20">
                                    <div class="col-12 col-md-12 col-sm-12">
                                        <h5>Diagnosa</h5>
                                    </div>
                                    <div id="load-diagnosa-list" class="col-md-12">
                                        <div class="row my-3">
                                            <div class="col-12">
                                                <button class="btn btn-info btn-modal-diagnosa">Tambah Diagnosa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Rujukan</label>
                                            <select name="status_rujukan" id="status_rujukan"
                                                class="form-control select2">
                                                <option value="1">Dirujuk</option>
                                                <option value="0" selected>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row rujukan-form d-none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Poli Rujukan</label>
                                            <select name="poli_rujukan" id="poli_rujukan" class="form-control select2">
                                                @foreach($dataPoliRujukan as $rujukan)
                                                <option value="{{$rujukan->id}}">{{$rujukan->rujukan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row rujukan-form d-none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">RS Rujukan</label>
                                            <select name="rs_rujukan" id="rs_rujukan" class="form-control select2">
                                                @foreach($dataRumahsakit as $tumahsakit)
                                                <option value="{{$tumahsakit->id}}">{{$tumahsakit->rumahsakit}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Poli</label>
                                            <input type="text" class="form-control" id="poli"
                                                value="{{$dataKunjungan->namaPoli}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Tanggal Kunjungan</label>
                                            <input type="text" id="tglKunjungan" class="form-control"
                                                value="{{$dataKunjungan->tanggal}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Alamat</label>
                                            <textarea id="alamat" class="form-control" cols="30" rows="10"
                                                readonly>{{$dataKunjungan->alamat}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Jenis Kasus</label>
                                            <select name="jenis_kasus" id="jenis_kasus" class="form-control">
                                                <option value="0">Lama</option>
                                                <option value="1">Baru</option>
                                                <option value="2">KKL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if ($dataKunjungan->is_prolanis == 1)
                                @if($dataKunjungan->keterangan_prolanis)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Jenis Pemeriksaan</label>
                                            <select name="jenis_pemeriksaan" id="jenis_pemeriksaan"
                                                class="form-control select-pemeriksaan">
                                                @foreach($jenisPemeriksaan as $pemeriksaan)
                                                <option value="{{$pemeriksaan}}">{{$pemeriksaan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pemeriksaan pemeriksaan-gdp">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">GDP</label>
                                            <input type="text" name="gdp" id="gdp" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row pemeriksaan pemeriksaan-hba1c d-none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">HBA1C</label>
                                            <input type="text" name="hba1c" id="hba1c" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row pemeriksaan pemeriksaan-kontrol d-none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Kontrol</label>
                                            <input type="text" name="kontrol" id="kontrol" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row pemeriksaan pemeriksaan-kimiadarah d-none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Kimia Darah</label>
                                            <input type="text" name="kimia_darah" id="kimia_darah" class="form-control"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
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
                                            <td><input type="radio" name="klnama" value="1" checked></td>
                                            <td><input type="radio" name="klnama" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>NO RM</td>
                                            <td><input type="radio" name="klnorm" value="1" checked></td>
                                            <td><input type="radio" name="klnorm" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>TGL LAHIR</td>
                                            <td><input type="radio" name="kltglLahir" value="1" checked></td>
                                            <td><input type="radio" name="kltglLahir" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>JK</td>
                                            <td><input type="radio" name="kljk" value="1" checked></td>
                                            <td><input type="radio" name="kljk" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><input type="radio" name="klalamat" value="1" checked></td>
                                            <td><input type="radio" name="klalamat" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>NO BPJS</td>
                                            <td><input type="radio" name="klnoBpjs" value="1" checked></td>
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
                                            <td><input type="radio" name="kls" value="1" checked></td>
                                            <td><input type="radio" name="kls" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>O</td>
                                            <td><input type="radio" name="klo" value="1" checked></td>
                                            <td><input type="radio" name="klo" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>A</td>
                                            <td><input type="radio" name="kla" value="1" checked></td>
                                            <td><input type="radio" name="kla" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>P</td>
                                            <td><input type="radio" name="klp" value="1" checked></td>
                                            <td><input type="radio" name="klp" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>KIE</td>
                                            <td><input type="radio" name="klkie" value="1" checked></td>
                                            <td><input type="radio" name="klkie" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>DX</td>
                                            <td><input type="radio" name="kldx" value="1" checked></td>
                                            <td><input type="radio" name="kldx" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>KODE DY</td>
                                            <td><input type="radio" name="kldy" value="1" checked></td>
                                            <td><input type="radio" name="kldy" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Petugas</td>
                                            <td><input type="radio" name="namaPetugas" value="1" checked></td>
                                            <td><input type="radio" name="namaPetugas" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>TTD Petugas</td>
                                            <td><input type="radio" name="ttdPetugas" value="1" checked></td>
                                            <td><input type="radio" name="ttdPetugas" value="0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit"
                            class="btn btn-info btn-fill pull-right btn-save-klpcm m-t-20">Simpan</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-cari-diagnosa" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h6 class="modal-title" id="modal-title-default">Cari Data</h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form role="form" id="form-cari-diagnosa">
                        <div class="form-group mb-3">
                            <input class="form-control" name="keyword" placeholder="Cari..." type="text">
                        </div>
                        <div class="text-left">
                            <button type="button" class="btn btn-primary btn-cari-data my-4">Cari</button>
                        </div>
                    </form>
                    <table class="table table-flush table-cari-data" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Kode ICD</th>
                                <th>Diagnosa</th>
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
@endsection
@section('page-scripts')
<script>
    $('.btn-save-klpcm').click(function (e) {
    e.preventDefault();

    let rowDiagnosa = $('.row-diagnosa').length;
    if (rowDiagnosa == 0){
        $.notify('Diagnosa harus di isi', 'danger');
        return false;
    } else {
        var frm = $('#formKLPCM');
        var dataForm = frm.serializeArray();
        var items = 0;
        var count = 0;
        var countDaftar = 0;
        var countPoli = 0;
        dataForm.forEach(function (data) {
            var getValue = data['value'];
            if (items >= 6 && items <= 11) {
                if (getValue === '1') {
                    countDaftar = countDaftar + 1;
                    count = count + 1;
                }
            } else if (items >= 12 && items <= 20) {
                if (getValue === '1') {
                    countPoli = countPoli + 1;
                    count = count + 1;
                }
            }
            items = items + 1;
        });
        $('#jmlLengkap').val(count);
        $('#jmlLengkapDaftar').val(countDaftar);
        $('#jmlLengkapPoli').val(countPoli);
        $('#formKLPCM').submit();
    }
});

$('#kodeIcd').change(function () {
    var getValue = $(this).val();
    $.ajax({
        url: '/klpcms/check/icd',
        type: 'GET',
        data: {
            icd: getValue
        },
        success: function (response) {
            $('#diagnosa').val(response);
        }
    });
});

$('.btn-modal-diagnosa').click(function(e){
    e.preventDefault();
    $('#modal-cari-diagnosa').modal('show');
});

$('.btn-cari-data').click(function(e) {
    let form = $('#form-cari-diagnosa');
    let tbody = $('.table-cari-data').find('tbody');
    $.ajax({
        url : '{{route("cari_data_diagnosa")}}',
        method : 'GET',
        dataType : 'json',
        data : form.serialize(),
        success : function(response){
            tbody.html('');
            response.forEach(function(element, index) {
                let tr = $('<tr>');
                let td1 = $('<td>', {text : index});
                let td2 = $('<td>', {text : element.kode_icd});
                let td3 = $('<td>', {text : element.diagnosa});
                let td4 = $('<td>');
                let action = $('<a>', {href:'javascript:;', text:'Pilih', class:'btn btn-sm btn-neutral btn-pilih-diagnosa', diagnosa_id:element.id, kode_icd : element.kode_icd, diagnosa : element.diagnosa});
                tr.append(td1);
                tr.append(td2);
                tr.append(td3);
                td4.append(action);
                tr.append(td4);
                tbody.append(tr);
            });
        }
    });
});

var elmDiagnosa = $('#load-diagnosa-list');
function countDiagnosa(){
    let resultCount = elmDiagnosa.find('.row-diagnosa').length;
    return resultCount+1;
}

$(document).on('click', '.btn-pilih-diagnosa', function(e){
    let diagnosaId = $(this).attr('diagnosa_id');
    let kodeIcd = $(this).attr('kode_icd');
    let diagnosa = $(this).attr('diagnosa');
    let rowCount = countDiagnosa();
    let idPasien = $('#idPasien').val();

    if (rowCount == 1){
        $.ajax({
            url : '{{route("check_kasus")}}',
            method : 'GET',
            dataType : 'json',
            data : {id_pasien : idPasien, diagnosaId : diagnosaId},
            success : function(response){
                console.log(response);
            }
        });
    }

    if (rowCount == 4){
        swal({
            title: 'Warning',
            text: 'Maximum Diagnosa adalah 3',
            type: 'warning',
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-warning'
        });
        return false;
    } else {
        let rowDiagnosa = '<div class="row row-diagnosa row-diagnosa-'+rowCount+' mb-2"><input type="hidden" name="id_diagnosa[]" value="'+diagnosaId+'"></input><div class="col-3 col-md-3 col-sm-3"><input type="text" name="kodeIcd[]" class="form-control" value="'+kodeIcd+'" readonly></div><div class="col-6 col-md-6 col-sm-6"><input type="text" name="diagnosa[]" class="form-control" value="'+diagnosa+'" readonly></div><div class="col-1 col-md-1 col-sm-1"><a href="javascript:;" class="btn btn-danger btn-delete-diagnosa" data-row="'+rowCount+'">X</a></div></div>';
        elmDiagnosa.append(rowDiagnosa);
    }

    $('#modal-cari-diagnosa').modal('hide');
});

$(document).on('click', '.btn-delete-diagnosa', function(e){
    let rowData = $(this).attr('data-row');
    elmDiagnosa.find('.row-diagnosa-'+rowData).remove();
});

$('#status_rujukan').change(function(e){
    let getVal = parseInt($(this).val());
    if (getVal == 1){
        $('.rujukan-form').removeClass('d-none');
    } else {
        $('.rujukan-form').addClass('d-none');
    }
});

$('.select-pemeriksaan').change(function(e){
    let getValue = $(this).val();
    $('.pemeriksaan').addClass('d-none');
    switch (getValue.toLowerCase()) {
        case 'gdp':
            $('.pemeriksaan-gdp').removeClass('d-none');
            break;
        case 'hba1c':
            $('.pemeriksaan-hba1c').removeClass('d-none');
            break;
        case 'kontrol':
            $('.pemeriksaan-kontrol').removeClass('d-none');
            break;
        case 'kimia darah':
            $('.pemeriksaan-kimiadarah').removeClass('d-none');
            break;

        default:
            break;
    }
})
</script>
@endsection