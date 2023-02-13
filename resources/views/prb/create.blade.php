@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Tambah Pasien PRB</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">PRB</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="card mb-4">
        <div class="card-body">
            <div class="form-group align-items-center m-b-10">
                <a href="javascript:;" class="btn btn-pill btn-primary btn-modal-cari">Cari Data</a>
            </div>
            <form action="{{route('save_prb')}}" id="form-prb" class="form theme-form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idPasien" id="idPasien">
                <input type="hidden" name="noRm" id="noRm">
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Nama</label>
                                    <input type="text" name="namaPasien" id="namaPasien" class="form-control col-8" placeholder="Nama Pasien" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Alamat KTP</label>
                                    <textarea name="alamat" id="alamat" class="form-control col-8" cols="30" rows="2" autocomplete="new-text" placeholder="Alamat KTP" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">RT / RW</label>
                                    <input type="text" name="rt" id="rt" class="form-control col mr-2" placeholder="RT" readonly>
                                    <input type="text" name="rw" id="rw" class="form-control col" placeholder="RW" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Alamat Domisili</label>
                                    <textarea name="alamat_dom" id="alamat_dom" class="form-control col-8" cols="30" rows="2" placeholder="Alamat Domisili" autocomplete="new-text" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Dokter</label>
                                    <select name="dokter" id="dokter" class="form-control selectize col-8">
                                        @foreach($dataDokter as $dokter)
                                            <option value="{{$dokter->id}}">{{$dokter->nama}}</option>
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
                                    <label class="col-form-label">Tensi</label>
                                    <input type="text" name="tensi" id="tensi" class="form-control col-8 input-form-tensi" placeholder="Tensi">
                                    <div class="offset-md-4 col-10 invalid-feedback">Tensi wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Nadi</label>
                                    <input type="text" name="nadi" id="nadi" class="form-control col-8 input-form-nadi" placeholder="Nadi">
                                    <div class="offset-md-4 col-10 invalid-feedback">Nadi wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Suhu</label>
                                    <input type="text" name="suhu" id="suhu" class="form-control col-8 input-form-suhu" placeholder="Suhu">
                                    <div class="offset-md-4 col-10 invalid-feedback">Suhu wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Berat Badan</label>
                                    <input type="text" name="berat_badan" id="berat_badan" class="form-control col-8 input-form-berat_badan" placeholder="Berat Badan">
                                    <div class="offset-md-4 col-10 invalid-feedback">Berat badan wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Tinggi Badan</label>
                                    <input type="text" name="tinggi_badan" id="tinggi_badan" class="form-control col-8 input-form-tinggi_badan" placeholder="Tinggi Badan">
                                    <div class="offset-md-4 col-10 invalid-feedback">Tinggi badan wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div id="load-obat-list">
                            <div class="row my-3">
                                <div class="col-12">
                                    <button class="btn btn-info btn-modal-obat">Tambah Obat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                        <button type="reset" class="btn btn-fill btn-danger btn-batal-pasien">Batal</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-cari-obat" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cari Data</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form role="form" class="form theme-form" id="form-cari-obat">
                        <div class="form-group mb-3">
                            <input class="form-control" name="keyword" placeholder="Cari..." type="text">
                        </div>
                        <div class="text-left">
                            <button type="button" class="btn btn-primary btn-cari-obat my-4">Cari</button>
                        </div>
                    </form>
                    <table class="table table-flush table-cari-obat" id="datatable-basic">
                        <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Obat</th>
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
                        <input class="form-control" name="namaPasien" placeholder="Nama Pasien" type="text">
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
@endsection
@section('page-scripts')
<script>
    $('input').attr('autocomplete', 'off');

    $('.btn-cari-data').click(function(e){
        let form = $('#form-cari-data');
        let tbody = $('.table-cari-data').find('tbody');
        $.ajax({
            url : '{{route("cari_data_pasien")}}',
            method : 'GET',
            dataType : 'json',
            data : form.serialize(),
            success : function(response){
                tbody.html('');
                response.forEach(function(element, index) {
                    let tr = $('<tr>');
                    let td1 = $('<td>', {text : index + 1});
                    let td2 = $('<td>', {text : element.no_rm});
                    let td3 = $('<td>', {text : element.nama});
                    let td4 = $('<td>', {text : element.alamat});
                    let td5 = $('<td>');
                    let action = $('<a>', {href:'javascript:;', text:'Pilih', class:'btn btn-sm btn-neutral btn-pilih-member', member_id:element.id});
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

    $(document).on('click', '.btn-pilih-member', function(e){
        e.preventDefault();
        let memberId = $(this).attr('member_id');
        var options = {
            theme:"sk-bounce",
            message:'Mohon tunggu, sedang memproses data...',
            backgroundColor:"#5e72e4",
            textColor:"#ffffff"
        };

        HoldOn.open(options);
        $.ajax({
            url : '{{route("get_from_kepala_keluarga")}}',
            method : 'GET',
            dataType : 'json',
            data : {memberId:memberId},
            success : function(response){
                $('#idPasien').val(response.id);
                $('#namaPasien').val(response.nama);
                $('#namaPasien').attr('readonly', 'readonly');
                $('#noRm').val(response.no_rm);
                $('#alamat').text(response.alamat);
                $('#rt').val(response.rt);
                $('#rw').val(response.rw);
                $('#alamat_dom').text(response.alamat_dom);
                if (response.alamat == response.alamat_dom){
                    $('.btn-same-address').prop('checked', true);
                }
                $('#modal-cari-data').modal('hide');
                setTimeout(() => {
                    HoldOn.close();
                }, 1500);
            }
        });
    })

    $('.btn-modal-obat').click(function(e){
        e.preventDefault();
        $('#modal-cari-obat').modal('show');
    });

    $('.btn-cari-obat').click(function(e) {
        let form = $('#form-cari-obat');
        let tbody = $('.table-cari-obat').find('tbody');
        $.ajax({
            url : '{{route("cari_data_obat")}}',
            method : 'GET',
            dataType : 'json',
            data : form.serialize(),
            success : function(response){
                tbody.html('');
                response.forEach(element => {
                    let tr = $('<tr>');
                    let td1 = $('<td>', {text : '1'});
                    let td2 = $('<td>', {text : element.nama});
                    let td4 = $('<td>');
                    let action = $('<a>', {href:'javascript:;', text:'Pilih', class:'btn btn-sm btn-neutral btn-pilih-obat', obat_id:element.id, obat : element.nama});
                    tr.append(td1);
                    tr.append(td2);
                    td4.append(action);
                    tr.append(td4);
                    tbody.append(tr);
                });
            }
        });
    });

    var elmObat = $('#load-obat-list');
    function countObat(){
        let resultCount = elmObat.find('.row-obat').length;
        return resultCount+1;
    }

    $(document).on('click', '.btn-pilih-obat', function(e){
        let obatId = $(this).attr('obat_id');
        let obat = $(this).attr('obat');
        let rowCount = countObat();
        let rowObat = '<div class="row row-obat row-obat-'+rowCount+' mb-2"><input type="hidden" name="id_obat[]" value="'+obatId+'"></input><div class="col-5 col-md-5 col-sm-5"><input type="text" name="obat[]" class="form-control" value="'+obat+'" readonly></div><div class="col-4 col-md-4 col-sm-4"><input type="text" name="takaran[]" class="form-control" value="" placeholder="Takaran"></div><div class="col-1 col-md-1 col-sm-1"><a href="javascript:;" class="btn btn-danger btn-delete-obat" data-row="'+rowCount+'">X</a></div></div>';
        elmObat.append(rowObat);
    });

    $(document).on('click', '.btn-delete-obat', function(e){
        let rowData = $(this).attr('data-row');
        elmObat.find('.row-obat-'+rowData).remove();
    });

    $('#form-prb').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/prb', false, false);

        setTimeout(() => {
            window.location.href = '/prb';
        }, 1000);
    });

    $('.btn-modal-cari').click(function (e) {
        $('#modal-cari-data').modal('show');
    });
</script>
@endsection