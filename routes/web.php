<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DokterController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('pasien', [PasienController::class, 'index'])->name('daftar_pasien');
    Route::get('pasien/create', [PasienController::class, 'create'])->name('tambah_pasien');
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

    Route::get('regency/check/city', [RegencyController::class, 'getDataCity'])->name('load_data_city');
    Route::get('regency/check/district', [RegencyController::class, 'getDataDistrict'])->name('load_data_district');
    Route::get('regency/check/villages', [RegencyController::class, 'getDataVillages'])->name('load_data_villages');

    Route::get('kunjungan', [KunjunganController::class, 'index'])->name('kunjungan_pasien');
    Route::get('kunjungan/create/{param}', [KunjunganController::class, 'create'])->name('kunjungan_pasien_create');
    Route::get('kunjungan/pasien/save', [KunjunganController::class, 'store'])->name('kunjungan_pasien_save');
    Route::get('kunjungans/klpcm/{param}', [KunjunganController::class, 'klpcm'])->name('klpcm');
    Route::get('kunjungans/harian/{param}', [KunjunganController::class, 'index'])->name('kunjunganHarian');

    Route::get('klpcms/check/icd', [KlpcmController::class, 'checkIcd'])->name('cari_data_diagnosa');
    Route::get('klpcms/check/obat', [KlpcmController::class, 'checkObat'])->name('cari_data_obat');
    Route::get('klpcms/index/{param}', [KlpcmController::class, 'index'])->name('Detail');
    Route::post('klpcms/save', [KlpcmController::class, 'store'])->name('save_klpcm');

    Route::get('cetak/{param}', [PrintController::class, 'index'])->name('Cetak');
    Route::get('reusedRM/{param}/{param1}/{param2}/{param3}', [PasienController::class, 'reusedRM'])->name('reusedRM');
    Route::get('cek/formPasien', [PasienController::class, 'formPasien'])->name('pasien_form');

    Route::get('setting/nomor', [SettingController::class, 'index'])->name('setting_nomor');
    Route::get('setting/cek', [SettingController::class, 'nomorCek'])->name('setting_cek');
    Route::get('setting/set/nomor', [SettingController::class, 'reusedRM'])->name('setting_set_nomor');

    Route::get('prolanis', [PasienController::class, 'prolanis'])->name('show_prolanis');
    Route::get('prolanis/filter/{val}', [PasienController::class, 'prolanisFilter'])->name('show_prolanis_filter');
    Route::get('prolanis/create', [PasienController::class, 'prolanisCreate'])->name('create_prolanis');
    Route::get('prolanis/check', [PasienController::class, 'checkProlanis'])->name('check_prolanis');
    Route::get('prolanis/save', [PasienController::class, 'saveProlanis'])->name('save_prolanis');

    Route::get('prb', [PrbController::class, 'index'])->name('show_prb');
    Route::get('prb/create', [PrbController::class, 'create'])->name('create_prb');
    Route::post('prb/save', [PrbController::class, 'store'])->name('save_prb');
    Route::post('prb/edit', [PrbController::class, 'edit'])->name('edit_prb');

    Route::get('dokter', [DokterController::class, 'index'])->name('show_dokter');
    Route::get('dokter/create', [DokterController::class, 'create'])->name('create_dokter');
    Route::post('dokter/save', [DokterController::class, 'store'])->name('save_dokter');
    Route::get('dokter/edit/{param}', [DokterController::class, 'edit'])->name('edit_dokter');
    Route::post('dokter/update', [DokterController::class, 'update'])->name('update_dokter');
    Route::get('dokter/destroy/{param}', [DokterController::class, 'delete'])->name('delete_dokter');

    Route::get('diagnosa', [DiagnosaController::class, 'index'])->name('show_diagnosa');
    Route::get('diagnosa/create', [DiagnosaController::class, 'create'])->name('create_diagnosa');
    Route::post('diagnosa/save', [DiagnosaController::class, 'store'])->name('save_diagnosa');
    Route::get('diagnosa/edit/{param}', [DiagnosaController::class, 'edit'])->name('edit_diagnosa');
    Route::post('diagnosa/update', [DiagnosaController::class, 'update'])->name('update_diagnosa');
    Route::get('diagnosa/destroy/{param}', [DiagnosaController::class, 'delete'])->name('delete_diagnosa');

    Route::get('poli', [PoliController::class, 'index'])->name('show_poli');
    Route::get('poli/create', [PoliController::class, 'create'])->name('create_poli');
    Route::post('poli/save', [PoliController::class, 'store'])->name('save_poli');
    Route::get('poli/edit/{param}', [PoliController::class, 'edit'])->name('edit_poli');
    Route::post('poli/update', [PoliController::class, 'update'])->name('update_poli');
    Route::get('poli/destroy/{param}', [PoliController::class, 'delete'])->name('delete_poli');

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

    Route::get('laporan/klpcm', [LaporanController::class, 'klpcm'])->name('laporan_klpcm');
    Route::get('laporan/klpcm/{type}/{date}', [LaporanController::class, 'klpcm'])->name('laporan_klpcm_filter');

    Route::get('laporan/prolanis', [LaporanController::class, 'prolanis'])->name('laporan_prolanis');
    Route::get('laporan/prolanis/{type}/{date}', [LaporanController::class, 'prolanis'])->name('laporan_prolanis_filter');

    Route::get('laporan/pemeriksaan', [LaporanController::class, 'pemeriksaan'])->name('laporan_pemeriksaan');
    Route::get('laporan/pemeriksaan/ht', [LaporanController::class, 'pemeriksaanHT'])->name('laporan_pemeriksaan_ht');
    Route::get('laporan/pemeriksaan/{type}/{date}', [LaporanController::class, 'pemeriksaan'])->name('laporan_pemeriksaan_filter');

    Route::get('klpcms/check/kasus', [KlpcmController::class, 'checkKasus'])->name('check_kasus');

    Route::get('test/api/send', [UnitTestController::class, 'testSendMessage'])->name('unit_test_send_message');
    Route::get('test/getProlanis', [UnitTestController::class, 'getProlanis'])->name('unit_test_get_prolanis');

    Route::get('retensi', [RetensiController::class, 'index'])->name('retensi_index');
    Route::get('retensi/save', [RetensiController::class, 'store'])->name('retensi_save');
    Route::get('retensi/report', [RetensiController::class, 'report'])->name('retensi_report');

    Route::get('send/whatsapp/{pasienId}', [UnitTestController::class, 'send'])->name('prolanis.send');
});
