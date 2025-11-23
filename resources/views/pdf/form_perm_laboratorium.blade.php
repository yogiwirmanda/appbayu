@extends('master.blank')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: auto;
        background: white;
        position: relative;
    }
    .title {
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    .info-table td {
        padding: 4px 2px;
        vertical-align: top;
    }
    .border-box {
        width: 100%;
        border: 1px solid black;
        padding: 10px;
        margin-top: 10px;
    }
    .check-row {
        margin-top: 12px;
        display: flex;
        align-items: center;
    }
</style>

<div class="page">

    <div style="text-align:center; font-size:18px; font-weight:bold;">
        PEMERINTAH KOTA MALANG <br>
        DINAS KESEHATAN <br>
        PUSKESMAS RAMPAL CELAKET
    </div>

    <div style="text-align:center; font-size:13px; margin-bottom:10px;">
        Jl. Simpang Kasembon No 5, Telp. (0341) 356380<br>
        Email: puskrampalcelaket@malangkota.go.id - Malang 65111
    </div>

    <div class="title" style="margin-top:20px; font-size:20px;">
        PERMINTAAN PEMERIKSAAN LABORATORIUM
    </div>

    <table class="info-table" style="margin-top:20px;">
        <tr><td style="width:120px;">NAMA</td><td>: {{ $nama }}</td></tr>
        <tr><td>UMUR</td><td>: {{ $umur }}</td></tr>
        <tr><td>ALAMAT</td><td>: {{ $alamat }}</td></tr>
        <tr><td>STATUS</td><td>: {{ $status }}</td></tr>
        <tr><td>NO. BPJS</td><td>: {{ $no_bpjs }}</td></tr>
        <tr><td>PENGIRIM</td><td>: {{ $pengirim }}</td></tr>
        <tr><td>TANGGAL</td><td>: {{ $tanggal }}</td></tr>
        <tr><td>NO LAB</td><td>: {{ $no_lab }}</td></tr>
    </table>

    <div class="title" style="margin-top:25px;">KIMIA KLINIK</div>

    <div class="border-box">
        <div class="check-row">
            <input type="checkbox" {{ $gdp ? 'checked' : '' }}> &nbsp; Gula Darah Puasa
        </div>
        <div class="check-row">
            <input type="checkbox" {{ $gd2jpp ? 'checked' : '' }}> &nbsp; Gula Darah 2 JPP
        </div>
        <div class="check-row">
            <input type="checkbox" {{ $gds ? 'checked' : '' }}> &nbsp; Gula Darah Sesaat
        </div>
    </div>

    <div style="margin-top:40px;">
        <div style="float:right; text-align:center;">
            <br><br>
            <div>TTD DOKTER</div>
            <br><br><br>
            (..................................)
        </div>
    </div>

    <div style="clear:both;"></div>

    <div style="margin-top:60px; border-top:1px solid black; padding-top:10px;">
        <strong>INFORMED CONSENT</strong><br><br>
        <div class="border-box" style="height:90px;">
            TTD: ........................................................ <br><br>
            JAM: ........................................................ <br><br>
            BERSEDIA DIAMBIL SPESIMEN LABORATORIUM
        </div>
    </div>

</div>
@endsection
