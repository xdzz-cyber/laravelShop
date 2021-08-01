<div>
    <div class="container px-3 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All categories
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.addCategory')}}" class="btn btn-success pull-right">Add new
                                    category</a>
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
                                <th>Category name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>
                                        <a class="mx-5" href="{{route('admin.editCategory',['category_slug'=>$category->slug])}}"><i
                                                class="fa fa-edit fa-2x"></i> </a>
                                        <a class="mx-5" href="#" wire:click.prevent="deleteCategory({{$category->id}})"> <i
                                                class="fa fa-trash fa-2x text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
