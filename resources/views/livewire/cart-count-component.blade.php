<div class="wrap-icon-section minicart">
    <a href="{{route("product.cart")}}" class="link-direction">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        <div class="left-info">
            <span class="index">{{Cart::instance("cart")->count() ?? 0}} items</span>
            <span class="title">CART</span>
        </div>
    </a>
</div>
