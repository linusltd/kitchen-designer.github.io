<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allOrders = Order::where(['type' => 0])->orderBy('id', 'desc')->paginate(10);
        $pendingOrdersCount = getAllOrdersCount(0);
        $shippedOrdersCount = getAllOrdersCount(3);
        $deliveredOrdersCount = getAllOrdersCount(1);
        $cancelledOrdersCount = getAllOrdersCount(2);
        $cancelRequestOrdersCount = getAllOrdersCount(4);
        $failedDeliveryOrdersCount = getAllOrdersCount(5);
        return view('admin.orders.index', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $pendingOrders = Order::where(['status' => 0, 'type' => 0])->orderBy('id', 'desc')->paginate(10);
        $pendingOrdersCount = getAllOrdersCount(0);
        $shippedOrdersCount = getAllOrdersCount(3);
        $deliveredOrdersCount = getAllOrdersCount(1);
        $cancelledOrdersCount = getAllOrdersCount(2);
        $cancelRequestOrdersCount = getAllOrdersCount(4);
        $failedDeliveryOrdersCount = getAllOrdersCount(5);
        return view('admin.orders.pending', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivered()
    {
        $deliveredOrders = Order::where(['status' => 1, 'type' => 0])->orderBy('id', 'desc')->paginate(10);
        $pendingOrdersCount = getAllOrdersCount(0);
        $shippedOrdersCount = getAllOrdersCount(3);
        $deliveredOrdersCount = getAllOrdersCount(1);
        $cancelledOrdersCount = getAllOrdersCount(2);
        $cancelRequestOrdersCount = getAllOrdersCount(4);
        $failedDeliveryOrdersCount = getAllOrdersCount(5);
        return view('admin.orders.delivered', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipped()
    {
        $shippedOrders = Order::where(['status' => 3, 'type' => 0])->orderBy('id', 'desc')->paginate(10);
        $pendingOrdersCount = getAllOrdersCount(0);
        $shippedOrdersCount = getAllOrdersCount(3);
        $deliveredOrdersCount = getAllOrdersCount(1);
        $cancelledOrdersCount = getAllOrdersCount(2);
        $cancelRequestOrdersCount = getAllOrdersCount(4);
        $failedDeliveryOrdersCount = getAllOrdersCount(5);
        return view('admin.orders.shipped', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelled()
    {
        $cancelledOrders = Order::where(['status' => 2, 'type' => 0])->orderBy('id', 'desc')->paginate(10);
        $pendingOrdersCount = getAllOrdersCount(0);
        $shippedOrdersCount = getAllOrdersCount(3);
        $deliveredOrdersCount = getAllOrdersCount(1);
        $cancelledOrdersCount = getAllOrdersCount(2);
        $cancelRequestOrdersCount = getAllOrdersCount(4);
        $failedDeliveryOrdersCount = getAllOrdersCount(5);
        return view('admin.orders.cancelled', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelRequest()
    {
        $cancelRequestOrders = Order::where(['status' => 4, 'type' => 0])->orderBy('id', 'desc')->paginate(10);
        $pendingOrdersCount = getAllOrdersCount(0);
        $shippedOrdersCount = getAllOrdersCount(3);
        $deliveredOrdersCount = getAllOrdersCount(1);
        $cancelledOrdersCount = getAllOrdersCount(2);
        $cancelRequestOrdersCount = getAllOrdersCount(4);
        $failedDeliveryOrdersCount = getAllOrdersCount(5);
        return view('admin.orders.cancelrequest', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function failedDelivery()
    {
        $failedDeliveryOrders = Order::where(['status' => 5, 'type' => 0])->orderBy('id', 'desc')->paginate(10);
        $pendingOrdersCount = getAllOrdersCount(0);
        $shippedOrdersCount = getAllOrdersCount(3);
        $deliveredOrdersCount = getAllOrdersCount(1);
        $cancelledOrdersCount = getAllOrdersCount(2);
        $cancelRequestOrdersCount = getAllOrdersCount(4);
        $failedDeliveryOrdersCount = getAllOrdersCount(5);
        return view('admin.orders.faileddelivery', get_defined_vars());
    }

    /*Change Order Status*/
    public function changeOrderStatus(Request $request){
        $order = Order::with('address','order_items.book')->where('id', $request->id)->firstOrFail();

         /*Sending Mail To Customer*/
         $details = [
            'order' => $order,
            'date' => Carbon::parse($order->received_at)->format('F j, Y'),
            'orderItems' => $order->order_items,
            'address' => $order->address,
            'payment_method' => 'Cash on delivery'
        ];


        $order->status = $request->status;
        if($request->status == 3){ // Shipped Order
            Mail::to($order->address)->send(new \App\Mail\ShipOrderMail(['details' => $details]));
            $order->shipped_at = Carbon::now();
        }elseif($request->status == 2){ // Cancelled Order
            Mail::to($order->address)->send(new \App\Mail\CancelOrderMail(['details' => $details]));
            // Increament Books Quantity
            foreach ($order->order_items as $cartItem) {
                Book::where('id', $cartItem->book_id)->increment('quantity', intval($cartItem->qty));
            }
            $order->cancelled_at = Carbon::now();
        }elseif($request->status == 5){ // Failed Delivery
            $order->cancelled_at = Carbon::now();
            // Increament Books Quantity
            foreach ($order->order_items as $cartItem) {
                Book::where('id', $cartItem->book_id)->increment('quantity', intval($cartItem->qty));
            }
            Mail::to($order->address)->send(new \App\Mail\FailedOrderDeliveryMail(['details' => $details]));
        }elseif($request->status == 1){ // Delivered Delivery
            $order->cancelled_at = Carbon::now();
            Mail::to($order->address)->send(new \App\Mail\DeliverOrderMail(['details' => $details]));
        }
        $order->update();

        return redirect()->back();

    }

    public function printShippingLabels(Request $request, $orderIds){
        $orderIds = explode(',' , $orderIds);
        $logo = getGeneral()->logo;
        $general = getGeneral();
        $orders = Order::with('address','order_items.book')->whereIN('id', $orderIds)->get();
        return view('admin.orders.print', get_defined_vars());
    }
}
