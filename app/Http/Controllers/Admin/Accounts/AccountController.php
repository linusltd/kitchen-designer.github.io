<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accounts\Account\StoreRequest;
use App\Http\Requests\Admin\Accounts\Account\UpdateRequest;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $accounts = Account::orderBy('id', 'desc')->get();

            $data = [];
            foreach ($accounts as $key => $item) {
                $data[] = [
                    'Row_Index_ID' => ++$key,
                    'id' => $item->id,
                    'account_id' => $item->account_id,
                    'name' => $item->name,
                    'status' => '<span class="badge bg-label-' . ($item->status == 0 ? 'primary' : 'warning') . ' me-1">' . ($item->status == 0 ? 'Active' : 'Inactive') . '</span>',
                ];
            }

            return response()->json(['data' => $data]);
        }
        return view('admin.accounts.account.index', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $account = Account::create($request->all());
        Account::where('id', $account->id)->update(['account_id' => generateAccountId($account->id)]);
        return response()->json(['success' => true, 'response' => 'account created successfully!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $account = Account::where('id', $id)->first();
        $account->update($request->all());
        return response()->json(['success' => true, 'response' => 'account updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::destroy($id);
        return response()->json(['success' => true, 'response' => 'account deleted successfully!']);
    }
}
