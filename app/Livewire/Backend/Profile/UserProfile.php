<?php

namespace App\Livewire\Backend\Profile;

use Livewire\Component;
use App\Models\User;

class UserProfile extends Component
{
    public $user;

    protected $listeners = [
        'updateUser'=>'$refresh'
    ];

    public function mount(){
        $this->user = User::find(auth('web')->id());
    }

    public function render()
    {
        return view('livewire.backend.profile.user-profile');
    }
}
