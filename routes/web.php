<?php

use App\Http\Controllers\DataKontenController;
use App\Http\Controllers\DataSaranController;
use App\Http\Controllers\MasterKontenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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

Route::post('/storesaran', [IndexController::class, 'store'])->name('storesaran');
Route::get('/index', [IndexController::class, 'index'])->name('index');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/konten', [MasterKontenController::class, 'index'])->name('masterkonten');
    Route::get('/listkonten', [MasterKontenController::class, 'listkonten'])->name('listkonten');
    Route::post('/simpankonten', [MasterKontenController::class, 'store'])->name('simpankonten');
    Route::post('/updatekonten', [MasterKontenController::class, 'update'])->name('updatekonten');
    Route::post('/editkonten', [MasterKontenController::class, 'edit'])->name('editkonten');
    Route::post('/hapuskonten', [MasterKontenController::class, 'destroy'])->name('hapuskonten');

    Route::get('/datakonten', [DataKontenController::class, 'index'])->name('datakonten');
    Route::get('/listdatakonten', [DataKontenController::class, 'listkonten'])->name('listdatakonten');
    Route::post('/simpandatakonten', [DataKontenController::class, 'store'])->name('simpandatakonten');
    Route::post('/updatedatakonten', [DataKontenController::class, 'update'])->name('updatedatakonten');
    Route::post('/editdatakonten', [DataKontenController::class, 'edit'])->name('editdatakonten');
    Route::post('/hapusdatakonten', [DataKontenController::class, 'destroy'])->name('hapusdatakonten');
    Route::post('/getkonten', [DataKontenController::class, 'getkonten'])->name('getkonten');

    Route::get('/datasaran', [DataSaranController::class, 'index'])->name('datasaran');
    Route::get('/listdatasaran', [DataSaranController::class, 'listdatasaran'])->name('listdatasaran');

    Route::get('/userman', [UserController::class, 'index'])->name('userman');
    Route::get('/datauser', [UserController::class, 'datauser'])->name('datauser');
    Route::post('/edituser', [UserController::class, 'edit'])->name('edituser');
    Route::post('/storeuser', [UserController::class, 'store'])->name('storeuser');
    Route::post('/updateuser', [UserController::class, 'update'])->name('updateuser');
    Route::post('/hapususer', [UserController::class, 'destroy'])->name('hapususer');
});
