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


            <hr>

<h6>Status Claim</h6>
<div class="row align-items-center" id="claim-status-section">
  <div class="col-md-4">
    <select class="form-select form-select-sm" id="claim_status">
      <option value="">-- Pilih Status Claim --</option>
      <option value="BISA_CLAIM">BISA CLAIM</option>
      <option value="PROLANIS_HT">PROLANIS HT</option>
      <option value="BELUM_PROLANIS">BELUM PROLANIS</option>
      <option value="LANJUT_ENTRY">LANJUT ENTRY</option>
    </select>
  </div>

  <div class="col-md-3">
    <button class="btn btn-primary btn-sm" id="btn-update-claim">
      Simpan Status Claim
    </button>
  </div>

  <div class="col-md-5">
    <small class="text-muted" id="claim-status-info">
      Update status klaim pasien
    </small>
  </div>
</div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Update BPJS -->
<div class="modal fade" id="modalUpdateBpjs" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-update-bpjs">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update No BPJS</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="pasien_id">

          <div class="form-group">
            <label>No BPJS</label>
            <input type="text" class="form-control" id="no_bpjs" placeholder="Masukkan Nomor BPJS" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Batal
          </button>
          <button type="submit" class="btn btn-primary">
            Simpan
          </button>
        </div>
      </div>
    </form>
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
      $("#no_bpjs").val(pasien.no_bpjs);

      if (pasien.claim_status) {
        $("#claim_status").val(pasien.claim_status);
      }

      $("#detail-data").html(`
        <div class="row"><div class="col-3"><span>No KTP</span></div><div class="col-9">${pasien.no_ktp ?? '-'}</div></div>
        <div class="row"><div class="col-3"><span>No BPJS</span></div><div class="col-9">${pasien.no_bpjs ?? '-'}</div></div>
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
          <a href="/pasien/download/fhp/${pasienId}" target="_blank" class="btn btn-success btn-sm btn-input-hasil-prolanis me-2">Form Hasil Lab Prolanis</a>'
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

      buttons = `
        <div class="col-md-3 mb-2">
          <button class="btn btn-warning btn-sm" id="btn-update-bpjs">
            Update No BPJS
          </button>
        </div>
      ` + buttons;

      $("#download-buttons").html(buttons);

      $("#loading").addClass("d-none");
      $("#pasien-content").removeClass("d-none");
    },
    error: function(err) {
      console.error(err);
      $("#loading").html("<p class='text-danger'>Gagal memuat data pasien.</p>");
    }
  });

  $(document).on("click", "#btn-update-bpjs", function () {
    $("#pasien_id").val(pasienId);
    $("#modalUpdateBpjs").modal("show");
  });

  $("#form-update-bpjs").on("submit", function (e) {
    e.preventDefault();

    const payload = {
      pasien_id: $("#pasien_id").val(),
      no_bpjs: $("#no_bpjs").val()
    };

    $.ajax({
      url: `https://ehealthprc.com/api/api/v1/pasien/${payload.pasien_id}/bpjs`,
      method: "PUT",
      contentType: "application/json",
      data: JSON.stringify(payload),
      success: function (res) {
        alert("No BPJS berhasil diperbarui");
        $("#modalUpdateBpjs").modal("hide");

        $("#detail-data").find("div:contains('No BPJS')").next().text(payload.no_bpjs);
      },
      error: function (err) {
        console.error(err);
        alert("Gagal update No BPJS");
      }
    });
  });

$(document).on("click", "#btn-update-claim", function () {
  const status = $("#claim_status").val();

  if (!status) {
    alert("Silakan pilih status claim terlebih dahulu");
    return;
  }

  const btn = $(this);
  btn.prop("disabled", true).text("Menyimpan...");

  $.ajax({
    url: `https://ehealthprc.com/api/api/v1/claims/${pasienId}/status`,
    method: "PUT",
    contentType: "application/json",
    data: JSON.stringify({
      claim_status: status,
    }),
    success: function (res) {
      alert(res.message || "Status claim berhasil diperbarui");

      // update badge kalau ada
      renderClaimBadge(status);

      btn.prop("disabled", false).text("Simpan Status Claim");
    },
    error: function (xhr) {
      alert(xhr.responseJSON?.message || "Gagal update status claim");
      btn.prop("disabled", false).text("Simpan Status Claim");
    },
  });
});



});
</script>
@endsection
