@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Tambah Pekerjaan</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Pekerjaan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('save_pekerjaan')}}" class="form theme-form" id="form-pekerjaan" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" id="nama_pekerjaan"
                                        class="form-control input-form-nama" placeholder="Nama Pekerjaan">
                                    <div class="offset-md-2 col-10 invalid-feedback">Nama Pekerjaan wajib di isi</div>
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
@endsection
@section('page-scripts')
<script>
    $('#form-pekerjaan').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/pekerjaan');
    });
</script>
@endsection