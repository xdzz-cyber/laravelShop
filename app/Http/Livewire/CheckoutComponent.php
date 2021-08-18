<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;
use Stripe;

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

    public $cardNumber;
    public $expiryMonth;
    public $expiryYear;
    public $cvc;


    public function updated($fields)
    {
        $this->validateOnly($fields, [
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

        if ($this->paymentMode == "card"){
            $this->validateOnly($fields, [
                "cardNumber"=>"required|numeric",
                "expiryMonth"=>"required|numeric",
                "expiryYear"=>"required|numeric",
                "cvc"=>"required|numeric",
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
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

        if ($this->paymentMode == "card"){
            $this->validate([
                "cardNumber"=>"required|numeric",
                "expiryMonth"=>"required|numeric",
                "expiryYear"=>"required|numeric",
                "cvc"=>"required|numeric",
            ]);
        }

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

            $this->makeTransaction($order->id, "pending");
            $this->resetCart();

        } else if($this->paymentMode == "card"){

            $stripe = Stripe::make(env("STRIPE_KEY"));
            try{
                $token = $stripe->tokens()->create([
                    "card"=>[
                        "number"=>$this->cardNumber,
                        "exp_month"=>$this->expiryMonth,
                        "exp_year"=>$this->expiryYear,
                        "cvc"=>$this->cvc
                    ]
                ]);

                if (!isset($token['id'])){
                    session()->flash("stripe_error", "The stripe token was not generated correctly");
                    $this->thankYou = 0;
                }

                $customer = $stripe->customers()->create([
                    "name"=>"$this->firstname $this->lastname",
                    "email"=>$this->email,
                    "phone"=>$this->mobile,
                    "address"=>[
                        "line1"=>$this->line1,
                        "postal_code"=>$this->zipcode,
                        "city"=>$this->city,
                        "state"=>$this->province,
                        "country"=>$this->country
                    ],
                    "shipping"=>[
                        "name"=>"$this->firstname $this->lastname",
                        "address"=>[
                            "line1"=>$this->line1,
                            "postal_code"=>$this->zipcode,
                            "city"=>$this->city,
                            "state"=>$this->province,
                            "country"=>$this->country
                        ],
                    ],
                    "source"=>$token['id']
                ]);

                $charge = $stripe->charges()->create([
                    "customer"=>$customer['id'],
                    "currency"=>"USD",
                    "amount"=>session()->get("checkout")['total'],
                    "description"=>"Payment for order with id - $order->id"
                ]);

                if ($charge['status'] == "succeeded"){
                    $this->makeTransaction($order->id, "approved");
                    $this->resetCart();
                } else{
                    session()->flash("stripe_error", "Transaction error");
                    $this->thankYou = 0;
                }

            } catch (Exception $exception){
                session()->flash("stripe_error", $exception->getMessage());
                $this->thankYou = 0;
            }
        }

    }

    public function resetCart(){
        $this->thankYou = 1;
        Cart::instance("cart")->destroy();
        session()->forget("checkout");
    }

    public function makeTransaction($order_id, $status){
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $this->paymentMode;
        $transaction->status = $status;

        $transaction->save();
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
