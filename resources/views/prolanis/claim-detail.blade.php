@extends('master.main')
@section('content')
<div class="container-fluid mt-5 pt-5">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body" id="claim-detail">
          <div class="text-center py-5" id="loading">
            <div class="spinner-border text-primary"></div>
            <p class="mt-3">Memuat data pasien...</p>
          </div>

          <div id="pasien-content" class="d-none">
            <div class="media mb-4">
              <div class="media-body">
                <div class="d-flex w-100">
                  <div class="m-r-15">
                    <h3 id="nama"></h3>
                    <p id="no_rm"></p>
                  </div>
                  <div class="d-flex align-items-start ml-2">
                    <span id="badge-prolanis" class="badge badge-danger d-none">Prolanis</span>
                    <span id="badge-prb" class="badge badge-success d-none">Prb</span>
                  </div>
                </div>
              </div>
            </div>

            <h6>Data Pasien</h6>
            <div class="details" id="detail-data"></div>

            <div class="row mt-4" id="download-buttons"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-scripts')
<script>
$(document).ready(function() {
  const pasienId = "{{ $idClaim }}"; // ensure route passes ID
  const apiUrl = `https://ehealthprc.com/api/api/v1/claims/${pasienId}`;

  // Helper: hitung umur
  function hitungUmur(tglLahir) {
    const birth = new Date(tglLahir);
    const today = new Date();
    let years = today.getFullYear() - birth.getFullYear();
    let months = today.getMonth() - birth.getMonth();
    let days = today.getDate() - birth.getDate();
    if (days < 0) { months--; days += 30; }
    if (months < 0) { years--; months += 12; }
    return `${years} Tahun ${months} Bulan ${days} Hari`;
  }

  // Load detail data
  $.ajax({
    url: apiUrl,
    method: "GET",
    dataType: "json",
    success: function(res) {
      const pasien = res.pasien || res; // adjust depending on your API response
      $("#nama").text(pasien.nama);
      $("#no_rm").text(pasien.no_rm);

      if (pasien.status_prolanis == 1) $("#badge-prolanis").removeClass("d-none");
      if (pasien.status_prb == 1) $("#badge-prb").removeClass("d-none");

      const umur = hitungUmur(pasien.tgl_lahir);

      $("#detail-data").html(`
        <div class="row"><div class="col-3"><span>Kepala Keluarga</span></div><div class="col-9">${pasien.kepala_keluarga ?? '-'}</div></div>
        <div class="row"><div class="col-3"><span>No KTP</span></div><div class="col-9">${pasien.no_ktp ?? '-'}</div></div>
        <div class="row"><div class="col-3"><span>Tanggal Lahir</span></div><div class="col-9">${pasien.tgl_lahir} (${umur})</div></div>
        <div class="row"><div class="col-3"><span>Alamat</span></div><div class="col-9">${pasien.alamat ?? '-'}</div></div>
        <div class="row"><div class="col-3"><span>No HP</span></div><div class="col-9">${pasien.no_hp ?? '-'}</div></div>
        <div class="row"><div class="col-3"><span>Jenis Bayar</span></div><div class="col-9">${pasien.cara_bayar ?? '-'} ${(pasien.cara_bayar == 'BPJS') ? pasien.no_bpjs : ''}</div></div>
        <div class="row"><div class="col-3"><span>Keterangan Prolanis</span></div><div class="col-9">${pasien.keterangan_prolanis ?? '-'}</div></div>
      `);

      // Button logic
      let buttons = "";
      @if(Auth::user()->role == 'admin' || Auth::user()->role == 'rm')
      buttons += `
        <div class="col-md-3">
          <a href="/pasien/download/fhlp/${pasienId}" target="_blank" class="btn btn-success btn-sm btn-input-hasil-prolanis me-2">Form Hasil Lab Prolanis</a>'
          </div>
        <div class="col-md-3">
          <a href="/pasien/download/ffp/${pasien.id}" target="_blank" class="btn btn-info btn-sm btn-input-hasil-prolanis me-2">Form Format Preventif</a>'
          </div>
        <div class="col-md-3">
        <a href="/pasien/download/fpl/${pasien.id}" target="_blank" class="btn btn-primary btn-sm btn-input-hasil-prolanis me-2">Form Pemeriksaan Lab</a>'
          </div>
      `;
      @endif

      if (pasien.status_prolanis == 1) {
        buttons += `
          <div class="col-md-3">
            <a href="/pasien/download/prolanis/${pasien.id}" target="_blank" class="btn btn-primary">Berkas Prolanis</a>
          </div>
        `;
      }

      $("#download-buttons").html(buttons);

      $("#loading").addClass("d-none");
      $("#pasien-content").removeClass("d-none");
    },
    error: function(err) {
      console.error(err);
      $("#loading").html("<p class='text-danger'>Gagal memuat data pasien.</p>");
    }
  });
});
</script>
@endsection
