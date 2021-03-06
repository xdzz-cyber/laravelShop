<?php

namespace App\Http\Livewire;

use App\Models\Product;
//use Gloudemans\Shoppingcart\Cart;
use App\Models\Sale;
use Cart;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $slug;
    public $quantity;

    public function mount($slug){
        $this->slug = $slug;
        $this->quantity = 1;
    }

    public function changeQuantity($ShouldIncrease){
        if ($ShouldIncrease == true){
            $this->quantity+=1;
        } else if($this->quantity > 1){
            $this->quantity-=1;
        }
    }

    public function store($product_id, $product_name, $product_price){
        Cart::instance("cart")->add($product_id,$product_name,$this->quantity,$product_price)->associate("App\Models\Product");
        session()->flash("success_message","Item added in Cart");
        return redirect()->route("product.cart");
    }

    public function render()
    {
        $product = Product::where("slug",$this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where("category_id",$product->category_id)->inRandomOrder()->limit(5)->get();
        $saleTimeRecord = Sale::find(1);
        return view('livewire.details-component',["product"=>$product, "popular_products"=>$popular_products, "related_products"=>$related_products, "saleTimeRecord"=>$saleTimeRecord])->layout("layouts.base");
    }
}
