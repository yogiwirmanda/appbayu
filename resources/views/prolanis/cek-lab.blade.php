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
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <input type="date" name="tanggal" id="tanggal" value="<?php echo Date('Y-m-d') ?>" class="form-control search-filter">
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
                                    <th>Hasil</th>
                                    <th width="20%">Aksi</th>
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
                <h6 class="modal-title" id="modal-title-default">Ubah Status Periksa</h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form role="form" id="form-cek-lab">
                        <input type="hidden" name="id" id="pasien-cek-lab-id">
                        <div class="form-group mb-3">
                            <select name="datang" class="form-control select2" required>
                              <option value="1">Periksa</option>
                              <option value="0">Tidak Periksa</option>
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
<div class="modal fade" id="modal-input-lab" tabindex="-1" role="dialog" aria-labelledby="modal-form"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header px-4">
                <h6 class="modal-title" id="modal-title-default">Buat Jadwal Cek Lab</h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body px-lg-4 py-lg-3">
                    <form id="labForm" class="form">
                      @csrf
                      <input type="hidden" name="ceklab_id" id="ceklabid">
                      <div id="form-rows" class="container">
                          <div class="row mb-3">
                              <input type="text" id="pemeriksaan" name="pemeriksaan" class="form-control mb-2" placeholder="Pemeriksaan" readonly>
                              <input type="text" id="hasil "name="hasil" class="form-control mb-2" placeholder="Hasil" required>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary mt-3">Simpan</button>
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
    function loadTable(){
        let tanggal = $('#tanggal').val();
        let jenis = $('#jenis_prolanis').val();
        let role = "<?= Auth::user()->role ?>";

        let queryParam = '?tanggal=' + tanggal;
        if (jenis != 'ALL'){
            queryParam += '&jenis=' + jenis;
        }
        // queryParam += '&role=' + role;

        if ($.fn.DataTable.isDataTable('#table-prolanis')) {
            $('#table-prolanis').DataTable().clear().destroy();
        }

        var table = $('#table-prolanis').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'https://ehealthprc.com/api/api/v1/prolanis/jadwal-cek-lab' + queryParam,
            searchDelay: 500,
            columns: [
                {
                    data: 'pasien.no_rm',
                    name: 'no_rm'
                },
                {
                    render: function(data,type,row) {
                        return '<a href="/pasiens/detail/' + row.pasien.id + '">' + row.pasien.nama + '</a>';
                    }
                },
                {
                    data: 'keterangan_prolanis',
                    name: 'Keterangan Prolanis'
                },
                {
                    render: function (data, type, row) {
                        const date = new Date(row.tanggal);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const year = date.getFullYear();
                        return `${day}-${month}-${year}`;
                    }
                },
                {
                    render: function (data, type, row) {
                        if (row.hasil == null){
                            return '-';
                        } else {
                            return row.hasil
                        }
                    }
                },
                {
                    render: function (data, type, row) {
                        let actionBtn = '';
                        let role = "<?= Auth::user()->role ?>";
                        if (role == 'admin' || role == 'rm') {
                            if (row.datang == null){
                                actionBtn += '<a href="javascript:;" class="btn btn-info btn-sm btn-update-datang me-2" data-pasien-id="'+row.id+'">Periksa</a>';
                                actionBtn += '<a href="javascript:;" class="btn btn-danger btn-sm btn-remove-ceklab" data-pasien-id="'+row.id+'" data-pasien-nama="'+row.pasien.nama+'">Hapus</a>';
                            } else {
                                if (row.datang == 1 && row.hasil == null){
                                    actionBtn += '<a href="javascript:;" class="btn btn-info btn-sm btn-input-hasil me-2" prolanis="'+row.keterangan_prolanis+'" ceklabid="'+row.id+'">Hasil</a>';
                                } else if (row.datang == 1 && row.hasil != null){
                                    actionBtn += '<a href="javascript:;" class="btn btn-danger btn-sm btn-remove-ceklab" data-pasien-id="'+row.id+'" data-pasien-nama="'+row.pasien.nama+'">Hapus</a>';
                                }
                                else {
                                    actionBtn += "Tidak Periksa";
                                }
                            }
                        } else if (role == 'lab'){
                            if (row.datang == null){
                                actionBtn += '<a href="javascript:;" class="btn btn-info btn-sm btn-update-datang me-2" data-pasien-id="'+row.id+'">Periksa</a>';
                            } else {
                                if (row.datang == 1 && row.hasil == null){
                                    actionBtn += '<a href="javascript:;" class="btn btn-info btn-sm btn-input-hasil me-2" prolanis="'+row.keterangan_prolanis+'" ceklabid="'+row.id+'">Hasil</a>';
                                }
                                else {
                                    actionBtn += "Tidak Periksa";
                                }
                            }
                        }
                        return actionBtn;
                    }
                },
            ]
        });
    }

    loadTable();

    $(document).on('change', '#jenis_prolanis', function(e) {
        e.stopImmediatePropagation();
        loadTable();
    });

    $(document).on('change', '#tanggal', function(e) {
        e.stopImmediatePropagation();
        loadTable();
    });

    $(document).on('click', '.btn-update-datang', function (e) {
        e.stopImmediatePropagation();
        $('#modal-cek-lab').modal('show');
        $('#pasien-cek-lab-id').val($(this).attr('data-pasien-id'))
    });

    $(document).on('click', '.btn-remove-ceklab', function (e) {
        e.stopImmediatePropagation();
        swal({
            title: 'Apakah anda yakin?',
            text: 'Menghapus data ceklab atas nama ' + $(this).attr('data-pasien-nama'),
            type: 'question',
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success btn-delete-pasien',
            confirmButtonText: 'Hapus',
            cancelButtonClass: 'btn btn-danger',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    url: "https://ehealthprc.com/api/api/v1/prolanis/remove-cek-lab",
                    method: "POST",
                    dataType: "json",
                    data : {
                        id: $(this).attr('data-pasien-id')
                    },
                    success: function (response) {
                        if (response.errCode == 0) {
                            $.notify('Jadwal Ceklab Berhasil dihapus', {type: 'success'});
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                });
            }
        })
    });

    $('#form-cek-lab').submit(function(e){
        e.preventDefault();
        let form = $(this);
        var dataForm = form.serializeArray();

        $.ajax({
            url: "https://ehealthprc.com/api/api/v1/prolanis/update-datang-cek-lab",
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

    $('#labForm').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: "{{ route('lab.extract') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#hasil').val('');
                $('#modal-input-lab').modal('hide');
                $.notify('Hasil berhasil ditambahkan', 'success');
                loadTable();
            },
            error: function(xhr) {
                alert('Submit failed!');
                console.error(xhr.responseText);
            }
        });
    });


    $(document).on('click', '.btn-input-hasil', function(){
      $('#ceklabid').val($(this).attr('ceklabid'));
      $('#pemeriksaan').val($(this).attr('prolanis'));
      $('#modal-input-lab').modal('show');
    })


</script>
@endsection