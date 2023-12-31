<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/upload',[FileController::class,'create']);
Route::post('/upload',[FileController::class,'upload'])->name('file.upload');
Route::get('/share/{id}',[FileController::class,'share'])->name('file.share');
Route::get('file/download/{uuid}', [FileController::class, 'download'])->middleware('signed')->name('file.download');
Route::get('files/download', [FileController::class, 'showAllFiles'])->name('file.show');
