<table>
    <thead>
        <tr>
            <td rowspan="3">No</td>
            <td colspan="2">No RM</td>
            <td rowspan="3">Nama</td>
            <td rowspan="3">Alamat</td>
            <td rowspan="3">TTL</td>
            <td colspan="6">Umur</td>
            <td rowspan="3">Kepersertaan</td>
            <td rowspan="3">No BPJS</td>
            <td rowspan="3">Poli</td>
            <td rowspan="3">Diagnosa</td>
            <td rowspan="3">Jenis Kasus</td>
        </tr>
        <tr>
            <td rowspan="2">BARU</td>
            <td rowspan="2">LAMA</td>
            <td colspan="3">L</td>
            <td colspan="3">P</td>
        </tr>
        <tr>
            <td>TH</td>
            <td>BLN</td>
            <td>HR</td>
            <td>TH</td>
            <td>BLN</td>
            <td>HR</td>
        </tr>
    </thead>
    <tbody>
        @foreach($dataPasien as $key => $pasien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
                @if($pasien['jpk'] == 1)
                {{ $pasien['no_rm'] }}
                @endif
            </td>
            <td>
                @if($pasien['jpk'] == 2)
                {{ $pasien['no_rm'] }}
                @endif
            </td>
            <td>{{ $pasien['nama'] }}</td>
            <td>{{ $pasien['alamat'] }}</td>
            <td>{{ $pasien['tgl_lahir'] }}</td>
            <td>{{ ($pasien['jk'] == 'L' ? $pasien['thn'] : '') }}</td>
            <td>{{ ($pasien['jk'] == 'L' ? $pasien['bln'] : '') }}</td>
            <td>{{ ($pasien['jk'] == 'L' ? $pasien['hr'] : '') }}</td>
            <td>{{ ($pasien['jk'] == 'P' ? $pasien['thn'] : '') }}</td>
            <td>{{ ($pasien['jk'] == 'P' ? $pasien['bln'] : '') }}</td>
            <td>{{ ($pasien['jk'] == 'P' ? $pasien['hr'] : '') }}</td>
            <td>{{ $pasien['bayar'] }}</td>
            <td>{{ $pasien['no_bpjs'] }}</td>
            <td>{{ $pasien['namaPoli'] }}</td>
            <td>{{ $pasien['diagnosaDetail'] }}</td>
            <td>{{ $pasien['jenis_kasus'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>