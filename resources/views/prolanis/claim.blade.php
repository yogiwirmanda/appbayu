@extends('master.main')

@section('content')
<div class="container-fluid">
  <div class="row mt-5 pt-5">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-4">Daftar Klaim Pasien</h4>

          <div id="claims-content">
            <div class="table-responsive">
                <div class="row mb-3">
    <div class="col-md-3">
        <label>Bulan Pemeriksaan</label>
        <input type="month" id="filter-bulan" class="form-control">
    </div>

    <div class="col-md-3">
        <label>Status Klaim</label>
        <select id="filter-status" class="form-control">
            <option value="">Semua Status</option>
            <option value="BISA_CLAIM">Bisa Claim</option>
            <option value="PROLANIS_HT">Prolanis HT</option>
            <option value="BELUM_PROLANIS">Belum Prolanis</option>
            <option value="LANJUT_ENTRY">Lanjut Entry</option>
        </select>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button id="btn-filter" class="btn btn-primary w-100">Filter</button>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <button id="btn-reset" class="btn btn-secondary w-100">Reset</button>
    </div>
</div>

            <table class="table table-bordered table-striped" id="claims-table">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>No RM</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Status</th>
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
const table = $('#claims-table').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    lengthChange: true,
    pageLength: 10,
    order: [[1, 'desc']],

    ajax: {
        url: "https://ehealthprc.com/api/api/v1/claims/list",
        type: "GET",
        data: function (d) {
            return {
                draw: d.draw,
                start: d.start,
                length: d.length,
                search: d.search.value,

                bulan: $('#filter-bulan').val(),
                status: $('#filter-status').val()
            };
        },
        dataSrc: function (json) {
            return json.data;
        }
    },


    columns: [
        // No
        {
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },

        // Tanggal Pemeriksaan
        {
            data: 'tanggal',
            render: function (data) {
                return data
                    ? new Date(data).toLocaleDateString('id-ID')
                    : '-';
            }
        },

        // No RM
        { data: 'pasien.no_rm', defaultContent: '-' },

        // Nama
        { data: 'pasien.nama', defaultContent: '-' },

        // NIK
        { data: 'pasien.no_ktp', defaultContent: '-' },

        // Alamat
        { data: 'pasien.alamat', defaultContent: '-' },

        {
            data: 'claim_status',
                render: function (data) {
                    const map = {
                        BISA_CLAIM: 'success',
                        PROLANIS_HT: 'info',
                        BELUM_PROLANIS: 'warning',
                        LANJUT_ENTRY: 'primary'
                    };

                    return `<span class="badge badge-${map[data] || 'secondary'}">${data}</span>`;
                }
            },

        // Aksi
        {
            data: 'id',
            orderable: false,
            searchable: false,
            render: function (id) {
                return `
                    <a href="/claim/${id}" class="btn btn-sm btn-primary mr-1">
                        Detail
                    </a>
                    <button class="btn btn-sm btn-danger btn-delete"
                        data-id="${id}">
                        Hapus
                    </button>
                `;
            }
        }
    ]
});


// 🗑 DELETE CLAIM
$(document).on('click', '.btn-delete', function () {
    const id = $(this).data('id');

    if (!confirm('Yakin ingin menghapus klaim ini?')) return;

    $.ajax({
        url: "https://ehealthprc.com/api/api/v1/claims/delete",
        type: "POST",
        data: { id },
        success: function () {
            table.ajax.reload(null, false);
        },
        error: function () {
            alert('Gagal menghapus data klaim');
        }
    });
});

$('#btn-filter').on('click', function () {
    table.ajax.reload();
});

$('#btn-reset').on('click', function () {
    $('#filter-bulan').val('');
    $('#filter-status').val('');
    table.ajax.reload();
});

</script>
@endsection

