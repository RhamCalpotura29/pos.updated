<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Detail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index',compact('transactions'));
        
    }

    public function cancel(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'Cancellation Requested';
        $transaction->cancellation_reason = $request->input('reason');
        $transaction->save();

        return redirect()->back()->with('success', 'Cancellation requested successfully.');
    }

    public function approveCancellation(Request $request, $id)
    {
    $transaction = Transaction::find($id);

    // Check if the transaction has a cancellation reason
    if ($transaction->cancellation_reason) {
        // Update the transaction status to 'Cancelled' and perform any additional actions
        $transaction->status = 'Cancelled';
        $transaction->delete();

        return redirect()->back()->with('success', 'Transaction cancelled successfully.');
    } else {
        return redirect()->back()->with('error', 'Cancellation reason not provided. Please review the cancellation reason before approving.');
    }
    }
    public function approve($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'Paid';
        $transaction->save();
        
        return redirect()->back()->with('success', 'Transaction paid successfully.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

}