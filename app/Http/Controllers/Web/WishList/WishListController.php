<?php

namespace App\Http\Controllers\Web\WishList;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class WishListController extends Controller
{
    /*Loading Wish List View*/
    public function index()
    {
        $token = Cookie::get('wishlist-token');
        $wishlists = WishList::with('book')->where('token', $token)->get();
        return view('new-website.home.wishlist', get_defined_vars());
    }

    /*Add To Wish List Function*/
    public function addToWishList(Request $request)
    {
        $book_id = $request->book_id;
        $book = getBookDetails($book_id);

        $html = '<div class="wishlist__header">
        <a href="' . route('website.wishlist.index') . '">Show Wishlist</a>
        <img src="' . asset('assets/website/images/wishlistcross.svg') . '" class="wishlist__cross"/>
        </div>
        <div class="wishlist__body">
        <div class="wishlist__img-wrapper">
        <a href="' . route('website.home.book-detail-view', $book->slug) . '"><img src="' . asset('storage/' . $book->images[0]->filename) . '" alt="Book Image"></a>
        </div>
        <div>
        <a href="' . route('website.home.book-detail-view', $book->slug) . '"><p class="wishlist__book-name">' . $book->name . '</p></a>
        <p class="wishlist__book-price">Rs.' . $book->special_price . '</p>
        </div>
        </div>';

        /*Check If Cookie Already Exists*/
        if (!Cookie::has('wishlist-token')) {
            $data = [
                'book_id' => $book_id,
            ];
            /*Store Data To Wishlist Table*/
            $wishlist = WishList::create($data);
            /*Create WhishList Unique Token*/
            $token = encryptCartId($wishlist->id);
            WishList::where('id', $wishlist->id)->update(['token' => $token]);
            /*Create Cookie If Not Exists*/
            $cookie = Cookie::make('wishlist-token', $token, null);

            // return response()->json(['success' => true, 'html' => $html])->withCookie($cookie);
            return response()->json(['success' => true])->withCookie($cookie);
        } else {
            /*Get Cookie Value*/
            $token = Cookie::get('wishlist-token');
            $checkWishList = WishList::where(['token' => $token, 'book_id' => $book_id])->first();

            if (is_null($checkWishList)) {
                $data = [
                    'book_id' => $book_id,
                    'token' => $token
                ];
                /*Store Data To Wishlist Table*/
                $wishlist = WishList::create($data);
                return response()->json(['success' => true, 'html' => $html]);
            } else {
                $html = '<div class="wishlist__alert-error">
                    <p class="wishlist__alert-message"> Oops! ' . $book->name . ' already existed in your wishlist</p>
                </div>';
                return response()->json(['success' => false, 'html' => $html]);
            }
        }
    }

    /*Remove WishList Item*/
    public function removeWishListItem(Request $request)
    {
        WishList::destroy($request->id);
        $token = Cookie::get('wishlist-token');
        $wishlists = WishList::with('book')->where('token', $token)->get();

        return response()->json(['count' => $wishlists->count()]);
    }

    /*Clearing Wish List All Items*/
    public function clearWishList(Request $request)
    {
        $token = Cookie::get('wishlist-token');
        WishList::with('book')->where('token', $token)->delete();
        $cookie = Cookie::forget('wishlist-token');
        return response('Cookie Removed')->withCookie($cookie);
    }

    public function getWishList()
    {
        $token = Cookie::get('wishlist-token');
        $wishlists = WishList::with('book')->where('token', $token)->get();

        $html = '';
        // foreach ($wishlists as $wishlist) {
        // $html .= '
        //     <tr>
        //         <td>
        //             <div class="cart__item">
        //                 <div class="cart__item-img">
        //                     <a href="' . route('website.home.book-detail-view', $wishlist->book->slug) . '">
        //                         <img src="' . asset('storage/' . $wishlist->book->images[0]->filename) . '" alt="">
        //                     </a>
        //                 </div>
        //                 <p class="cart__item-name"><a href="' . route('website.home.book-detail-view', $wishlist->book->slug) . '">' . $wishlist->book->name . '</a></p>
        //             </div>
        //         </td>
        //         <td>Rs.' . $wishlist->book->special_price . '</td>
        //         <td>In Stock</td>
        //         <td>
        //             <input type="hidden" name="id" value="' . $wishlist->id . '">
        //             <input type="hidden" name="book_id" value="' . $wishlist->book_id . '">
        //             <button class="btn book__addtocart-btn quick__btn wishlist__addto-cart" id="addToCartWishList">Add To Cart</button>
        //         </td>
        //         <td><i class="fa fa-trash" style="cursor: pointer;color:red" id="removeItemFromWishList" data-id="' . $wishlist->id . '"></i></td>
        //     </tr>
        // ';
        // }
        foreach ($wishlists as $wishlist) {
            $html .= '<tr>
            <td class="pro-thumbnail">
                <a href="' . route("website.home.book-detail-view", $wishlist->book->slug) . '">
                <img class="img-fluid"
                src="' . asset("storage/" . $wishlist->book->images[0]->filename) . '"
                alt="' . $wishlist->book->name . '" />
                </a>
            </td>
            <td class="pro-title">
                <a href="' . route("website.home.book-detail-view", $wishlist->book->slug) . '">' . $wishlist->book->name . '</a>
            </td>
            <td class="pro-price">
            <span>
                Rs.' . ($wishlist->book->special_price != $wishlist->book->price ? $wishlist->book->special_price : $wishlist->book->price) . '</span>
            </td>
            <td class="pro-quantity">';
            if ($wishlist->in_stock == 0) {
                $html .= '
                    <span class="text-success">
                        In Stock
                    </span>';
            } else {
                $html .= '
                    <span class="text-danger">
                        Out of Stock
                    </span>';
            }
            $html .= '
            </td>
            <td class="pro-subtotal">
                <input type="hidden" name="id" value="' . $wishlist->id . '">
                <input type="hidden" name="book_id" value="' . $wishlist->book_id . '">
                <a href="" class="btn btn__bg" id="addToCartWishList">
                    Add to
                    Cart
                </a>
            </td>
            <td class="pro-remove">
                <a href="#" id="removeItemFromWishList"
                    data-id="' . $wishlist->id . '">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>';
        }

        return $html;
    }
}
