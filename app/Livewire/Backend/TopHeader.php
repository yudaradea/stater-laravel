<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\User;

class TopHeader extends Component
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

        return view('livewire.backend.top-header');
    }
}
