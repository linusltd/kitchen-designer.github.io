<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /*Loading Profile Index View*/
    public function index()
    {
        $pendingOrders = getOrdersCount(0);
        $deliveredOrders = getOrdersCount(1);
        $shippedOrders = getOrdersCount(3);
        $totalOrders = Order::where([
            'orderable_type' => 'App\Models\User',
            'orderable_id' => auth()->user()->id,
        ])->where('status', '!=', 2)->count();
        $user = User::with('orders')->where('id', auth()->user()->id)->first();
        $address = Address::where('user_id', auth()->user()->id)->first();
        return view('new-website.profile.index', get_defined_vars());
    }

    /*Loading Update Profile View*/
    public function UpdateView()
    {
        $address = Address::where('user_id', auth()->user()->id)->first();
        return view('website.profile.updateprofile', get_defined_vars());
    }

    /*Loading Change Password View*/
    public function ChangePasswordView()
    {
        return view('website.profile.changepassword', get_defined_vars());
    }

    public function updateAddress(Request $request)
    {
        $user = Auth::user();
        /*Creating Address*/
        $address = Address::where(['user_id' => $user->id])->first();
        $addresses = Address::where(['user_id' => $user->id])->count();
        if (is_null($address)) {
            $address = Address::create([
                'user_id' => $user->id,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
                'zip' => $request->zip,
                'is_default' => $addresses > 0 ? 0 : 1
            ]);
        } else {
            $address->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
                'zip' => $request->zip
            ]);
        }
        return true;
    }

    /*Loading My Orders View*/
    public function MyOrders()
    {
        $user = User::with('orders')->where('id', auth()->user()->id)->first();
        return view('website.profile.orders', get_defined_vars());
    }
}
