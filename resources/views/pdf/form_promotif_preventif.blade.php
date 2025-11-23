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
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 6px;
    }
    td {
        padding: 3px;
        vertical-align: top;
    }
    .section-title {
        text-align:center;
        font-weight:bold;
        font-size:20px;
        margin-bottom:20px;
    }
</style>

<div class="page">

    <div class="section-title">
        PUSKESMAS RAMPAL CELAKET<br>
        BUKTI PELAYANAN PROMOTIF DAN PREVENTIF
    </div>

    <table>
        <tr><td style="width:150px;">NO</td><td>: {{ $no }}</td></tr>
        <tr><td>NAMA PASIEN</td><td>: {{ $nama }}</td></tr>
        <tr><td>NO BPJS / NIK</td><td>: {{ $no_bpjs }}</td></tr>
        <tr><td>TANGGAL LAHIR</td><td>: {{ $tgl_lahir }}</td></tr>
        <tr><td>ALAMAT</td><td>: {{ $alamat }}</td></tr>
        <tr><td>TINDAKAN</td><td>: {{ $tindakan }}</td></tr>
    </table>

    <table>
        <tr>
            <td style="width:80px;">BB</td>
            <td>: {{ $bb }}</td>
        </tr>
        <tr>
            <td>TB</td>
            <td>: {{ $tb }}</td>
        </tr>
        <tr>
            <td>LP</td>
            <td>: {{ $lp }}</td>
        </tr>
        <tr>
            <td>TENSI</td>
            <td>: {{ $tensi }}</td>
        </tr>
    </table>

    <div style="margin-top:40px; width:100%; display:flex; justify-content:space-between;">
        <div></div>
        <div style="text-align:center;">
            Malang, {{ $tanggal }} <br><br>
            Dokter Pemeriksa<br><br><br>
            (...................................)
        </div>
        <div style="text-align:center;">
            Peserta<br><br><br>
            (.................................)
        </div>
    </div>

</div>
@endsection
