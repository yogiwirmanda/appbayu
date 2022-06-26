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
        @foreach($dataLaporanKunjungan as $key => $data)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$data['no_rm']}}</td>
            <td>{{$data['nama']}}</td>
            <td>{{$data['kontrol1']}}</td>
            <td>{{$data['kimiaDarah1']}}</td>
            <td>{{$data['kontrol2']}}</td>
            <td>{{$data['kimiaDarah2']}}</td>
            <td>{{$data['kontrol3']}}</td>
            <td>{{$data['kimiaDarah3']}}</td>
            <td>{{$data['kontrol4']}}</td>
            <td>{{$data['kimiaDarah4']}}</td>
            <td>{{$data['kontrol5']}}</td>
            <td>{{$data['kimiaDarah5']}}</td>
            <td>{{$data['kontrol6']}}</td>
            <td>{{$data['kimiaDarah6']}}</td>
            <td>{{$data['kontrol7']}}</td>
            <td>{{$data['kimiaDarah7']}}</td>
            <td>{{$data['kontrol8']}}</td>
            <td>{{$data['kimiaDarah8']}}</td>
            <td>{{$data['kontrol9']}}</td>
            <td>{{$data['kimiaDarah9']}}</td>
            <td>{{$data['kontrol10']}}</td>
            <td>{{$data['kimiaDarah10']}}</td>
            <td>{{$data['kontrol11']}}</td>
            <td>{{$data['kimiaDarah11']}}</td>
            <td>{{$data['kontrol12']}}</td>
            <td>{{$data['kimiaDarah12']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>