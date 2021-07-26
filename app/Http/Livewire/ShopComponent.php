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

    public function mount(){
        $this->sorting = "default";
        $this->pageSize = 12;
    }

    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate("App\Models\Product");
        session()->flash("success_message","Item added in Cart");
        return redirect()->route("product.cart");
    }

    public function sortShopItems($field, $type = "ASC"){
        $flag = preg_match("~desc~", $field);
        $field = preg_match("~desc~mi", $field) ? preg_replace("~(\w){1}desc~mi", "",$field) : $field;
        return Product::orderBy($field,$flag ? "DESC" : $type)->paginate($this->pageSize);
    }

    public function render()
    {
        $products = $this->sorting === "default" ? Product::paginate($this->pageSize) : $this->sortShopItems($this->sorting);
        $categories = Category::all();
        return view('livewire.shop-component', ['products'=>$products, "categories"=>$categories])->layout("layouts.base");
    }
}
