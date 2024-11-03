<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DetailController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/',[ShopController::class,'index']);
Route::post('/',[ShopController::class,'search']);
Route::get('/detail',[DetailController::class,'show']);

Route::middleware('auth')->group(function () {
    Route::put('/',[ShopController::class,'favorite']);
    Route::post('/done',[DetailController::class,'store']);
});

require __DIR__.'/auth.php';
