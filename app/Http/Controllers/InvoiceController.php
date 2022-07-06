<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

/* Creating a class called InvoiceController that extends the Controller class. */

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

    public function toggleLink($invoiceNumber)
    {
        $invoice = DB::table('invoices')->where('invoice_number', $invoiceNumber)->get()->first();
        DB::table('invoices')->where('invoice_number', $invoiceNumber)->update(['link' => !$invoice->link]);

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPenjualan(Request $request)
    {
        $datas = $request->all();
        $invoice = new Invoice();
        $invoice->user_id = Auth::user()->id;
        $invoice->invoice_date = Carbon::now();
        $invoice->category = 'penjualan';
        $invoice->save();
        foreach ($datas as $data) {
            $item = DB::table('items')->where('name', $data['name'])->first();
            $item->stock = $item->stock - $data['quantity'];
            DB::table('items')->where('name', $data['name'])->update(['stock' => $item->stock]);

            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->item_id = $item->id;
            $invoice_item->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPembelian(Request $request)
    {
        $supplierId = DB::table('suppliers')->where('name', $request->supplier)->first()->id;

        $datas = $request->form;
        $invoice = new Invoice();
        $invoice->user_id = Auth::user()->id;
        $invoice->invoice_date = Carbon::now();
        $invoice->category = 'pembelian';
        $invoice->supplier_id = $supplierId;
        $invoice->save();

        foreach ($datas as $data) {
            $item = DB::table('items')->where('name', $data['name'])->first();
            $item->stock = $item->stock + $data['quantity'];
            DB::table('items')->where('name', $data['name'])->update(['stock' => $item->stock]);

            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->item_id = $item->id;
            $invoice_item->save();
        }
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
     * It gets all invoices from the database, and then returns a view with the data
     *
     * @param Request request The request object.
     *
     * @return The view of the table-invoice.blade.php
     */
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

    /**
     *
     *
     * @param Request request The request object.
     */
    public function addNewItemInvoice(Request $request)
    {
    }

    /**
     * I want to get the data from the database and display it in the view
     *
     * @param Request request The request object.
     * @param id The id of the invoice
     *
     * @return The view of the invoice.
     */
    public function getInvoiceSell(Request $request, $id)
    {
        $struk = DB::table('invoices')->where('invoices.id', $request->id)
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->join('users', 'invoices.user_id', '=', 'users.id')
      ->select(DB::raw('SUM(items.retail_price) as total_price, invoice_number, invoice_date, users.username'))
      ->groupBy('invoice_number', 'invoice_date', 'users.username', 'items.retail_price')
      ->orderBy('items.retail_price', 'asc')
      ->get();

        $total_price = DB::table('invoices')->where('invoices.id', $request->id)
      ->select(DB::raw('SUM(items.retail_price) as total_struk', 'invoices.id'))
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->groupBy('invoices.id')
      ->first();

        $items = DB::table('invoice_items')->where('invoice_items.invoice_id', $request->id)
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->select(DB::raw('items.name, items.retail_price'))
      ->orderBy('items.retail_price', 'asc')
      ->get();

        $banyak_items = DB::table('invoice_items')->where('invoice_items.invoice_id', $request->id)
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->select(DB::raw('COUNT(items.id) as total_items'))
      ->groupBy('items.id')
      ->orderBy('items.retail_price', 'asc')
      ->get();
        // dd($total_price);


        return view('components.struk-penjualan', compact('struk', 'total_price', 'items', 'banyak_items'));
    }

    /**
     * I want to return the view of the invoice, but I want to pass the id of the invoice to the view
     *
     * @param Request request The request object.
     * @param id The id of the invoice
     *
     * @return The id of the invoice.
     */
    public function getInvoiceBuy(Request $request)
    {
        $struk = DB::table('invoices')->where('invoices.id', $request->id)
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->select(DB::raw('SUM(items.retail_price) as total_price, invoice_number, invoice_date'))
      ->groupBy('invoice_number', 'invoice_date', 'items.retail_price')
      ->orderBy('items.retail_price', 'asc')
      ->get();

        $supplier = DB::table('invoices')->where('invoices.id', $request->id)
      ->join('suppliers', 'invoices.supplier_id', '=', 'suppliers.id')
      ->select(DB::raw('suppliers.name, suppliers.email, suppliers.phone, suppliers.address'))
      ->first();


        $total_price = DB::table('invoices')->where('invoices.id', $request->id)
      ->select(DB::raw('SUM(items.retail_price) as total_struk', 'invoices.id'))
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->groupBy('invoices.id')
      ->first();

        $items = DB::table('invoice_items')->where('invoice_items.invoice_id', $request->id)
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->select(DB::raw('items.name, items.retail_price'))
      ->orderBy('items.retail_price', 'asc')
      ->get();

        $banyak_items = DB::table('invoice_items')->where('invoice_items.invoice_id', $request->id)
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->select(DB::raw('COUNT(items.id) as total_items'))
      ->groupBy('items.id')
      ->orderBy('items.retail_price', 'asc')
      ->get();



        return view('components.struk-pembelian', compact('struk', 'total_price', 'items', 'banyak_items', 'supplier'));
    }

    /**
     * It gets all the invoices of the current user, then it counts the number of invoices per month,
     * and finally it returns the invoices, the number of invoices per month, and the user's income
     *
     * @param Request request The request object.
     *
     * @return an array of invoices, an array of invoice counters, an array of months name, and the
     * user income.
     */
    public function getUserInvoices(Request $request)
    {
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
        $lastOneYearDateTime = Carbon::now()->subYear()->addMonth()->firstofMonth()->format('Y-m-d H:i:s');

        $invoices = Invoice::where('user_id', Auth::id())
      ->whereBetween('invoice_date', [
        $lastOneYearDateTime,
        $currentDateTime
      ])
      ->where('category', 'penjualan')
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

            // $firstMonth = Carbon::parse($invoices[0]->invoice_date)->month;
            $firstMonth = Carbon::parse($lastOneYearDateTime)->month;
            if ($firstMonth != 0) {
                $invoicesCtr = array_values(array_slice($invoicesCounter, $firstMonth - 1, count($invoicesCounter) - ($firstMonth - 1), true) + array_slice($invoicesCounter, 0, $firstMonth - 1, true));
            }
            return response()->json([
        'message' => 'Invoices found',
        'invoices' => $invoices,
        'invoicesCtr' => $invoicesCtr,
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

    public function getInvoice($invoiceNumber)
    {
        $invoice = DB::table('invoices')->where('invoice_number', $invoiceNumber)
      ->select('invoices.id', 'invoices.link', 'invoices.supplier_id', 'invoices.invoice_number', 'invoices.invoice_date', 'users.username', 'invoices.category')
      ->join('users', 'invoices.user_id', '=', 'users.id')->first();
        if (!$invoice->link) {
            return view('components.invoice-not-found');
        }
        $items = DB::table('invoice_items')->where('invoice_items.invoice_id', $invoice->id)
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->select('items.name', 'items.retail_price', 'items.id')
      ->selectRaw('COUNT(items.id) as quantity')
      ->groupBy('items.id', 'items.name', 'items.retail_price')
      ->orderBy('items.retail_price', 'asc')
      ->get();

        $banyak_items = DB::table('invoice_items')->where('invoice_items.invoice_id', $invoice->id)
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->select(DB::raw('COUNT(items.id) as total_items, SUM(items.retail_price) as total_price'))
      ->groupBy('invoice_items.invoice_id')
      ->orderBy('total_items', 'asc')
      ->get()
      ->first();

        if ($invoice->supplier_id) {
            $supplier = Supplier::find($invoice->supplier_id);
            return view('components.public-struk-pembelian', compact('invoice', 'items', 'banyak_items', 'supplier'));
        } else {
            return view('components.public-struk-penjualan', compact('invoice', 'items', 'banyak_items'));
        }
    }

    /**
     * It gets the data from the database and returns it to the view
     *
     * @return The data is being returned in the form of a table.
     */
    public function getDataPerYear()
    {
        $invoices = DB::table('invoices')

      ->select('invoices.id', 'invoices.invoice_date', 'users.username', 'users.email', 'invoices.link', 'invoice_number')
      ->selectRaw('SUM(retail_price) as total_price, COUNT(items.retail_price) as total_items')
      ->join('users', 'invoices.user_id', '=', 'users.id')
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->whereYear('invoices.invoice_date', '=', date('Y') - 1)
      ->where('invoices.category', '=', 'penjualan')
      ->groupBy('invoices.id', 'invoices.invoice_date', 'users.username', 'users.email', 'invoices.user_id', 'invoices.category', 'invoices.link', 'invoice_number')
      ->paginate(20);

        $invoice_select = 'year';
        $total_invoices = DB::table('invoices')->whereYear('invoice_date', '=', date('Y') - 1)->count();

        return view('components.table-penjualan', compact('invoices', 'total_invoices', 'invoice_select'));
    }

    /**
     * It gets the total price, total items, invoice id, invoice date, username, and email of all
     * invoices that are created in the last month, and groups them by invoice id, invoice date,
     * username, and email
     *
     * @return a view of the table-penjualan.blade.php file.
     */
    public function getDataPerMonth()
    {
        $invoices = DB::table('invoices')
      ->select(DB::raw('SUM(items.retail_price) as total_price, COUNT(items.retail_price) as total_items, invoices.id, invoices.invoice_date, users.username, users.email, invoices.link, invoice_number'))
      ->join('users', 'invoices.user_id', '=', 'users.id')
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->where('invoices.invoice_date', '>=', date('Y-m-d', strtotime('-1 months')))
      ->where('invoices.category', '=', 'penjualan')
      ->groupBy('invoices.id', 'invoices.invoice_date', 'users.username', 'users.email', 'invoices.link', 'invoice_number')
      ->paginate(20);

        $invoice_select = 'month';
        $total_invoices = DB::table('invoices')->where('invoice_date', '>=', date('Y-m-d', strtotime('-1 months')))->count();
        return view('components.table-penjualan', compact('invoices', 'total_invoices', 'invoice_select'));
    }

    /**
     * It gets the total price and total items of each invoice, the invoice id, invoice date, username,
     * and email of the user who made the invoice, and then groups them by invoice id, invoice date,
     * username, and email, and then paginates them
     *
     * @return a view of the table-penjualan.blade.php file.
     */
    public function getDataPerWeek()
    {
        $invoices = DB::table('invoices')
      ->select(DB::raw('SUM(items.retail_price) as total_price, COUNT(items.retail_price) as total_items, invoices.id, invoices.invoice_date, users.username, users.email, invoices.link, invoice_number'))
      ->join('users', 'invoices.user_id', '=', 'users.id')
      ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
      ->join('items', 'invoice_items.item_id', '=', 'items.id')
      ->where('invoices.invoice_date', '>=', date('Y-m-d', strtotime('-7 days')))
      ->where('invoices.category', '=', 'penjualan')
      ->groupBy('invoices.id', 'invoices.invoice_date', 'users.username', 'users.email', 'invoices.link')
      ->paginate(20);

        $invoice_select = 'week';
        $total_invoices = DB::table('invoices')->where('invoice_date', '>=', date('Y-m-d', strtotime('-7 days')))->count();
        return view('components.table-penjualan', compact('invoices', 'total_invoices', 'invoice_select', 'invoice_number'));
    }

    /**
     * It returns the average number of sales per hour for the last three months
     *
     * @param Request request The request object.
     *
     * @return The average number of sales per hour for the last 3 months.
     */
    public function getAverageSale(Request $request)
    {
        $monthsDiff = 3;
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
        $lastThreeMonthsDateTime = Carbon::now()->subMonths($monthsDiff)->firstofMonth()->format('Y-m-d H:i:s');

        // $invoices = DB::table('invoices')
        // ->whereBetween('invoice_date', [
        //   $lastThreeMonthsDateTime,
        //   $currentDateTime
        // ])
        // ->get();


        // if ($invoices[0]) {
        $avgPerHour = array();
        $lower = 7;
        $upper = 9;
        for ($i = 0; $i < 8; $i++) {
            $temp = DB::table('invoices')
        ->whereBetween('invoice_date', [
          $lastThreeMonthsDateTime,
          $currentDateTime
        ])
        ->whereBetween(DB::raw('HOUR(invoice_date)'), [
          $lower,
          $upper
        ])
        ->count();
            $upper += 2;
            $lower += 2;
            array_push($avgPerHour, $temp);
        }
        return response()->json([
      'message' => 'Invoices found',
      'avgPerHour' => $avgPerHour,
      'monthsDiff' => $monthsDiff
    ]);



        //   }
    //   return response()->json([
    //     'message' => 'No invoices found'
    // ]);
    }
}
