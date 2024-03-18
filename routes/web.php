<?php


use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get('/', function () {

//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// redirect / to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function (Request $request) {
    $invoices = DB::table('invoices')
        ->select(DB::raw('SUM(items.retail_price) as total_price, COUNT(items.retail_price) as total_items, invoices.id, invoices.created_at, users.username, users.email'))
        ->join('users', 'invoices.user_id', '=', 'users.id')
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->join('items', 'invoice_items.item_id', '=', 'items.id')
        ->groupBy('invoices.id')
        ->groupBy('invoices.created_at')
        ->groupBy('users.username')
        ->groupBy('users.email')
        ->paginate(15);

    // sum invoices
    $total_invoices = DB::table('invoices')->count();

    $items = DB::table('items')
        ->select('items.name', 'items.retail_price', 'items.id', 'items.last_purchase_date', 'items.category')
        ->orderBy('items.last_purchase_date', 'desc')
        ->paginate(6);

    $date = [
        'day' => date('l'),
        'date' => date('d / m / y'),
    ];

    // $userInvoice = new InvoiceController();
    // list($invoices, $invoicesCtr, $monthsName, $userIncome) = $userInvoice->getUserInvoice($request);

    return view('dashboard', compact('invoices', 'total_invoices', 'items', 'date'));
})->middleware(['auth'])->name('dashboard');

Route::post('deleteRow', [InvoiceController::class, 'destroy'])->middleware(['auth'])->name('invoice.deleteRow');



Route::get('/invoice', function () {
    return view('invoice');
})->middleware(['auth'])->name('invoice');


Route::get('/product', function () {
    return view('product');
})->middleware(['auth'])->name('product');

Route::get('/report', function () {

    // Pie chart
    $total_penjualan = DB::select("SELECT COUNT(invoice_items.item_id), SUM(items.retail_price) as total_price, items.category FROM invoice_items
    JOIN items ON invoice_items.item_id = items.id
    JOIN invoices ON invoice_items.invoice_id = invoices.id
    WHERE invoices.category = 'penjualan'
    GROUP BY items.category
    ORDER BY total_price
    DESC LIMIT 6");

    // Column chart
    $pendapatan_bulanan = DB::select("    
    SELECT
        COUNT(invoice_items.item_id) as count,
        SUM(items.retail_price) as untung_kotor,
        SUM(items.retail_price - items.cost_of_goods_sold) as untung_bersih,
        SUM(items.cost_of_goods_sold) as pengeluaran,
        EXTRACT(YEAR FROM CAST(invoices.invoice_date AS DATE)) as tahun,
        EXTRACT(MONTH FROM CAST(invoices.invoice_date AS DATE)) as bulan
    FROM
        invoice_items
        JOIN items ON invoice_items.item_id = items.id
        JOIN invoices ON invoice_items.invoice_id = invoices.id
    WHERE
        (
            (EXTRACT(YEAR FROM CAST(invoices.invoice_date AS DATE)) = EXTRACT(YEAR FROM CURRENT_TIMESTAMP) - 1
            AND EXTRACT(MONTH FROM CAST(invoices.invoice_date AS DATE)) > EXTRACT(MONTH FROM CURRENT_TIMESTAMP))
            AND invoices.category = 'penjualan'
        )
        OR
        (
            (EXTRACT(YEAR FROM CAST(invoices.invoice_date AS DATE)) = EXTRACT(YEAR FROM CURRENT_TIMESTAMP)
            AND EXTRACT(MONTH FROM CAST(invoices.invoice_date AS DATE)) <= EXTRACT(MONTH FROM CURRENT_TIMESTAMP))
            AND invoices.category = 'penjualan'
        )
    GROUP BY
        EXTRACT(YEAR FROM CAST(invoices.invoice_date AS DATE)),
        EXTRACT(MONTH FROM CAST(invoices.invoice_date AS DATE))
    ");
    // dd($pendapatan_bulanan);
    // dd($column_data);


    return view('report', compact('total_penjualan', 'pendapatan_bulanan'));
})->middleware(['auth'])->name('report');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');



require __DIR__ . '/auth.php';
