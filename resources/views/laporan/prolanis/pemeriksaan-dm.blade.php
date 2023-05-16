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
        @foreach($dataLaporanKunjungan as $key => $data)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$data['no_rm']}}</td>
            <td>{{$data['nama']}}</td>
            <td class="{{ $data['gdp1'] != 0 ? '' : 'bg-white' }}">{{$data['gdp1']}}</td>
            <td class="{{ $data['hba1c1'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c1']}}</td>
            <td class="{{ $data['gdp2'] != 0 ? '' : 'bg-white' }}">{{$data['gdp2']}}</td>
            <td class="{{ $data['hba1c2'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c2']}}</td>
            <td class="{{ $data['gdp3'] != 0 ? '' : 'bg-white' }}">{{$data['gdp3']}}</td>
            <td class="{{ $data['hba1c3'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c3']}}</td>
            <td class="{{ $data['gdp4'] != 0 ? '' : 'bg-white' }}">{{$data['gdp4']}}</td>
            <td class="{{ $data['hba1c4'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c4']}}</td>
            <td class="{{ $data['gdp5'] != 0 ? '' : 'bg-white' }}">{{$data['gdp5']}}</td>
            <td class="{{ $data['hba1c5'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c5']}}</td>
            <td class="{{ $data['gdp6'] != 0 ? '' : 'bg-white' }}">{{$data['gdp6']}}</td>
            <td class="{{ $data['hba1c6'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c6']}}</td>
            <td class="{{ $data['gdp7'] != 0 ? '' : 'bg-white' }}">{{$data['gdp7']}}</td>
            <td class="{{ $data['hba1c7'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c7']}}</td>
            <td class="{{ $data['gdp8'] != 0 ? '' : 'bg-white' }}">{{$data['gdp8']}}</td>
            <td class="{{ $data['hba1c8'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c8']}}</td>
            <td class="{{ $data['gdp9'] != 0 ? '' : 'bg-white' }}">{{$data['gdp9']}}</td>
            <td class="{{ $data['hba1c9'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c9']}}</td>
            <td class="{{ $data['gdp10'] != 0 ? '' : 'bg-white' }}">{{$data['gdp10']}}</td>
            <td class="{{ $data['hba1c10'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c10']}}</td>
            <td class="{{ $data['gdp11'] != 0 ? '' : 'bg-white' }}">{{$data['gdp11']}}</td>
            <td class="{{ $data['hba1c11'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c11']}}</td>
            <td class="{{ $data['gdp12'] != 0 ? '' : 'bg-white' }}">{{$data['gdp12']}}</td>
            <td class="{{ $data['hba1c12'] != 0 ? '' : 'bg-white' }}">{{$data['hba1c12']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>