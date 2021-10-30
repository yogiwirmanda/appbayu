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
        <div class="card-header d-flex justify-content-between">
            <h3 class="mb-0">Tambah Poli</h3>
        </div>
        <div class="card-body">
            <form action="{{route('save_poli')}}" id="form-poli" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control col-6 input-form-nama" placeholder="Nama Poli">
                                    <div class="offset-md-2 col-10 invalid-feedback">Nama Poli wajib di isi</div>
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
<script>
    $('#form-poli').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/poli');
    });
</script>
@endsection