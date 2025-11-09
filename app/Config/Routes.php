<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\UserPengurus;
use App\Controllers\UserPersuratan;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/sejarah', 'Home::sejarah');
$routes->get('/visimisi', 'Home::visimisi');
$routes->get('/tentang', 'Home::tentang');
$routes->get('/imam-khatib', 'Home::imamKhatib');
$routes->get('/keuangan', 'Home::keuangan');
$routes->get('/keuangan/export-pdf', 'Home::exportKeuanganPdf');
$routes->get('/inventaris', 'Home::inventaris');
$routes->post('/submit-feedback', 'Home::submit_feedback');
$routes->post('home/store_masukan', 'Home::store_masukan');

// Public route for showing news detail
$routes->get('berita/show/(:num)', 'Berita::show/$1');

// Authentication routes
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

// Public routes for gallery
$routes->get('galeri', 'Galeri::index');
$routes->get('galeri/show/(:num)', 'Galeri::show/$1');

// Admin routes - hanya bisa diakses oleh admin
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    
    // User management routes
    $routes->get('users', 'AdminUsers::index');
    $routes->get('users/create', 'AdminUsers::create');
    $routes->post('users/store', 'AdminUsers::store');
    $routes->get('users/edit/(:num)', 'AdminUsers::edit/$1');
    $routes->post('users/update/(:num)', 'AdminUsers::update/$1');
    $routes->get('users/delete/(:num)', 'AdminUsers::delete/$1');
});

// User routes - hanya bisa diakses oleh user
$routes->group('user', ['filter' => 'user'], function($routes) {
    $routes->get('dashboard', 'User::dashboard');
    
    // Keuangan routes
    $routes->get('keuangan', 'UserKeuangan::index');
    $routes->get('keuangan/create', 'UserKeuangan::create');
    $routes->post('keuangan/store', 'UserKeuangan::store');
    $routes->get('keuangan/show/(:num)', 'UserKeuangan::show/$1');
    $routes->get('keuangan/edit/(:num)', 'UserKeuangan::edit/$1');
    $routes->post('keuangan/update/(:num)', 'UserKeuangan::update/$1');
    $routes->get('keuangan/delete/(:num)', 'UserKeuangan::delete/$1');
    $routes->get('keuangan/export-pdf', 'UserKeuangan::exportPdf');
    
    // Donasi routes
    $routes->get('donasi', 'UserDonasi::index');
    $routes->get('donasi/show/(:num)', 'UserDonasi::show/$1');
    $routes->post('donasi/accept/(:num)', 'UserDonasi::accept/$1');
    $routes->post('donasi/reject/(:num)', 'UserDonasi::reject/$1');
    $routes->post('donasi/delete/(:num)', 'UserDonasi::delete/$1');
    
    // Pengurus routes
    $routes->get('pengurus', 'UserPengurus::index');
    $routes->get('pengurus/create', 'UserPengurus::create');
    $routes->post('pengurus/store', 'UserPengurus::store');
    $routes->get('pengurus/show/(:num)', 'UserPengurus::show/$1');
    $routes->get('pengurus/edit/(:num)', 'UserPengurus::edit/$1');
    $routes->post('pengurus/update/(:num)', 'UserPengurus::update/$1');
    $routes->get('pengurus/delete/(:num)', 'UserPengurus::delete/$1');
    
    // Inventaris routes
    $routes->get('inventaris', 'UserInventaris::index');
    $routes->get('inventaris/create', 'UserInventaris::create');
    $routes->post('inventaris/store', 'UserInventaris::store');
    $routes->get('inventaris/show/(:num)', 'UserInventaris::show/$1');
    $routes->get('inventaris/edit/(:num)', 'UserInventaris::edit/$1');
    $routes->post('inventaris/update/(:num)', 'UserInventaris::update/$1');
    $routes->get('inventaris/delete/(:num)', 'UserInventaris::delete/$1');

    $routes->get('kelola-berita', 'User::kelola_berita');
    $routes->get('kelola-galeri', 'User::kelola_galeri');
    $routes->get('kelola-masukan', 'User::kelola_masukan');
    $routes->get('kelola-imam-khatib', 'User::kelola_imam_khatib');
    $routes->get('kelola-persuratan', 'User::kelola_persuratan');

    $routes->get('berita', 'UserBerita::index');
    $routes->get('berita/create', 'UserBerita::create');
    $routes->post('berita/store', 'UserBerita::store');
    $routes->get('berita/edit/(:num)', 'UserBerita::edit/$1');
    $routes->post('berita/update/(:num)', 'UserBerita::update/$1');
    $routes->get('berita/show/(:num)', 'UserBerita::show/$1');
    $routes->get('berita/delete/(:num)', 'UserBerita::delete/$1');
    $routes->get('berita/delete-gambar/(:num)', 'UserBerita::deleteGambar/$1');

    $routes->get('galeri', 'UserGaleri::index');
    $routes->get('galeri/create', 'UserGaleri::create');
    $routes->post('galeri/store', 'UserGaleri::store');
    $routes->get('galeri/edit/(:num)', 'UserGaleri::edit/$1');
    $routes->post('galeri/update/(:num)', 'UserGaleri::update/$1');
    $routes->get('galeri/show/(:num)', 'UserGaleri::show/$1');
    $routes->get('galeri/delete/(:num)', 'UserGaleri::delete/$1');
    $routes->get('galeri/delete-gambar/(:num)', 'UserGaleri::deleteGambar/$1');

    $routes->get('masukan', 'UserMasukan::index');
    $routes->get('masukan/delete/(:num)', 'UserMasukan::delete/$1');
    $routes->get('masukan/show/(:num)', 'UserMasukan::show/$1');

    $routes->get('imamkhatib', 'UserImamKhatib::index');
    $routes->get('imamkhatib/create', 'UserImamKhatib::create');
    $routes->post('imamkhatib/store', 'UserImamKhatib::store');
    $routes->get('imamkhatib/edit/(:num)', 'UserImamKhatib::edit/$1');
    $routes->post('imamkhatib/update/(:num)', 'UserImamKhatib::update/$1');
    $routes->post('imamkhatib/delete/(:num)', 'UserImamKhatib::delete/$1');

    // Imam Muadzin Harian
    $routes->get('imamkhatib/harian/create', 'UserImamKhatib::create_harian');
    $routes->post('imamkhatib/harian/store', 'UserImamKhatib::store_harian');
    $routes->get('imamkhatib/harian/edit/(:num)', 'UserImamKhatib::edit_harian/$1');
    $routes->post('imamkhatib/harian/update/(:num)', 'UserImamKhatib::update_harian/$1');
    $routes->post('imamkhatib/harian/delete/(:num)', 'UserImamKhatib::delete_harian/$1');

    // Persuratan routes
    $routes->get('persuratan', 'UserPersuratan::index');
    $routes->get('persuratan/create', 'UserPersuratan::create');
    $routes->post('persuratan/store', 'UserPersuratan::store');
    $routes->get('persuratan/edit/(:num)', 'UserPersuratan::edit/$1');
    $routes->post('persuratan/update/(:num)', 'UserPersuratan::update/$1');
    $routes->get('persuratan/delete/(:num)', 'UserPersuratan::delete/$1');
    $routes->get('persuratan/show/(:num)', 'UserPersuratan::show/$1');
    $routes->get('persuratan/preview-a4/(:num)', 'UserPersuratan::previewA4/$1');
    $routes->get('persuratan/export-word/(:num)', 'UserPersuratan::exportWord/$1');
    $routes->get('persuratan/download-template-word', 'UserPersuratan::downloadTemplateWord');

    $routes->get('pengaturan', 'UserPengaturan::index', ['filter' => 'user']);
    $routes->get('pengaturan/edit', 'UserPengaturan::edit', ['filter' => 'user']);
    $routes->post('pengaturan/update', 'UserPengaturan::update', ['filter' => 'user']);

    $routes->get('edit-profile', 'User::edit_profile');
    $routes->post('update-profile', 'User::update_profile');
});

$routes->get('berita', 'Berita::index');

$routes->get('/donasi', 'Home::donasi');
$routes->post('/donasi', 'Home::submitDonasi');

$routes->get('/feedback', 'Home::feedback');
$routes->post('/feedback', 'Home::submitFeedback');



