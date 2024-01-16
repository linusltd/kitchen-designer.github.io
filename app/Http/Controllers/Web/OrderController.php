<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAdress;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /*Loading Complete Order View*/
    public function index($order_secret)
    {
        $order = Order::with('address', 'order_items.book')->where('order_secret', $order_secret)->firstOrFail();
        return view('new-website.order.index', get_defined_vars());
    }

    /*Create Order Process*/
    public function create(Request $request)
    {
        $user = Auth::user();

        if (is_null($user)) {
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'password' => $request->email,
                'customer_type' => 1,
            ]);
        }

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
                'state' => $request->state,
                'country' => $request->country,
                'address' => $request->address,
                'city' => $request->city,
                'zip' => $request->zip ? $request->zip : '',
                'is_default' => $addresses > 0 ? 0 : 1
            ]);
        } else {
            $address->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'state' => $request->state,
                'country' => $request->country,
                'address' => $request->address,
                'city' => $request->city,
                'zip' => $request->zip
            ]);
        }


        $order_address = OrderAdress::create([
            'user_id' => $user->id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip ? $request->zip : '',
            'is_default' => $addresses > 0 ? 0 : 1
        ]);

        /*Getting Cart Data*/
        $cart = getCartDetails();
        $delivery_charges = $cart->items_subtotal_price <= 10000 ? 300 : 0;
        /*Creating Order No*/
        $recentOrder = Order::where('type', 0)->orderBy('id', 'desc')->first();
        $order_no = 0;

        if (is_null($recentOrder)) {
            $order_no = 1000;
        } else {
            $order_no = intval($recentOrder->order_no) + 1;
        }

        /*Creating Order*/
        $order = $user->orders()->create([
            'order_no' => $order_no,
            'order_secret' => encrypt_value($order_no),
            'address_id' => $order_address->id,
            'qty' => $cart->item_count,
            'sub_total' => $cart->items_subtotal_price,
            'delivery_charges' => $delivery_charges,
            'total_amount' => $cart->items_subtotal_price + $delivery_charges,
            'received_at' => Carbon::now(),
            'note' => $request->note,
            'type' => 0,
            'status' => 0,
            'payment_method' => 'Cash on delivery'
        ]);
        /*Storing Order Items*/
        foreach ($cart->cart_items as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $cartItem->book_id,
                'price' => $cartItem->price,
                'discount' => 0,
                'qty' => $cartItem->quantity,
                'total_amount' => $cartItem->total_price,
            ]);
            Book::where('id', $cartItem->book_id)->decrement('quantity', $cartItem->quantity);
        }

        $orderItems = OrderItem::with('book')->where('order_id', $order->id)->get();
        $address = OrderAdress::where('user_id', $user->id)->first();

        /*Deleteing Cart*/
        Cart::where('token', getCookieToken())->delete();
        $cookie = Cookie::forget('cart-token');

        /*Sending Mail To Customer*/
        $details = [
            'order' => $order,
            'date' => Carbon::parse($order->received_at)->format('F j, Y'),
            'orderItems' => $orderItems,
            'address' => $order_address,
            'payment_method' => 'Cash on delivery'
        ];
        try {
            Mail::to($request->email)->send(new \App\Mail\ConfirmOrderMail(['details' => $details]));
        } catch (\Exception $e) {
            $order->delete();
            return response()->json(['status' => false]);
        }
        /*Sending Mail To My Staff*/
        // Mail::to('zainveeray@gmail.com')->send(new \App\Mail\NewOrderMail(['details' => $details]));
        Mail::to('talhaashraf235@gmail.com')->send(new \App\Mail\NewOrderMail(['details' => $details]));

        return response(route('website.order.complete-order', $order->order_secret))->withCookie($cookie);
    }

    /*Cancel Order Reuqest*/
    public function cancelOrderRequest(Request $request)
    {
        $order = Order::with('address', 'order_items.book')->where('id', $request->id)->first();

        /*Sending Mail To Customer*/
        $details = [
            'order' => $order,
            'date' => Carbon::parse($order->received_at)->format('F j, Y'),
            'orderItems' => $order->order_items,
            'address' => $order->address,
            'payment_method' => 'Cash on delivery'
        ];
        Mail::to('zainveeray@gmail.com')->send(new \App\Mail\CancelOrderRequestMail(['details' => $details]));
        // Mail::to('talhaashraf235@gmail.com')->send(new \App\Mail\CancelOrderRequestMail(['details' => $details]));
        $order->status = 4;
        $order->update();

        return true;
    }
}
