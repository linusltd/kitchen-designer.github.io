<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CashReceiptVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::all();
        return view('admin.accounts.cashreceiptvoucher.index', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Creating Voucher*/
        $voucher = Voucher::create(['amount' => $request->amount]);
        /*Updating Voucher ID*/
        Voucher::where('id', $voucher->id)->update(['voucher_id' => generateVoucherId($voucher->id)]);

        /*Storing Transaction Against This Voucher*/
        foreach ($request->account_ids as $key => $account_id) {
            Transaction::create([
                'voucher_id' => $voucher->id,
                'account_id' => $account_id,
                'narration' => $request->narrations[$key],
                'date' => $request->dates[$key],
                'bill_no' => $request->bill_nos[$key],
                'dr' => $request->amounts[$key]
            ]);
        }

        return response()->json(['success' => true, 'response' => 'Receipt voucher created successfully!']);
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
