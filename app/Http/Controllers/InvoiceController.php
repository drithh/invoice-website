<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('invoice_items')->where('invoice_id', $request->id)->delete();
        return redirect()->route('dashboard');
    }

    public function getDataPerYear()
    {
        $invoices = DB::table('invoices')
      ->select(DB::raw('SUM(items.retail_price) as total_price, COUNT(items.retail_price) as total_items, invoices.id, invoices.invoice_date, users.username, users.email'))
      ->join('users', 'invoices.user_id', '=', 'users.id')
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->whereYear('invoices.invoice_date', '=', date('Y') - 1)
      ->groupBy('invoices.id')
      ->groupBy('invoices.invoice_date')
      ->groupBy('users.username')
      ->groupBy('users.email')
      ->paginate(20);

        $invoice_select = 'year';
        $total_invoices = DB::table('invoices')->whereYear('invoice_date', '=', date('Y') - 1)->count();

        return view('components.table-penjualan', compact('invoices', 'total_invoices', 'invoice_select'));
    }

    public function getDataPerMonth()
    {
        $invoices = DB::table('invoices')
      ->select(DB::raw('SUM(items.retail_price) as total_price, COUNT(items.retail_price) as total_items, invoices.id, invoices.invoice_date, users.username, users.email'))
      ->join('users', 'invoices.user_id', '=', 'users.id')
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->where('invoices.invoice_date', '>=', date('Y-m-d', strtotime('-1 months')))
      ->groupBy('invoices.id')
      ->groupBy('invoices.invoice_date')
      ->groupBy('users.username')
      ->groupBy('users.email')
      ->paginate(20);



        // sum invoices
        $invoice_select = 'month';
        $total_invoices = DB::table('invoices')->where('invoice_date', '>=', date('Y-m-d', strtotime('-1 months')))->count();
        return view('components.table-penjualan', compact('invoices', 'total_invoices', 'invoice_select'));
    }

    public function getDataPerWeek()
    {
        $invoices = DB::table('invoices')
      ->select(DB::raw('SUM(items.retail_price) as total_price, COUNT(items.retail_price) as total_items, invoices.id, invoices.invoice_date, users.username, users.email'))
      ->join('users', 'invoices.user_id', '=', 'users.id')
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->where('invoices.invoice_date', '>=', date('Y-m-d', strtotime('-7 days')))
      ->groupBy('invoices.id')
      ->groupBy('invoices.invoice_date')
      ->groupBy('users.username')
      ->groupBy('users.email')
      ->paginate(20);

        $invoice_select = 'week';
        $total_invoices = DB::table('invoices')->where('invoice_date', '>=', date('Y-m-d', strtotime('-7 days')))->count();
        return view('components.table-penjualan', compact('invoices', 'total_invoices', 'invoice_select'));
    }
}
