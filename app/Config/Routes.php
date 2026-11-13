<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Auth::index');
$routes->get('/RedirectModules','RedirectModules::index'); 
$routes->post('auth','\App\Controllers\Auth::checking_authentication');
$routes->get('logout', 'Logout::index',['filter' => 'AdminFilter']);
// Routes Profil
$routes->get('profil','Profil::index',['filter' => 'AdminFilter']);
$routes->post('update_profil/(:num)','Profil::update_profil/$1',['filter' => 'AdminFilter']);
$routes->post('update_pass','Profil::update_password',['filter' => 'AdminFilter']);
// End Routes Profil
$routes->get('wilayah/getKecamatan','admin\Account::getKecamatan');
$routes->get('wilayah/getKelurahan','admin\Account::getKelurahan');

$routes->get('wilayah/getKecamatanByKabkot','admin\Kematian::getKecamatanByKabkot');
$routes->get('wilayah/getKelurahanByKecamatan','admin\Kematian::getKelurahanByKecamatan');

$routes->group('admin', static function ($routes) {
    $routes->get('dashboard_prov','Dashboard_prov::index',['filter' => 'AdminFilter']);
    $routes->get('dashboard_kabkot','Dashboard_kabkot::index',['filter' => 'AdminFilter']);
    $routes->get('dashboard_kec','Dashboard_kec::index',['filter' => 'AdminFilter']);
    $routes->get('dashboard_kel','Dashboard_kel::index',['filter' => 'AdminFilter']);

    $routes->get('getPieChartData','Dashboard::getPieChartData',['filter' => 'AdminFilter']);
    $routes->get('logout', 'Logout::index',['filter' => 'AdminFilter']);
    
    // Routes Data Akun Pengguna
    $routes->get('users','admin\Account::index',['filter' => 'AdminFilter']);
    $routes->post('insert_user','admin\Account::account_insert',['filter' => 'AdminFilter']);
    $routes->get('data_user','admin\Account::get_data_office',['filter' => 'AdminFilter']);
    $routes->post('delete_user','admin\Account::delete',['filter' => 'AdminFilter']);
    $routes->get('edit_user','admin\Account::edit',['filter' => 'AdminFilter']);
    $routes->post('update_user','admin\Account::update_account',['filter' => 'AdminFilter']);
    $routes->post('update_pass','admin\Account::update_account_password',['filter' => 'AdminFilter']);

    $routes->get('users_kabkot','kabkot\Account::index',['filter' => 'AdminFilter']);
    $routes->post('insert_user_kabkot','kabkot\Account::account_insert',['filter' => 'AdminFilter']);
    $routes->get('data_user_kabkot','kabkot\Account::get_data_office',['filter' => 'AdminFilter']);
    $routes->post('delete_user_kabkot','kabkot\Account::delete',['filter' => 'AdminFilter']);
    $routes->get('edit_user_kabkot','kabkot\Account::edit',['filter' => 'AdminFilter']);
    $routes->post('update_user_kabkot','kabkot\Account::update_account',['filter' => 'AdminFilter']);
    $routes->post('update_pass_kabkot','kabkot\Account::update_account_password',['filter' => 'AdminFilter']);
    // End Data Akun Pengguna

    // Routes Pengaturan 
    $routes->get('seo','admin\Seo::index',['filter' => 'AdminFilter']);
    $routes->post('update_seo','admin\Seo::update',['filter' => 'AdminFilter']);
    $routes->get('logo','admin\Logo::index',['filter' => 'AdminFilter']);
    $routes->post('upload_logo','admin\Logo::upload_logo',['filter' => 'AdminFilter']);
    $routes->post('upload_bg','admin\Logo::upload_bg',['filter' => 'AdminFilter']);
    $routes->post('upload_favicon','admin\Logo::upload_favicon',['filter' => 'AdminFilter']);
    $routes->get('profil_website','admin\Profil_web::index',['filter' => 'AdminFilter']);
    $routes->post('update_profil_website','admin\Profil_web::update',['filter' => 'AdminFilter']);
    $routes->get('profil_dinas','admin\Profil_dinas::index',['filter' => 'AdminFilter']);
    $routes->post('update_profil_dinas','admin\Profil_dinas::update',['filter' => 'AdminFilter']);
    $routes->get('sosial_media','admin\Sosial_media::index',['filter' => 'AdminFilter']);
    $routes->post('update_sosial_media','admin\Sosial_media::update',['filter' => 'AdminFilter']);
    // End Routes Pengaturan 

    //level Provinsi
    $routes->get('perkawinan','admin\Perkawinan::index',['filter' => 'AdminFilter']);
    $routes->get('perkawinan/detail/(:any)','admin\Perkawinan::detail/$1',['filter' => 'AdminFilter']);
    $routes->get('getPerkawinan','admin\Perkawinan::getAll',['filter' => 'AdminFilter']);
    $routes->post('verifyPerkawinan','admin\Perkawinan::verify',['filter' => 'AdminFilter']);
    // End provinsi

    //level Kabupaten kota
    $routes->get('kabkot_perkawinan','kabkot\Perkawinan::index',['filter' => 'AdminFilter']);
    $routes->get('getPerkawinanKabkot','kabkot\Perkawinan::getAll',['filter' => 'AdminFilter']);
    // End kabupaten Kota

    //level Kecamatan
    $routes->get('kecamatan_perkawinan','kecamatan\Perkawinan::index',['filter' => 'AdminFilter']);
    $routes->get('getPerkawinanKecamatan','kecamatan\Perkawinan::getAll',['filter' => 'AdminFilter']);
    // End Kecamatan

    //level Kelurahan
    $routes->get('kelurahan_perkawinan','kelurahan\Perkawinan::index',['filter' => 'AdminFilter']);
    $routes->get('getPerkawinanKelurahan','kelurahan\Perkawinan::getAll',['filter' => 'AdminFilter']);
    $routes->get('getByIdPerkawinan','kelurahan\Perkawinan::getById',['filter' => 'AdminFilter']);
    $routes->post('insert_perkawinan','kelurahan\Perkawinan::insert',['filter' => 'AdminFilter']);
    $routes->post('update_perkawinan','kelurahan\Perkawinan::update',['filter' => 'AdminFilter']);
    $routes->post('deletePerkawinan','kelurahan\Perkawinan::delete',['filter' => 'AdminFilter']);
    // End Kelurahan

    // Routes Log Aktivitas
    $routes->get('log','admin\Log::index',['filter' => 'AdminFilter']);
    $routes->get('data_log','admin\Log::get_data',['filter' => 'AdminFilter']);
    $routes->post('delete_log','admin\Log::delete',['filter' => 'AdminFilter']);
    // End Routes Aktivitas

    // Routes Laporan 
    $routes->get('laporan_perkawinan_prov','admin\LaporanPerkawinan::index',['filter' => 'AdminFilter']);
    $routes->get('laporan_perkawinan_kabkot','kabkot\LaporanPerkawinan::index',['filter' => 'AdminFilter']);
    $routes->get('laporan_perkawinan_kecamatan','kecamatan\LaporanPerkawinan::index',['filter' => 'AdminFilter']);
    $routes->get('laporan_perkawinan_kelurahan','kelurahan\LaporanPerkawinan::index',['filter' => 'AdminFilter']);
    // End Routes Laporan

    // Routes Pengajuan 
    
});
