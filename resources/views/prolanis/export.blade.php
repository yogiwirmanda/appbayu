<table>
    <thead>
        <tr>
            <td>No</td>
            <td>No RM</td>
            <td>Nama</td>
            <td>No Telp</td>
            <td>Alamat</td>
            <td>Kelurahan</td>
            <td>RT</td>
            <td>RW</td>
            <td>TTL</td>
            <td>Umur</td>
            <td>Keterangan</td>
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
            <td>{{ $pasien['no_hp'] }}</td>
            <td>{{ $pasien['alamat'] }}</td>
            <td>{{ $pasien['kelurahan'] }}</td>
            <td>{{ $pasien['rt'] }}</td>
            <td>{{ $pasien['rw'] }}</td>
            <td>{{ $pasien['tgl_lahir'] }}</td>
            <td>{{ $pasien['thn'] }} Tahun {{ $pasien['bln'] }} Bulan {{ $pasien['hr'] }} Hari</td>
            <td>{{ $pasien['keterangan_prolanis'] }}</td>
            <td>{{ $pasien['no_bpjs'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>