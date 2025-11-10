@extends('master.main')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-4">Daftar Klaim Pasien</h4>

          <div class="text-center py-5" id="loading">
            <div class="spinner-border text-primary"></div>
            <p class="mt-3">Memuat data klaim...</p>
          </div>

          <div id="claims-content" class="d-none">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="claims-table">
                <thead class="thead-light">
                  <tr>
                    <th>Nama</th>
                    <th>No. BPJS</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
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
  const apiUrl = `https://ehealthprc.com/api/api/v1/claims/list?start=0&length=50`;

  $.ajax({
    url: apiUrl,
    method: "GET",
    dataType: "json",
    success: function(res) {
      const data = res.data || [];
      let rows = "";

      if (data.length === 0) {
        rows = `<tr><td colspan="4" class="text-center text-muted">Tidak ada data klaim</td></tr>`;
      } else {
        data.forEach(item => {
          const pasien = item.pasien || {};
          const nama = pasien.nama ?? '-';
          const no_bpjs = pasien.no_bpjs ?? '-';
          const tanggal = item.tanggal ? new Date(item.tanggal).toLocaleDateString('id-ID') : '-';
          const id = pasien.id ?? '';

          rows += `
            <tr>
              <td>${nama}</td>
              <td>${no_bpjs}</td>
              <td>${tanggal}</td>
              <td>
                <a href="/claim/${item.id}" class="btn btn-sm btn-primary">
                  Detail
                </a>
              </td>
            </tr>
          `;
        });
      }

      $("#claims-table tbody").html(rows);
      $("#loading").addClass("d-none");
      $("#claims-content").removeClass("d-none");
    },
    error: function(err) {
      console.error(err);
      $("#loading").html("<p class='text-danger'>Gagal memuat data klaim.</p>");
    }
  });
});
</script>
@endsection
