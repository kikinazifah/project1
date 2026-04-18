<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController2;
use App\Http\Controllers\MenuController2;
use App\Http\Controllers\ArtikelController2;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthCustomController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\GoogleController;

// Route::get('/', function () {
//     return view('landing');
// })->name('landing');

Route::get('/auth', function () {
    return view('auth.index');
});

Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback',  [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/login', [AuthCustomController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthCustomController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [AuthCustomController::class, 'register'])->name('auth.register');
Route::match(['GET', 'POST'], '/logout', [AuthCustomController::class, 'logout'])
    ->name('logout');

Route::get('/', [HomeController2::class, 'index'])->name('home');
Route::prefix('test')->group(function () {
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('test.profile.update');
    Route::get('/profile', [ProfileController::class, 'halamanProfile'])->name('test.profile');
    // Route::get('/profile', function () {
    //     return view('pages.profile');
    // })->name('test.profile');
});
Route::get('/menu', [MenuController2::class, 'showUser'])->name('menu');
Route::get('/menu/{id}', [MenuController2::class, 'showDetail'])->name('menu.show');
Route::get('/artikel', [ArtikelController2::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController2::class, 'show'])->name('artikel.show');
Route::match(['get', 'post'], '/kalkulator', [HomeController2::class, 'kalkulator'])->name('kalkulator');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('menu', AdminMenuController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('kategori', AdminKategoriController::class);
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
});

Route::post('/admin/users/{id}/toggle-status',[AdminController::class, 'toggleStatus']
    )->name('admin.users.toggleStatus');
