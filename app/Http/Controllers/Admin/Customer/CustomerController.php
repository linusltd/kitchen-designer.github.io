<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('orders')->orderBy('id', 'desc')->get();
        return view('admin.customer.index', get_defined_vars());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['orders' => function($query){
            return $query->orderBy('id', 'desc');
        }])->where('id',$id)->first();
        return view('admin.customer.show', get_defined_vars());
    }

}
