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
                    <li class="breadcrumb-item"><a href="/home"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg></a></li>
                    <li class="breadcrumb-item">Pasien</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between mb-3">
                            <h2>Filter Data Pasien</h2>
                            <a href="{{asset('pasien/create')}}" class="btn btn-pill btn-primary" data-toggle="tooltip"
                                data-original-title="Tambah Pasien">
                                <span class="btn-inner--text">Tambah Pasien</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Kata Kunci</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tgl" class="form-control" placeholder="Tanggal">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <a href="javascript:;" class="btn btn-primary btn-filter-pasien">Cari Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-flush" id="table-pasien" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>No RM</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Umur</th>
                                    {{-- <th>Aksi</th> --}}
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
@endsection
@section('page-scripts')
<script>
    var table = '';
    var dataTableCounter = 1

    function loadTable(getName = '', getTanggal){
        table = $('#table-pasien').DataTable({
            ajax: 'http://localhost:5000/api/v1/pasien',
            processing: true,
            serverSide: true,
            // ajax: {
            //     url : "{{ route('ajax_load_pasien') }}",
            //     type :  "GET",
            //     data : {
            //         name : getName,
            //         tgl : getTanggal
            //     }
            // },
            searchDelay: 500,
            columns: [
                // {
                //     data: 'DT_RowIndex',
                //     name: 'DT_RowIndex'
                // },
                {
                    data: 'no_rm',
                    name: 'no_rm',
                },
                {
                    data: 'no_rm',
                    name: 'no_rm',
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    searchable: false
                },
                {
                    data: 'tgl_lahir',
                    name: 'tgl_lahir',
                    searchable: false
                },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // },
            ],
            drawCallback : function(settings) {

                function calculateAge(dateOfBirth) {
                    const dob = new Date(dateOfBirth);
                    const now = new Date();

                    let age = now.getFullYear() - dob.getFullYear();
                    const monthDiff = now.getMonth() - dob.getMonth();

                    if (monthDiff < 0 || (monthDiff === 0 && now.getDate() < dob.getDate())) {
                        age--; // Birthday for the current year hasn't occurred yet
                    }

                    return age;
                }

                var api = this.api();
                var startIndex = api.context[0]._iDisplayStart;
                api.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                    cell.innerHTML = startIndex + i + 1;
                });
                api.column(4, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                    var rowData = table.column(4).data();
                    const dateOfBirthString = rowData[i];
                    const age1 = calculateAge(dateOfBirthString);
                    cell.innerHTML = age1;
                });
            }
        });
    }

    loadTable();

    $('.btn-filter-pasien').click(function(e){
        let getValue = $('#nama').val();
        let tanggal = $('#tgl').val();
        table.destroy();
        loadTable(getValue, tanggal);
    })

    $(document).on('click', '.table-action-delete', function () {
        let dataPasienId = $(this).attr('data-pasien-id');
        let namaPasien = $(this).attr('data-pasien-nama');
        swal({
            title: 'Apakah anda yakin?',
            text: 'Menghapus data pasien atas nama ' + namaPasien,
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
                    url: "pasien/destroy/" + dataPasienId,
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
            }
        })
    });
</script>
@endsection