<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All slides
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.addHomeSlider')}}" class="btn btn-success pull-right">Add new slide</a>
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
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Price</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td>{{$slider->id}}</td>
                                        <td><img src="{{asset('assets/images/sliders')}}/{{$slider->image}}" class="AdminHomeSliderSingleImage img-fluid" alt="{{$slider->title}}"></td>
                                        <td>{{$slider->title}}</td>
                                        <td>{{$slider->subtitle}}</td>
                                        <td>{{$slider->price}}</td>
                                        <td>{{$slider->link}}</td>
                                        <td>{{$slider->status == 1 ? "Active" : "Inactive"}}</td>
                                        <td>{{$slider->created_at}}</td>
                                        <td><a href="{{route('admin.editHomeSlider',['slide_id'=>$slider->id])}}"><i class="fa fa-edit fa-2x text-info"></i></a></td>
                                        <td><a href="#" wire:click.prevent="deleteSlide({{$slider->id}})"><i class="fa fa-2x fa-times text-danger"></i></a></td>
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
