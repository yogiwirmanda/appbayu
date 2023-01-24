<div class="table-responsive">
    <table class="table table-flush" id="datatable-basic-with-export"
        style="text-transform: uppercase;">
        <thead>
            <th>No</th>
            <th>Nama Ruang</th>
            <th>Lengkap</th>
            <th>Tidak Lengkap</th>
        </thead>
        <tbody>
            @foreach($dataLaporan as $key => $data)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{'POLI '.$data['namaPoli']}}</td>
                <td>{{$data['totalPasienLengkap'].'%'}}</td>
                <td>{{$data['totalPasienTidakLengkap'].'%'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>