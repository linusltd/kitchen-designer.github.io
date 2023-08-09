<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /*Loading index view*/
    public function index()
    {
        $todayPendingOrdersCount = getTodayAllOrdersCount(0);
        $todayCancelledOrdersCount = getTodayAllOrdersCount(2);
        $totalOrdersCount =  Order::where(['type' => 0])->orderBy('id', 'desc')->count();
        $totalShippedOrdersCount = getAllOrdersCount(3);
        $totalCancelledOrdersCount = getAllOrdersCount(2);
        $totalDeliveredOrdersCount = getAllOrdersCount(1);
        $totalFailedDeliveredOrdersCount = getAllOrdersCount(1);
        $onlineProductsCount = Book::where('status', 1)->count();
        $reviewsCount = Review::count();
        $customersCount = User::count();
        $toDayCartCount = Cart::whereDate('created_at', today())->count();
        $totalCartCount = Cart::withTrashed()->count();

        return view('admin.dashboard.index', get_defined_vars());
    }
}
