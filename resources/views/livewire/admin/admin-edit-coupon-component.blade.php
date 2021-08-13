<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit coupon
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.coupons')}}" class="btn btn-success pull-right">Go see all coupons</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has("success_message"))
                            <div class="alert alert-success" role="alert">
                                <p>{{Session::get("success_message")}}</p>
                            </div>
                        @endif
                        <form action="" method="post" class="form-horizontal" wire:submit.prevent="editCoupon">
                            @csrf
                            <div class="form-group">
                                <label for="code" class="col-md-4 control-label">Coupon code</label>
                                <div class="col-md-4">
                                    <input type="text" id="code" class="form-control form-control-sm" wire:model="code">
                                    @error("code")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type" class="col-md-4 control-label">Coupon type</label>
                                <div class="col-md-4">
                                    <select class="form-control form-control-sm" id="type" wire:model="type">
                                        <option selected value="">Select</option>
                                        <option  value="fixed">Fixed</option>
                                        <option  value="percent">Percent</option>
                                    </select>
                                    @error("type")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="value" class="col-md-4 control-label">Coupon value</label>
                                <div class="col-md-4">
                                    <input type="text" id="value" class="form-control form-control-sm" wire:model="value">
                                    @error("value")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cart_value" class="col-md-4 control-label">Cart value</label>
                                <div class="col-md-4">
                                    <input type="text" id="cart_value" class="form-control form-control-sm" wire:model="cart_value">
                                    @error("cart_value")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Edit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
