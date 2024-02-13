<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['verify.shopify'])->name('home');

Route::get('/',[HomeController::class, 'index'])->middleware(['verify.shopify'])->name('home');
Route::post('/getPageList',[HomeController::class, 'getPageList']);
Route::post('/createpage',[HomeController::class, 'createPage']);

