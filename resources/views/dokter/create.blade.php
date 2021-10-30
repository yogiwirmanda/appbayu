@extends('master.main')
@section('content')
<div class="container-fluid mt--6">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mb-0">Tambah Dokter</h3>
        </div>
        <div class="card-body">
            <form action="{{route('save_dokter')}}" id="form-dokter" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">Nama</label>
                                    <input type="text" name="nama" id="nama_dokter" class="form-control col-8 input-form-nama" placeholder="Nama Dokter">
                                    <div class="offset-md-2 col-10 invalid-feedback">Nama Dokter wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-4 col-form-label">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form-control col-8 input-form-nip" placeholder="NIP">
                                    <div class="offset-md-2 col-10 invalid-feedback">NIP wajib di isi</div>
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
    $('#form-dokter').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/dokter');
    });
</script>
@endsection