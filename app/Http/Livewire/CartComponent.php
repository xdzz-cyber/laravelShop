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

    public function switchProductToItemsForLater($rowId){
        $item = Cart::instance("cart")->get($rowId);
        Cart::instance("cart")->remove($rowId);
        Cart::instance("saveForLater")->add($item->id, $item->name, $item->qty, $item->price)->associate("App\Models\Product");
        $this->emitTo("cart-count-component", "refreshComponent");
        session()->flash("success_message", "Product has been successfully switched and placed into saveForLater products");
    }

    public function moveProductFromSavedForLaterToCart($rowId){
        $item = Cart::instance("saveForLater")->get($rowId);
        Cart::instance("saveForLater")->remove($rowId);
        Cart::instance("cart")->add($item->id, $item->name, $item->qty, $item->price)->associate("App\Models\Product");
        $this->emitTo("cart-count-component", "refreshComponent");
        session()->flash("success_message", "Product has been successfully moved from savedForLater into the cart");
    }

    public function deleteProductFromSavedForLater($rowId){
        Cart::instance("saveForLater")->remove($rowId);
        session()->flash("success_message", "Product has been successfully deleted from save for later");
    }

    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
