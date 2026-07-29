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
                            <a target="_blank" href="https://ehealthprc.com/api/api/v1/pasien/filter/export" class="btn btn-success" onclick="exportExcel()">
                                <i class="fa fa-file-excel"></i> Export Excel
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
                                    <th>No BPJS</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tgl Lahir</th>
                                    <th>Kelurahan</th>
                                    <th>Alamat</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>No HP</th>
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
            ajax: 'https://ehealthprc.com/api/api/v1/pasien/filter?' + queryParam,
            processing: true,
            serverSide: true,
            searchDelay: 500,
            columns: [
                {
                    data: 'pasien.no_bpjs',
                    name: 'no_bpjs',
                    searchable: false
                },
                {
                    data: 'pasien.no_ktp',
                    name: 'no_ktp',
                    searchable: false
                },
                {
                    render: function (data, type, row) {

                        const dob = new Date(row.pasien.tgl_lahir);
                        const now = new Date();

                        let age = now.getFullYear() - dob.getFullYear();
                        const monthDiff = now.getMonth() - dob.getMonth();

                        if (monthDiff < 0 || (monthDiff === 0 && now.getDate() < dob.getDate())) {
                            age--;
                        }

                        let addNama = '';
                        if (row.pasien.jk == 'L' && row.pasien.status_kawin == 'kawin'){
                            addNama = 'Tn. ';
                        }

                        if (row.pasien.jk == 'L' && row.pasien.status_kawin == 'belum'){
                            addNama = 'Sdr. ';
                        }

                        if (row.pasien.jk == 'L' && row.pasien.status_kawin == 'cerai-hidup'){
                            addNama = 'Tn. ';
                        }

                        if (row.pasien.jk == 'L' && row.pasien.status_kawin == 'cerai-mati'){
                            addNama = 'Tn. ';
                        }

                        if (row.pasien.jk == 'P' && row.pasien.status_kawin == 'kawin'){
                            addNama = 'Ny. ';
                        }

                        if (row.pasien.jk == 'P' && row.pasien.status_kawin == 'belum'){
                            addNama = 'Nn. ';
                        }

                        if (row.pasien.jk == 'P' && row.pasien.status_kawin == 'cerai-hidup'){
                            addNama = 'Ny. ';
                        }

                        if (row.pasien.jk == 'P' && row.pasien.status_kawin == 'cerai-mati'){
                            addNama = 'Ny. ';
                        }

                        if (age <= 6){
                            addNama = 'An. ';
                        }

                        if (age > 6 && age < 30 && row.pasien.jk == 'L' && row.pasien.status_kawin == 'belum'){
                            addNama = 'Sdr. ';
                        }

                        if (age > 6 && age < 30 && row.pasien.jk == 'P' && row.pasien.status_kawin == 'belum'){
                            addNama = 'Sdri. ';
                        }

                        if (age > 6 && age < 30 && row.pasien.jk == 'L' && row.pasien.status_kawin == 'kawin'){
                            addNama = 'Tn. ';
                        }

                        if (age > 6 && age < 30 && row.pasien.jk == 'P' && row.pasien.status_kawin == 'kawin'){
                            addNama = 'Ny. ';
                        }

                        let urlNama = '<a href="/pasiens/detail/'+row.pasien.id+'">'+addNama + row.pasien.nama+'</a>'
                        if (row.pasien.status_prolanis == 1){
                            urlNama += '<span class="badge badge-danger m-l-5">Prolanis</span>';
                        }
                        if (row.pasien.status_prb == 1){
                            urlNama += '<span class="badge badge-success m-l-5">Prb</span>';
                        }
                        return urlNama;
                    },
                },
                {
                    data: 'pasien.tgl_lahir',
                    name: 'tgl_lahir',
                    width : '80px',
                    searchable: false
                },
                {
                    data: null,
                    name: 'kelurahan',
                    searchable: false,
                    render: function (data, type, row) {
                        if (row.pasien &&
                            row.pasien.villageData &&
                            row.pasien.villageData.name) {
                            return row.pasien.villageData.name;
                        }

                        return '-';
                    }
                },
                {
                    data: 'pasien.alamat',
                    name: 'alamat',
                    searchable: false
                },
                {
                    data: 'pasien.rt',
                    name: 'rt',
                    searchable: false
                },
                {
                    data: 'pasien.rw',
                    name: 'rw',
                    searchable: false
                },
                                {
                    data: 'pasien.no_hp',
                    name: 'no_hp',
                    searchable: false
                },
                {
                    // Define the custom action column
                    // Use the "render" function to generate custom content
                    render: function (data, type, row) {
                        let classEdit = 'btn-info';
                        if(row.is_data_complete == 0){
                            classEdit = 'btn-warning';
                        }
                let phone = row.pasien.no_hp ?? "";

                // Normalize phone number
                phone = phone.replace(/\D/g, "");
                if (phone.startsWith("0")) {
                    phone = "62" + phone.substring(1);
                }

                const message = `Selamat pagi. Bpk/Ibu ${row.pasien.nama}, mengingatkan untuk bulan ini waktunya CEK LAB LENGKAP PROLANIS yang dicover secara GRATIS oleh BPJS

                ▪️Untuk Persiapan pemeriksaan LAB LENGKAP PROLANIS Bpk/Ibu ${row.pasien.nama}:

                1. WAJIB puasa satu hari sebelum tanggal yang dipilih, maksimal makan minum jam 10 malam.
                2. Puasa dilakukan selama 10 jam sebelum cek lab dan hanya boleh minum air putih.
                3. Pemeriksaan lab dilakukan di Puskesmas Rampal Celaket pada jam 09.00.
                4. Menyiapkan KTP atau BPJS asli/fotokopi untuk kelengkapan data.
                5. Mohon konfirmasi dengan membalas Whatsapp ini dengan tanggal yang diinginkan (selain tanggal merah dan hari minggu).

                Terimakasih 🙏

                ▪️*NB :*
                Pemeriksaan LAB LENGKAP PROLANIS ini dapat dilakukan rutin setiap 6 bulan sekali.`;

                const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;

                let actionBtn = `
                <div class="d-flex align-items-center justify-content-around">
                    <a target="_blank"
                    href="${whatsappUrl}"
                    class="btn btn-sm btn-success"
                    data-bs-toggle="tooltip"
                    title="Kirim WhatsApp">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                </div>`;
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
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection