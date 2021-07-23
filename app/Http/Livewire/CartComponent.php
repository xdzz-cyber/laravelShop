<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function changeQuantity($rowId, $increase){
        $product = Cart::get($rowId);
        $qty = $product->qty;
        $increase === true ? $qty++ : $qty--;
        Cart::update($rowId, $qty);
    }

    public function deleteCartItem($rowId){
        Cart::remove($rowId);
        session()->flash("success_message", "Cart item has been removed");
    }

    public function clearCart(){
        Cart::destroy();
    }

    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
