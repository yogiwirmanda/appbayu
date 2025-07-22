@extends('master.blank')
@section('content')
<table class="table table-flush table-bordered" id="table-ht" style="text-transform: uppercase;">
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
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
            <th>KONTROL</th>
            <th>KIMIA DARAH</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection
@section('page-scripts')
<script>
    var table = $('#table-ht').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: "{{ route('ajax_load_pemeriksaan_ht') }}?year=<?php echo $year ?>&pasien=<?php echo $idPasien ?>",
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
                data: 'kontrol1',
                name: 'kontrol1',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah1',
                name: 'kimiaDarah1',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol2',
                name: 'kontrol2',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah2',
                name: 'kimiaDarah2',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol3',
                name: 'kontrol3',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah3',
                name: 'kimiaDarah3',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol4',
                name: 'kontrol4',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah4',
                name: 'kimiaDarah4',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol5',
                name: 'kontrol5',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah5',
                name: 'kimiaDarah5',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol6',
                name: 'kontrol6',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah6',
                name: 'kimiaDarah6',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol7',
                name: 'kontrol7',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah7',
                name: 'kimiaDarah7',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol8',
                name: 'kontrol8',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah8',
                name: 'kimiaDarah8',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol9',
                name: 'kontrol9',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah9',
                name: 'kimiaDarah9',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol10',
                name: 'kontrol10',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah10',
                name: 'kimiaDarah10',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol11',
                name: 'kontrol11',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah11',
                name: 'kimiaDarah11',
                class : 'no-uppercase'
            },
            {
                data: 'kontrol12',
                name: 'kontrol12',
                class : 'no-uppercase'
            },
            {
                data: 'kimiaDarah12',
                name: 'kimiaDarah12',
                class : 'no-uppercase'
            },
        ]
    });
</script>
@endsection