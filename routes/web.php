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

Route::get("/checkout", CheckoutComponent::class);

Route::get("/product/{slug}", DetailsComponent::class)->name("product.details");

Route::get("/product_category/{category_slug}", CategoryComponent::class)->name("product.category");

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//For user or customer
Route::middleware(['auth:sanctum','verified'])->group(function (){
    Route::get("/user/dashboard", UserDashboardComponent::class)->name("user.dashboard");
});

//For admin
Route::middleware(['auth:sanctum','verified', "authAdmin"])->group(function (){
    Route::get("/admin/dashboard", AdminDashboardComponent::class)->name("admin.dashboard");
});
