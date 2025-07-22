@extends('master.blank')
@section('content')
<table class="table table-flush table-bordered" id="table-dm" style="text-transform: uppercase;">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">No RM</th>
            <th rowspan="2">Nama Pasien</th>
            <th colspan="2" class="text-center">Jan</th>
            <th colspan="2" class="text-center">Feb</th>
            <th colspan="2" class="text-center">Mar</th>
            <th colspan="2" class="text-center">Apr</th>
            <th colspan="2" class="text-center">Mei</th>
            <th colspan="2" class="text-center">Jun</th>
            <th colspan="2" class="text-center">Jul</th>
            <th colspan="2" class="text-center">Agu</th>
            <th colspan="2" class="text-center">Sep</th>
            <th colspan="2" class="text-center">Okt</th>
            <th colspan="2" class="text-center">Nov</th>
            <th colspan="2" class="text-center">Des</th>
        </tr>
        <tr>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
            <th>GDP</th>
            <th>HBA1C</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection
@section('page-scripts')
<script>
    var table = $('#table-dm').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: "{{ route('ajax_load_pemeriksaan_dm') }}?year=<?php echo $year ?>&pasien=<?php echo $idPasien ?>",
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'no_rm',
                name: 'no_rm',
                class : 'no-uppercase'
            },
            {
                data: 'nama',
                name: 'nama',
                class : 'no-uppercase'
            },
            {
                data: 'gdp1',
                name: 'gdp1',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c1',
                name: 'hba1c1',
                class : 'no-uppercase'
            },
            {
                data: 'gdp2',
                name: 'gdp2',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c2',
                name: 'hba1c2',
                class : 'no-uppercase'
            },
            {
                data: 'gdp3',
                name: 'gdp3',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c3',
                name: 'hba1c3',
                class : 'no-uppercase'
            },
            {
                data: 'gdp4',
                name: 'gdp4',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c4',
                name: 'hba1c4',
                class : 'no-uppercase'
            },
            {
                data: 'gdp5',
                name: 'gdp5',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c5',
                name: 'hba1c5',
                class : 'no-uppercase'
            },
            {
                data: 'gdp6',
                name: 'gdp6',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c6',
                name: 'hba1c6',
                class : 'no-uppercase'
            },
            {
                data: 'gdp7',
                name: 'gdp7',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c7',
                name: 'hba1c7',
                class : 'no-uppercase'
            },
            {
                data: 'gdp8',
                name: 'gdp8',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c8',
                name: 'hba1c8',
                class : 'no-uppercase'
            },
            {
                data: 'gdp9',
                name: 'gdp9',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c9',
                name: 'hba1c9',
                class : 'no-uppercase'
            },
            {
                data: 'gdp10',
                name: 'gdp10',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c10',
                name: 'hba1c10',
                class : 'no-uppercase'
            },
            {
                data: 'gdp11',
                name: 'gdp11',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c11',
                name: 'hba1c11',
                class : 'no-uppercase'
            },
            {
                data: 'gdp12',
                name: 'gdp12',
                class : 'no-uppercase'
            },
            {
                data: 'hba1c12',
                name: 'hba1c12',
                class : 'no-uppercase'
            },
        ]
    });
</script>
@endsection