<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order confirmation</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>
<body>
<p>Hi, {{$order->firstname}} {{$order->lastname}}</p>
<p class="ml-3">Your order has been successfully placed</p>
<table class="mailTable text-right">
    <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    </thead>

    <tbody>
    @foreach($order->orderItems as $item)
        <tr>
            <td><img src="{{asset('assets/images/products')}}/{{$item->product->image}}" width="100" alt="order image">
            </td>
            <td>{{$item->product->name}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->price * $item->quantity}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3"></td>
        <td>Subtotal: ${{$order->subtotal}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Tax: ${{$order->tax}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Shipping: Free shipping</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Total: ${{$order->total}}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
