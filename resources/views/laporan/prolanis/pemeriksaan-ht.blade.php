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
            <td class="{{ $data['kontrol1'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol1']}}</td>
            <td class="{{ $data['kimiaDarah1'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah1']}}</td>
            <td class="{{ $data['kontrol2'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol2']}}</td>
            <td class="{{ $data['kimiaDarah2'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah2']}}</td>
            <td class="{{ $data['kontrol3'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol3']}}</td>
            <td class="{{ $data['kimiaDarah3'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah3']}}</td>
            <td class="{{ $data['kontrol4'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol4']}}</td>
            <td class="{{ $data['kimiaDarah4'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah4']}}</td>
            <td class="{{ $data['kontrol5'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol5']}}</td>
            <td class="{{ $data['kimiaDarah5'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah5']}}</td>
            <td class="{{ $data['kontrol6'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol6']}}</td>
            <td class="{{ $data['kimiaDarah6'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah6']}}</td>
            <td class="{{ $data['kontrol7'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol7']}}</td>
            <td class="{{ $data['kimiaDarah7'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah7']}}</td>
            <td class="{{ $data['kontrol8'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol8']}}</td>
            <td class="{{ $data['kimiaDarah8'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah8']}}</td>
            <td class="{{ $data['kontrol9'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol9']}}</td>
            <td class="{{ $data['kimiaDarah9'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah9']}}</td>
            <td class="{{ $data['kontrol10'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol10']}}</td>
            <td class="{{ $data['kimiaDarah10'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah10']}}</td>
            <td class="{{ $data['kontrol11'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol11']}}</td>
            <td class="{{ $data['kimiaDarah11'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah11']}}</td>
            <td class="{{ $data['kontrol12'] != 0 ? '' : 'bg-white' }}">{{$data['kontrol12']}}</td>
            <td class="{{ $data['kimiaDarah12'] != 0 ? '' : 'bg-white' }}">{{$data['kimiaDarah12']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>