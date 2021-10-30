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
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Filter</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="col-6 d-flex justify-content-around">
                        <input type="text" name="no_rm" id="no_rm" class="form-control" value="">
                        <a href="javascript:;" class="btn btn-info btn-fill pull-right btn-cari-data ml-2">Cari</a>
                    </div>
                </div>
            </div>
            <form action="{{route('save_prolanis')}}" method="GET">
                <input type="hidden" name="id_pasien" id="id_pasien">
                <div class="card">
                    <div class="card-body">
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
<script>
    $('.btn-cari-data').click(function(e){
        let noRM = $('#no_rm').val();
        $.ajax({
            url : '{{route("check_prolanis")}}',
            method : 'GET',
            dataType : 'json',
            data : {noRM : noRM},
            success : function (response) {
                $('#id_pasien').val(response.id);
                $('#noRm').val(response.no_rm);
                $('#nama').val(response.nama);
                $('#alamat').val(response.alamat);
                $('#jk').val(response.jk);
                $('#tgl_lahir').val(response.tgl_lahir);
            }
        });
    });
</script>
@endsection
