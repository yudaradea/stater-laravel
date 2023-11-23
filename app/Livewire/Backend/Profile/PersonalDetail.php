<?php

namespace App\Livewire\Backend\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PersonalDetail extends Component
{

    public $user;
    public $name, $username, $email;
    public $password;

    protected $listeners = [
        "resetForm"
    ];

    public function resetForm()
    {
        $this->password = null;
        $this->resetErrorBag();
    }

    public function mount(){
        $this->user = User::find(auth('web')->id());
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
    }

    public function UpdateDetails()
    {
        $this->validate([
            'name'=>'required|string',
            'username'=>'required|unique:users,username,'.auth('web')->id(),
            'email'=>'required|unique:users,email,'.auth('web')->id()
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username telah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email telah terdaftar'
        ]);

        $this->dispatch('openModalPassword');

    }

    public function passwordUser(){
        $this->validate([
            'password' => [
                'required', function($attribute, $value, $fail){
                    if(!Hash::check($value, User::find(auth('web')->id())->password)){
                        return $fail(__('Password salah'));
                    }
                }
            ],
        ]);

       $updated = User::where('id', auth('web')->id())->update([
            'name'=>$this->name,
            'username'=>$this->username,
            'email'=>$this->email,
        ]);

        if($updated){
            $this->dispatch('alert', type : 'success', pesan : 'Personal detail berhasil di perbaharui');
        }

        $this->dispatch('closeModalPassword');
        $this->dispatch('updateUser');

    }

    public function render()
    {
        return view('livewire.backend.profile.personal-detail');
    }
}
