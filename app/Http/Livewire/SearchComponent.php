<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class SearchComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;
    public $search;
    public $product_category;
    public $product_category_id;

    public function mount(){
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->fill(request()->only('search','product_category','product_category_id'));
    }

    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate("App\Models\Product");
        session()->flash("success_message","Item added in Cart");
        return redirect()->route("product.cart");
    }

    public function sortShopItems($field, $type = "ASC"){
        $flag = preg_match("~desc~", $field);
        $field = preg_match("~desc~mi", $field) ? preg_replace("~(\w){1}desc~mi", "",$field) : $field;
        return Product::where("name","like","%{$this->search}%")->where("category_id","like","%{$this->product_category_id}%")::orderBy($field,$flag ? "DESC" : $type)->paginate($this->pageSize);
    }

    public function render()
    {
        $products = $this->sorting === "default" ? Product::where("name","like","%{$this->search}%")->where("category_id","like","%{$this->product_category_id}%")->paginate($this->pageSize) : $this->sortShopItems($this->sorting);
        $categories = Category::all();
        return view('livewire.search-component', ['products'=>$products, "categories"=>$categories])->layout("layouts.base");
    }
}
