<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProfileUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('user.landingpage');
});

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/userregister', [AuthController::class, "userregister"])->name('userregister');
Route::post('/userregister', [AuthController::class, "douserregister"])->name('do.userregister');
Route::get('/forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::post('/forgotpassword', [AuthController::class, "forgotPassword"])->name('forgot.password');

// USER
Route::middleware(['auth:web'])->group(function () {
    Route::get('/profileuser', [ProfileUserController::class, 'showuser']);
    Route::get('/profileuser/{id}', [ProfileUserController::class, 'showdetailuser']);
    Route::get('/profileuser/{id}/edit', [ProfileUserController::class, 'edit']);
    Route::get('/profiletransaksi', [ProfileUserController::class, 'showtransaksi']);
    Route::get('/booking/add/{id}', [BookingController::class, 'bookingPage']);
    Route::post('/booking', [BookingController::class, 'booking']);
    Route::get('/paket', [PaketController::class, 'index'])->name('paket.page');
    Route::get('/detailpaket/{id}', [PaketController::class, 'detailPaket']);
    Route::get('/user/{id}/edit', [ProfileUserController::class, 'edit']);
    Route::put('/user/{id}', [ProfileUserController::class, 'updatedetailuser'])->name('update.profile');
});

// ADMIN
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/adminindex', [AdminController::class, 'index'])->name('adminindex');
    Route::get('/detailpaket/{id}', [AdminController::class, 'detailpaket'])->name('detailpaket');

    Route::get('/adminlistuser', [AdminController::class, 'listuser'])->name('showlistuser');
    Route::get('/createuser/add', [AdminController::class, 'adduser'])->name('add.user');
    Route::post('/createuser', [AdminController::class, 'createuser'])->name('create.user');
    Route::get('/updateuser/{id}/edit', [AdminController::class, 'edit']);
    Route::put('/updateuser/{id}', [AdminController::class, 'updateuser'])->name('update.user');
    Route::get('/adminlistuser/{id}/delete', [AdminController::class, 'destroyuser'])->name('deleteuser');
    
    Route::get('/adminlistadmin', [AdminController::class, 'listadmin'])->name('showlistadmin');
    Route::get('/createadmin/add', [AdminController::class, 'addadmin'])->name('add.admin');
    Route::post('/createadmin', [AdminController::class, 'createadmin'])->name('create.admin');
    Route::get('/updateadmin/{id}/edit', [AdminController::class, 'editadmin']);
    Route::put('/updateadmin/{id}', [AdminController::class, 'updateadmin'])->name('update.admin');
    Route::get('/admin/{id}/delete', [AdminController::class, 'destroyadmin']);

    Route::get('/category', [CatController::class, 'index'])->name('showlistcat');
    Route::get('/createcategory/add', [CatController::class, 'create'])->name('add.cat');
    Route::post('/createcategory', [CatController::class, 'store'])->name('create.cat');
    Route::get('/updatekategori/{id}/edit', [CatController::class, 'edit']);
    Route::put('/updatekategori/{id}', [CatController::class, 'update'])->name('update.cat');
    Route::get('/kategori/{id}/delete', [CatController::class, 'destroy']);

    Route::get('/paket', [PaketController::class, 'listpaket'])->name('showlistpaket');
    Route::get('/createpaket/add', [PaketController::class, 'create'])->name('add.paket');
    Route::post('/createpaket', [PaketController::class, 'store'])->name('create.paket');
    Route::get('/updatepaket/{id}/edit', [PaketController::class, 'edit']);
    Route::put('/updatepaket/{id}', [PaketController::class, 'update'])->name('update.paket');
    Route::get('/adminpaket/{id}/delete', [AdminController::class, 'destroypaket']);
});
