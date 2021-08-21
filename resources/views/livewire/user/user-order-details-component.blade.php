<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has("order_message"))
                    <div class="alert alert-success" role="alert">
                        {{Session::get("order_message")}}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Order details
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('user.orders')}}" class="customButton btn btn-success pull-right">My orders</a>
                                @if($order->status == "ordered")
                                    <a href="#" class="customButton btn btn-warning pull-right" wire:click.prevent="cancelOrder">Cancel order</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Order ID</th>
                                <td>{{$order->id}}</td>
                                <th>Order date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Order status</th>
                                <td>{{$order->status}}</td>
                                @if($order->status == "delivered")
                                    <th>Delivery date</th>
                                    <td>{{$order->delivered_date}}</td>
                                @elseif($order->status == "canceled")
                                    <th>Canceled date</th>
                                    <td>{{$order->canceled_date}}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ordered items
                    </div>
                    <div class="panel-body">

                        <div class="wrap-iten-in-cart">
                            <h3 class="box-title">Products Name</h3>
                            <ul class="products-cart">
                                @foreach($order->orderItems as $item)
                                    <li class="pr-cart-item">
                                        <div class="product-image">
                                            <figure><img src="{{asset('assets/images/products')}}/{{$item->product->image}}" alt="{{$item->product->name}}"></figure>
                                        </div>
                                        <div class="product-name">
                                            <a class="link-to-product" href="{{route("product.details",["slug"=>$item->product->slug])}}">{{$item->product->name}}</a>
                                        </div>
                                        <div class="price-field produtc-price"><p class="price">${{$item->product->price}}</p></div>
                                        <div class="quantity">
                                            <h5>{{$item->quantity}}</h5>
                                        </div>
                                        <div class="price-field sub-total"><p class="price">${{$item->price * $item->quantity}}</p></div>
                                        @if($order->status == "delivered" && !$item->reviewStatus)
                                        <div class="price-field sub-total"><p class="price"><a href="{{route('user.review',['order_item_id'=>$item->id])}}">Write a review</a></p></div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="summary">
                            <div class="order-summary">
                                <h4 class="title-box">Order summary</h4>
                                <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{$order->subtotal}}</b></p>
                                <p class="summary-info"><span class="title">Tax</span><b class="index">${{$order->tax}}</b></p>
                                <p class="summary-info"><span class="title">Shipping</span><b class="index">Free shipping</b></p>
                                <p class="summary-info"><span class="title">Total</span><b class="index">${{$order->total}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Billing details
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>First name</th>
                                <td>{{$order->first_name}}</td>
                                <th>Last name</th>
                                <td>{{$order->last_name}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$order->mobile}}</td>
                                <th>Email</th>
                                <td>{{$order->email}}</td>
                            </tr>
                            <tr>
                                <th>Line1</th>
                                <td>{{$order->line1}}</td>
                                <th>Line2</th>
                                <td>{{$order->line2}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{$order->city}}</td>
                                <th>Province</th>
                                <td>{{$order->province}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{$order->country}}</td>
                                <th>Zipcode</th>
                                <td>{{$order->zipcode}}</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        @if($order->is_shipping_different)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Shipping details
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>First name</th>
                                    <td>{{$order->shipping->first_name}}</td>
                                    <th>Last name</th>
                                    <td>{{$order->shipping->last_name}}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{$order->shipping->mobile}}</td>
                                    <th>Email</th>
                                    <td>{{$order->shipping->email}}</td>
                                </tr>
                                <tr>
                                    <th>Line1</th>
                                    <td>{{$order->shipping->line1}}</td>
                                    <th>Line2</th>
                                    <td>{{$order->shipping->line2}}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{$order->shipping->city}}</td>
                                    <th>Province</th>
                                    <td>{{$order->shipping->province}}</td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{$order->shipping->country}}</td>
                                    <th>Zipcode</th>
                                    <td>{{$order->shipping->zipcode}}</td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Transaction
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Transaction mode</th>
                                <td>{{$order->transaction->mode}}</td>
                            </tr>
                            <tr>
                                <th>Transaction status</th>
                                <td>{{$order->transaction->status}}</td>
                            </tr>
                            <tr>
                                <th>Transaction date</th>
                                <td>{{$order->transaction->created_at}}</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
