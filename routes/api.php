<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('invoices/year', [InvoiceController::class, 'getDataPerYear'])->middleware('auth')->name('invoices.year');
Route::get('invoices/month', [InvoiceController::class, 'getDataPerMonth'])->middleware('auth')->name('invoices.month');
Route::get('invoices/week', [InvoiceController::class, 'getDataPerWeek'])->middleware('auth')->name('invoices.week');
Route::get('invoices/user', [InvoiceController::class, 'getUserInvoices'])->middleware('auth')->name('invoices.user');


Route::get('items/list', [ItemController::class, 'getItemsList'])->middleware('auth')->name('items.list');
Route::get('items/grid', [ItemController::class, 'getItemsGrid'])->middleware('auth')->name('items.grid');
Route::get('invoices/all', [InvoiceController::class, 'getAllInvoices'])->middleware('auth')->name('invoices.all');

Route::post('item/search', [ItemController::class, 'itemSearch'])->middleware(['auth'])->name('item.search');
Route::post('item/updateStock', [ItemController::class, 'updateStock'])->middleware(['auth'])->name('item.update.stock');
Route::get('item/getStock', [ItemController::class, 'getStock'])->middleware(['auth'])->name('item.get.stock');
