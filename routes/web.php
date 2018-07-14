<?php

use App\Jurusan;
use App\Komponen;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/buat-akun', 'HomeController@createAdmin')->name('admin.create');

// Tahun Aktif
Route::get('admin/set-tahun-aktif', 'TahunAktifController@index')->name('set-tahun-aktif');
Route::post('admin/set-tahun-aktif', 'TahunAktifController@setTahunAktif')->name('set-tahun-aktif');

// Asesor
Route::name('admin.asesor.')->group(function () {
    Route::get('/admin/asesor', 'AsesorController@index')->name('index');
    Route::get('/admin/asesor/show/{id}', 'AsesorController@show')->name('show');
    Route::get('/admin/asesor/create', 'AsesorController@create')->name('create');
    Route::post('/admin/asesor/store', 'AsesorController@store')->name('store');
    Route::get('/admin/asesor/edit/{id}', 'AsesorController@edit')->name('edit');
    Route::post('/admin/asesor/edit/{id}', 'AsesorController@update')->name('update');
    Route::get('/admin/asesor/delete/{id}', 'AsesorController@destroy')->name('delete');
});

// Dokumen asesor
Route::name('admin.dokumen-asesor.')->group(function() {
    Route::post('/admin/dokumen-asesor/create/{id}', 'DokumenAsesorController@store')->name('create');
    Route::get('/admin/dokumen-asesor/delete/{id}', 'DokumenAsesorController@destroy')->name('delete');
});

Route::name('asesor.dokumen-asesor.')->group(function() {
    Route::get('/admin/dokumen-asesor', 'DokumenAsesorController@index')->name('index');
});

// Data diri
Route::name('asesor.data-asesor.')->group(function() {
    Route::get('asesor/data-asesor', 'AsesorController@editDataSendiri')->name('edit');
});


// Peserta
Route::name('admin.peserta.')->group(function () {
    Route::get('/admin/peserta', 'PesertaController@index')->name('index');
    Route::get('/admin/peserta/create', 'PesertaController@create')->name('create');
    Route::post('/admin/peserta/store', 'PesertaController@store')->name('store');
    Route::get('/admin/peserta/import', 'PesertaController@importView')->name('import');
    Route::post('/admin/peserta/import', 'PesertaController@import');
    Route::get('/admin/peserta/edit/{id}', 'PesertaController@edit')->name('edit');
    Route::post('/admin/peserta/edit/{id}', 'PesertaController@update')->name('update');
    Route::get('/admin/peserta/delete/{id}', 'PesertaController@destroy')->name('delete');
    Route::get('/admin/peserta/show/{id}', 'PesertaController@show')->name('show');
});


// Tahun Ajar
Route::name('admin.tahun-ajar.')->group(function () {
    Route::get('/admin/tahun-ajar', 'TahunAjarController@index')->name('index');
    Route::get('/admin/tahun-ajar/create', 'TahunAjarController@create')->name('create');
    Route::post('/admin/tahun-ajar/store', 'TahunAjarController@store')->name('store');
});

// Perusahaan
Route::name('admin.perusahaan.')->group(function () {
    Route::get('/admin/perusahaan', 'PerusahaanController@index')->name('index');
    Route::get('/admin/perusahaan/create', 'PerusahaanController@create')->name('create');
    Route::post('/admin/perusahaan/store', 'PerusahaanController@store')->name('store');
    Route::get('/admin/perusahaan/edit/{id}', 'PerusahaanController@edit')->name('edit');
    Route::post('/admin/perusahaan/edit/{id}', 'PerusahaanController@update')->name('update');
    Route::get('/admin/perusahaan/delete/{id}', 'PerusahaanController@destroy')->name('delete');
});


// Komponen
Route::name('admin.komponen.')->group(function () {
    Route::get('/admin/komponen', 'KomponenController@index')->name('index');
    Route::get('/admin/komponen/create', 'KomponenController@create')->name('create');
    Route::post('/admin/komponen/create', 'KomponenController@store');
    Route::post('/admin/komponen/create-copy', 'KomponenController@storeCopy')->name('create-copy');
    Route::get('/admin/komponen/edit/{id}', 'KomponenController@edit')->name('edit');
    Route::post('/admin/komponen/edit/{id}', 'KomponenController@update')->name('update');
    Route::get('/admin/komponen/delete/{id}', 'KomponenController@destroy')->name('delete');
    Route::get('admin/komponen/show/{id}', 'KomponenController@show')->name('show');
});

// Detail Komponen
Route::name('admin.detail-komponen.')->group(function () {
    Route::post('/admin/komponen/detail-komponen/create', 'DetailKomponenController@store')->name('create');
    Route::post('/admin/komponen/detail-komponen/edit/{id}', 'DetailKomponenController@update')->name('edit');
});

// Indikator
Route::name('admin.indikator.')->group(function () {
    Route::get('/admin/komponen/{id}/indikator/create', 'IndikatorController@create')->name('create');
    Route::post('/admin/komponen/{id}/indikator/create', 'IndikatorController@store');
    Route::get('/admin/komponen/indikator/edit/{id}', 'IndikatorController@edit')->name('edit');
    Route::post('/admin/komponen/indikator/edit/{id}', 'IndikatorController@update');
    Route::get('/admin/komponen/indikator/delete/{id}', 'IndikatorController@destroy')->name('delete');
});

// Penilaian

Route::name('admin.penilaian.')->group(function () {
    Route::get('/admin/penilaian', 'PenilaianController@index')->name('index');
    Route::get('/admin/penilaian/delete/{id}', 'PenilaianController@destroy')->name('delete');
    Route::get('/admin/penilaian/hasil-akhir', 'PenilaianController@exportView')->name('export');
    Route::get('/admin/penilaian/hasil-akhir-real', 'PenilaianController@exportViewRealUkk')->name('exportReal');
    Route::get('/admin/penilaian/hasil-akhir/export', 'PenilaianController@export')->name('export-excel');
    Route::get('/admin/penilaian/hasil-akhir-real/export', 'PenilaianController@exportRealUkk')->name('export-excel-real');
});

Route::name('asesor.penilaian.')->group(function () {
    Route::get('/asesor/penilaian', 'PenilaianController@index')->name('index');
    Route::get('/asesor/penilaian/create/{id}', 'PenilaianController@create')->name('create');
    Route::post('/asesor/penilaian/create/{id}', 'PenilaianController@store');
    Route::get('/asesor/penilaian/delete/{id}', 'PenilaianController@destroy')->name('delete');
});

// Detail Penilaian

Route::name('asesor.detail-penilaian.')->group(function () {
    Route::get('/asesor/detail-penilaian/create/{id}', 'DetailPenilaianController@create')->name('create');
    Route::post('/asesor/detail-penilaian/create/{id}', 'DetailPenilaianController@store')->name('store');
    Route::post('/asesor/detail-penilaian/edit/{id}', 'DetailPenilaianController@update')->name('edit');
    Route::get('/asesor/penilaian/show/{id}', 'DetailPenilaianController@show')->name('show');
});

// Jurusan

Route::name('admin.jurusan.')->group(function() {
    Route::get('/admin/jurusan', 'JurusanController@index')->name('index');
    Route::get('/admin/jurusan/create', 'JurusanController@create')->name('create');
    Route::post('/admin/jurusan/create', 'JurusanController@store')->name('store');
    Route::get('/admin/jurusan/edit/{id}', 'JurusanController@edit')->name('edit');
    Route::post('/admin/jurusan/edit/{id}', 'JurusanController@update')->name('update');
    Route::get('/admin/jurusan/delete/{id}', 'JurusanController@destroy')->name('delete');
    Route::post('/admin/jurusan/set-jurusan-aktif', 'JurusanController@setJurusanAktif')->name('setJurusanAktif');
});

Route::name('admin.kelas.')->group(function() {
    Route::get('/admin/kelas', 'KelasController@index')->name('index');
    Route::get('/admin/kelas/create', 'KelasController@create')->name('create');
    Route::post('/admin/kelas/create', 'KelasController@store')->name('store');
    Route::get('/admin/kelas/edit/{id}', 'KelasController@edit')->name('edit');
    Route::post('/admin/kelas/edit/{id}', 'KelasController@update')->name('update');
    Route::get('/admin/kelas/delete/{id}', 'KelasController@destroy')->name('delete');
});

// Chained dropdown selection
Route::get('/api/dropdown', function() {

    $input = Request::get('option');
    // return $input;
    $parentKomponen = Komponen::where('id_jurusan', $input);
    // return $parentKomponen;
    return Response::make($parentKomponen->get(['id_komponen', 'komponen']));
});

Route::get('/api/dropdown/copy/jurusan', function() {

    $input = Request::get('option');
    // return $input;
    $jurusan = Jurusan::join('komponen', 'komponen.id_jurusan', 'jurusan.id_jurusan')
                    ->select('jurusan.id_jurusan', 'nama_jurusan')
                    ->where('komponen.id_tahun_ajar', $input)
                    ->groupBy('jurusan.id_jurusan');
    return Response::make($jurusan->get());

});

Route::get('/api/dropdown/copy/komponen', function() {

    $input = Request::get('option');
    $id_tahun_ajar = Request::get('tahun');
    // return $input;
    $komponen = Komponen::where('id_jurusan', $input)
                            ->where('id_tahun_ajar', $id_tahun_ajar);
    // return $komponen;
    return Response::make($komponen->get(['id_komponen', 'komponen']));
});


