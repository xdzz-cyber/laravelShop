<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class CheckoutComponent extends Component
{
    public $ship_to_different;
    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipcode;

    public $shipping_ship_to_different;
    public $shipping_firstname;
    public $shipping_lastname;
    public $shipping_email;
    public $shipping_mobile;
    public $shipping_line1;
    public $shipping_line2;
    public $shipping_city;
    public $shipping_province;
    public $shipping_country;
    public $shipping_zipcode;

    public $paymentMode;
    public $thankYou;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            "ship_to_different"=>"required",
            "firstname"=>"required",
            "lastname"=>"required",
            "email"=>"required|email",
            "mobile"=>"required|numeric",
            "line1"=>"required",
            "city"=>"required",
            "province"=>"required",
            "country"=>"required",
            "zipcode"=>"required",
            "paymentMode"=>"required"
        ]);

        if ($this->ship_to_different){
            $this->validateOnly($fields,[
                "shipping_ship_to_different"=>"required",
                "shipping_firstname"=>"required",
                "shipping_lastname"=>"required",
                "shipping_email"=>"required|email",
                "shipping_mobile"=>"required|numeric",
                "shipping_line1"=>"required",
                "shipping_city"=>"required",
                "shipping_province"=>"required",
                "shipping_country"=>"required",
                "shipping_zipcode"=>"required",
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
             "ship_to_different"=>"required",
             "firstname"=>"required",
             "lastname"=>"required",
             "email"=>"required|email",
             "mobile"=>"required|numeric",
             "line1"=>"required",
             "city"=>"required",
             "province"=>"required",
             "country"=>"required",
             "zipcode"=>"required",
            "paymentMode"=>"required"
        ]);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get("checkout")["subtotal"];
        $order->discount = session()->get("checkout")["discount"];
        $order->tax = session()->get("checkout")["tax"];
        $order->total = session()->get("checkout")["total"];
        $order->first_name = $this->firstname;
        $order->last_name = $this->lastname;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipcode = $this->zipcode;
        $order->status = "ordered";
        $order->is_shipping_different = $this->ship_to_different ? 1 : 0;

        $order->save();

        foreach (Cart::instance("cart")->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;

            $orderItem->save();
        }

        if ($this->ship_to_different){
            $this->validate([
                "shipping_firstname"=>"required",
                "shipping_lastname"=>"required",
                "shipping_email"=>"required|email",
                "shipping_mobile"=>"required|numeric",
                "shipping_line1"=>"required",
                "shipping_city"=>"required",
                "shipping_province"=>"required",
                "shipping_country"=>"required",
                "shipping_zipcode"=>"required",
            ]);

            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->first_name = $this->shipping_firstname;
            $shipping->last_name = $this->shipping_lastname;
            $shipping->email = $this->shipping_email;
            $shipping->mobile = $this->shipping_mobile;
            $shipping->line1 = $this->shipping_line1;
            $shipping->line2 = $this->shipping_line2;
            $shipping->city = $this->shipping_city;
            $shipping->province = $this->shipping_province;
            $shipping->country = $this->shipping_country;
            $shipping->zipcode = $this->shipping_zipcode;

            $shipping->save();
        }

        if ($this->paymentMode == "cod"){
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->order_id = $order->id;
            $transaction->mode = "cod";
            $transaction->status = "pending";

            $transaction->save();
        }

        $this->thankYou = 1;
        Cart::instance("cart")->destroy();
        session()->forget("checkout");
    }

    public function verifyForCheckout(){
        if (!Auth::check()){
            return redirect()->route("login");
        }

        if($this->thankYou){
            return redirect()->route("thank-you");
        } else if(!session()->get("checkout")){
            return redirect()->route("product.cart");
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout("layouts.base");
    }
}
