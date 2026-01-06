<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "DashboardController::landingpage");
$routes->get('/dashboard', "DashboardController::index", ['filter' => 'login:Admin']);
$routes->get("/visi-misi", "DashboardController::visi_misi");
$routes->get("/tugas-pokok", "DashboardController::tugas_pokok");
$routes->get("/dasar-hukum", "DashboardController::dasar_hukum");
$routes->get('/berita_umum', "DashboardController::berita");
$routes->get('/artikel_umum', "DashboardController::artikel");
$routes->get('/pengumuman_umum', "DashboardController::pengumuman");
$routes->get('/foto_umum', "DashboardController::foto");
$routes->get('/postingan', "DashboardController::postingan");
$routes->get('/infografis_umum', "DashboardController::infografis");
$routes->get('/faq', "DashboardController::faq");
$routes->get('/pejabat', "DashboardController::pejabat");
$routes->get('data', 'DataController::index');



// Halaman view data BPS
$routes->get('/data', 'DashboardController::data_bps');
$routes->get('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout', ['filter' => 'login:Admin']);
$routes->post('/proses-login', 'AuthController::proses_login');


$routes->get('/kelola-berita', 'BeritaController::index', ['filter' => 'login:Admin']);
$routes->get('/kelola-berita/create', 'BeritaController::create', ['filter' => 'login:Admin']);
$routes->post('/kelola-berita/store', 'BeritaController::store', ['filter' => 'login:Admin']);
$routes->get('/kelola-berita/(:num)', 'BeritaController::show/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-berita/(:num)/edit', 'BeritaController::edit/$1', ['filter' => 'login:Admin']);
$routes->put('/kelola-berita/(:num)', 'BeritaController::update/$1', ['filter' => 'login:Admin']);
$routes->delete('/kelola-berita/(:num)', 'BeritaController::delete/$1', ['filter' => 'login:Admin']);

$routes->get('/kelola-artikel', 'ArtikelController::index', ['filter' => 'login:Admin']);
$routes->get('/kelola-artikel/create', 'ArtikelController::create', ['filter' => 'login:Admin']);
$routes->post('/kelola-artikel/store', 'ArtikelController::store', ['filter' => 'login:Admin']);
$routes->get('/kelola-artikel/(:num)', 'ArtikelController::show/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-artikel/(:num)/edit', 'ArtikelController::edit/$1', ['filter' => 'login:Admin']);
$routes->put('/kelola-artikel/(:num)', 'ArtikelController::update/$1', ['filter' => 'login:Admin']);
$routes->delete('/kelola-artikel/(:num)', 'ArtikelController::delete/$1', ['filter' => 'login:Admin']);

$routes->get('/kelola-pengumuman', 'PengumumanController::index', ['filter' => 'login:Admin']);
$routes->get('/kelola-pengumuman/create', 'PengumumanController::create', ['filter' => 'login:Admin']);
$routes->post('/kelola-pengumuman/store', 'PengumumanController::store', ['filter' => 'login:Admin']);
$routes->get('/kelola-pengumuman/(:num)', 'PengumumanController::show/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-pengumuman/(:num)/edit', 'PengumumanController::edit/$1', ['filter' => 'login:Admin']);
$routes->put('/kelola-pengumuman/(:num)', 'PengumumanController::update/$1', ['filter' => 'login:Admin']);
$routes->delete('/kelola-pengumuman/(:num)', 'PengumumanController::delete/$1', ['filter' => 'login:Admin']);

$routes->get('/kelola-media', 'MediaController::index', ['filter' => 'login:Admin']);
$routes->get('/kelola-media/create', 'MediaController::create', ['filter' => 'login:Admin']);
$routes->post('/kelola-media/store', 'MediaController::store', ['filter' => 'login:Admin']);
$routes->get('/kelola-media/(:num)', 'MediaController::show/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-media/edit/(:num)', 'MediaController::edit/$1', ['filter' => 'login:Admin']);
$routes->put('/kelola-media/(:num)', 'MediaController::update/$1', ['filter' => 'login:Admin']);
$routes->delete('/kelola-media/(:num)', 'MediaController::delete/$1', ['filter' => 'login:Admin']);

$routes->get('/kelola-instagram', 'InstagramPostController::index', ['filter' => 'login:Admin']);
$routes->post('/kelola-instagram/store', 'InstagramPostController::store', ['filter' => 'login:Admin']);
$routes->post('/kelola-instagram/update/(:num)', 'InstagramPostController::update/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-instagram/delete/(:num)', 'InstagramPostController::delete/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-instagram/activate/(:num)', 'InstagramPostController::activatePost/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-instagram/deactivate/(:num)', 'InstagramPostController::deactivatePost/$1', ['filter' => 'login:Admin']);

$routes->get('/kelola-users', 'UserController::index', ['filter' => 'login:Admin']);
$routes->get('/kelola-users/create', 'UserController::create', ['filter' => 'login:Admin']);
$routes->post('/kelola-users/store', 'UserController::store', ['filter' => 'login:Admin']);
$routes->get('/kelola-users/(:num)', 'UserController::show/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-users/(:num)/edit', 'UserController::edit/$1', ['filter' => 'login:Admin']);
$routes->put('/kelola-users/(:num)', 'UserController::update/$1', ['filter' => 'login:Admin']);
$routes->delete('/kelola-users/(:num)', 'UserController::delete/$1', ['filter' => 'login:Admin']);

$routes->get('/kelola-pegawai', 'PegawaiController::index', ['filter' => 'login:Admin']);
$routes->post('/kelola-pegawai/store', 'PegawaiController::store', ['filter' => 'login:Admin']);
$routes->post('/kelola-pegawai/update/(:num)', 'PegawaiController::update/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-pegawai/delete/(:num)', 'PegawaiController::delete/$1', ['filter' => 'login:Admin']);

$routes->get('/kelola-instagram', 'InstagramPostController::index', ['filter' => 'login:Admin']);
$routes->post('/kelola-instagram/store', 'InstagramPostController::store', ['filter' => 'login:Admin']);
$routes->post('/kelola-instagram/update/(:num)', 'InstagramPostController::update/$1', ['filter' => 'login:Admin']);
$routes->get('/kelola-instagram/delete/(:num)', 'InstagramPostController::delete/$1', ['filter' => 'login:Admin']);




// Public article detail by slug
$routes->get('/artikel/(:any)', 'DashboardController::artikel_detail/$1');

// Public berita detail by slug
$routes->get('/berita/(:any)', 'DashboardController::berita_detail/$1');
// Public berita detail by slug
$routes->get('/pengumuman/(:any)', 'DashboardController::pengumuman_detail/$1');

$routes->get('/infografis/(:any)', 'DashboardController::infografis_detail/$1');

