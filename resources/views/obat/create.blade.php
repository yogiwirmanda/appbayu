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
            <h3 class="mb-0">Tambah Obat</h3>
        </div>
        <div class="card-body">
            <form action="{{route('save_obat')}}" id="form-obat" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-2 col-form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control col-6 input-form-nama" placeholder="Nama Obat" value="">
                                    <div class="offset-md-2 col-10 invalid-feedback">Nama obat wajib di isi</div>
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
    function disabledValidation(){
        $('.form-control').removeClass('is-invalid');
    }
    $('#form-obat').submit(function(e){
        e.preventDefault();
        disabledValidation();
        let form = $(this);
        form.find('.btn').attr('disabled', 'disabled');
        $.ajax({
            url : form.attr('action'),
            method : form.attr('method'),
            dataType : 'json',
            data : form.serialize(),
            success : function(response){
                let error = response.error;
                if (error === 1){
                    let field = response.field;
                    $.each(field, function(key, value){
                        $('.input-form-'+value).addClass('is-invalid');
                    });
                    form.find('.btn').removeAttr('disabled');
                } else {
                    let messages = response.messages;
                    $.notify(messages, 'success');
                    setTimeout(() => {
                        window.location.href = '/obat';
                    }, 1000);
                }
                HoldOn.close();
            }
        })
    })
</script>
@endsection