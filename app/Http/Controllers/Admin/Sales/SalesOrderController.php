<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\Book;

class SalesOrderController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $parties = Order::with('party')->orderBy('id', 'desc')->where('type', 2)->get();
            $data = [];
            if ($parties->count()) {
                foreach ($parties as $key => $item) {
                    $class = '';
                    $status = '';
                    if ($item->status == 0) {
                        $class = 'primary';
                        $status = 'Open';
                    } elseif ($item->status == 1) {
                        $class = 'success';
                        $status = 'Completed';
                    } else {
                        $class = 'danger';
                        $status = 'Cancelled';
                    }
                    $data[] = [
                        'Row_Index_ID' => ++$key,
                        'id' => $item->id,
                        'date' => $item->created_at->format('d-M-Y'),
                        'order_no' => $item->order_no,
                        'supplier' => $item->party ? $item->party->name : '',
                        'delivery' => $item->delivery_date,
                        'qty' => $item->qty,
                        'total_amount' => $item->total_amount,
                        'status' => '<span class="badge bg-label-' . $class . ' me-1">' . $status . '</span>',
                    ];
                }
            }
            return response()->json(['data' => $data]);
        }
        return view('admin.sales.index', get_defined_vars());
    }

    public function create()
    {
        $Parties = Party::all();
        return view('admin.sales.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'orderable_type' => 'App\Models\Party',
            'orderable_id' => $request->party_id,
            'reference_no' => $request->reference_no,
            'issue_date' => $request->issue_date,
            'delivery_date' => $request->delivery_date,
            'qty' => $request->total_qty ? $request->total_qty : 0,
            'total_amount' => $request->total_order_amount ? $request->total_order_amount : 0,
            'type' => 2
        ]);
        $order_id = $order->id;
        Order::where('id', $order_id)->update(['order_no' =>  'SAL0' . $order_id]);

        /*Creating Order Items*/
        if (isset($request->price)) {
            foreach ($request->price as $key => $price) {
                $orderItem = OrderItem::create([
                    'order_id' => $order_id,
                    'price' => $price,
                    'discount' => $request->discount_percentrage[$key],
                    'qty' => $request->qty[$key],
                    'total_amount' => $request->total_amount[$key],
                    'product_name' => $request->product_name[$key]
                ]);
                if ($request->book_id[$key] != null) {
                    $orderItem_id = $orderItem->id;
                    OrderItem::where('id', $orderItem_id)->update(['book_id' => $request->book_id[$key]]);
                }
            }
        }

        return response()->json(['success' => true, 'response' => 'Sales Order created successfully!']);
    }

    public function edit($id)
    {
        $suppliers = Party::all();
        $order = Order::with(['order_items' => function ($query) {
            return $query->with('book');
        }])->where('id', $id)->first();
        return view('admin.sales.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();
        $order->update([
            'supplier_id' => $request->party_id,
            'reference_no' => $request->reference_no,
            'issue_date' => $request->issue_date,
            'status' => $request->status,
            'delivery_date' => $request->delivery_date,
            'qty' => $request->total_qty ? $request->total_qty : 0,
            'total_amount' => $request->total_order_amount ? $request->total_order_amount : 0
        ]);
        $order_id = $order->id;

        /*Deleting Purhcase Order Items*/
        $order->order_items()->delete();

        /*Creating Order Items*/
        if (isset($request->price)) {
            foreach ($request->price as $key => $price) {
                $orderItem = OrderItem::create([
                    'order_id' => $order_id,
                    'price' => $price,
                    'discount' => $request->discount_percentrage[$key],
                    'qty' => $request->qty[$key],
                    'total_amount' => $request->total_amount[$key],
                    'product_name' => $request->product_name[$key]
                ]);
                if ($request->book_id[$key] != null) {
                    $orderItem_id = $orderItem->id;
                    OrderItem::where('id', $orderItem_id)->update(['book_id' => $request->book_id[$key]]);
                }
            }

            if ($request->status == 1) {
                $book = Book::where('id', $request->book_id[$key])->first();
                $book->quantity -= $request->qty[$key];
                $book->update();
            }
        }

        return response()->json(['success' => true, 'response' => 'Sales Order updated successfully!']);
    }

    public function show($id)
    {
        $order = Order::with('party')->with(['order_items' => function ($query) {
            return $query->with('book');
        }])->where('id', $id)->first();
        return view('admin.invoices.sales_order', get_defined_vars());
    }

    public function destroy()
    {
    }
}
