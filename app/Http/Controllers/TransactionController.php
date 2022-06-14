<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $allAcounts = Account::where('user_id', '=', $userId)->get();
        $data = [];
        foreach ($allAcounts as $key => $value) {
            $data[] = Transaction::where('origing_account', '=', $value->id)->orWhere('destination_account', '=', $value->id)->get();
        }

        return view('transactions.index',compact('data'));
        
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
        $request->validate([
            'origing_account' => 'required',
            'destination_account' => 'required',
            'value' => 'required',
        ]);

        $this->validateDataTransaction($request);

        $code = "TRANSID-".strtoupper(uniqid());
        
        $transaction = new Transaction();
        $transaction->origing_account = $request->origing_account;
        $transaction->destination_account = $request->destination_account;
        $transaction->value = $request->value;
        $transaction->code = $code;

        $transaction->save();
 
        return redirect()->route('indexUser')->with('success','Transacción exitosa codigo: ' . $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    /**
     * Process data for transactions
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateDataTransaction(Request $request)
    {
        $accountOrigin = Account::find($request->origing_account);
        
        
        if($accountOrigin->balance < $request->value){

            return redirect()->route('indexUser')->with('invalid','Fondos insuficientes');

        }else if($request->origing_account == $request->destination_account){

            return redirect()->route('indexUser')->with('invalid','Las cuentas deben ser distintas');

        }else if($request->value <= 0){

            return redirect()->route('indexUser')->with('invalid','El valor debe ser mayor a cero');

        }else {
            $accountOrigin->balance = $accountOrigin->balance - $request->value;
            $accountOrigin->save();
        }

        if ($request->value > 0) {
            $accountDestination = Account::find($request->destination_account);
            $accountDestination->balance = $accountDestination->balance + $request->value;
            $accountDestination->save();
        }
    }
}
