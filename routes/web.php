<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntreanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\RumahsakitController;
use App\Http\Controllers\RujukanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlpcmController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PrbController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\RetensiController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuratSehatController;
use App\Http\Controllers\UnitTestController;

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login_show');
Route::post('login', [AuthController::class, 'login'])->name('login_post');
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('regency/check/city', [RegencyController::class, 'getDataCity'])->name('load_data_city');
Route::get('regency/check/district', [RegencyController::class, 'getDataDistrict'])->name('load_data_district');
Route::get('regency/check/villages', [RegencyController::class, 'getDataVillages'])->name('load_data_villages');

Route::get('/antrean-online', [AntreanController::class, 'index'])->name('antrean-online');
Route::post('/antrean-online/save', [AntreanController::class, 'store'])->name('save_antrean');
Route::get('/antrean-online/result/{id}', [AntreanController::class, 'result'])->name('result_antrean');
Route::get('/antrean-online/cetak/{id}', [AntreanController::class, 'cetak'])->name('cetak_antrean');

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('pasien', [PasienController::class, 'index'])->name('daftar_pasien');
    Route::get('pasien/create', [PasienController::class, 'create'])->name('tambah_pasien');
    Route::get('pasien/choose/{id}', [PasienController::class, 'choose'])->name('choose_pasien');
    Route::get('pasien/createAdmin', [PasienController::class, 'createAdmin'])->name('tambah_pasien_admin');
    Route::post('pasien/store', [PasienController::class, 'store'])->name('save_pasien');
    Route::post('pasien/storeAdmin', [PasienController::class, 'storeAdmin'])->name('save_pasien_admin');
    Route::get('pasien/edit/{param}', [PasienController::class, 'edit'])->name('edit_pasien');
    Route::get('pasien/destroy/{param}', [PasienController::class, 'destroy'])->name('delete_pasien');
    Route::post('pasien/update', [PasienController::class, 'update'])->name('save_edit_pasien');
    Route::get('pasien/check/checkStatusPasien', [PasienController::class, 'checkStatusPasien'])->name('cek_status_pasien');
    Route::get('pasien/check/getFromKepalaKeluarga', [PasienController::class, 'getFromKepalaKeluarga'])->name('get_from_kepala_keluarga');
    Route::get('pasien/check/getDetailPasien', [PasienController::class, 'getDetailPasien'])->name('get_detail_pasien');
    Route::get('pasien/cariData', [PasienController::class, 'cariData'])->name('cari_data_pasien');
    Route::get('pasiens/check/norm', [PasienController::class, 'checkNoRM'])->name('cek_no_rm');
    Route::get('pasiens/check/nik/{nik}', [PasienController::class, 'getDataFromNIK'])->name('getDataFromNIK');
    Route::get('pasiens/dtAjax', [PasienController::class, 'dtAjax'])->name('ajax_load_pasien');
    Route::get('pasiens/dtAjaxProlanis', [PasienController::class, 'dtAjaxProlanis'])->name('ajax_load_prolanis');
    Route::get('pasiens/dtAjaxProlanisRiwayat', [PasienController::class, 'dtAjaxProlanisRiwayat'])->name('ajax_load_prolanis_riwayat');
    Route::get('pasiens/detail/{pasienId}', [PasienController::class, 'detailPasien'])->name('detail_pasien');
    Route::get('pasiens/dtAjaxKunjungan/{pasienId}', [PasienController::class, 'dtAjaxKunjungan'])->name('dtAjaxKunjungan');

    Route::get('pasien/download/ci/{idPasien}', [PasienController::class, 'downloadCI'])->name('pasien_download_ci');
    Route::get('pasien/download/ci2/{idPasien}', [PasienController::class, 'downloadCI2'])->name('pasien_download_ci2');
    Route::get('pasien/download/gigimulut/{idPasien}', [PasienController::class, 'downloadGigiMulut'])->name('pasien_download_gigi_mulut');
    Route::get('pasien/download/cet/{idPasien}', [PasienController::class, 'downloadCet'])->name('pasien_download_cet');
    Route::get('pasien/download/gc/{idPasien}', [PasienController::class, 'downloadGc'])->name('pasien_download_gc');
    Route::get('pasien/download/pak/{idPasien}', [PasienController::class, 'downloadPak'])->name('pasien_download_pak');
    Route::get('pasien/download/prolanis/{idPasien}', [PasienController::class, 'downloadProlanis'])->name('pasien_download_prolanis');
    Route::get('pasien/download/ss/{idKunjungan}', [PasienController::class, 'downloadSuratSehat'])->name('pasien_download_ss');
    Route::get('pasien/download/catin/{idKunjungan}', [PasienController::class, 'downloadCatin'])->name('pasien_download_catin');

    Route::get('kunjungan', [KunjunganController::class, 'index'])->name('kunjungan_pasien');
    Route::get('kunjungan/create/{param}/{type?}', [KunjunganController::class, 'create'])->name('kunjungan_pasien_create');
    Route::get('kunjungan/edit/{param}', [KunjunganController::class, 'edit'])->name('kunjungan_pasien_edit');
    Route::get('kunjungan/delete/{param}', [KunjunganController::class, 'delete'])->name('kunjungan_pasien_delete');
    Route::post('kunjungan/update', [KunjunganController::class, 'update'])->name('kunjungan_pasien_update');
    Route::post('kunjungan/pasien/save', [KunjunganController::class, 'store'])->name('kunjungan_pasien_save');
    Route::get('kunjungans/klpcm/{param}', [KunjunganController::class, 'klpcm'])->name('kunjungan_klpcm');
    Route::get('kunjungans/harian/{param}', [KunjunganController::class, 'index'])->name('kunjunganHarian');
    Route::get('kunjungan/dtAjax', [KunjunganController::class, 'dtAjax'])->name('ajax_load_kunjungan');
    Route::get('kunjungan/form', [KunjunganController::class, 'formKunjungan'])->name('formKunjungan');

    Route::get('klpcms/check/icd', [KlpcmController::class, 'checkIcd'])->name('cari_data_diagnosa');
    Route::get('klpcms/check/obat', [KlpcmController::class, 'checkObat'])->name('cari_data_obat');
    Route::get('klpcms/index/{param}', [KlpcmController::class, 'index'])->name('klpcm_index');
    Route::post('klpcms/save', [KlpcmController::class, 'store'])->name('save_klpcm');

    Route::get('cetak/{param}', [PrintController::class, 'index'])->name('Cetak');
    Route::get('reusedRM/{param}/{param1}/{param2}/{param3}', [PasienController::class, 'reusedRM'])->name('reusedRM');
    Route::get('cek/formPasien', [PasienController::class, 'formPasien'])->name('pasien_form');

    Route::get('setting/nomor', [SettingController::class, 'index'])->name('setting_nomor');
    Route::get('setting/cek', [SettingController::class, 'nomorCek'])->name('setting_cek');
    Route::get('setting/set/nomor', [SettingController::class, 'reusedRM'])->name('setting_set_nomor');
    Route::get('setting/kk', [SettingController::class, 'kk'])->name('setting_kk');
    Route::get('setting/dtAjax', [SettingController::class, 'dtAjaxSetKK'])->name('ajax_load_set_kk');
    Route::post('setting/save/kk', [SettingController::class, 'saveKK'])->name('setting_save_kk');

    Route::get('prolanis', [PasienController::class, 'prolanis'])->name('show_prolanis');
    Route::get('prolanis/filter/{val}', [PasienController::class, 'prolanisFilter'])->name('show_prolanis_filter');
    Route::get('prolanis/create', [PasienController::class, 'prolanisCreate'])->name('create_prolanis');
    Route::get('prolanis/check', [PasienController::class, 'checkProlanis'])->name('check_prolanis');
    Route::get('prolanis/save', [PasienController::class, 'saveProlanis'])->name('save_prolanis');
    Route::get('prolanis/remove/{pasienId}', [PasienController::class, 'removeProlanis'])->name('remove_prolanis');
    Route::get('prolanis/riwayat/{pasienId}', [PasienController::class, 'riwayat'])->name('prolanis_riwayat');

    Route::get('prb', [PrbController::class, 'index'])->name('show_prb');
    Route::get('prb/create', [PrbController::class, 'create'])->name('create_prb');
    Route::post('prb/save', [PrbController::class, 'store'])->name('save_prb');
    Route::get('prb/edit', [PrbController::class, 'edit'])->name('edit_prb');
    Route::get('prb/dtAjax', [PrbController::class, 'dtAjax'])->name('ajax_load_prb');
    Route::get('prb/download/{idPasien}', [PrbController::class, 'download'])->name('prb_download');
    Route::get('prb/downloadDokter/{idPasien}', [PrbController::class, 'downloadDokter'])->name('prb_download_dokter');

    Route::get('dokter', [DokterController::class, 'index'])->name('show_dokter');
    Route::get('dokter/create', [DokterController::class, 'create'])->name('create_dokter');
    Route::post('dokter/save', [DokterController::class, 'store'])->name('save_dokter');
    Route::get('dokter/edit/{param}', [DokterController::class, 'edit'])->name('edit_dokter');
    Route::post('dokter/update', [DokterController::class, 'update'])->name('update_dokter');
    Route::get('dokter/destroy/{param}', [DokterController::class, 'delete'])->name('delete_dokter');
    Route::get('dokter/dtAjax', [DokterController::class, 'dtAjax'])->name('ajax_load_dokter');

    Route::get('pekerjaan', [PekerjaanController::class, 'index'])->name('show_pekerjaan');
    Route::get('pekerjaan/create', [PekerjaanController::class, 'create'])->name('create_pekerjaan');
    Route::post('pekerjaan/save', [PekerjaanController::class, 'store'])->name('save_pekerjaan');
    Route::get('pekerjaan/edit/{param}', [PekerjaanController::class, 'edit'])->name('edit_pekerjaan');
    Route::post('pekerjaan/update', [PekerjaanController::class, 'update'])->name('update_pekerjaan');
    Route::get('pekerjaan/destroy/{param}', [PekerjaanController::class, 'delete'])->name('delete_pekerjaan');
    Route::get('pekerjaan/dtAjax', [PekerjaanController::class, 'dtAjax'])->name('ajax_load_pekerjaan');

    Route::get('rumahsakit', [RumahsakitController::class, 'index'])->name('show_rumahsakit');
    Route::get('rumahsakit/create', [RumahsakitController::class, 'create'])->name('create_rumahsakit');
    Route::post('rumahsakit/save', [RumahsakitController::class, 'store'])->name('save_rumahsakit');
    Route::get('rumahsakit/edit/{param}', [RumahsakitController::class, 'edit'])->name('edit_rumahsakit');
    Route::post('rumahsakit/update', [RumahsakitController::class, 'update'])->name('update_rumahsakit');
    Route::get('rumahsakit/destroy/{param}', [RumahsakitController::class, 'delete'])->name('delete_rumahsakit');
    Route::get('rumahsakit/dtAjax', [RumahsakitController::class, 'dtAjax'])->name('ajax_load_rumahsakit');

    Route::get('poli-rujukan', [RujukanController::class, 'index'])->name('show_poli_rujukan');
    Route::get('poli-rujukan/create', [RujukanController::class, 'create'])->name('create_poli_rujukan');
    Route::post('poli-rujukan/save', [RujukanController::class, 'store'])->name('save_poli_rujukan');
    Route::get('poli-rujukan/edit/{param}', [RujukanController::class, 'edit'])->name('edit_poli_rujukan');
    Route::post('poli-rujukan/update', [RujukanController::class, 'update'])->name('update_poli_rujukan');
    Route::get('poli-rujukan/destroy/{param}', [RujukanController::class, 'delete'])->name('delete_poli_rujukan');
    Route::get('poli-rujukan/dtAjax', [RujukanController::class, 'dtAjax'])->name('ajax_load_poli_rujukan');

    Route::get('diagnosa', [DiagnosaController::class, 'index'])->name('show_diagnosa');
    Route::get('diagnosa/create', [DiagnosaController::class, 'create'])->name('create_diagnosa');
    Route::post('diagnosa/save', [DiagnosaController::class, 'store'])->name('save_diagnosa');
    Route::get('diagnosa/edit/{param}', [DiagnosaController::class, 'edit'])->name('edit_diagnosa');
    Route::post('diagnosa/update', [DiagnosaController::class, 'update'])->name('update_diagnosa');
    Route::get('diagnosa/destroy/{param}', [DiagnosaController::class, 'delete'])->name('delete_diagnosa');
    Route::get('diagnosa/dtAjax', [DiagnosaController::class, 'dtAjax'])->name('ajax_load_diagnosa');

    Route::get('poli', [PoliController::class, 'index'])->name('show_poli');
    Route::get('poli/create', [PoliController::class, 'create'])->name('create_poli');
    Route::post('poli/save', [PoliController::class, 'store'])->name('save_poli');
    Route::get('poli/edit/{param}', [PoliController::class, 'edit'])->name('edit_poli');
    Route::post('poli/update', [PoliController::class, 'update'])->name('update_poli');
    Route::get('poli/destroy/{param}', [PoliController::class, 'delete'])->name('delete_poli');
    Route::get('poli/dtAjax}', [PoliController::class, 'dtAjax'])->name('ajax_load_poli');

    Route::get('surat-sehat', [SuratSehatController::class, 'index'])->name('show_surat_sehat');
    Route::get('surat-sehat/create', [SuratSehatController::class, 'create'])->name('create_surat_sehat');
    Route::post('surat-sehat/save', [SuratSehatController::class, 'store'])->name('save_surat_sehat');
    Route::get('surat-sehat/edit/{param}', [SuratSehatController::class, 'edit'])->name('edit_surat_sehat');
    Route::post('surat-sehat/update', [SuratSehatController::class, 'update'])->name('update_surat_sehat');
    Route::get('surat-sehat/destroy/{param}', [SuratSehatController::class, 'delete'])->name('delete_surat_sehat');

    Route::get('obat', [ObatController::class, 'index'])->name('show_obat');
    Route::get('obat/create', [ObatController::class, 'create'])->name('create_obat');
    Route::post('obat/save', [ObatController::class, 'store'])->name('save_obat');
    Route::get('obat/edit/{param}', [ObatController::class, 'edit'])->name('edit_obat');
    Route::post('obat/update', [ObatController::class, 'update'])->name('update_obat');
    Route::get('obat/destroy/{param}', [ObatController::class, 'delete'])->name('delete_obat');
    Route::get('obat/dtAjax', [ObatController::class, 'dtAjax'])->name('ajax_load_obat');

    Route::get('laporan/klpcm', [LaporanController::class, 'klpcm'])->name('laporan_klpcm');
    Route::get('laporan/klpcm/load', [LaporanController::class, 'loadKlpcm'])->name('laporan_klpcm_filter');

    Route::get('laporan/prolanis', [LaporanController::class, 'prolanis'])->name('laporan_prolanis');
    Route::get('laporan/prolanis/dtAjax', [LaporanController::class, 'dtAjaxProlanis'])->name('ajax_load_laporan_prolanis');

    Route::get('laporan/kunjungan', [LaporanController::class, 'kunjungan'])->name('laporan_kunjungan_default');
    Route::get('laporan/kunjungan/filter/{month}/{year}', [LaporanController::class, 'kunjungan'])->name('laporan_kunjungan');
    Route::get('laporan/lb1', [LaporanController::class, 'lb1'])->name('laporan_lb1');
    Route::get('laporan/lb1Download/{month}', [LaporanController::class, 'lb1Download'])->name('laporan_lb1_download');
    Route::get('pasien/export', [PasienController::class, 'export'])->name('pasien_export_daily');
    Route::get('pasien/export/{date}', [PasienController::class, 'export'])->name('pasien_export_date');

    Route::get('laporan/pemeriksaan', [LaporanController::class, 'pemeriksaan'])->name('laporan_pemeriksaan');
    Route::get('laporan/pemeriksaan/dm', [LaporanController::class, 'pemeriksaanDM'])->name('laporan_pemeriksaan_dm');
    Route::get('laporan/pemeriksaan/dm/{idPasien}', [LaporanController::class, 'pemeriksaanDMWithId'])->name('laporan_pemeriksaan_dm_with_id');
    Route::get('laporan/pemeriksaan/ht', [LaporanController::class, 'pemeriksaanHT'])->name('laporan_pemeriksaan_ht');
    Route::get('laporan/pemeriksaan/ht/{idPasien}', [LaporanController::class, 'pemeriksaanHTWithId'])->name('laporan_pemeriksaan_ht_with_id');
    // Route::get('laporan/pemeriksaan/{type}/{date}', [LaporanController::class, 'pemeriksaan'])->name('laporan_pemeriksaan_filter');

    Route::get('antrean/', [AntreanController::class, 'list'])->name('admin-antrean');
    Route::get('antrean/cek-data/{id}', [AntreanController::class, 'cek'])->name('antrean_cek_data');
    Route::get('antrean/choose-pasien/{id}/{pasien}', [AntreanController::class, 'choose'])->name('antrean_choose_pasien');

    Route::get('laporan/pemeriksaanPrb', [LaporanController::class, 'pemeriksaanPrb'])->name('laporan_pemeriksaan_prb');
    Route::get('laporan/pemeriksaan/prb', [LaporanController::class, 'loadPrb'])->name('loadPrb');
    Route::get('laporan/pemeriksaan/prb/{idPasien}', [LaporanController::class, 'loadPrbWithId'])->name('loadPrbWithId');

    Route::get('klpcms/check/kasus', [KlpcmController::class, 'checkKasus'])->name('check_kasus');

    Route::get('test/api/send', [UnitTestController::class, 'testSendMessage'])->name('unit_test_send_message');
    Route::get('test/getProlanis', [UnitTestController::class, 'getProlanis'])->name('unit_test_get_prolanis');

    Route::get('retensi', [RetensiController::class, 'index'])->name('retensi_index');
    Route::get('retensi/save', [RetensiController::class, 'store'])->name('retensi_save');
    Route::get('retensi/report', [RetensiController::class, 'report'])->name('retensi_report');
    Route::get('retensi/ajaxDt', [RetensiController::class, 'dtAjax'])->name('ajax_load_retensi');

    Route::get('send/whatsapp/{pasienId}', [UnitTestController::class, 'send'])->name('prolanis.send');
    Route::get('reformat/district', [UnitTestController::class, 'reformatDistrict'])->name('reformat_district');
    Route::get('reformat/head-rm', [UnitTestController::class, 'reformatHeadRM'])->name('reformat_head_rm');
    Route::get('reformat/no-urut', [UnitTestController::class, 'reformatNoUrut'])->name('reformat_no_urut');
    Route::get('reformat/data', [UnitTestController::class, 'runCompleteData'])->name('runCompleteData');

    Route::get('reformat/tanggal', [UnitTestController::class, 'reformat'])->name('reformat');
    Route::get('count-tidak-lengkap/{idPoli}', [LaporanController::class, 'countTidakLengkap'])->name('count-tidak-lengkap');
    Route::get('/laporan/klpcm/report/{idPoli}', [LaporanController::class, 'loadListTidakLengkap'])->name('report-tidak-lengkap');

    Route::get('/pasien/print/sticker/{idPasien}', [PasienController::class, 'tesPrint'])->name('tes-print-pasien');

    Route::get('/laporan/klpcm/umum', [LaporanController::class, 'loadGraphUmum'])->name('load-klpcm-umum');
    Route::get('/laporan/klpcm/kia', [LaporanController::class, 'loadGraphKia'])->name('load-klpcm-kia');
    Route::get('/laporan/klpcm/gigi', [LaporanController::class, 'loadGraphGigi'])->name('load-klpcm-gigi');
    Route::get('/laporan/klpcm/lansia', [LaporanController::class, 'loadGraphLansia'])->name('load-klpcm-lansia');

    Route::get('/antrean/list', [AntreanController::class, 'list'])->name('list_antrean');
    Route::get('/antrean/dtAjax', [AntreanController::class, 'dtAjax'])->name('ajax_load_antrean');

    Route::get('/pasien/check-available-rm', [PasienController::class, 'checkAvailRM'])->name('cek_avail_rm');
    Route::get('/pasien/check-available-rm-by-wilayah/{wilayah}', [PasienController::class, 'checkAvailableRMByWilayah'])->name('cek_avail_rm_by_wilayah');

});
