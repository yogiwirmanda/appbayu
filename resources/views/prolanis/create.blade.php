@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('save_prolanis')}}" id="form-prolanis" method="GET">
                <input type="hidden" name="id_pasien" id="id_pasien">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-block btn-default w-25" data-toggle="modal" data-target="#modal-cari-data">Cari Pasien</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">No RM</label>
                                            <input type="text" name="noRm" id="noRm" class="form-control col-8" placeholder="No RM" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control col-8" placeholder="Nama" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control col-8" placeholder="Alamat" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Jenis Kelamin</label>
                                            <select name="status_prolanis" id="status_prolanis" class="form-control col-8">
                                                <option value="Diabetes Melitus">Diabetes Melitus</option>
                                                <option value="Hipertensi">Hipertensi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Jenis Kelamin</label>
                                            <input type="text" name="jk" id="jk" class="form-control col-8" placeholder="Jenis Kelamin" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Tanggal Lahir</label>
                                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control col-8" placeholder="Tanggal Lahir" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-2 my-3">
                            <div class="col-md-12">
                                <div class="form-group row">
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
<div class="modal fade" id="modal-cari-data" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
             <div class="modal-header px-4">
                <h6 class="modal-title" id="modal-title-default">Cari Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form role="form" id="form-cari-data">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-copy-04"></i></span>
                            </div>
                            <input class="form-control" name="noRm" placeholder="No RM" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>
                            <input class="form-control" name="namaPasien" placeholder="Nama Pasien" type="text">
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="button" class="btn btn-primary btn-cari-data my-4">Cari</button>
                        </div>
                    </form>
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
</div>
<script>
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
                response.forEach(element => {
                    let tr = $('<tr>');
                    let td1 = $('<td>', {text : '1'});
                    let td2 = $('<td>', {text : element.no_rm});
                    let td3 = $('<td>', {text : element.kepala_keluarga});
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
