<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pageSize;
    public $category_slug;

    public function mount($category_slug){
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->category_slug = $category_slug;
    }

    public function store($product_id, $product_name, $product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate("App\Models\Product");
        session()->flash("success_message","Item added in Cart");
        return redirect()->route("product.cart");
    }

    public function sortShopItems($field, $category_id, $type = "ASC"){
        $flag = preg_match("~desc~", $field);
        $field = preg_match("~desc~mi", $field) ? preg_replace("~(\w){1}desc~mi", "",$field) : $field;
        return Product::where("category_id", $category_id)->orderBy($field,$flag ? "DESC" : $type)->paginate($this->pageSize);
    }

    public function render()
    {
        $category = Category::where("slug",$this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        $products = $this->sorting === "default" ? Product::where("category_id",$category_id)->paginate($this->pageSize) : $this->sortShopItems($this->sorting,$category_id);
        $categories = Category::all();

        return view('livewire.category-component', ['products'=>$products, "categories"=>$categories, "category_name"=>$category_name])->layout("layouts.base");
    }
}
