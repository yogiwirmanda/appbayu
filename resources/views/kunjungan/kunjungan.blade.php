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
                        {{-- <input type="hidden" name="caraBayar" value="{{$dataPasien->cara_bayar}}"> --}}
                        {{-- <input type="hidden" name="noBpjs" value="{{$dataPasien->no_bpjs}}"> --}}
                        @if($dataPasien->status_prb || $dataPasien->status_prolanis)
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Tipe Kunjungan</h5>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            @if($dataPasien->status_prb)
                            <div class="form-group col-md-2 align-items-center">
                                <input type="checkbox" name="is_prb" class="input-pendatang mr-2" value="1">
                                <label class="col-form-label">Prb</label>
                            </div>
                            @endif
                            @if($dataPasien->status_prolanis)
                            <div class="form-group col-md-2 align-items-center">
                                <input type="checkbox" name="is_prolanis" class="input-pendatang mr-2" value="1">
                                <label class="col-form-label">Prolanis</label>
                            </div>
                            @endif
                        </div>
                        @endif
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
                                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"
                                                readonly>{{$dataPasien->alamat}}</textarea>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Pembayaran</label>
                                            <div class="col-8">
                                                <select class="form-control select2" name="caraBayar" id="caraBayar">
                                                    <option value="UMUM" {{ ($dataPasien->cara_bayar == 'UMUM') ?
                                                        'selected' : '' }}>Umum</option>
                                                    <option value="BPJS" {{ ($dataPasien->cara_bayar == 'BPJS') ?
                                                        'selected' : '' }}>BPJS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-bpjs {{($dataPasien->cara_bayar == 'BPJS') ? '' : 'd-none'}}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">No BPJS</label>
                                            <div class="col-8">
                                                <input type="text" name="noBpjs" id="noBpjs" class="form-control"
                                                    placeholder="No BPJS" value="{{$dataPasien->no_bpjs}}" readonly>
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
                                                value="{{$dataPasien->kepala_keluarga}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="text" name="tglLahir" id="tglLahir" class="form-control"
                                                placeholder="Tanggal Lahir" value="{{$dataPasien->tgl_lahir}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Umur</label>
                                            <input type="text" name="umur" id="umur" class="form-control"
                                                placeholder="Umur" value="{{$umur}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Pasien</label>
                                            <div class="col-8">
                                                <select class="form-control select2" name="jenis_pasien"
                                                    id="jenis_pasien">
                                                    <option value="2">Lama</option>
                                                    <option value="1">Baru</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Kunjungan</label>
                                            <div class="col-8">
                                                <select class="form-control select2" name="jenis_pasien"
                                                    id="jenis_pasien">
                                                    <option value="1">Sakit</option>
                                                    <option value="2">Sehat - Surat Sehat</option>
                                                    <option value="3">Sehat - Surat Catin</option>
                                                </select>
                                            </div>
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
    $('.btn-batal-kunjungan').click(function (e) {
        e.preventDefault();
        window.location.href = '/pasiens';
    });

    var noBpjs = "{{$dataPasien->noBpjs}}";
    var caraBayar = "{{$dataPasien->bayar}}";
    if (caraBayar.length > 0){
        $('#caraBayar').val(caraBayar);
    }
    if (caraBayar === 'BPJS') {
        $('#noBPJS').removeClass('d-none');
        $('#noBpjs').val(noBpjs);
    }
    $('#caraBayar').change(function () {
        console.log($(this).val())
        var getValue = $(this).val();
        if (getValue === 'UMUM') {
            $('#noBPJS').addClass('d-none');
            $('.row-bpjs').addClass('d-none');
        } else {
            $('#noBPJS').removeClass('d-none');
            $('.row-bpjs').removeClass('d-none');
        }
    });
    $('.btn-save-form').click(function (e) {
        e.preventDefault();
        $('#formKunjungan').submit();
    });

    $('#formKunjungan').submit(function (e) {
        e.preventDefault();
        PRC.disabledValidation();
        let form = $(this);
        PRC.ajaxSubmit(form, '/kunjungan', false);
    });
</script>
@endsection