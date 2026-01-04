@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>List Reminder Whatsapp</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Reminder Whatsapp</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{route('retensi_save')}}" method="POST" class="form-retensi">
                    @csrf
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table-list-reminder">
                                <thead class="thead-light">
                                    <th>No</th>
                                    <th>No RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
const table = $('#table-list-reminder').DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    lengthChange: true,
    pageLength: 10,

    ajax: {
        url: "http://127.0.0.1:5001/api/v1/queue",
        type: "GET",
        data: function (d) {
            return {
                draw: d.draw,
                start: d.start,
                length: d.length
            };
        },
        dataSrc: function (json) {
            return json.data;
        }
    },

    columns: [
        {
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },

        { data: 'pasien.no_rm', defaultContent: '-' },
        { data: 'pasien.nama', defaultContent: '-' },

        {
            data: 'module',
            render: function (data) {
                if (data === 'prolanis-reminder') return 'Reminder 6 Bulan';
                if (data === 'prolanis-reminder-ceklab') return 'Reminder Ceklab';
                return data ?? '-';
            }
        },

        {
            data: 'date',
            render: function (data) {
                return data ? new Date(data).toLocaleDateString('id-ID') : '-';
            }
        },

        {
            data: 'is_send',
            render: function (data) {
                if (data == 1) {
                    return '<span class="badge badge-success">Terkirim</span>';
                }
                return '<span class="badge badge-warning">Belum Terkirim</span>';
            }
        },
        {
            data: 'id',
            orderable: false,
            searchable: false,
            render: function (id) {
                return `
                    <button class="btn btn-sm btn-danger btn-delete"
                        data-id="${id}">
                        <i data-feather="trash-2"></i>
                    </button>
                `;
            }
        }
    ],

    drawCallback: function () {
        feather.replace();
    }
});


$(document).on('click', '.btn-delete', function () {
    const id = $(this).data('id');

    if (!confirm('Yakin ingin menghapus reminder ini?')) return;

    $.ajax({
        url: `http://127.0.0.1:5001/api/v1/queue/${id}`,
        type: 'DELETE',
        success: function (res) {
            if (res.success) {
                table.ajax.reload(null, false); // keep current page
            } else {
                alert(res.message);
            }
        },
        error: function () {
            alert('Gagal menghapus data');
        }
    });
});
</script>
@endsection


