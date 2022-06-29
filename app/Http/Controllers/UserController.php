<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
            ->select('users.username', 'users.email', DB::raw('count(invoices.id) as invoice_count'), 'users.registration_number', 'users.address', 'users.phone', 'users.nik', 'users.birthday', 'users.registration_number', 'users.role')
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
    public function update(Request $request)
    {
        try {
            $dataValidation =
                $this->validate($request, [
                    'username' => ['required', 'min:3', 'max:255'],
                    'email' =>  'required|email|unique:users,email,' . $request->user()->id,
                    // 'password' => 'required',
                    'address' => 'nullable',
                    'phone' => 'nullable',
                    'nik' => 'nullable|digits:16',
                    'birthday' => 'nullable|date',
                ]);
            $request->validate([
                'password' => 'required',
            ]);

            if (!Hash::check($request->password, $request->user()->password)) {
                return response()->json([
                    'err' => 'Password Salah',
                ], 422);
            }

            $request->user()->password = Hash::make($request->password);
            $request->user()->save();
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }

        // return response()->json([
        //     'data' => $request->user()->id
        // ]);

        User::where('id', $request->user()->id)->update($dataValidation);

        return response()->json([
            'success' => 'Data telah berhasil diupdate'
        ]);

        // $validatedData = $request->validate($rules);

        // if($request->file('photo')){
        //     if($request->oldPhoto){
        //         Storage::delete($request->oldPhoto);
        //     }
        //     $validatedData['photo'] = $request->file('photo')->store('users-photo');
        // }


        // User::where('id', $user->id)->update($validatedData);
        // return ($request);
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
