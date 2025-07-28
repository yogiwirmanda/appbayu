@extends('master.main')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Daftar Pasien Prolanis</h3>
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
                        <div class="col-3 d-flex justify-content-end">
                            <a href="javascript:;" class="btn btn-pill btn-success btn-export-pasien"
                                data-toggle="tooltip" data-original-title="Export Pasien">
                                <span class="btn-inner--text">Export Pasien</span>
                            </a>
                        </div>
                        <div class="col-3 d-flex justify-content-end">
                            <a href="{{asset('prolanis/create')}}" class="btn btn-primary btn-pill">Tambah</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label">Nama Pasien</label>
                                <input type="text" name="nama" id="nama" class="form-control search-filter"
                                    placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label">No RM</label>
                                <input type="text" name="no_rm" id="no_rm" class="form-control search-filter"
                                    placeholder="No RM">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label">NIK</label>
                                <input type="text" name="no_ktp" id="no_ktp" class="form-control search-filter"
                                    placeholder="No KTP">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control search-filter"
                                    placeholder="Alamat">
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
                        <input type="hidden" name="pasien" id="pasien-cek-lab-id">
                        <div class="form-group mb-3">
                            <input class="form-control" id="tanggal-ceklab" name="tanggal" placeholder="Tanggal..." type="date">
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary btn-submit-jadwal-ceklab my-4">Buat Jadwal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-last-ceklab" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h6 class="modal-title" id="modal-title-default">Setting Tanggal Terakhir Cek Lab</h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form role="form" id="form-last-ceklab">
                        <input type="hidden" name="pasien" id="pasien-last-ceklab">
                        <div class="form-group mb-3">
                            <input class="form-control" id="tanggal-last-ceklab" name="tanggal" placeholder="Tanggal..." type="date">
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary btn-submit-jadwal-last-ceklab my-4">Setting Tanggal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit-pasien-prolanis" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h6 class="modal-title" id="modal-title-default">Ubah Status Prolanis</h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form role="form" id="form-pasien-edit-prolanis">
                        <input type="hidden" name="id_pasien" id="pasien-id">
                        <div class="form-group mb-3">
                            <select name="keterangan_prolanis" class="form-control select2" id="jenis_prolanis">
                                <option value="Diabetes Melitus">Diabetes Melitus</option>
                                <option value="Hipertensi">Hipertensi</option>
                            </select>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary btn-submit-edit-prolanis my-4">Ubah Status</button>
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
            ajax: 'http://ehealthprc.com:5000/api/v1/prolanis?' + queryParam,
            searchDelay: 500,
            columns: [
                {
                    data: 'no_rm',
                    name: 'no_rm'
                },
                {
                    render: function(data,type,row) {
                        return '<a href="/pasiens/detail/' + row.id + '">' + row.nama + '</a>';
                    }
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
                    render: function (data, type, row) {
                        actionBtn = '<a href="javascript:;" class="btn btn-danger btn-sm btn-remove-prolanis me-2" data-pasien-id="'+row.id+'">Hapus</a>';
                        actionBtn += '<a href="javascript:;" class="btn btn-info btn-sm btn-edit-prolanis me-2" data-pasien-id="'+row.id+'">Edit Prolanis</a>';
                        actionBtn += '<a href="javascript:;" class="btn btn-primary btn-sm btn-send-whatsapp me-2 mt-2" data-pasien-id="'+row.id+'">Kirim WA</a>';
                        actionBtn += '<a href="javascript:;" class="btn btn-secondary btn-sm btn-last-ceklab mt-2 text-black" data-pasien-id="'+row.id+'">Setting Tanggal</a>';
                        actionBtn += '<a href="javascript:;" class="btn btn-warning btn-sm btn-cek-lab mt-2" data-pasien-id="'+row.id+'">Cek Lab</a>';
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

    $('.btn-export-pasien').click(function(e){
        e.stopImmediatePropagation();
        window.location.href = '/prolanis/export/';
    });

    $(document).on('click', '.btn-cek-lab', function (e) {
        e.stopImmediatePropagation();
        $('#modal-cek-lab').modal('show');
        $('#pasien-cek-lab-id').val($(this).attr('data-pasien-id'))
    });

    $(document).on('click', '.btn-last-ceklab', function (e) {
        e.stopImmediatePropagation();
        $('#modal-last-ceklab').modal('show');
        $('#pasien-last-ceklab').val($(this).attr('data-pasien-id'))
    });

    $(document).on('click', '.btn-edit-prolanis', function (e) {
        e.stopImmediatePropagation();
        $('#modal-edit-pasien-prolanis').modal('show');
        $('#pasien-id').val($(this).attr('data-pasien-id'))
    });

    $(document).on('click', '.btn-send-whatsapp', function (e) {
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

    $(document).on('click', '.btn-remove-prolanis', function (e) {
        let dataPasienId = $(this).attr('data-pasien-id');
        $.ajax({
            url: "/prolanis/remove/" + dataPasienId,
            method: "GET",
            dataType: "json",
            data: {
                dataPasienId: dataPasienId
            },
            success: function (response) {
                if (response.errCode == 0) {
                    $.notify('Pasien Prolanis Berhasil dihapus', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });

    let timeoutId;

    function handleKeyupWithDelay() {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(function() {
        var nama = $('#nama').val();
        var no_rm = $('#no_rm').val();
        var no_ktp = $('#no_ktp').val();
        var alamat = $('#alamat').val();
        var queryParam = '';
        queryParam += '&nama=' + nama;
        queryParam += '&no_rm=' + no_rm;
        queryParam += '&no_ktp=' + no_ktp;
        queryParam += '&alamat=' + alamat;
        loadTable(queryParam)
      }, 500);
    }

    $('.search-filter').on('keyup', handleKeyupWithDelay);

    $('#form-cek-lab').submit(function(e){
        e.preventDefault();

        let tanggal = $('#tanggal-ceklab').val();

        if (tanggal == ''){
            $.notify({message: 'Pilih Tanggal Cek Lab'}, {type: 'danger'});
        } else {
            $('.btn-submit-jadwal-ceklab').attr('disabled', true);
            $('.btn-submit-jadwal-ceklab').text('Memproses data.....');

            let form = $(this);
            var dataForm = form.serializeArray();

            $.ajax({
                url: "http://ehealthprc.com:5000/api/v1/prolanis/create-jadwal-cek-lab",
                method: "POST",
                dataType: "json",
                data: dataForm,
                success: function (response) {
                    if (response.message != '') {
                        $.notify('Pembuatan Jadwal Cek Lab Prolanis Berhasil', {type: 'success'});
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
    });

    $('#form-last-ceklab').submit(function(e){
        e.preventDefault();

        let tanggal = $('#tanggal-last-ceklab').val();

        if (tanggal == ''){
            $.notify({message: 'Pilih Tanggal Cek Lab'}, {type: 'danger'});
        } else {
            $('.btn-submit-jadwal-last-ceklab').attr('disabled', true);
            $('.btn-submit-jadwal-last-ceklab').text('Memproses data.....');

            let form = $(this);
            var dataForm = form.serializeArray();

            $.ajax({
                url: "http://ehealthprc.com:5000/api/v1/prolanis/update-jadwal-cek-lab",
                method: "POST",
                dataType: "json",
                data: dataForm,
                success: function (response) {
                    if (response.message != '') {
                        $.notify('Pembuatan Jadwal Cek Lab Prolanis Berhasil', {type: 'success'});
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
    });

    $('#form-pasien-edit-prolanis').submit(function(e){
        e.preventDefault();

        let jenis = $('#jenis_prolanis').val();

        if (jenis == ''){
            $.notify({message: 'Pilih Status Prolanis'}, {type: 'danger'});
        } else {
            $('.btn-submit-edit-prolanis').attr('disabled', true);
            $('.btn-submit-edit-prolanis').text('Memproses data.....');

            let form = $(this);
            var dataForm = form.serializeArray();

            $.ajax({
                url: "http://ehealthprc.com:5000/api/v1/prolanis/update-status-prolanis",
                method: "POST",
                dataType: "json",
                data: dataForm,
                success: function (response) {
                    if (response.message != '') {
                        $.notify('Update status Prolanis Berhasil', {type: 'success'});
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        }
    });


</script>
@endsection