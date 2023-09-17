<?php
namespace App\Http\Controllers\Export;

use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\Diagnosa;
use App\Models\Klpcm;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PasienExport implements FromView
{

    protected $tgl;

    function __construct($tgl) {
        $this->tgl = $tgl;
    }

    public function checkAge($borndate){
        $tglLahir = date_create($borndate);
        $dateNow = date_create(Date('Y-m-d'));
        $dateDiff = date_diff($tglLahir, $dateNow);
        $dataReturn['thn'] = $dateDiff->y;
        $dataReturn['bln'] = $dateDiff->m;
        $dataReturn['hr'] = $dateDiff->d;
        return $dataReturn;
    }
    public function getData()
    {
        $tglSeparate = explode('|||', $this->tgl);
        $data = Kunjungan::select('kunjungans.*', 'kunjungans.jenis_pasien as jpk', 'pasiens.no_rm', 'pasiens.nama', 'pasiens.jk', 'pasiens.alamat', 'pasiens.tgl_lahir', 'kunjungans.bayar', 'kunjungans.no_bpjs', 'polis.nama as namaPoli')
            ->join('pasiens', 'pasiens.id', 'kunjungans.id_pasien')
            ->join('polis', 'polis.id', 'kunjungans.id_poli')
            ->whereDate('kunjungans.created_at', '>=', $tglSeparate[0])
            ->whereDate('kunjungans.created_at', '<=', $tglSeparate[1])
            ->get();
        $dataReturn = [];
        foreach ($data as $key => $value) {
            switch ($value->jenis_kasus) {
                case 0:
                    $jenisKasus = 'Lama';
                    break;
                case 1:
                    $jenisKasus = 'Baru';
                    break;
                case 2:
                    $jenisKasus = 'KKL';
                    break;

                default:
                    $jenisKasus = 'Lama';
                    break;
            }
            $modelDiagnosa = Diagnosa::find($value->diagnosa_main);
            $modelKlpcm = Klpcm::where('id_kunjungan', $value->id)->first();
            $diagnosaDetail = '';
            $keteranganDetail = '';
            if ($modelDiagnosa){
                $diagnosaDetail = $modelDiagnosa->kode_icd;
            }
            if ($modelKlpcm){
                $keteranganDetail = $modelKlpcm->poli_rujukan . ' - ' . $modelKlpcm->rs_rujukan;
            }
            $dataTemp = [];
            $dataAge = [];
            $dataTemp = $value->toArray();
            $dataTemp['diagnosaDetail'] = $diagnosaDetail;
            $dataTemp['jenis_kasus'] = $jenisKasus;
            $dataTemp['keterangan'] = $keteranganDetail;
            $dataAge = self::checkAge($value->tgl_lahir);
            $dataReturn[] = array_merge($dataTemp, $dataAge);
        }

        return $dataReturn;
    }

    public function view(): View
    {
        $pasien = self::getData();
        return view('pasien.export', ['dataPasien' => $pasien]);
    }
}
