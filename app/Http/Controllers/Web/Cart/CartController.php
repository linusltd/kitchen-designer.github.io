<?php

namespace App\Http\Controllers\Web\Cart;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /*Loading Cart Index View*/
    public function index(){
        $cart = getCartDetails();
        $cart_items = getCartDetails() ? getCartDetails()->cart_items : [];
        $address = Address::where(['user_id' => Auth::user() ? Auth::user()->id : 0])->orderBy('id', 'desc')->first();
        return view('website.cart.index', get_defined_vars());
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getCartCount(Request $request)
    {
        return getCartCount();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getCartTotal(Request $request)
    {
        return getCartTotal();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getCartItemsDetails(Request $request)
    {
        $cart = getCartDetails();

        $cart_items = getCartDetails() ? getCartDetails()->cart_items : [];
        $html = '';
        foreach($cart_items as $item){
            $html .= '
            <tr>
            <td>
                <div class="cart__item">
                    <div class="cart__item-img">
                        <a href="'.route('website.home.book-detail-view', $item->book->slug).'" class="cart__item-name">
                            <img src="'.asset('storage/' . $item->book->images[0]->filename) .'" alt="'.$item->book->name.'">
                        </a>
                    </div>

                    <div class="cart__item-info">
                        <a href="'.route('website.home.book-detail-view', $item->book->slug).'" class="cart__item-name">'.$item->book->name.'
                        </a>
                        <span class="cart__mobile_quantity">'.$item->quantity.' x Rs.'.$item->price.' = Rs.'.$item->total_price.'</span>
                        <i class="cart__mobile_trash fa fa-trash" style="cursor: pointer;color:red" id="deleteCartItem" data-id="'.$item->id.'"></i>
                    </div>
                </div>
            </td>
            <td>Rs.'.$item->price.'</td>
            <td><div class="quick__qty">
                <div class="qty__wrapper">
                    <button class="minus__btn" id="removeFromCartInternalBtn" data-id="'.$item->id.'"><i class="fas fa-minus"></i></button>
                    <input type="text" name="" id="" value="'.$item->quantity.'" readonly>
                    <button class="plus__btn" id="addToCartInternalBtn" data-id="'.$item->book_id.'"><i class="fas fa-plus"></i></button>
                </div>
            </div></td>
            <td>Rs.'.$item->total_price.'</td>
            <td><i class="fa fa-trash" style="cursor: pointer;color:red" id="deleteCartItem" data-id="'.$item->id.'"></i></td>
        </tr>
            ';
        }


        $totalBillHtml = '';


        foreach ($cart_items as $item){
           $totalBillHtml .= '<tr>
            <td>'.$item->book->name.' x '.$item->quantity.'</td>
                <td align="center">Rs.'.number_format($item->total_price, 2).'</td>
            </tr>';
        }

        $delivery_charges = $cart->items_subtotal_price <= 5000 ? 150 : 0;
        $totalBillHtml .= '
            <tr>
                <td><strong>SUB TOTAL</strong></td>
                <td align="center">Rs.'.number_format($cart->items_subtotal_price, 2).'</td>
            </tr>';

            $totalBillHtml .= '<tr>
            <td><strong>SHIPPING FEE</strong></td>
                <td align="center" class="shipping__fee">Rs.'.$delivery_charges.'.00</td>
            </tr>';


           $totalBillHtml .= '<tr>
                <td class="total"><strong>TOTAL</strong></td>
                <td align="center" class="total"><strong>Rs.'.number_format($cart->items_subtotal_price + $delivery_charges, 2).'</strong></td>
            </tr>';

        return response()->json(['cartItems' => $html, 'cartBill' => $totalBillHtml]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getCartContent(Request $request)
    {
        $cart = getCartDetails();

        $cart_items = getCartDetails() ? getCartDetails()->cart_items : [];
        $html = '<div class="modal-header">
                <h3 class="cart__modal-title">YOUR CART</h3>
                <p class="cart__items-count">('.$cart->item_count.') ITEMS</p>
                <a href="'.route('website.cart.index').'" class="cart__view">View Cart</a>
            </div>
            <div class="modal-body">
                <div class="cart__wrapper-container">

                ';
        foreach($cart_items as $item){
            $html .= '
            <div class="cart__item-wrapper">
                        <div class="cart__item-image">
                            <a href="'.route('website.home.book-detail-view', $item->book->slug).'">
                                <img src="'.asset('storage/' . $item->book->images[0]->filename) .'" alt="">
                            </a>
                        </div>
                        <div class="cart__info">
                            <p class="cart__item-name">
                            <a href="'.route('website.home.book-detail-view', $item->book->slug).'">'.$item->book->name.'</a>
                            </p>
                            <p class="cart__item-price">
                                '.$item->quantity.' x Rs.'.$item->price.'
                            </p>
                            <div class="delete-cart">
                               <!--- <i class="fas fa-close"></i>---->
                            </div>
                        </div>
                    </div>
            ';
        }

        $html .= '</div>
        </div>';

         return $html;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearCart(Request $request)
    {
        $token = Cookie::get('cart-token');
        $cart = Cart::where('token', $token)->first();
        CartItem::where('cart_id', $cart->id)->delete();
        $cart->delete();
        $cookie = Cookie::forget('cart-token');
        return response('Cookie Removed')->withCookie($cookie);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request)
    {
        // $cookie = Cookie::forget('cart-token');

        // return response('Cookie Removed')->withCookie($cookie);
        /*Get Book Data*/
        $book = getBookDetails($request->book_id);
        $price = $book->special_price != $book->price ? $book->special_price : $book->price;
        $html = getRecentlyAddedCartItemsHtml($request->book_id);

        /*Check If Cookie Already Exists*/
        if (!Cookie::has('cart-token') || expiredCookie('cart-token')) {
            $data = [
                'price' => $price,
                'item_count' => 1,
                'items_subtotal_price' => $price,
                'original_total_price' => $price,
            ];
            /*Store Data To Cart Table*/
            $cart = Cart::create($data);
            /*Create Cart Unique Token*/
            $token = encryptCartId($cart->id);
            Cart::where('id', $cart->id)->update(['token' => $token]);
            /*Create Cookie If Not Exists*/
            $cookie = Cookie::make('cart-token', $token, time() + (10 * 365 * 24 * 60 * 60));

            /*Storing Cart Items Data*/
            CartItem::create([
                'cart_id' => $cart->id,
                'book_id' => $request->book_id,
                'quantity' => 1,
                'price' => $price,
                'total_price' => $price,
            ]);


            return response($html)->withCookie($cookie);

        }else{
            /*Get Cookie Value*/
            $token = Cookie::get('cart-token');
            $cart = Cart::where('token', $token)->first();

            /*Check If Cart Item Already Exist*/
            $checkCartItem = CartItem::where(['cart_id' => $cart->id, 'book_id' => $request->book_id])->first();
            $price = $book->special_price != $book->price ? $book->special_price : $book->price;

            if(!is_null($checkCartItem)){

                $checkCartItem->quantity += 1;
                $checkCartItem->total_price += $price;
                $checkCartItem->update();

            }else{

                /*Storing Cart Items Data*/
                CartItem::create([
                    'cart_id' => $cart->id,
                    'book_id' => $request->book_id,
                    'quantity' => 1,
                    'price' => $price,
                    'total_price' => $price,
                ]);

            }

            /*Upating Cart Values*/
            $cart->item_count += 1;
            $cart->items_subtotal_price += $price;
            $cart->original_total_price += $price;
            $cart->update();

            return response($html);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCartQuickView(Request $request)
    {
        /*Get Book Data*/
        $book = getBookDetails($request->book_id);
        $price = $book->special_price != $book->price ? $book->special_price : $book->price;
        $html = getRecentlyAddedCartItemsHtml($request->book_id);

        /*Check If Cookie Already Exists*/
        if (!Cookie::has('cart-token') || expiredCookie('cart-token')) {

            $data = [
                'item_count' => $request->quantity,
                'items_subtotal_price' => $price * $request->quantity,
                'original_total_price' => $price * $request->quantity,
            ];

            /*Store Data To Cart Table*/
            $cart = Cart::create($data);
            /*Create Cart Unique Token*/
            $token = encryptCartId($cart->id);
            Cart::where('id', $cart->id)->update(['token' => $token]);
            /*Create Cookie If Not Exists*/
            $cookie = Cookie::make('cart-token', $token, time() + (10 * 365 * 24 * 60 * 60));

            /*Storing Cart Items Data*/
            CartItem::create([
                'cart_id' => $cart->id,
                'book_id' => $request->book_id,
                'quantity' => $request->quantity,
                'price' => $price,
                'total_price' => $price * $request->quantity,
            ]);

            return response($html)->withCookie($cookie);

        }else{
            /*Get Cookie Value*/
            $token = Cookie::get('cart-token');
            $cart = Cart::where('token', $token)->first();

            /*Check If Cart Item Already Exist*/
            $checkCartItem = CartItem::where(['cart_id' => $cart->id, 'book_id' => $request->book_id])->first();
            $price = $book->special_price != $book->price ? $book->special_price : $book->price;

            if(!is_null($checkCartItem)){

                $checkCartItem->quantity += $request->quantity;
                $checkCartItem->total_price += $price * $request->quantity;
                $checkCartItem->update();

            }else{

                /*Storing Cart Items Data*/
                CartItem::create([
                    'cart_id' => $cart->id,
                    'book_id' => $request->book_id,
                    'quantity' => $request->quantity,
                    'price' => $price,
                    'total_price' => $price * $request->quantity,
                ]);

            }

            /*Upating Cart Values*/
            $cart->item_count += $request->quantity;
            $cart->items_subtotal_price += $price;
            $cart->original_total_price += $price;
            $cart->update();

            return response($html);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCartWishList(Request $request){
        /*Get Book Data*/
        $book = getBookDetails($request->book_id);
        $price = $book->special_price != $book->price ? $book->special_price : $book->price;
        $html = getRecentlyAddedCartItemsHtml($request->book_id);

        /*Deleteing Item From WishList*/
        $wishlilst =  WishList::where('id',$request->id)->first();
        $wishlilsts = WishList::where('token', $wishlilst->token)->get();
        $wishlilst->delete();
        /*Check If Cookie Already Exists*/
        if (!Cookie::has('cart-token') || expiredCookie('cart-token')) {

            $data = [
                'item_count' => $request->quantity,
                'items_subtotal_price' => $price,
                'original_total_price' => $price,
            ];

            /*Store Data To Cart Table*/
            $cart = Cart::create($data);
            /*Create Cart Unique Token*/
            $token = encryptCartId($cart->id);
            Cart::where('id', $cart->id)->update(['token' => $token]);
            /*Create Cookie If Not Exists*/
            $cookie = Cookie::make('cart-token', $token, time() + (10 * 365 * 24 * 60 * 60));

            /*Storing Cart Items Data*/
            CartItem::create([
                'cart_id' => $cart->id,
                'book_id' => $request->book_id,
                'quantity' => 1,
                'price' => $price,
                'total_price' => $price,
            ]);

            return response()->json(['wishlilsts' => $wishlilsts])->withCookie($cookie);

        }else{
            /*Get Cookie Value*/
            $token = Cookie::get('cart-token');
            $cart = Cart::where('token', $token)->first();

            /*Check If Cart Item Already Exist*/
            $checkCartItem = CartItem::where(['cart_id' => $cart->id, 'book_id' => $request->book_id])->first();
            $price = $book->special_price != $book->price ? $book->special_price : $book->price;

            if(!is_null($checkCartItem)){

                $checkCartItem->quantity += 1;
                $checkCartItem->total_price += $price;
                $checkCartItem->update();

            }else{

                /*Storing Cart Items Data*/
                CartItem::create([
                    'cart_id' => $cart->id,
                    'book_id' => $request->book_id,
                    'quantity' => 1,
                    'price' => $price,
                    'total_price' => $price,
                ]);

            }

            /*Upating Cart Values*/
            $cart->item_count += 1;
            $cart->items_subtotal_price += $price;
            $cart->original_total_price += $price;
            $cart->update();

            return response()->json(['wishlilsts' => $wishlilsts]);
        }

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCartAllWishList(Request $request){

        /*Deleteing Item From WishList*/
        $wishListToken = Cookie::get('wishlist-token');
        $wishlists = WishList::where('token', $wishListToken)->get();

        $token = encryptCartId(date('d-m-y').time());
        $cookie = '';
        foreach($wishlists as $wishlist){
            /*Get Book Data*/
            $book = getBookDetails($wishlist->book_id);
            $price = $book->special_price != $book->price ? $book->special_price : $book->price;
             /*Check If Cookie Already Exists*/
            if (!Cookie::has('cart-token') || expiredCookie('cart-token')) {

                $data = [
                    'item_count' => $request->quantity,
                    'items_subtotal_price' => $price,
                    'original_total_price' => $price,
                ];

                /*Store Data To Cart Table*/
                $cart = Cart::create($data);
                /*Create Cart Unique Token*/
                Cart::where('id', $cart->id)->update(['token' => $token]);
                /*Create Cookie If Not Exists*/

                /*Storing Cart Items Data*/
                CartItem::create([
                    'cart_id' => $cart->id,
                    'book_id' => $wishlist->book_id,
                    'quantity' => 1,
                    'price' => $price,
                    'total_price' => $price,
                ]);


            }else{

                /*Get Cookie Value*/
                $token = Cookie::get('cart-token');
                $cart = Cart::where('token', $token)->first();

                /*Check If Cart Item Already Exist*/
                $checkCartItem = CartItem::where(['cart_id' => $cart->id, 'book_id' => $wishlist->book_id])->first();
                $price = $book->special_price != $book->price ? $book->special_price : $book->price;

                if(!is_null($checkCartItem)){

                    $checkCartItem->quantity += 1;
                    $checkCartItem->total_price += $price;
                    $checkCartItem->update();

                }else{

                    /*Storing Cart Items Data*/
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'book_id' => $wishlist->book_id,
                        'quantity' => 1,
                        'price' => $price,
                        'total_price' => $price,
                    ]);

                }

                /*Upating Cart Values*/
                $cart->item_count += 1;
                $cart->items_subtotal_price += $price;
                $cart->original_total_price += $price;
                $cart->update();

            }
        }

        WishList::where('token', $wishListToken)->delete();
        if(!Cookie::has('cart-token') || expiredCookie('cart-token')){
            $cookie = Cookie::make('cart-token', $token, time() + (10 * 365 * 24 * 60 * 60));
            return response()->withCookie($cookie);
        }else{
            return true;
        }


    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function removeFromCart(Request $request)
    {
        /*Update Quantity From Cart Items*/
        $cartItem = CartItem::where('id', $request->id)->first();

        if($cartItem->quantity == 1){
            /*Delete Cart Item*/
            $cartItem->delete();
        }else{
            $cartItem->quantity -= 1;
            $cartItem->total_price -= $cartItem->price;
            $cartItem->update();
        }

        /*Get Cart Item and Update Totals*/
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        $cart->item_count -= 1;
        $cart->items_subtotal_price -= $cartItem->price;
        $cart->original_total_price -= $cartItem->price;
        $cart->update();

        /*Refetching The Cart*/
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        if($cart->item_count <= 0){
            $cart->delete();
            $cookie = Cookie::forget('cart-token');
            return response()->json(['success'   => false, 'response' => 'Cart Is Empty'])->withCookie($cookie);
        }

        return  response()->json(['success'   => true, 'response' => 'Cart Item Delete Successfully!']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function deleteFromCart(Request $request)
    {
        /*Get Delete Cart Item From Cart Items*/
        $cartItem = CartItem::where('id', $request->id)->first();
        /*Get Cart Item and Update Totals*/
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        $cart->item_count -= $cartItem->quantity;
        $cart->items_subtotal_price -= $cartItem->total_price;
        $cart->original_total_price -= $cartItem->total_price;
        $cart->update();

        /*Delete Cart Item*/
        $cartItem->delete();

        /*Refetching The Cart*/
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        if($cart->item_count <= 0){
            $cart->delete();
            $cookie = Cookie::forget('cart-token');
            return response()->json(['success'   => false, 'response' => 'Cart Is Empty'])->withCookie($cookie);
        }

        return  response()->json(['success'   => true, 'response' => 'Cart Item Delete Successfully!']);

    }

}
