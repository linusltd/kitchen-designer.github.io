<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Query;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /*Loading Index View*/
    public function index()
    {
        $sliders = Slider::with('book', 'category')->where(['type' => 0, 'status' => 0])->get();
        $categories = getAllCategories();
        $categoriesWithProducts = Book::all();

        return view('website.home.index', get_defined_vars());
    }

    /*Loading Shop View*/
    public function shop()
    {
        $books = Book::with('reviews','images')->paginate(52);
        $sliders = Slider::with('book', 'category')->where(['type' => 1, 'status' => 0])->get();
        return view('website.home.shop', get_defined_vars());
    }

    /*Loading English View*/
    public function english()
    {
        $sliders = Slider::with('book', 'category')->where(['type' => 2, 'status' => 0])->get();
        $categories = getAllCategories();
        $categoriesWithProducts = getProductsByCategory();
        return view('website.home.index', get_defined_vars());
    }

    /*Loading Contact View*/
    public function contact()
    {
        return view('website.home.contact', get_defined_vars());
    }

    /*Loading Contact View*/
    public function contactPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ],
            [
                'email.required' => 'Email is invalid.',
            ]
        );

        Query::create($request->all());

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'query' => $request->input('query'),
            'phone' => $request->phone,
        ];

        Mail::to('hamzaashraf160@gmail.com')->send(new \App\Mail\ContactUsMail(['details' => $details]));

        return redirect()->back()->with('message','Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.');

    }

    /*Loading Book Detail View*/
    public function BookDetailView($slug){

        $book = Book::with('images', 'categories', 'authors', 'reviews')->where('slug', $slug)->firstOrFail();
        $reviews = Review::where('book_id', $book->id)->where('is_verified', 1)->limit(4)->get();
        $categories = $book->categories->count() ? implode(",", $book->categories->pluck('name')->toArray()): '--';
        $authors = $book->authors->count() ? implode(",", $book->authors->pluck('name')->toArray()): '--';

        return view('website.home.book-detail', get_defined_vars());
    }

    /*Loading Category Detail View*/
    public function CategoryDetailView($slug){
        $category = Category::with('books')->where('slug', $slug)->first();
        $books = $category->books()->paginate(52);
        $sliders = Slider::where(['type' => 1, 'status' => 0])->get();
        return view('website.home.category', get_defined_vars());
    }

    /*Loading Quick View*/
    public function quickView(Request $request){
        $book = getBookDetails($request->id);
        $categories = $book->categories->count() ? implode(",", $book->categories->pluck('name')->toArray()): '--';
        $authors = $book->authors->count() ? implode(",", $book->authors->pluck('name')->toArray()): '--';

        $html = '
        <div class="qucik__view-wrapper">
            <div class="quick__view-left">
                <div class="quick__img-wrapper">
                    <a href="'.route('website.home.book-detail-view', $book->slug).'">
                        <img src="'.asset('storage/'. $book->images[0]->filename).'" alt="" class="quick__img">
                    </a>
                </div>
            </div>
            <div class="quick__view-right">
                <a href="'.route('website.home.book-detail-view', $book->slug).'"><h2 class="quick__view-title">'.$book->name.'</h2></a>
                <div class="quick__spacer"></div>
                <p class="quick__view-prices">';
                if($book->price !== $book->special_price){
                    $html .= '<span class="quick__view-discount">Rs.'.number_format($book->price , 2).'</span>';
                }
                $html .= '<span class="quick__view-price">Rs.'.number_format($book->special_price , 2).'</span>
                </p>
                <div class="quick__view-reviews">';

                if($book->reviews->count()){
                    $averageRating = $book->reviews->avg('ratings');
                    $fullStars = floor($averageRating);
                    $halfStar = $averageRating - $fullStars;
                    $emptyStars = 5 - $fullStars - ceil($halfStar);

                    $html .= '
                        <div class="ratings"> ';
                        for ($i = 1; $i <= $fullStars; $i++){
                            $html .= '<img src="'.asset('assets/website').'/images/star.svg" class="ratin__star"/>';
                        }


                        if ($halfStar > 0){
                           $html .=  '
                            <img src="'.asset('assets/website').'/images/hald_star.svg" class="ratin__star"/>';
                        }


                        for ($i = 1; $i <= $emptyStars; $i++){
                            $html .= '
                            <img src="'.asset('assets/website').'/images/bland_star.svg" class="ratin__star"/>';
                        }

                    $html .=  '</div>
                        <span class="'.$book->reviews->count().'">(11 review)</span>';
                    }


                $html .='
                </div>
                <div class="quick__spacer"></div>
                <div class="quick__cart-wrapper">';

                if($book->in_stock == 0){
                    $html .= '<span class="in__stock">In Stock</span>';
                }else{
                    $html .= '<span class="out__of-stock">Out Of Stock</span>';
                }

                    $html .= '<div class="quick__qty">
                        <div class="qty__wrapper">
                            <button class="minus__btn" id="deacreaseQuanatity"><i class="fas fa-minus"></i></button>
                            <input type="text" name="quantity" id="quantity" value="1" readonly />
                            <button class="plus__btn" id="increaseQuantity"><i class="fas fa-plus"></i></button>
                        </div>';
                        if($book->in_stock == 0){
                            $html .= '<button class="btn book__addtocart-btn quick__btn" id="addToCartBtnQuickView" data-id="'.$book->id.'">Add To Cart</button>
                            <button class="btn book__addtocart-btn quick__btn buy_now-btn" id="addToCartBtnQuickView" data-id="'.$book->id.'">Buy Now</button>';
                        }else{
                            $html .= '<button class="btn book__addtocart-btn quick__btn" disabled data-id="'.$book->id.'">Add To Cart</button>
                            <button class="btn book__addtocart-btn quick__btn buy_now-btn">Buy Now</button>';
                        }

                    $html .= '</div>
                </div>
                <div class="quick__spacer"></div>
                <div class="quick__view-info">
                    <p><span>SKU: </span>  '.$book->sku.'</p>
                    <div>
                    '.htmlspecialchars_decode(stripslashes($book->highlights)).'
                    </div>
                </div>
                <div class="quick__spacer"></div>
                <div class="quick__view-socials">
                    <div class="share__wrapper">
                    <strong>Share This Product</strong>
                    <div class="quick__view-socials--wrapper">
                        <div class="tooltip" style="display: block !important">
                            <a href="https://www.facebook.com/sharer.php?u='.request()->url().'" target="_blank">
                                <img src="'.asset('assets/website').'/images/fb1.svg" alt="Facebook" class="social__img"/>
                            </a>
                            <div class="top">
                                <p>Share on Facebook</p>
                                <i></i>
                            </div>
                        </div>
                        <div class="tooltip" style="display: block !important">
                            <a href="https://twitter.com/intent/tweet?text='.$book->name.'&url='.request()->url().'" target="_blank">
                                <img src="'.asset('assets/website').'/images/twit.svg" alt="Twitter" class="social__img"/>
                            </a>
                            <div class="top">
                                <p>Share on Twitter</p>
                                <i></i>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="quick_verticle__spacer"></div>
                    <p class="quick__view-wishlist" id="addToWishList" data-id="{{ $book->id }}">
                        <img src="'.asset('assets/website').'/images/heart.svg" alt="">
                        Add to Wishlist
                    </p>

                </div>
            </div>
        </div>';

        return $html;

    }

    /*Add Review*/
    public function addReview(Request $request){
        Review::create($request->all());
        return true;
    }

    /*Search Book View*/
    public function search(Request $request){
        return view('website.home.search');
    }

    /*Search Book Function*/
    public function searchBook(Request $request){
        $books = Book::with('images', 'categories', 'authors', 'reviews')->where('name', 'like', '%'.$request->search.
        '%')->limit(20)->get();

        $html = '';


        if($books->count()){
            foreach($books as $book){
                $html .= '
                    <article class="search__book-item">
                    <div class="search__book_info">
                        <a href="'.route('website.home.book-detail-view', $book->slug).'">
                            <img src="'.asset('storage/'. $book->images[0]->filename).'" alt="" class="book__img">

                        </a>
                        <a class="book__name" href="'.route('website.home.book-detail-view', $book->slug).'">
                            '.$book->name.'
                        </a>
                    </div>
                    <div class="book__price">';

                        if($book->price !== $book->special_price){
                            $html .= '<span class="book__real__price">
                            Rs.'.number_format($book->price).'
                        </span>';
                        }
                        $html .= '<span class="book__special__price">Rs.'.number_format($book->special_price).'</span>
                    </div>
                    </article>
                ';
            }
        }

        return $html;
    }

}
