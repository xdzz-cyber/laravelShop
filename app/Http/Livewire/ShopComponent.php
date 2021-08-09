<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class ShopComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;
    public $min_price;
    public $max_price;

    public function mount(){
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->min_price = 1;
        $this->max_price = 1000;
    }

    public function store($product_id, $product_name, $product_price){
        Cart::instance("cart")->add($product_id,$product_name,1,$product_price)->associate("App\Models\Product");
        session()->flash("success_message","Item added in Cart");
        return redirect()->route("product.cart");
    }

    public function addToWishList($product_id, $product_name, $product_price){
        Cart::instance("wishlist")->add($product_id, $product_name, 1, $product_price)->associate("App\Models\Product");
        $this->emitTo("wish-list-count-component","refreshComponent");
    }

    public function sortShopItems($field, $type = "ASC"){
        $flag = preg_match("~desc~", $field);
        $field = preg_match("~desc~mi", $field) ? preg_replace("~(\w){1}desc~mi", "",$field) : $field;
        return Product::whereBetween("regular_price",[$this->min_price, $this->max_price])->orderBy($field,$flag ? "DESC" : $type)->paginate($this->pageSize);
    }

    public function render()
    {
        $products = $this->sorting === "default" ? Product::whereBetween("regular_price",[$this->min_price, $this->max_price])->paginate($this->pageSize) : $this->sortShopItems($this->sorting);
        $categories = Category::all();
        return view('livewire.shop-component', ['products'=>$products, "categories"=>$categories])->layout("layouts.base");
    }
}
