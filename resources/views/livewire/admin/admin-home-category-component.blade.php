<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage home categories
                    </div>
                    <div class="panel-body">
                        @if(Session::has("success_message"))
                            <div class="alert alert-success" role="alert">
                                {{Session::get("success_message")}}
                            </div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="updateHomeCategory">

                            <div class="form-group">
                                <label for="categories" class="col-md-4 control-label">
                                    Choose categories
                                </label>
                                <div class="col-md-4" wire:ignore>
                                    <select class="selectCategories form-select form-select-sm" name="selectedCategories[]"
                                            id="categories" multiple wire:model="selectedCategories">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="numberOfProducts" class="col-md-4 control-label">
                                    Number of products
                                </label>
                                <div class="col-md-4">
                                    <input type="text" id="numberOfProducts" class="form-control input-sm"
                                           wire:model="numberOfProducts">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                    <div class="col-md-4">
                                        <input type="submit" class="btn btn-primary" value="Save">
                                    </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(() => {
            const selectedCategoriesSelect = $(".selectCategories");
            selectedCategoriesSelect.select2();

            selectedCategoriesSelect.on("change", function (e){
                let data = $(".selectCategories").select2("val");
                @this.set("selectedCategories",data);
            })
        });
    </script>
@endpush
