@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Daftar Pasien</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Prolanis</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 text-left d-flex">
                            <select name="jenis_prolanis" class="form-control select2" id="jenis_prolanis">
                                <option value="ALL">Semua</option>
                                <option value="Diabetes Melitus">Diabetes Melitus</option>
                                <option value="Hipertensi">Hipertensi</option>
                            </select>
                            <a href="javascript:;"
                                class="btn btn-info btn-fill pull-right btn-submit-filter m-l-10">Filter
                            </a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{asset('prolanis/create')}}" class="btn btn-primary btn-pill">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-prolanis" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>No RM</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    $('.select2').select2();
    function loadTable(type){
        $('#table-prolanis').dataTable().fnClearTable();
        $('#table-prolanis').dataTable().fnDestroy();
        var table = $('#table-prolanis').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax_load_prolanis') }}",
                type: "GET",
                data: function(d){
                    d.type = type;
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_rm',
                    name: 'no_rm'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'keterangan_prolanis',
                    name: 'keterangan_prolanis'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    }

    loadTable('ALL');

    $('.btn-submit-filter').click(function () {
        let value = $('#jenis_prolanis').val();
        loadTable(value);
    });

    $('.btn-send-whatsapp').click(function (e) {
        let dataPasienId = $(this).attr('data-pasien-id');
        $.ajax({
            url: "/send/whatsapp/" + dataPasienId,
            method: "GET",
            dataType: "json",
            data: {
                dataPasienId: dataPasienId
            },
            success: function (response) {
                if (response.errCode == 0) {
                    $.notify('Pasien Berhasil dihapus', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }
        });
    });

</script>
@endsection
