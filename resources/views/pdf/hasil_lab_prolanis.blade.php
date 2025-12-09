@extends('master.blank')
@section('content')
<style>
    @page {
        margin: 15mm;
    }

    body {
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 11px;
    }

    .page {
        width: 100%;
    }

    .center {
        text-align: center;
        font-weight: bold;
        line-height: 1.3;
    }

    .sub {
        text-align: center;
        font-size: 10px;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .info td {
        padding: 2px 4px;
        vertical-align: top;
        font-size: 11px;
    }

    .result-table th,
    .result-table td {
        border: 1px solid #000;
        padding: 5px;
        font-size: 11px;
    }

    .result-table th {
        text-align: center;
        font-weight: bold;
    }

    .note {
        margin-top: 10px;
        font-size: 11px;
    }

    .petugas {
        float: right;
        text-align: center;
        width: 180px;
    }

    .clear {
        clear: both;
    }

    .time-box {
        border: 1px solid #000;
        margin-top: 10px;
        padding: 6px;
        font-size: 11px;
    }

    .no-border {
        border: none !important;
    }
</style>

<div class="page">

    <div class="center">
        FORMULIR HASIL LABORATORIUM<br>
        PUSKESMAS RAMPAL CELAKET
    </div>

    <div class="sub">
        Jl. Simpang Kasembon No 5, Telp. (0341) 356380<br>
        e-mail : puskrampalcelaket@malangkota.go.id &nbsp;&nbsp; MALANG – 65111
    </div>

    <table class="info">
        <tr><td width="160">No. Register Lab / RM</td><td>: {{ $no_register }}</td></tr>
        <tr><td>Tanggal Periksa</td><td>: {{ $tgl_periksa }}</td></tr>
        <tr><td>Nama Pasien</td><td>: {{ $nama_pasien }}</td></tr>
        <tr><td>Tanggal Lahir</td><td>: {{ $tgl_lahir }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $alamat }}</td></tr>
        <tr><td>No. Telp</td><td>: {{ $telepon }}</td></tr>
        <tr><td>Pengirim</td><td>: dr. MOH. ALI SAHIB</td></tr>
    </table>

    <table class="result-table" style="margin-top:10px;">
        <tr>
            <th style="width:40%;">Jenis Pemeriksaan</th>
            <th style="width:20%;">Hasil</th>
            <th style="width:15%;">Satuan</th>
            <th style="width:25%;">Nilai Normal</th>
        </tr>

        <tr>
            <td>Gula Darah Puasa</td>
            <td style="text-align:center;">{{ $gdp }}</td>
            <td style="text-align:center;">mg/dL</td>
            <td style="text-align:center;">70 - 110</td>
        </tr>

        <tr>
            <td>Asam Urat</td>
            <td style="text-align:center;"></td>
            <td style="text-align:center;">mg/dL</td>
            <td>
                L: 3,5 – 7,2<br>
                P: 2,6 – 6,0
            </td>
        </tr>

        <tr>
            <td>Kolesterol Total</td>
            <td style="text-align:center;"></td>
            <td style="text-align:center;">mg/dL</td>
            <td style="text-align:center;">&lt; 200</td>
        </tr>

        <tr>
            <td>Trigliserida</td>
            <td style="text-align:center;"></td>
            <td style="text-align:center;">mg/dL</td>
            <td style="text-align:center;">&lt; 150</td>
        </tr>
    </table>

    <div class="note">
        Catatan :
        <div class="petugas">
            Petugas Laboratorium,<br><br><br>
            ( ................................ )
        </div>
    </div>

    <div class="clear"></div>

    <div style="margin-top:30px; font-size:11px;">
        *Waktu Tunggu Penyerahan Hasil Lab &lt; 120 menit
    </div>

    <div class="time-box">
        Waktu Pengambilan Spesimen : 08.00<br>
        Waktu Penyerahan Hasil : 08.23<br><br>
    </div>

</div>
@endsection
