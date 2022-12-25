
<table class="table table-flush table-bordered" id="table-ht" style="text-transform: uppercase;">
    <thead>
        <tr>
            <th>No</th>
            <th>No RM</th>
            <th>Nama Pasien</th>
            <th class="text-center">Jan</th>
            <th class="text-center">Feb</th>
            <th class="text-center">Mar</th>
            <th class="text-center">Apr</th>
            <th class="text-center">Mei</th>
            <th class="text-center">Jun</th>
            <th class="text-center">Jul</th>
            <th class="text-center">Agu</th>
            <th class="text-center">Sep</th>
            <th class="text-center">Okt</th>
            <th class="text-center">Nov</th>
            <th class="text-center">Des</th>
        </tr>
    </thead>
    <tbody>
        @if (count($dataLaporanKunjungan) > 0)
            @foreach($dataLaporanKunjungan as $key => $data)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$data['no_rm']}}</td>
                <td>{{$data['nama']}}</td>
                <td>{{$data['januari']}}</td>
                <td>{{$data['februari']}}</td>
                <td>{{$data['maret']}}</td>
                <td>{{$data['april']}}</td>
                <td>{{$data['mei']}}</td>
                <td>{{$data['juni']}}</td>
                <td>{{$data['juli']}}</td>
                <td>{{$data['agustus']}}</td>
                <td>{{$data['september']}}</td>
                <td>{{$data['oktober']}}</td>
                <td>{{$data['november']}}</td>
                <td>{{$data['desember']}}</td>
            </tr>
            @endforeach
        @else
            <tr class="text-center">
                <td colspan="15">Tidak Ada Data</td>
            </tr>
        @endif
    </tbody>
</table>