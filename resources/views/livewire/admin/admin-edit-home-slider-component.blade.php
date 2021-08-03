<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit slide
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.homeSlider')}}" class="btn btn-success pull-right">All slides</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has("success_message"))
                            <div class="alert alert-success" role="alert">
                                {{Session::get("success_message")}}
                            </div>
                        @endif
                        <form method="post" enctype="multipart/form-data" class="form-horizontal" wire:submit.prevent="updateSlide">

                            <div class="form-group">
                                <label for="title" class="col-md-4 control-label">Title</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="title" class="form-control form-control-sm" wire:model="title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subtitle" class="col-md-4 control-label">Subtitle</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="subtitle" class="form-control form-control-sm" wire:model="subtitle">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-md-4 control-label">Price</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="price" class="form-control form-control-sm" wire:model="price">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link" class="col-md-4 control-label">Link</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="link" class="form-control form-control-sm" wire:model="link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Image</label>
                                <div class="col-md-4">
                                    <input type="file" placeholder="image" class="form-control form-control-sm" wire:model="newImage">
                                    @if($newImage)
                                        <img src="{{$newImage->temporaryUrl()}}" class="img-fluid w-25" alt="user chosen image">
                                        @else
                                        <img src="{{asset('assets/images/sliders')}}/{{$image}}" class="img-fluid w-25" alt="user default photo">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-4">
                                    <select class="form-control form-control-sm" id="status" wire:model="status">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success" value="Update slide">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
