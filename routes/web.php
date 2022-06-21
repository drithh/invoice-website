<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('dashboard');
    return redirect()->route('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [InvoiceController::class, 'getUserInvoice'])->middleware(['auth'])->name('dashboard');

Route::get('/invoice', function () {
    return view('invoice');
})->middleware(['auth'])->name('invoice');


Route::get('/product', function () {
    return view('product');
})->middleware(['auth'])->name('product');

Route::get('/report', function () {
    return view('report');
})->middleware(['auth'])->name('report');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

require __DIR__ . '/auth.php';
