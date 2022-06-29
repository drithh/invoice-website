<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* Extending the Controller class. */

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // list user with invoice transaction from this month
        $users = DB::table('users')
            ->select('users.id', 'users.username', 'users.email', DB::raw('count(invoices.id) as invoice_count'))
            ->join('invoices', 'invoices.user_id', '=', 'users.id')
            ->where('invoices.created_at', '>=', date('Y-m-01'))
            ->groupBy('users.id', 'users.username', 'users.email')
            ->orderBy('invoice_count', 'desc')
            ->paginate(8);

        return view('components.table-karyawan', compact('users'));
    }

    public function get($id)
    {
        $user = DB::table('users')
            ->select('users.username', 'users.email', DB::raw('count(invoices.id) as invoice_count'), 'users.registration_number',  'users.address', 'users.phone', 'users.nik', 'users.birthday', 'users.registration_number', 'users.role')
            ->join('invoices', 'invoices.user_id', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->groupBy('users.username', 'users.email', 'users.address', 'users.phone', 'users.nik', 'users.birthday', 'users.registration_number', 'users.registration_number', 'users.role')
            ->first();

        return view('components.data-karyawan', compact('user'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
