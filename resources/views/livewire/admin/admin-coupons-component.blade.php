<div>
    <div class="container px-3 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All coupons
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.addCoupon')}}" class="btn btn-success pull-right">Add new
                                    coupon</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has("success_message"))
                            <div class="alert alert-success" role="alert">
                                {{Session::get("success_message")}}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Coupon code</th>
                                <th>Coupon type</th>
                                <th>Coupon value</th>
                                <th>Cart value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{$coupon->id}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->type}}</td>
                                    @if($coupon->type === "fixed")
                                        <td>${{$coupon->value}}</td>
                                    @else
                                        <td>{{$coupon->value}} %</td>
                                    @endif
                                    <td>${{$coupon->cart_value}}</td>
                                    <td>
                                        <a class="mx-5" href="{{route('admin.editCoupon',['coupon_id'=>$coupon->id])}}"><i
                                                class="fa fa-edit fa-2x"></i> </a>
                                        <a class="mx-5" href="#" wire:click.prevent="deleteCoupon({{$coupon->id}})"> <i
                                                class="fa fa-trash fa-2x text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

