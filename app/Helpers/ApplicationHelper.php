<?php

use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\General;
use App\Models\Order;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function getTodayAllOrdersCount($status)
{
    return Order::whereDate('created_at', today())->where(['status' => $status, 'type' => 0])->count();
}

function getAllOrdersCount($status)
{
    return Order::where(['status' => $status, 'type' => 0])->count();
}

function getOrdersCount($status)
{
    return Order::where([
        'orderable_type' => 'App\Models\User',
        'orderable_id' => auth()->user()->id,
        'status' => $status,
    ])->count();
}

function getCookieToken()
{
    return Cookie::has('cart-token') ? Cookie::get('cart-token') : '';
}

function getCartDetails()
{
    return Cart::with('cart_items.book')->where('token', getCookieToken())->first();
}

function getCartCount()
{
    $cart =  Cart::where('token', getCookieToken())->first();
    return !is_null($cart) ? $cart->item_count : 0;
}

function getCartTotal()
{
    $cart =  Cart::where('token', getCookieToken())->first();
    return !is_null($cart) ? intval($cart->items_subtotal_price) : 0;
}

function getBookDetails($book_id)
{
    return Book::with('images')->where('id', $book_id)->first();
}

function getRandomProducts($book_id, $limit)
{
    return Book::with('reviews', 'images')->where('id', '!=', $book_id)->inRandomOrder()->take($limit)->get();
}

function getRandomProductsByCategory($category_id, $book_id, $limit)
{
    $category = Category::with(['books' => function ($query) use ($limit, $book_id) {
        return $query->where('id', '!=', $book_id)->inRandomOrder()->take($limit);
    }])->where('id', $category_id)->first();
    return $category->books;
}

function encryptCartId($cart_id)
{
    return md5($cart_id);
}

function getRecentlyAddedCartItemsHtml($book_id)
{
    $book = getBookDetails($book_id);

    $html = '';

    $html = '
    <div class="newitem__added-wrapper">
    <div class="cart__modal-left">
    <h2 class="newitem__added">1 new item have been added to your cart</h2>
    <div class="newitem__detail">
    <div class="newitem__img">
    <a href="' . route('website.home.book-detail-view', $book->slug) . '">
    <img src="' . asset('storage/' . $book->images[0]->filename) . '" alt="">
    </a>
    </div>
    <div class="newitem__info">
    <h3 class="newitem__name">
    <a href="">' . $book->name . '</a>
    </h3>
    </div>
    </div>
    </div>
    <div class="cart__modal-right">
    <a href="' . route('website.cart.index') . '">
    <button class="btn newitem__view-cart">
    View Cart
    </button>
    </a>
    </div>
    </div>
    ';
    // $books = getRandomProducts($book_id, 6);

    /*Random Products*/
    // $html .= '
    // <article class="book__card">
    // <div class="book__img-wrapper">
    // <a href="' . route('website.home.book-detail-view', $book->slug) . '">
    // <img src="' . asset('storage/' . $book->images[0]->filename) . '" alt="Book Name" class="book__img">

    // </a>
    // </div>
    // <div class="book__info-wrapper">
    // <div class="quick__view-wrapper">
    // <div class="tooltip"><i class="fa-regular fa-eye" id="quickView"></i>
    // <div class="top">
    // <p>Quick View</p>
    // <i></i>
    // </div>
    // </div>';

    // if ($book->reviews->count()) {
    // $averageRating = $book->reviews->avg('ratings');
    // $fullStars = floor($averageRating);
    // $halfStar = $averageRating - $fullStars;
    // $emptyStars = 5 - $fullStars - ceil($halfStar);


    // $html .= '<div class="ratings-wrapper">';
    // for ($i = 1; $i <= $fullStars; $i++) {
    // $html .= '<img src="' . asset('assets/website') . '/images/star.svg" class="ratin__star"/>';
    // }


    // if ($halfStar > 0) {
    // $html .=  '
    // <img src="' . asset('assets/website') . '/images/review_star.svg" class="ratin__star"/>';
    // }


    // for ($i = 1; $i <= $emptyStars; $i++) {
    // $html .= '
    // <img src="' . asset('assets/website') . '/images/review_star.svg" class="ratin__star"/>';
    // }
    // $html .= '</div> ';
    // } else {
    // $html .= '  <div class="ratings-wrapper">
    // <img src="' . asset('assets/website') . '/images/star.svg" class=""/>
    // <img src="' . asset('assets/website') . '/images/star.svg" class=""/>
    // <img src="' . asset('assets/website') . '/images/star.svg" class=""/>
    // <img src="' . asset('assets/website') . '/images/star.svg" class=""/>
    // <img src="' . asset('assets/website') . '/images/star.svg" class=""/>
    // </div>';
    // }

    //     $html .= '
    // <div class="tooltip"><i class="fa-regular fa-heart" id="addToWishList" data-id="' . $book->id . '"></i>
    // <div class="top">
    // <p>Add To Wishlist</p>
    // <i></i>
    // </div>
    // </div>
    // </div>
    // <a href="' . route('website.home.book-detail-view', $book->slug) . '" class="book__name">' . $book->name . '</a>

    // <div class="book__price">';
    // if ($book->price != $book->special_price) {
    // $html .= '<span class="book__real__price">
    // Rs.' . $book->price . '
    // </span>';
    // }

    // $html .= '<span class="book__special__price">Rs.' . $book->special_price . '</span>
    // </div>
    // <button class="btn book__addtocart-btn" id="addToCartBtn" data-id="' . $book->id . '">Add To Cart</button>
    // </div>
    // </article>
    // ';
    // }

    // $html .= '</div>
    // </div>
    // ';
    return $html;
}

function getGeneral()
{
    return General::limit(1)->first();
}

function getAllCategories()
{
    return Category::with('books')->where(['status' => 0, 'parent_id' => 0])->get();
}

function getTopCategories()
{
    return Category::where(['status' => 0, 'parent_id' => 0])->get();
}

function generateSKU($book_id)
{
    $lastSku = Book::orderBy('id', 'desc')->where('id', '!=', $book_id)->first();

    $sku = '';
    if (!is_null($lastSku)) {
        $sku = intval($lastSku->sku) + 1;
    } else {
        $sku = '1001';
    }

    Book::where('id', $book_id)->update(['sku' => $sku]);
}

function generateAccountId($account_id)
{
    $account_id = strval($account_id);
    $acc = '';
    if (strlen($account_id) == 1) {
        $acc = 'AC-000' . $account_id;
    } elseif (strlen($account_id) == 2) {
        $acc = 'AC-00' . $account_id;
    } elseif (strlen($account_id) == 3) {
        $acc = 'AC-0' . $account_id;
    } elseif (strlen($account_id) == 4) {
        $acc = 'AC-' . $account_id;
    }
    return $acc;
}

function generateVoucherId($voucher_id)
{
    $voucher_id = strval($voucher_id);
    $voucher = '';
    if (strlen($voucher_id) == 1) {
        $voucher = 'CV000000' . $voucher_id;
    } elseif (strlen($voucher_id) == 2) {
        $voucher = 'CV00000' . $voucher_id;
    } elseif (strlen($voucher_id) == 3) {
        $voucher = 'CV0000' . $voucher_id;
    } elseif (strlen($voucher_id) == 4) {
        $voucher = 'CV000' . $voucher_id;
    } elseif (strlen($voucher_id) == 5) {
        $voucher = 'CV00' . $voucher_id;
    } elseif (strlen($voucher_id) == 6) {
        $voucher = 'CV0' . $voucher_id;
    } elseif (strlen($voucher_id) == 7) {
        $voucher = 'CV0' . $voucher_id;
    }
    return $voucher;
}


// Function to check if the cookie has expired
function expiredCookie($cookieName)
{
    $expiration = strtotime('+10 years'); // Replace with the actual expiration time or method of obtaining it

    return (time() >= $expiration);
}

function getProductsByCategory()
{
    return Category::has('books')->with('books')->where('parent_id', 0)->limit(5)->get();
}

function compressImage($image)
{
    // Generate a new filename for the compressed image
    $imageName = time() . \Str::random() . '.' . $image->getClientOriginalExtension();

    // create an instance of Intervention Image
    $img = Image::make($image->getRealPath());

    // resize the image to a width of 300 and constrain aspect ratio (auto height)
    $img->resize(500, null, function ($constraint) {
        $constraint->aspectRatio();
    });

    // encode the image in the desired format (70% quality in this example)
    $img->encode('jpg', 90);

    // save the image to the desired location
    Storage::disk('public')->put('images/' . $imageName, $img->__toString());

    return 'images/' . $imageName;
}

function encrypt_value($value)
{
    $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = 'H%$^&%!@)(*)^%0';
    $value = openssl_encrypt($value, $ciphering, $encryption_key, $options, $encryption_iv);
    $value = str_replace('/', '_', $value);
    return $value;
}

function decrypt_value($value)
{
    $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = 'H%$^&%!@)(*)^%0';
    $value = str_replace('_', '/', $value);
    $value = openssl_decrypt($value, $ciphering, $encryption_key, $options, $encryption_iv);
    return $value;
}
