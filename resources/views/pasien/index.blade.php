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
                        <table class="table table-flush" id="table-pasien" style="text-transform: uppercase;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No RM</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tgl Lahir</th>
                                    <th>Alamat</th>
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
@endsection
@section('page-scripts')
<script>
    var table = '';
    var dataTableCounter = 1

    function loadTable(queryParam = ''){
        $('#table-pasien').dataTable().fnClearTable();
        $('#table-pasien').dataTable().fnDestroy();
        table = $('#table-pasien').DataTable({
            ajax: 'http://ehealthprc.com:5000/api/v1/pasien?' + queryParam,
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
                // {
                //     data: 'no_rm',
                //     name: 'no_rm',
                // },
                {
                    data: 'no_rm',
                    name: 'no_rm',
                    searchable: false
                },
                {
                    data: 'no_ktp',
                    name: 'no_ktp',
                    searchable: false
                },
                {
                    render: function (data, type, row) {
                        let addNama = '';
                        if (row.jk == 'L' && row.status_kawin == 'kawin'){
                            addNama = 'Tn. ';
                        }

                        if (row.jk == 'L' && row.status_kawin == 'belum'){
                            addNama = 'Sdr. ';
                        }

                        if (row.jk == 'P' && row.status_kawin == 'kawin'){
                            addNama = 'Ny. ';
                        }

                        if (row.jk == 'P' && row.status_kawin == 'belum'){
                            addNama = 'Nn. ';
                        }
                        let urlNama = '<a href="pasiens/detail/'+row.id+'">'+addNama + row.nama+'</a>'
                        return urlNama;
                    },
                },
                {
                    data: 'tgl_lahir',
                    name: 'tgl_lahir',
                    searchable: false
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    searchable: false
                },
                {
                    // Define the custom action column
                    // Use the "render" function to generate custom content
                    render: function (data, type, row) {
                        let urlKunjungan = '/kunjungan/create/' + row.id
                        let urlEdit = '/pasien/edit/' + row.id;
                        let actionBtn = '<a href='+urlKunjungan+' class="btn btn-sm btn-success m-r-10">Kunjungan</a>';
                        actionBtn += '<button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button><div class="dropdown-menu">';
                        actionBtn += '<a href='+urlEdit+' class="dropdown-item" data-toggle="tooltip" data-original-title="Edit pasien">Edit</a>';
                        actionBtn += '<a href="javascript:;" class="dropdown-item table-action-delete" data-pasien-id="'+row.id+'" data-pasien-nama="'+row.nama+'">Hapus</a>';
                        actionBtn += '</div>';
                        return actionBtn;
                    },
                }
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
                // api.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                //     cell.innerHTML = startIndex + i + 1;
                // });
                api.column(3, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                    var rowData = table.column(3).data();
                    // function formatDateToYMD(date) {
                    //     const year = date.getFullYear();
                    //     const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so we add 1 and pad with '0' if needed
                    //     const day = String(date.getDate()).padStart(2, '0'); // Pad with '0' if the day is a single digit

                    //     return `${day}-${month}-${year}`;
                    // }

                    // Example usage:
                    const myDate = rowData[i]; // Replace this with your own Date object
                    // const formattedDate = formatDateToYMD(myDate);

                    cell.innerHTML = myDate;
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
</script>
@endsection