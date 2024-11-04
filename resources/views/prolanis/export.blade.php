<table>
    <thead>
        <tr>
            <td>No</td>
            <td>No RM</td>
            <td>Nama</td>
            <td>Alamat</td>
            <td>TTL</td>
            <td>Umur</td>
            <td>No BPJS</td>
        </tr>
    </thead>
    <tbody>
        @foreach($dataPasien as $key => $pasien)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>
              {{ $pasien['no_rm'] }}
            </td>
            <td>{{ $pasien['nama'] }}</td>
            <td>{{ $pasien['alamat'] }}</td>
            <td>{{ $pasien['tgl_lahir'] }}</td>
            <td>{{ $pasien['thn'] }} Tahun {{ $pasien['bln'] }} Bulan {{ $pasien['hr'] }} Hari</td>
            <td>{{ $pasien['no_bpjs'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>