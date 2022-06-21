<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Auth;

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
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function getUserInvoice(Request $request, Invoice $invoices)
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


        // string bulan-bulan
        $temp = Carbon::parse($invoices[0]->invoice_date);
        $monthsName = array();
        for ($i=0; $i<12; $i++) {
            $name = substr($temp->format('F'), 0, 3);
            array_push($monthsName, $name);
            $temp->addMonth();
        };

        // counter tiap bulan
        $invoicesCounter = [0,0,0,0,0,0,0,0,0,0,0,0];
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
        if ($firstMonth!=0) {
            $invoicesCtr = array_values(array_slice($invoicesCounter, $firstMonth-1, count($invoicesCounter)-($firstMonth-1), true)+ array_slice($invoicesCounter, 0, $firstMonth-1, true));
        }

        return view('dashboard', compact('invoices', 'invoicesCtr', 'monthsName'));
    }
}
