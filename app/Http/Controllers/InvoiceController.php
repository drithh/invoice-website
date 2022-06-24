<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

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

  public function getAllInvoices(Request $request)
  {
    $invoiceSelect = ['all', 'penjualan', 'pembelian'];
    $invoice_select = $invoiceSelect[$request->select];

    // invoices join with items
    if ($invoice_select != 'all') {
      $invoices = DB::table('invoices')
        ->select(DB::raw('SUM(items.retail_price) as total_price, invoice_number, invoice_date, users.username, users.email, invoices.category, invoices.id'))
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->join('items', 'invoice_items.item_id', '=', 'items.id')
        ->join('users', 'invoices.user_id', '=', 'users.id')
        ->groupBy('invoice_number', 'invoice_date', 'users.username', 'users.email', 'invoices.category', 'invoices.id')
        ->where('invoices.category', $invoice_select)
        ->orderBy('invoice_date', 'desc')
        ->paginate(20);
    } else {
      $invoices = DB::table('invoices')
        ->select(DB::raw('SUM(items.retail_price) as total_price, invoice_number, invoice_date, users.username, users.email, invoices.category, invoices.id'))
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->join('items', 'invoice_items.item_id', '=', 'items.id')
        ->join('users', 'invoices.user_id', '=', 'users.id')
        ->groupBy('invoice_number', 'invoice_date', 'users.username', 'users.email', 'invoices.category', 'invoices.id')
        ->orderBy('invoice_date', 'desc')
        ->paginate(20);
    }


    return view('components.table-invoice', compact('invoices', 'invoice_select'));
  }

  public function getInvoiceSell(Request $request, $id)
  {
    return $id;

    return view('components.struk-penjualan');
  }

  public function getInvoiceBuy(Request $request, $id)
  {
    return $id;

    return view('components.struk-pembelian');
  }

  public function getUserInvoices(Request $request)
  {
    $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
    $lastOneYearDateTime = Carbon::now()->subYear()->addMonth()->firstofMonth()->format('Y-m-d H:i:s');

    $invoices = Invoice::where('user_id', Auth::id())
      ->whereBetween('invoice_date', [
        $lastOneYearDateTime,
        $currentDateTime
      ])
      ->orderBy('invoice_date')
      ->get();

    $userIncome = Invoice::where('user_id', Auth::id())
      ->whereBetween('invoice_date', [
        $lastOneYearDateTime,
        $currentDateTime
      ])
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->sum('retail_price');


    // string bulan-bulan
    if ($invoices[0]) {
      $temp = Carbon::parse($invoices[0]->invoice_date);
      $monthsName = array();
      for ($i = 0; $i < 12; $i++) {
        $name = substr($temp->format('F'), 0, 3);
        array_push($monthsName, $name);
        $temp->addMonth();
      };

      // counter tiap bulan
      $invoicesCounter = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      foreach ($invoices as $invoice) {
        switch (Carbon::parse($invoice->invoice_date)->month) {
          case 1:
            $invoicesCounter[0]++;
            break;
          case 2:
            $invoicesCounter[1]++;
            break;
          case 3:
            $invoicesCounter[2]++;
            break;
          case 4:
            $invoicesCounter[3]++;
            break;
          case 5:
            $invoicesCounter[4]++;
            break;
          case 6:
            $invoicesCounter[5]++;
            break;
          case 7:
            $invoicesCounter[6]++;
            break;
          case 8:
            $invoicesCounter[7]++;
            break;
          case 9:
            $invoicesCounter[8]++;
            break;
          case 10:
            $invoicesCounter[9]++;
            break;
          case 11:
            $invoicesCounter[10]++;
            break;
          case 12:
            $invoicesCounter[11]++;
            break;
          default:
            $invoicesCounter[Carbon::parse($invoice->invoice_date)->month]++;
            break;
        }
      };

      $firstMonth = Carbon::parse($invoices[0]->invoice_date)->month;
      if ($firstMonth != 0) {
        $invoicesCtr = array_values(array_slice($invoicesCounter, $firstMonth - 1, count($invoicesCounter) - ($firstMonth - 1), true) + array_slice($invoicesCounter, 0, $firstMonth - 1, true));
      }
      return response()->json([
        'message' => 'Invoices found',
        'invoices' => $invoices,
        'invoicesCounter' => $invoicesCounter,
        'monthsName' => $monthsName,
        'userIncome' => $userIncome
      ]);
    }
    return response()->json([
      'message' => 'No invoices found'
    ]);
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
      ->where('invoices.category', '=', 'penjualan')
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
      ->where('invoices.category', '=', 'penjualan')
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
      ->where('invoices.category', '=', 'penjualan')
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
