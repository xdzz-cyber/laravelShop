<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\WishListComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\ThankYouComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
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


Route::get("/", HomeComponent::class);

Route::get("/shop", ShopComponent::class);

Route::get("/cart", CartComponent::class)->name("product.cart");

Route::get("/checkout", CheckoutComponent::class)->name("checkout");

Route::get("/product/{slug}", DetailsComponent::class)->name("product.details");

Route::get("/product_category/{category_slug}", CategoryComponent::class)->name("product.category");

Route::get("/search", SearchComponent::class)->name("product.search");

Route::get("/wishlist",WishListComponent::class)->name("product.wishlist");

Route::get("/thank-you", ThankYouComponent::class)->name("thank-you");


//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//For user or customer
Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::get("/user/dashboard", UserDashboardComponent::class)->name("user.dashboard");
    Route::get("/user/orders", UserOrdersComponent::class)->name("user.orders");
    Route::get("/user/orders/{order_id}", UserOrderDetailsComponent::class)->name("user.orderDetails");
});

//For admin
Route::middleware(['auth:sanctum','verified', "authAdmin"])->group(function (){
    Route::get("/admin/dashboard", AdminDashboardComponent::class)->name("admin.dashboard");
    Route::get("/admin/categories",AdminCategoryComponent::class)->name("admin.categories");
    Route::get("/admin/category/add", AdminAddCategoryComponent::class)->name("admin.addCategory");
    Route::get("/admin/category/edit/{category_slug}", AdminEditCategoryComponent::class)->name("admin.editCategory");
    Route::get("/admin/products", AdminProductComponent::class)->name("admin.products");
    Route::get("/admin/product/add", AdminAddProductComponent::class)->name("admin.addProduct");
    Route::get("/admin/product/edit/{product_slug}", AdminEditProductComponent::class)->name("admin.editProduct");
    Route::get("/admin/slider", AdminHomeSliderComponent::class)->name("admin.homeSlider");
    Route::get("/admin/slider/add", AdminAddHomeSliderComponent::class)->name("admin.addHomeSlider");
    Route::get("/admin/slider/edit/{slide_id}", AdminEditHomeSliderComponent::class)->name("admin.editHomeSlider");
    Route::get("/admin/homeCategories",AdminHomeCategoryComponent::class)->name("admin.homeCategories");
    Route::get("/admin/sale",AdminSaleComponent::class)->name("admin.sale");
    Route::get("/admin/coupons", AdminCouponsComponent::class)->name("admin.coupons");
    Route::get("/admin/coupons/add", AdminAddCouponComponent::class)->name("admin.addCoupon");
    Route::get("/admin/coupons/edit/{coupon_id}", AdminEditCouponComponent::class)->name("admin.editCoupon");
    Route::get("/admin/orders", AdminOrderComponent::class)->name("admin.orders");
    Route::get("admin/orders/{order_id}", AdminOrderDetailsComponent::class)->name("admin.orderDetails");
});
