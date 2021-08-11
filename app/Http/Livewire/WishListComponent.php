<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class WishListComponent extends Component
{
    public function removeFromWishList($product_id){
        foreach (Cart::instance("wishlist")->content() as $item){
            if ($item->id == $product_id){
                Cart::instance("wishlist")->remove($item->rowId);
                $this->emitTo("wish-list-count-component", "refreshComponent");
                return;
            }
        }

    }

    public function moveProductFromWishListToCart($row_id){
       $item = Cart::instance("wishlist")->get($row_id);
       Cart::instance("wishlist")->remove($row_id);
       Cart::instance("cart")->add($item->id, $item->name, 1, $item->price)->associate("App\Models\Product");
       $this->emitTo("wish-list-count-component", "refreshComponent");
       $this->emitTo("cart-count-component", "refreshComponent");
    }

    public function render()
    {
        return view('livewire.wish-list-component')->layout("layouts.base");
    }
}
