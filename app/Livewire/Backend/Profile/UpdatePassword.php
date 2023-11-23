<?php

namespace App\Livewire\Backend\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UpdatePassword extends Component
{

    public $current_password, $new_password, $confirm_password;

    public function UpdatePassword(){
        $this->validate([
            'current_password'=>[
                'required', function($attribute, $value, $fail){
                    if(!Hash::check($value, User::find(auth('web')->id())->password)){
                        return $fail(__('Password lama anda salah'));
                    }
                }
            ],

            'new_password' => 'required|min:8|max:25|different:current_password',
            'confirm_password' => 'same:new_password'
        ], [
            'current_password.required'=>'masukan password lama anda',
            'new_password.required'=>'Masukan password baru',
            'new_password.min'=>'Password minimal 8 karakter',
            'new_password.different'=> 'Password baru harus berbeda dari password lama',
            'confirm_password.same'=>'Password konfirmasi tidak sama'
        ]);

        $query = User::find(auth('web')->id())->update([
            'password'=>Hash::make($this->new_password)
        ]);

        session()->flash('success', 'Ganti password berhasil, silakan login dengan password baru anda');

        $notification = array(
            'message' => 'Password berhasil diganti',
            'alert-type' => 'success'
        );

        Auth::logout();
        return redirect()->route('login')->with($notification);

    }

    public function render()
    {
        return view('livewire.backend.profile.update-password');
    }
}
