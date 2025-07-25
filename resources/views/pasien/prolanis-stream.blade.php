@extends('master.blank')
@section('content')
<style>
  .text-center {
    text-align: center
  }
</style>
<div class="text-center"><strong>SURAT REKOMENDASI</strong></div>
<div class="text-center"><strong>PEMERIKSAAN PENUNJANG PESERTA PROLANIS</strong></div>
<table style="margin-top: 10px; margin-bottom: 10px">
  <tr>
    <td style="width: 100px">Kepada Yth</td>
    <td style="width: 20px">:</td>
    <td>Laboratorium Klinik Ciliwung</td>
  </tr>
  <tr>
    <td>Di</td>
    <td>:</td>
    <td>Jalan Ciliwung No 10 Malang</td>
  </tr>
</table>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:0cm;margin-right:0cm;margin-bottom:.1pt;margin-left:5.0pt;'>
  Mohon&nbsp;pemeriksaan&nbsp;laboratorium&nbsp;tahunan&nbsp;bagi&nbsp;peserta&nbsp;prolanis&nbsp;atas&nbsp;nama:</p>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:0cm;margin-right:0cm;margin-bottom:.1pt;margin-left:5.0pt;'>
  &nbsp;</p>
<table style="border: none;margin-left:5.5pt;border-collapse:collapse;">
  <tbody>
    <tr>
      <td
        style="width: 92.85pt;border-top: 1pt solid black;border-left: 1pt solid black;border-bottom: none;border-right: none;padding: 0cm;height: 40.5pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;margin:0cm;'>
          <span style="font-size:16px;">&nbsp;</span>
        </p>
        <p
          style='margin-top:8.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Nama</p>
      </td>
      <td
        style="width: 140.85pt;border-top: 1pt solid black;border-left: none;border-bottom: none;border-right: 1pt solid black;padding: 0cm;height: 40.5pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;margin:0cm;'>
          <span style="font-size:16px;">&nbsp;</span>
        </p>
        <p
          style='margin-top:8.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:19.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp; {{$nama}}</p>
      </td>
      <td
        style="width: 109.7pt;border-right: none;border-bottom: none;border-left: none;border-image: initial;border-top: 1pt solid black;padding: 0cm;height: 40.5pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;margin:0cm;'>
          <span style="font-size:16px;">&nbsp;</span>
        </p>
        <p
          style='margin-top:8.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Pemeriksaan&nbsp;DM/HT</p>
      </td>
      <td
        style="width: 124.25pt;border-top: 1pt solid black;border-left: none;border-bottom: none;border-right: 1pt solid black;padding: 0cm;height: 40.5pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;margin:0cm;'>
          <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
      </td>
    </tr>
    <tr>
      <td
        style="width: 92.85pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          No. JKN</p>
      </td>
      <td
        style="width: 140.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:19.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp; {{$no_bpjs}}</p>
      </td>
      <td style="width: 109.7pt;border: none;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Tekanan Darah</p>
      </td>
      <td
        style="width: 124.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:2.2pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp;................................</p>
      </td>
    </tr>
    <tr>
      <td
        style="width: 92.85pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Nama Faskes</p>
      </td>
      <td
        style="width: 140.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:19.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp; PKM Rampal Celaket</p>
      </td>
      <td style="width: 109.7pt;border: none;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          GDP</p>
      </td>
      <td
        style="width: 124.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:2.2pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp;................................</p>
      </td>
    </tr>
    <tr>
      <td
        style="width: 92.85pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Jenis Kelamin</p>
      </td>
      <td
        style="width: 140.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:19.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp; {{$jk}}</p>
      </td>
      <td style="width: 109.7pt;border: none;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Pemeriksaan&nbsp;HT</p>
      </td>
      <td
        style="width: 124.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;margin:0cm;'>
          <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
      </td>
    </tr>
    <tr>
      <td
        style="width: 92.85pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.8pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Umur</p>
      </td>
      <td
        style="width: 140.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.8pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:19.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp; {{$umur}}</p>
      </td>
      <td style="width: 109.7pt;border: none;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.8pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Tekanan Darah</p>
      </td>
      <td
        style="width: 124.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.6pt;vertical-align: top;">
        <p
          style='margin-top:4.8pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:2.2pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp;................................</p>
      </td>
    </tr>
    <tr>
      <td
        style="width: 92.85pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Alamat</p>
      </td>
      <td
        style="width: 140.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:19.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          : {{$alamat}}</p>
      </td>
      <td style="width: 109.7pt;border: none;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Tinggi&nbsp;Badan</p>
      </td>
      <td
        style="width: 124.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:3.5pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp;...............................</p>
      </td>
    </tr>
    <tr>
      <td
        style="width: 92.85pt;border-top: none;border-right: none;border-bottom: none;border-image: initial;border-left: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Diagnosa</p>
      </td>
      <td
        style="width: 140.85pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:19.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp; {{$diagnosa}}</p>
      </td>
      <td style="width: 109.7pt;border: none;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Berat&nbsp;Badan</p>
      </td>
      <td
        style="width: 124.25pt;border-top: none;border-bottom: none;border-left: none;border-image: initial;border-right: 1pt solid black;padding: 0cm;height: 22.65pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:2.9pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp;...............................</p>
      </td>
    </tr>
    <tr>
      <td
        style="width: 92.85pt;border-top: none;border-left: 1pt solid black;border-bottom: 1pt solid black;border-right: none;padding: 0cm;height: 27.35pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;margin:0cm;'>
          <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
      </td>
      <td
        style="width: 140.85pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0cm;height: 27.35pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;margin:0cm;'>
          <span style='font-family:"Times New Roman",serif;'>&nbsp;</span>
        </p>
      </td>
      <td
        style="width: 109.7pt;border-top: none;border-right: none;border-left: none;border-image: initial;border-bottom: 1pt solid black;padding: 0cm;height: 27.35pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:5.35pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          Lingkar&nbsp;Perut</p>
      </td>
      <td
        style="width: 124.25pt;border-top: none;border-left: none;border-bottom: 1pt solid black;border-right: 1pt solid black;padding: 0cm;height: 27.35pt;vertical-align: top;">
        <p
          style='margin-top:4.85pt;margin-right:0cm;margin-bottom:0cm;margin-left:4.1pt;font-size:15px;font-family:"Arial MT",sans-serif;'>
          :&nbsp;..............................</p>
      </td>
    </tr>
  </tbody>
</table>
<h1
  style='margin-top:10px;margin-right:0cm;margin-bottom:0cm;margin-left:3.0pt;font-size:15px;font-family:"Arial",sans-serif;line-height:12.6pt;'>
  Jenis Pemeriksaan<span style='font-family:"Arial MT",sans-serif;font-weight:normal;'>:</span></h1>
<table>
  <tr>
    <td>
      <table>
        <tr>
          <td>
            <input type="checkbox" {{ $keterangan_prolanis == 'Diabetes Melitus' ? "checked" : "" }}>
          </td>
          <td>
            <p style='font-size: 15px; font-family: "Arial MT", sans-serif; margin: 0cm 3.9pt 0.0001pt 10px;'>
              <u>Pemeriksaan
                DM
                Per 6 Bulan</u> HbA1C
            </p>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td>
            <input type="checkbox" {{ $keterangan_prolanis == 'Diabetes Melitus' ? "checked" : "" }}>
          </td>
          <td>
            <p style='margin: 0cm 0cm 0cm 10px; font-size: 15px; font-family: "Arial MT", sans-serif;'>
              <u>Pemeriksaan&nbsp;DM&nbsp;Per&nbsp;6&nbsp;Bulan</u> Kimia&nbsp;Darah&nbsp;:
            </p>
          </td>
        </tr>
      </table>
      <ul style="list-style-type: disc;margin-left:20px;">
        <li>Mikroalbuminuria</li>
        <li>Ureum</li>
        <li>Kreatinin</li>
        <li>Kholesterol&nbsp;total</li>
        <li>Kholesterol&nbsp;LDL</li>
        <li>Kholesterol&nbsp;HDL</li>
        <li>Trigliserida</li>
      </ul>
    </td>
    <td>
      <table>
        <tr>
          <td>
            <input type="checkbox" {{ $keterangan_prolanis == 'Hipertensi' ? "checked" : "" }}>
          </td>
          <td>
            <p
              style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:10.3pt;margin-right:59.15pt;margin-bottom:.0001pt;margin-left:5.0pt;'>
              <u>Pemeriksaan HT Per 6 Bulan</u> Kimia&nbsp;Darah&nbsp;:
            </p>
          </td>
        </tr>
      </table>
      <ul style="list-style-type: disc;">
        <li>Mikroalbuminuria</li>
        <li>Ureum</li>
        <li>Kreatinin</li>
        <li>Kholesterol&nbsp;total</li>
        <li>Kholesterol&nbsp;LDL</li>
        <li>Kholesterol&nbsp;HDL</li>
        <li>Trigliserida</li>
      </ul>
    </td>
  </tr>
</table>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:4.7pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:5.0pt;'>
  Demikian&nbsp;atas&nbsp;bantuan&nbsp;nya,&nbsp;diucapkan&nbsp;terimakasih.</p>
<p style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:.5pt;'><span
    style="font-size:9px;">&nbsp;</span></p>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:4.65pt;margin-right:0cm;margin-bottom:.0001pt;margin-left:267.25pt;'>
  Malang,&nbsp; {{$tanggal_cek_lab}}
</p>
<p style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:.05pt;'>&nbsp;</p>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-left:240.25pt;text-indent:30.45pt;line-height:12.6pt;'>
  <span style="margin-left:300px;margin-top:262px;width:103px;height:140px;"><img
      src="data:image/png;base64,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"
      alt="image" width="180" height="180"></span>
</p>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-left:267.25pt;text-indent:30.45pt;line-height:12.6pt;'>
  (dr. Moh. Ali Sahib)</p>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:0cm;margin-right:32.7pt;margin-bottom:.0001pt;margin-left:5.0pt;'>
  &nbsp;</p>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:0cm;margin-right:32.7pt;margin-bottom:.0001pt;margin-left:5.0pt;'>
  Dokter FKTP<em><span style='font-family:"Arial",sans-serif;'>*) coret yang tidak perlu&nbsp;</span></em></p>
<p
  style='margin:0cm;font-size:15px;font-family:"Arial MT",sans-serif;margin-top:0cm;margin-right:32.7pt;margin-bottom:.0001pt;margin-left:5.0pt;'>
  <strong><span style='font-family:"Arial",sans-serif;'>Catatan : diwajibkan Puasa 10 sd. 12 Jam
      sebelum&nbsp;</span></strong><strong></strong><strong><span
      style='font-family:"Arial",sans-serif;'>pemeriksaan</span></strong>
</p>
</div>
@endsection