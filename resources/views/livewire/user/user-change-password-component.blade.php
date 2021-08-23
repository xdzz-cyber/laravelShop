<div>
    <div class="container py-3 px-0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Change password
                    </div>
                    <div class="panel-body">
                        @if(Session::has("change_password_success_message"))
                            <p class="alert alert-success" role="alert">{{Session::get("change_password_success_message")}}</p>
                        @elseif(Session::has("change_password_error_message"))
                            <p class="alert alert-danger" role="alert">{{Session::get("change_password_error_message")}}</p>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="changePassword">

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Current password</label>
                                <div class="col-md-4">
                                    <input id="password" type="password" placeholder="current password" class="form-control input-md" name="currentPassword" wire:model="currentPassword">
                                    @error($currentPassword)
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="newPassword" class="col-md-4 control-label">New password</label>
                                <div class="col-md-4">
                                    <input id="newPassword" type="password" placeholder="new password" class="form-control input-md" name="newPassword" wire:model="newPassword">
                                    @error($newPassword)
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="col-md-4 control-label">Confirm password</label>
                                <div class="col-md-4">
                                    <input id="confirmPassword" type="password" placeholder="password confirmation" class="form-control input-md" name="confirmPassword" wire:model="newPassword_confirmation">
                                    @error($newPassword_confirmation)
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
