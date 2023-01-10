@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Tamah Prolanis</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Prolanis</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('save_prolanis')}}" id="form-prolanis" method="GET">
                <input type="hidden" name="id_pasien" id="idPasien">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 m-b-10">
                                <button type="button" class="btn btn-primary btn-pill btn-open-modal" data-toggle="modal" data-target="#modal-cari-data">Cari Pasien</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">No RM</label>
                                            <input type="text" name="noRm" id="noRm" class="form-control" placeholder="No RM" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" placeholder="Alamat" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Jenis Kelamin</label>
                                            <input type="text" name="jk" id="jk" class="form-control" placeholder="Jenis Kelamin" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Tanggal Lahir</label>
                                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-form-label">Prolanis</label>
                                            <select name="status_prolanis" id="status_prolanis" class="form-control select2">
                                                <option value="Diabetes Melitus">Diabetes Melitus</option>
                                                <option value="Hipertensi">Hipertensi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-2 my-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    $('.select2').select2();

    $('.btn-open-modal').click(function(e) {
       $('#modal-cari-data').modal('show');
    });

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
                    let action = $('<a>', {href:'javascript:;', text:'Pilih', class:'btn btn-primary btn-pilih-member', member_id:element.id});
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
                $('#nama').val(response.nama);
                $('#nama').attr('readonly', 'readonly');
                $('#noRm').val(response.no_rm);
                $('#alamat').text(response.alamat);
                $('#alamat_dom').text(response.alamat_dom);
                $('#jk').val(response.jk);
                $('#tgl_lahir').val(response.tgl_lahir);
                $('#modal-cari-data').modal('hide');
                setTimeout(() => {
                    HoldOn.close();
                }, 1500);
            }
        });
    })

    $('#form-prolanis').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/prolanis');
    });
</script>
@endsection
