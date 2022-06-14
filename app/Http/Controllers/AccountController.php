<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
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
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required|min:1|max:11',
            'balance' => 'required|min:1|max:11',
        ],
        [
            'account_number.required' => 'El campo de numero de cuenta es requerido',
            'account_number.min' => 'El campo de numero de cuenta debe ser minimo de 1 valor',
            'account_number.max' => 'El campo de numero de cuenta debe ser maximo de 11 valores',
            'balance.required' => 'El campo de saldo es requerido',
            'balance.min' => 'El campo de saldo debe ser minimo de 1 valor',
            'balance.max' => 'El campo de saldo debe ser maximo de 11 valores'
        ]);

        $account = new Account();
        $account->account_number = $request->account_number;
        $account->balance = $request->balance;
        $account->user_id = Auth::user()->id;
        
        $account->save();

        return redirect()->route('indexUser')->with('success','Cuenta creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
