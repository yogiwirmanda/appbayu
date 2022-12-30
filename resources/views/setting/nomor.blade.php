@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Setting Nomor RM</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Setting</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('setting_cek')}}" method="GET" id="formCek">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="wilayah" id="wilayah" class="form-control">
                                @foreach($dataWilayah as $wilayah)
                                <option value="{{$wilayah->id}}">{{$wilayah->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="kategori" id="kategori" class="form-control">
                                @foreach($dataKategori as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="nomorAwal" class="form-control mr-2" placeholder='Nomor Awal'>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="nomorAkhir" class="form-control mr-2" id="nomor-akhir" placeholder='Nomor Akhir'>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <a href="javascript:;" class="btn btn-primary btn-cek-nomor">Cek</a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-2 row-result d-none">
                <div class="col-md-12 d-flex align-items-center">
                    <h3>Total Nomor Kosong : <span class="result-cek"></span></h3>
                    <a href="javascript:;" class="ml-3 btn btn-md btn-primary btn-reset">Set Nomor</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    $('.btn-cek-nomor').click(function () {
        let formElm = $('#formCek');
        let nomorAkhir = $('#nomor-akhir').val();
        $.ajax({
            url: formElm.attr('action'),
            method: 'GET',
            dataType: 'json',
            data: formElm.serialize(),
            success: function (response) {
                $('.row-result').removeClass('d-none');
                $('.result-cek').text(parseInt(nomorAkhir) - parseInt(response.total));
            }
        });
    });

    $('.btn-reset').click(function () {
        let formElm = $('#formCek');
        let nomorAkhir = $('#nomor-akhir').val();
        var options = {
            theme:"sk-bounce",
            message:'Mohon tunggu, sedang memproses data...',
            backgroundColor:"#5e72e4",
            textColor:"#ffffff"
        };

        HoldOn.open(options);

        $.ajax({
            url: '{{route("setting_set_nomor")}}',
            method: 'GET',
            dataType: 'json',
            data: formElm.serialize(),
            success: function (response) {
                HoldOn.close();
                window.location.reload();
            }
        });
    });
</script>
@endsection