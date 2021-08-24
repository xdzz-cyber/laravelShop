<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Settings
                    </div>
                    <div class="panel-body">
                        @if(Session::has("settings_message"))
                            <div class="alert alert-success" role="alert">{{Session::get("settings_message")}}</div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="saveSettings">

                            <div class="form-group">
                                <label class="control-label col-md-4" for="email">Email</label>
                                <div class="col-md-4">
                                    <input id="email" type="email" placeholder="email" class="form-control input-md" wire:model="email">
                                    @error("email")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="phone">Phone</label>
                                <div class="col-md-4">
                                    <input id="phone" type="text" placeholder="phone" class="form-control input-md" wire:model="phone">
                                    @error("phone")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="phone2">Phone2</label>
                                <div class="col-md-4">
                                    <input id="phone2" type="text" placeholder="phone2" class="form-control input-md" wire:model="phone2">
                                    @error("phone2")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="address">Address</label>
                                <div class="col-md-4">
                                    <input id="address" type="text" placeholder="address" class="form-control input-md" wire:model="address">
                                    @error("address")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="map">Map</label>
                                <div class="col-md-4">
                                    <input id="map" type="text" placeholder="map" class="form-control input-md" wire:model="map">
                                    @error("map")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="twitter">Twitter</label>
                                <div class="col-md-4">
                                    <input id="twitter" type="text" placeholder="twitter" class="form-control input-md" wire:model="twitter">
                                    @error("twitter")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="facebook">Facebook</label>
                                <div class="col-md-4">
                                    <input id="facebook" type="text" placeholder="facebook" class="form-control input-md" wire:model="facebook">
                                    @error("facebook")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="pinterest">Pinterest</label>
                                <div class="col-md-4">
                                    <input id="pinterest" type="text" placeholder="pinterest" class="form-control input-md" wire:model="pinterest">
                                    @error("pinterest")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="instagram">Instagram</label>
                                <div class="col-md-4">
                                    <input id="instagram" type="text" placeholder="instagram" class="form-control input-md" wire:model="instagram">
                                    @error("instagram")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4" for="youtube">Youtube</label>
                                <div class="col-md-4">
                                    <input id="youtube" type="text" placeholder="youtube" class="form-control input-md" wire:model="youtube">
                                    @error("youtube")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-4" for=""></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
