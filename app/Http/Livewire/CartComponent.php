<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public function applyCouponCode(){
        $coupon = Coupon::where("code",$this->couponCode)->where("cart_value","<=",Cart::instance("cart")->subtotal())->first();
        if (!$coupon){
            session()->flash("couponMessage", "Coupon code is invalid");
            return;
        }

        session()->put("coupon",[
            "code"=>$coupon->code,
            "type"=>$coupon->type,
            "value"=>$coupon->value,
            "cart_value"=>$coupon->cart_value
        ]);
    }

    public function calculateDiscount(){
        if (session()->has("coupon")){
            $this->discount = session()->get("coupon")["type"] == "fixed" ? session()->get("coupon")["value"] : (Cart::instance("cart")->subtotal() * session()->get("coupon")["value"]) / 100;
            $this->subtotalAfterDiscount = Cart::instance("cart")->subtotal() - $this->discount;
            $this->taxAfterDiscount = $this->subtotalAfterDiscount * config("cart.tax") / 100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function removeCoupon(){
        session()->forget("coupon");
    }

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
        if (session()->has("coupon")){
            Cart::instance("cart")->subtotal() < session()->get("coupon")['cart_value'] ? session()->forget("coupon") : $this->calculateDiscount();
        }
        return view('livewire.cart-component')->layout("layouts.base");
    }
}
