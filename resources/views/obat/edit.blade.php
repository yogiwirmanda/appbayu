@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Edit Obat</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Obat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('update_obat')}}" method="POST" id="form-obat" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="obatId" value="{{$dataObat->id}}">
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Nama Obat</label>
                                    <input type="text" name="nama" id="nama" class="form-control input-form-nama" placeholder="Nama Obat" value="{{$dataObat->nama}}">
                                    <div class="invalid-feedback">Nama obat wajib di isi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-form-label">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control input-form-keterangan" placeholder="Keterangan" value="{{$dataObat->keterangan}}">
                                    <div class="invalid-feedback">Keterangan wajib di isi</div>
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
    $('#form-obat').submit(function(e){
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/obat');
    })
</script>
@endsection