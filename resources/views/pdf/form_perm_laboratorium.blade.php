@extends('master.blank')
@section('content')
<style>
    @page {
        size: A4;
        margin: 15mm 15mm 15mm 15mm;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .page {
        width: 180mm;
        min-height: 267mm;
        padding: 10mm;
    }

    .center {
        text-align: center;
        font-weight: bold;
        line-height: 1.3;
    }

    .sub-center {
        text-align: center;
        font-size: 11px;
        margin-top: 3px;
    }

    .title {
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        margin: 15px 0 10px 0;
        text-decoration: underline;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .info-table td {
        padding: 4px 2px;
        vertical-align: top;
        font-size: 12px;
        border: 1px solid
    }

    .kimia-box {
        border: 1px solid #000;
        padding: 6px;
        margin-top: 6px;
    }

    .kimia-table td {
        border: 1px solid #000;
        padding: 6px;
        font-size: 12px;
    }

    .ttd-area {
        width: 100%;
        margin-top: 30px;
    }

    .ttd-box {
        width: 200px;
        float: right;
        text-align: center;
        font-size: 12px;
    }

    .consent-box {
        border: 1px solid #000;
        margin-top: 20px;
        padding: 10px;
        height: 100px;
        font-size: 12px;
    }

    .clear { clear: both; }
</style>

<div class="page">

    <div class="center">
        PEMERINTAH KOTA MALANG<br>
        DINAS KESEHATAN<br>
        PUSKESMAS RAMPAL CELAKET
    </div>

    <div class="sub-center">
        Jl. Simpang Kasembon No 5, Telp. (0341) 356380<br>
        e-mail : puskrampalcelaket@malangkota.go.id &nbsp;&nbsp; MALANG – 65111
    </div>

    <div class="title">
        PERMINTAAN PEMERIKSAAN LABORATORIUM
    </div>

    <table class="info-table">
        <tr><td width="90">NAMA</td><td>: {{ $nama }}</td></tr>
        <tr><td>UMUR</td><td>: {{ $umur }}</td></tr>
        <tr><td>ALAMAT</td><td>: {{ $alamat }}</td></tr>
        <tr><td>STATUS</td><td>: {{ $status }}</td></tr>
        <tr><td>NO. BPJS</td><td>: {{ $no_bpjs }}</td></tr>
        <tr><td>PENGIRIM</td><td>: {{ $pengirim }}</td></tr>
        <tr><td>TANGGAL</td><td>: {{ $tanggal }}</td></tr>
        <tr><td>NO LAB</td><td>: {{ $no_lab }}</td></tr>
    </table>

    <div style="margin-top:10px; font-weight:bold;">KIMIA KLINIK</div>

    <table class="kimia-table" style="margin-top:5px;">
        <tr>
            <td width="85%" style="font-weight:bold;">JENIS PEMERIKSAAN</td>
            <td width="15%" style="text-align:center; font-weight:bold;">V</td>
        </tr>
        <tr>
            <td>Gula darah puasa</td>
            <td style="text-align:center;">
                <input type="checkbox" {{ $gdp ? 'checked' : '' }}>
            </td>
        </tr>
        <tr>
            <td>Gula darah 2 JPP</td>
            <td style="text-align:center;">
                <input type="checkbox" {{ $gd2jpp ? 'checked' : '' }}>
            </td>
        </tr>
        <tr>
            <td>Gula darah sesaat</td>
            <td style="text-align:center;">
                <input type="checkbox" {{ $gds ? 'checked' : '' }}>
            </td>
        </tr>
    </table>

    <div class="ttd-area">
        <div class="ttd-box">
            <br><br>
            TTD DOKTER<br><br><br>
            ( .................................. )
        </div>
    </div>

    <div class="clear"></div>

    <div style="margin-top:40px; font-weight:bold;">INFORMED CONCENT</div>

    <div class="consent-box">
        TTD : .........................................................<br><br>
        JAM : .........................................................<br><br>
        BERSEDIA DIAMBIL SPESIMEN LABORATORIUM
    </div>

    <div style="margin-top:10px; font-size:12px;">
        HASIL TELAH DITERIMA
    </div>

</div>
@endsection
