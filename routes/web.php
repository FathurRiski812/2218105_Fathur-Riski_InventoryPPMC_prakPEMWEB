<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
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
    return view('welcome');
});
Route::get('/obat', [ObatController::class, 'index']);
Route::get('/obat/tambah', [ObatController::class, 'create']);
Route::post('/obat/store', [ObatController::class, 'store']);
Route::get('/obat/edit/{id}', [ObatController::class, 'edit']);
Route::put('/obat/update/{id}', [ObatController::class, 'update']);
Route::get('/obat/hapus/{id}', [ObatController::class, 'delete']);
Route::delete('/obat/destroy/{id}', [ObatController::class, 'destroy']);
Route::get('/obat/cetak', [ObatController::class, 'cetak']);

