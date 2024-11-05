<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;

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

Route::middleware('auth:users')->group(function () {
    Route::put('/',[ShopController::class,'favorite']);
    Route::post('/done',[DetailController::class,'store']);
    Route::get('/mypage',[MypageController::class,'show']);
    Route::put('/mypage',[MypageController::class,'favorite']);
    Route::delete('/mypage',[MypageController::class,'delete']);
    Route::get('/review',[ReviewController::class,'show']);
    Route::put('/review',[ReviewController::class,'store']);
    Route::patch('/review',[ReviewController::class,'update']);
    Route::get('/review-edit',[ReviewController::class,'edit']);
    Route::delete('/review-edit',[ReviewController::class,'delete']);
    Route::get('/review-all',[ReviewController::class,'reviewAll']);
});

Route::delete('/review-all',[ReviewController::class,'deleteAdmin']);


require __DIR__.'/auth.php';
