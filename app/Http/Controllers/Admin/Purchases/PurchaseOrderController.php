<?php

namespace App\Http\Controllers\Admin\Purchases;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PDF;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $suppliers = Order::with('supplier')->orderBy('id', 'desc')->get();
            $data = [];
            if($suppliers->count()){
                    foreach($suppliers as $key => $item){
                        $class = '';
                        $status = '';
                        if($item->status == 0){
                            $class = 'primary';
                            $status = 'Open';
                        }elseif($item->status == 1){
                            $class = 'success';
                            $status = 'Completed';
                        }else{
                            $class = 'danger';
                            $status = 'Cancelled';
                        }
                        $data[] = [
                            'Row_Index_ID' => ++$key,
                            'id' => $item->id,
                            'date' => $item->created_at->format('d-M-Y'),
                            'order_no' => $item->order_no,
                            'supplier' => $item->supplier ? $item->supplier->name : '',
                            'delivery' => $item->delivery_date,
                            'qty' => $item->qty,
                            'total_amount' => $item->total_amount,
                            'status' => '<span class="badge bg-label-'.$class.' me-1">'.$status.'</span>',
                        ];
                    }
                }
                return response()->json(['data' => $data]);
        }
        return view('admin.purchases.purchase_order.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.purchases.purchase_order.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'orderable_type' => 'App\Models\Supplier',
            'orderable_id' => $request->supplier_id,
            'reference_no' => $request->reference_no,
            'issue_date' => $request->issue_date,
            'delivery_date' => $request->delivery_date,
            'qty' => $request->total_qty ? $request->total_qty : 0,
            'total_amount' => $request->total_order_amount ? $request->total_order_amount : 0,
            'type' => 1
        ]);
        $order_id = $order->id;
        Order::where('id', $order_id)->update(['order_no' =>  'ORD0'.$order_id]);

        /*Creating Order Items*/
        if(isset($request->price)){
            foreach($request->price as $key => $price){
                OrderItem::create([
                    'order_id' => $order_id,
                    'book_id' => $request->book_id[$key],
                    'price' => $price,
                    'discount' => $request->discount_percentrage[$key],
                    'qty' => $request->qty[$key],
                    'total_amount' => $request->total_amount[$key]
                ]);
            }
        }

        return response()->json(['success' => true, 'response' => 'Puchase Order created successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('supplier')->with(['order_items' => function($query){
            return $query->with('book');
        }])->where('id', $id)->first();
        return view('admin.invoices.purchase_order', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = Supplier::all();
        $order = Order::with(['order_items' => function($query){
            return $query->with('book');
        }])->where('id', $id)->first();
        return view('admin.purchases.purchase_order.edit', get_defined_vars());
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
        $order = Order::where('id', $id)->first();
        $order->update([
            'supplier_id' => $request->supplier_id,
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
        if(isset($request->price)){
            foreach($request->price as $key => $price){
                OrderItem::create([
                    'order_id' => $order_id,
                    'book_id' => $request->book_id[$key],
                    'price' => $price,
                    'discount' => $request->discount_percentrage[$key],
                    'qty' => $request->qty[$key],
                    'total_amount' => $request->total_amount[$key]
                ]);


                if($request->status == 1){
                    $book = Book::where('id', $request->book_id[$key])->first();
                    $book->quantity += $request->qty[$key];
                    $book->update();
                }

            }
        }

        return response()->json(['success' => true, 'response' => 'Puchase Order updated successfully!']);
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


    public function getProducts(Request $request){
        $books = Book::with('images')->where('name', 'like', '%'.$request->name.'%')->where('status', 1)->limit(20)->get();

        $html = '';

        if($books->count()){
            foreach($books as $key => $book){
                $html .= '<tr>
                    <td>'.++$key.'</td>
                    <td><img src="'.asset('storage/'. $book->images[0]->filename).'" width="50px" height="50px"/></td>
                    <td>'.$book->name.'</td>
                    <td>'.$book->sku.'</td>
                    <td>'.$book->price.'</td>
                    <td>'.$book->quantity.'</td>
                    <td>
                        <input type="hidden" name="name" value="'.$book->name.'"/>
                        <input type="hidden" name="sku" value="'.$book->sku.'"/>
                        <input type="hidden" name="price" value="'.$book->price.'"/>
                        <input type="hidden" name="quantity" value="'.$book->quantity.'"/>
                        <input type="hidden" name="image" value="'.asset('storage/'. $book->images[0]->filename).'"/>
                        <button class="btn btn-success btn-sm" id="loadBookBtn" data-id="'.$book->id.'">Load</button>
                    </td>
                </tr>';
            }
        }else{
            $html = '<tr>
                <td colspan="7" class="alert alert-danger text-center">No Book Found</td>
            </tr>';
        }

        return $html;
    }
}
