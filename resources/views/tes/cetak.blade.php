@extends('master.customer.cetak')
@section('content')
<style>
    .container {
        margin: 0px !important;
        padding: 0px !important;
    }

    .print-area {
        padding-top: 10px;
        width: 264.56692913px;
        height: 150.97637795px;
        border: 1px solid black;
    }

    .info {
        display: flex;
        justify-content: space-around;
    }

    .base-text {
        width: 100%;
        text-align: center;
        margin-bottom: 5px;
        margin-top: 5px;
        font-size: 12px;
    }

    .nama {
        font-weight: 700
    }

    .nik {
        font-size: 12px;
    }

    .alamat {
        font-size: 12px
    }

    .title {
        font-weight: 700;
        font-size: 15px
    }
</style>
<div class="print-area">
    <div class="info">
        <div>{{$modelPasien->no_rm}}</div>
        <div>{{$modelPasien->jk}}</div>
    </div>
    <div class="base-text nama">{{$modelPasien->nama}}</div>
    <div class="base-text nik">NIK. {{$modelPasien->no_ktp}}</div>
    <div class="base-text">
        <div>{{Date('d-m-Y', strtotime($modelPasien->tgl_lahir))}}</div>
    </div>
    <div class="base-text alamat">{{$modelPasien->alamat}} RT {{$modelPasien->rt}} RW {{$modelPasien->rw}}</div>
</div>
@endsection
@section('push-script')
<script>
    $(document).ready(function(e){
        window.print()
    })
</script>
@endsection