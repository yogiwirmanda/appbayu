@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mb-0">Tambah Diagnosa</h3>
        </div>
        <div class="card-body">
            <form action="{{route('save_diagnosa')}}" id="form-diagnosa" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Kode ICD</label>
                                    <input type="text" name="kode_icd" id="kode_icd" class="form-control col-6 input-form-kode_icd" placeholder="Kode ICD">
                                    <div class="offset-md-2 col-10 invalid-feedback">Kode ICD wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Diagnosa</label>
                                    <textarea name="diagnosa" id="diagnosa" cols="30" rows="10" class="form-control col-6 input-form-diagnosa" placeholder="Diagnosa"></textarea>
                                    <div class="offset-md-2 col-10 invalid-feedback">Diagnosa wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control col-6 input-form-keterangan" placeholder="Keterangan">
                                    <div class="offset-md-2 col-10 invalid-feedback">Keterangan wajib di isi</div>
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
    $('#form-diagnosa').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/diagnosa');
    });
</script>
@endsection