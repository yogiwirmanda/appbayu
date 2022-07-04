@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Tambah Diagnosa</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Diagnosa</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('save_diagnosa')}}" id="form-diagnosa" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Kode ICD</label>
                                    <input type="text" name="kode_icd" id="kode_icd" class="form-control input-form-kode_icd" placeholder="Kode ICD">
                                    <div class="invalid-feedback">Kode ICD wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Diagnosa</label>
                                    <textarea name="diagnosa" id="diagnosa" cols="30" rows="10" class="form-control input-form-diagnosa" placeholder="Diagnosa"></textarea>
                                    <div class="invalid-feedback">Diagnosa wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control input-form-keterangan" placeholder="Keterangan">
                                    <div class="invalid-feedback">Keterangan wajib di isi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                        <a href="{{route('show_diagnosa')}}" class="btn btn-fill btn-danger">Batal</a>
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
    $('#form-diagnosa').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/diagnosa');
    });
</script>
@endsection