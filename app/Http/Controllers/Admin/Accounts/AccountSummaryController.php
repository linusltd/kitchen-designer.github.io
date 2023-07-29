<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AccountSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $accounts = Account::with('transactions')->get();

            $html = '';
            if ($accounts->count()) {
                foreach ($accounts as $key => $item) {
                    $html .= '<tr>
                    <td>' . $item->account_id . '</td>
                    <td>' . $item->name . '</td>
                    <td>' . $item->transactions()->sum('dr') . '</td>
                    <td>' . $item->transactions()->sum('cr')  . '</td>
                    <td>' . ($item->transactions()->sum('dr')  - $item->transactions()->sum('cr')) . '</td>
                </tr>';
                }
            } else {
                $html .= '<tr><td colspan="5" class="text-center">No Record Found</td></tr>';
            }

            return $html;
        }
        $accounts = Account::all();
        return view('admin.accounts.accountsummary.index', get_defined_vars());
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
