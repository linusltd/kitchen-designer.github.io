<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\Cart\CartController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\Profile\ProfileController;
use App\Http\Controllers\Web\Auth\AuthController as WebAuthController;
use App\Http\Controllers\Web\WishList\WishListController;

use App\Http\Controllers\Admin\Accounts\AccountController;
use App\Http\Controllers\Admin\Accounts\AccountSummaryController;
use App\Http\Controllers\Admin\Accounts\CashBookController;
use App\Http\Controllers\Admin\Accounts\CashPaymentVoucherController;
use App\Http\Controllers\Admin\Accounts\CashReceiptVoucherController;
use App\Http\Controllers\Admin\Accounts\LedgerController;
use App\Http\Controllers\Admin\Accounts\VoucherController;
use App\Http\Controllers\Admin\Administration\RoleController;
use App\Http\Controllers\Admin\Administration\StaffController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Parameters\AuthorController;
use App\Http\Controllers\Admin\Parameters\CategoryController;
use App\Http\Controllers\Admin\Books\BooksController;
use App\Http\Controllers\Admin\Books\ReviewController;
use App\Http\Controllers\Admin\Cms\GeneralController;
use App\Http\Controllers\Admin\Cms\SliderController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Customer\QueryController;
use App\Http\Controllers\Admin\Orders\OrderController as OrdersOrderController;
use App\Http\Controllers\Admin\Parameters\SupplierController;
use App\Http\Controllers\Admin\Purchases\PurchaseOrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route Configurations*/

Route::get('/config', function () {
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('optimize');
});

/*Web Routes*/
Route::group(['prefix' => '/', 'as' => 'website.'], function () {
    /*Loading Auth Routes*/
    Route::controller(WebAuthController::class)->group(function () {
        Route::get('/login', 'login')->name('auth.login');
        Route::post('/login', 'loginCustomer')->name('auth.submit-login-form');
        Route::get('/register', 'register')->name('auth.register');
        Route::post('/register', 'registerCustomer')->name('auth.submit-register-form');
        Route::get('/verification/${token}', 'registerEmailVerification')->name('auth.register-emial-verification');
        Route::get('/forgot-password', 'forgotPassword')->name('auth.forgot-password');
        Route::post('/forgot-password', 'forgotPasswordProcess')->name('auth.forgot-password-process');
        Route::get('/reset-password/{token}', 'resetPassword')->name('auth.reset-password');
        Route::post('/reset-password', 'resetPasswordProcess')->name('auth.reset-password-process');
    });

    /*Protected Routes*/
    Route::group(['middleware' => 'auth'], function(){
            /*Logout User*/
            Route::get('logout',[ WebAuthController::class, 'logout'])->name('auth.logout');
            /*Loading Profile Routes*/
            Route::prefix('profile')->controller(ProfileController::class)->group(function () {
                Route::get('/', 'index')->name('profile.index');
                Route::get('/update', 'UpdateView')->name('profile.update');
                Route::post('/update', 'UpdateAddress')->name('profile.update-address');
                Route::get('/orders', 'MyOrders')->name('profile.my-orders');
                Route::get('/change-password', 'ChangePasswordView')->name('profile.change-password');
            });
    });

    /*Loading Home Routes*/
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home.index');
        Route::get('shop', 'shop')->name('home.shop');
        Route::get('english', 'english')->name('home.english');
        Route::get('contact', 'contact')->name('home.contact');
        Route::get('search', 'search')->name('home.search');
        Route::get('search-book', 'searchBook')->name('home.search-book');
        Route::post('contact', 'contactPost')->name('home.contact-post');
        Route::get('products/{slug}', 'BookDetailView')->name('home.book-detail-view');
        Route::get('collections/{slug}', 'CategoryDetailView')->name('home.category-detail-view');
        Route::get('quick-view', 'quickView')->name('home.quick-view');
        Route::post('add-review', 'addReview')->name('home.add-review');
    });

    /*Loading Cart Routes*/
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::get('get-cart-details', 'getCartItemsDetails')->name('cart.details');
        Route::get('get-cart-count', 'getCartCount')->name('cart.get.cart.count');
        Route::get('get-cart-total', 'getCartTotal')->name('cart.get.cart.total');
        Route::get('clear-cart', 'clearCart')->name('cart.clear.cart');
        Route::post('add-to-cart', 'addToCart')->name('cart.add.to.cart');
        Route::post('add-to-cart-quick-view', 'addToCartQuickView')->name('cart.add.to.cart-quick-view');
        Route::post('add-to-cart-wishlist', 'addToCartWishList')->name('cart.add.to.cart-wishlist');
        Route::post('add-to-cart-all-wishlist', 'addToCartAllWishList')->name('cart.add.to.cart-all-wishlist');
        Route::post('remove-from-cart', 'removeFromCart')->name('cart.remove.from.cart');
        Route::get('delete-to-cart', 'deleteFromCart')->name('cart.delete.from.cart');
        Route::put('update-cart', 'update')->name('update.cart');
        Route::delete('remove-from-cart', 'remove')->name('remove.from.cart');
        Route::get('cart-content', 'getCartContent')->name('cart.cart-content');
    });

    /*Loading WishList Routes*/
    Route::prefix('wishlist')->controller(WishListController::class)->group(function () {
        Route::get('/', 'index')->name('wishlist.index');
        Route::get('get', 'getWishList')->name('wishlist.get');
        Route::post('add-to-wishlist', 'addToWishList')->name('wishlist.add-to-wishlist');
        Route::post('remove-item', 'removeWishListItem')->name('wishlist.remove-item');
        Route::get('clear-all', 'clearWishList')->name('wishlist.clear-all');
    });

     /*Loading Order Routes*/
     Route::controller(OrderController::class)->group(function () {
        Route::post('/create-order', 'create')->name('order.create-order');
        Route::get('/complete-order/{order_no}/thankyou', 'index')->name('order.complete-order');
        Route::post('/cancel-order-request', 'cancelOrderRequest')->name('order.create-order-request');
    });

});

/*Super Admin Routes*/
Route::group(['prefix' => "portal-control-head-quarter", 'as' => 'admin.'], function () {
    /*Login Auth Routes*/
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/', 'index')->name('auth.index');
            Route::post('/', 'login')->name('auth.login');
        });
    });
    /*Protected Routers*/
    Route::group(['prefix' => '/', 'middleware' => 'auth:admin'], function () {
        /*Logout Route*/
        Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

        /*Dashboard Routes*/
        Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.index');
        });

        /*Administration Routes*/
        Route::group(['prefix' => 'administration'], function(){
            Route::resources([
                'role' => RoleController::class,
                'staff' => StaffController::class,
            ]);
        });

        /*Parameters Routes*/
        Route::group(['prefix' => 'parameters'], function(){
            Route::resources([
                'categories' => CategoryController::class,
                'authors' => AuthorController::class,
                'suppliers' => SupplierController::class
            ]);
        });

        /*Supliment Book Routes*/
        Route::prefix('books')->controller(BooksController::class)->group(function () {
            Route::get('draft', 'draft')->name('books.draft');
            Route::get('get-books-excel', 'getProductsExcel')->name('books.get-books-excel');
        });
        Route::prefix('reviews')->controller(ReviewController::class)->group(function () {
            Route::get('update-review-status', 'updateReviewStatus')->name('reviews.update-review-status');
        });

        /*Products Route*/
        Route::resources([
            'books' => BooksController::class,
            'reviews' => ReviewController::class
        ]);

        /*Supliment Book Routes*/
        Route::prefix('purchase-order')->controller(PurchaseOrderController::class)->group(function () {
            Route::get('get-books', 'getProducts')->name('purchase-order.get-books');
        });

        /*Order Routes*/
        Route::prefix('order')->controller(OrdersOrderController::class)->group(function () {
            Route::get('/', 'index')->name('order.index');
            Route::get('pending', 'pending')->name('order.pending');
            Route::get('shipped', 'shipped')->name('order.shipped');
            Route::get('delivered', 'delivered')->name('order.delivered');
            Route::get('cancelled', 'cancelled')->name('order.cancelled');
            Route::get('cancel-request', 'cancelRequest')->name('order.cancel-request');
            Route::get('failed-delivery', 'failedDelivery')->name('order.failed-delivery');
            Route::get('change-order-status', 'changeOrderStatus')->name('order.change-order-status');
            Route::get('print-shipping-label/{orderIds}', 'printShippingLabels')->name('order.print-shipping-label');

        });

        /*Purchases Route*/
        Route::resources([
            'purchase-order' => PurchaseOrderController::class
        ]);

        /*Customer Routes*/
        Route::group(['prefix' => 'manage-customers'],function(){
            Route::resources([
                'customer' => CustomerController::class,
                'quries' => QueryController::class
            ]);
        });

        /*Accounts Routes*/
        Route::group(['prefix' => 'accounts'], function () {
            Route::resources([
                'account' => AccountController::class,
                'voucher' => VoucherController::class,
                'cash-payment-voucher' => CashPaymentVoucherController::class,
                'cash-receipt-voucher' => CashReceiptVoucherController::class,
                'cash-book' => CashBookController::class,
                'ledger' => LedgerController::class,
                'account-summary' => AccountSummaryController::class,
            ]);
        });

        /*CMS*/
        Route::group(['prefix' => 'cms'], function(){
            Route::resources([
                'general' => GeneralController::class,
                'slider' => SliderController::class
            ]);
        });
    });
});


/*Staff Panel Routes*/
