@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Form Kunjungan</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"><a href="/kunjungan">Kunjungan</a></li>
                    <li class="breadcrumb-item active">Form Kunjungan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form class="form theme-form" method="post" action="{{route('kunjungan_pasien_save')}}"
                        enctype="multipart/form-data" id="formKunjungan">
                        @csrf
                        <input type="hidden" name="type" value="{{$type}}">
                        <input type="hidden" name="id_pasien" value="{{$idPasien}}">
                        <input type="hidden" name="tanggal" value="{{date('Y-m-d')}}">
                        <input type="hidden" name="caraBayar" value="{{$dataPasien->cara_bayar}}">
                        <input type="hidden" name="noBpjs" value="{{$dataPasien->no_bpjs}}">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">No RM</label>
                                            <input type="text" name="noRm" id="noRm" class="form-control"
                                                placeholder="No RM" value="{{$dataPasien->no_rm}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                placeholder="No RM" value="{{$dataPasien->nama}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="3"
                                                class="form-control" readonly>{{$dataPasien->alamat}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Poli</label>
                                            <div class="col-8">
                                                <select class="form-control select2" name="poli" id="poli">
                                                    @foreach($dataPoli as $poli)
                                                    <option value="{{$poli->id}}">{{$poli->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Kepala Keluarga</label>
                                            <input type="text" name="kepalaKeluarga" id="kepalaKeluarga"
                                                class="form-control" placeholder="Kepala Keluarga"
                                                value={{$dataPasien->kepala_keluarga}} readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="text" name="tglLahir" id="tglLahir" class="form-control"
                                                placeholder="Tanggal Lahir"
                                                value="{{$dataPasien->tgl_lahir}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Umur</label>
                                            <input type="text" name="umur" id="umur" class="form-control"
                                                placeholder="Umur" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-sm-6 control-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-fill btn-success btn-save-form">Simpan
                                        </button>
                                        <button type="reset"
                                            class="btn btn-fill btn-danger btn-batal-kunjungan">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    $(document).ready(function (e) {
        var getDate = $('#tglLahir').val();
        var getSplit = getDate.split('-');
        var date = new Date();
        var getYear = date.getFullYear();
        var age = parseInt(getYear - getSplit[0]);
        $('#umur').val(age);
    })

    $('.btn-batal-kunjungan').click(function (e) {
        e.preventDefault();
        window.location.href = '/pasiens';
    });

    var noBpjs = "{{$dataPasien->noBpjs}}";
    var caraBayar = "{{$dataPasien->bayar}}";
    $('#caraBayar').val(caraBayar);
    if (caraBayar === 'BPJS') {
        $('#noBPJS').removeClass('d-none');
        $('#noBpjs').val(noBpjs);
    }
    $('#caraBayar').change(function () {
        var getValue = $(this).val();
        if (getValue === 'UMUM') {
            $('#noBPJS').addClass('d-none');
        } else {
            $('#noBPJS').removeClass('d-none');
        }
    });
    $('.btn-save-form').click(function (e) {
        e.preventDefault();
        $('#formKunjungan').submit();
    });

    $('#formKunjungan').submit(function (e) {
        e.preventDefault();
        var frm = $(this);
        $.ajax({
            url: frm.attr('action'),
            type: 'GET',
            data: frm.serialize(),
            success: function (response) {
                window.location.href = '/kunjungan';
            }
        })
    })
</script>
@endsection