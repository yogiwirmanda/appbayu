@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Daftar Pasien Prolanis Cek Lab</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Prolanis Cek Lab</li>
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
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control search-filter"
                                    placeholder="Tanggal Cek Lab">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-prolanis" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No RM</th>
                                    <th>Nama</th>
                                    <th>Keterangan Prolanis</th>
                                    <th>Tanggal Cek Lab</th>
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
<div class="modal fade" id="modal-cek-lab" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h6 class="modal-title" id="modal-title-default">Buat Jadwal Cek Lab</h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form role="form" id="form-cek-lab">
                        <input type="hidden" name="id" id="pasien-cek-lab-id">
                        <div class="form-group mb-3">
                            <select name="datang" class="form-control select2" required>
                              <option value="1">Datang</option>
                              <option value="0">Tidak Datang</option>
                            </select>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary btn-simpan-kedatangan my-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    $('.select2').select2();
    function loadTable(queryParam = ''){
        $('#table-prolanis').dataTable().fnClearTable();
        $('#table-prolanis').dataTable().fnDestroy();
        var table = $('#table-prolanis').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'http://ehealthprc.com:5000/api/v1/prolanis/jadwal-cek-lab?' + queryParam,
            searchDelay: 500,
            columns: [
                {
                    data: 'pasien.no_rm',
                    name: 'no_rm'
                },
                {
                    render: function(data,type,row) {
                        return '<a href="/prolanis/riwayat/' + row.pasien.id + '">' + row.pasien.nama + '</a>';
                    }
                },
                {
                    data: 'keterangan_prolanis',
                    name: 'Keterangan Prolanis'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    render: function (data, type, row) {
                        if (row.datang == null){
                            actionBtn = '<a href="javascript:;" class="btn btn-info btn-sm btn-update-datang me-2" data-pasien-id="'+row.id+'">Update Kedatangan</a>';
                        } else {
                            actionBtn = row.datang == 1 ? "Datang" : "Tidak Datang";
                        }
                        return actionBtn;
                    }
                },
            ]
        });
    }

    loadTable('ALL');

    $('.btn-submit-filter').click(function () {
        let value = $('#jenis_prolanis').val();
        loadTable(value);
    });

    $(document).on('click', '.btn-update-datang', function (e) {
        e.stopImmediatePropagation();
        $('#modal-cek-lab').modal('show');
        $('#pasien-cek-lab-id').val($(this).attr('data-pasien-id'))
    });

    let timeoutId;

    function handleKeyupWithDelay() {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function() {
        var tanggal = $('#tanggal').val();
        var queryParam = '';
        queryParam += '&tanggal=' + tanggal;
        loadTable(queryParam)
      }, 500);
    }

    $('.search-filter').on('keyup', handleKeyupWithDelay);

    $('#form-cek-lab').submit(function(e){
        e.preventDefault();
        let form = $(this);
        var dataForm = form.serializeArray();

        $.ajax({
            url: "http://ehealthprc.com:5000/api/v1/prolanis/update-datang-cek-lab",
            method: "PATCH",
            dataType: "json",
            data: dataForm,
            success: function (response) {
                if (response.message != '') {
                    $.notify('Pembuatan Jadwal Cek Lab Prolanis Berhasil', 'success');
                    e.stopImmediatePropagation();
                    $('#modal-cek-lab').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });


</script>
@endsection