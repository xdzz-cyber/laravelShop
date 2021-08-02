<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit product
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.products')}}" class="btn btn-success pull-right">All products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        @if(Session::has("success_message"))
                            <div class="alert alert-success" role="alert">{{Session::get("success_message")}}</div>
                        @endif

                        <form method="post" class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateProduct">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Product name</label>
                                <div class="col-md-4">
                                    <input type="text" id="name" name="name" placeholder="product name" class="form-control form-control-sm" wire:model="name" wire:keyup="generateSlug">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="slug" class="col-md-4 control-label">Product slug</label>
                                <div class="col-md-4">
                                    <input type="text" id="slug" name="slug" placeholder="product slug" class="form-control form-control-sm" wire:model="slug">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="short_description" class="col-md-4 control-label">Product short description</label>
                                <div class="col-md-4">
                                    <textarea name="short_description" id="short_description" cols="30" rows="5" placeholder="Short description" class="form-control" wire:model="short_description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Product description</label>
                                <div class="col-md-4">
                                    <textarea name="description" id="description" cols="30" rows="5" placeholder="Description" class="form-control" wire:model="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="regular_price" class="col-md-4 control-label">Product regular price</label>
                                <div class="col-md-4">
                                    <input type="text" id="regular_price" name="regular_price" placeholder="product regular_price" class="form-control form-control-sm" wire:model="regular_price">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sale_price" class="col-md-4 control-label">Product sale price</label>
                                <div class="col-md-4">
                                    <input type="text" id="sale_price" name="sale_price" placeholder="product sale_price" class="form-control form-control-sm" wire:model="sale_price">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="SKU" class="col-md-4 control-label">Product SKU</label>
                                <div class="col-md-4">
                                    <input type="text" id="SKU" name="SKU" placeholder="product SKU" class="form-control form-control-sm" wire:model="SKU">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="stock_status" class="col-md-4 control-label">Product stock status</label>
                                <div class="col-md-4">
                                    <select name="stock_status" id="stock_status" class="form-control" wire:model="stock_status">
                                        <option value="inStock">In stock</option>
                                        <option value="outOfStock">Out of stock</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="featured" class="col-md-4 control-label">Featured</label>
                                <div class="col-md-4">
                                    <select name="featured" id="featured" class="form-control" wire:model="featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quantity" class="col-md-4 control-label">Product quantity</label>
                                <div class="col-md-4">
                                    <input type="text" id="quantity" name="quantity" placeholder="product quantity" class="form-control form-control-sm" wire:model="quantity">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Product image</label>
                                <div class="col-md-4">
                                    <input type="file" id="image" name="image" class="form-control form-control-sm" wire:model="newImage">
                                    @if($newImage)
                                        <img src="{{$newImage->temporaryUrl()}}" alt="user photo" class="img-fluid w-25">
                                    @else
                                        <img src="{{asset('assets/images/products')}}/{{$image}}" alt="user alt photo" class="img-fluid w-25">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="col-md-4 control-label">Product category</label>
                                <div class="col-md-4">
                                    <select name="category_id" id="category_id" class="form-control" wire:model="category_id">
                                        <option value="" selected>Select category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4">
                                    <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Update product">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
