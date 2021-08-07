<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add new category
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.categories')}}" class="btn btn-success pull-right">Go see all categories</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has("success_message"))
                            <div class="alert alert-success" role="alert">
                                <p>{{Session::get("success_message")}}</p>
                            </div>
                        @endif
                        <form action="" method="post" class="adminAddCategoryForm" wire:submit.prevent="storeCategory">
                            @csrf
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category name</label>
                                <input type="text" name="category_name" class="form-control" id="categoryName" aria-describedby="categoryName" wire:model="name" wire:keyup="generateSlug">
                                @error("name")
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categorySlug" class="form-label">Category slug</label>
                                <input type="text" class="form-control" id="categorySlug" name="slug" wire:model="slug">
                                @error("slug")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
