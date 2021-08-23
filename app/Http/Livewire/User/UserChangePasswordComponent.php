<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePasswordComponent extends Component
{
    public $currentPassword;
    public $newPassword;
    public $newPassword_confirmation;

    public function updated($fields){
        $this->validateOnly($fields, [
            "currentPassword"=>"required",
            "newPassword"=>"required|min:8|confirmed|different:currentPassword",
        ]);
    }

    public function changePassword(){

        $this->validate([
            "currentPassword"=>"required",
            "newPassword"=>"required|min:8|confirmed|different:currentPassword",
        ]);

        if (Hash::check($this->currentPassword, Auth::user()->password)){
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->newPassword);
            $user->save();
            session()->flash("change_password_success_message", "Password has been successfully changed");
        } else{
            session()->flash("change_password_error_message", "Password doesn't match");
        }

    }

    public function render()
    {
        return view('livewire.user.user-change-password-component')->layout("layouts.base");
    }
}
