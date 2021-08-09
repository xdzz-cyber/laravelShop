<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function changeQuantity($rowId, $increase){
        $product = Cart::instance("cart")->get($rowId);
        $qty = $product->qty;
        $increase === true ? $qty++ : $qty--;
        Cart::instance("cart")->update($rowId, $qty);
        $this->emitTo("cart-count-component","refreshComponent");
    }

    public function deleteCartItem($rowId){
        Cart::instance("cart")->remove($rowId);
        $this->emitTo("cart-count-component","refreshComponent");
        session()->flash("success_message", "Cart item has been removed");
    }

    public function clearCart(){
        Cart::instance("cart")->destroy();
        $this->emitTo("cart-count-component","refreshComponent");
    }

    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
