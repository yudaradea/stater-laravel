<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Users extends Component
{
    use WithPagination;

    public $search = "";
    public $perPage = 10;

    public $blocked;
    public $selected_user_id;
    public $name, $username, $email, $type, $gender;

    // reset form function
    protected $listeners = ["resetForm"];

    public function resetForm()
    {
        $this->name = $this->username = $this->email = $this->type = $this->gender = $this->selected_user_id = null;
        $this->resetErrorBag();
    }
    // end reset form function

    // reset page pagination
    public function mount()
    {
        $this->resetPage();
    }

    // reset page search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Add User
     public function addUser()
    {
        $this->validate(
            [
                "name" => "required",
                "username" => "required|unique:users,username|min:5|max:20",
                "email" => "required|unique:users,email|email",
                "type" => "required",
                'gender' => 'required',
            ],
            [
                "name.required" => "Nama tidak boleh kosong",
                "username.required" => "Username tidak boleh kosong ",
                "username.unique" => "Username sudah terdaftar",
                "username.min" => "Username minimal 5 character",
                "username.max" => "Username maximal 20 character",
                "email.required" => "Email tidak boleh kosong",
                "email.unique" => "Email sudah terdaftar",
                "email.email" => "Email tidak valid",
                "type.required" => "Pilih user type",
                'gender.required' => "Pilih jenis kelamin"
            ]
        );

        if ($this->isOnline()) {
            $default_password = Random::generate(8);
            $current = Carbon::now();

            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->username = $this->username;
            $user->password = Hash::make($default_password);
            $user->type = $this->type;
            $user->gender = $this->gender;
            $user->email_verified_at = $current;
            $saved = $user->save();

            $data = [
                "name" => $this->name,
                "username" => $this->username,
                "email" => $this->email,
                "password" => $default_password,
                "url" => route('login'),
            ];

            $user_email = $this->email;
            $user_name = $this->name;

            if ($saved) {
                Mail::send("new-user-email-template", $data, function (
                    $message
                ) use ($user_email, $user_name) {
                    $message
                        ->to($user_email, $user_name)
                        ->subject("Pembuatan akun");
                });

                // alert toaster
                $this->dispatch(
                    "alert",
                    type: "success",
                    pesan: "User berhasil dibuat, silakan cek email yang didaftarkan"
                );


                $this->dispatch("hideAddUserModal");
            } else {
                $this->dispatch(
                    "alert",
                    type: "error",
                    pesan: "Gagal membuat user",
                    title: "Error"
                );
            }
        } else {
            $this->dispatch(
                "alert",
                type: "error",
                pesan: "Anda sedang offline, cek koneksi internet anda",
                title: "Error"
            );
        }
    }

    public function isOnline($site = "https://youtube.com")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
    // End add user

    // Edit User
    public function editUser($user){
        {
        $this->selected_user_id = $user["id"];
        $this->name = $user["name"];
        $this->username = $user["username"];
        $this->email = $user["email"];
        $this->type = $user["type"];
        $this->gender = $user["gender"];
        $this->blocked = $user["blocked"];

        $this->dispatch('openModalEditUser');


        }
    }

    // Update User
    public function updateUser()
    {
        $this->validate(
            [
                "name" => "required",
                "username" => "required|min:5|max:20|unique:users,username," . $this->selected_user_id,
                "email" => "required|email|unique:users,email," . $this->selected_user_id,
                "type" => "required",
            ],
            [
                "name.required" => "Nama tidak boleh kosong",
                "username.required" => "Username tidak boleh kosong ",
                "username.unique" => "Username sudah terdaftar",
                "username.min" => "Username minimal 5 character",
                "username.max" => "Username maximal 20 character",
                "email.required" => "Email tidak boleh kosong",
                "email.unique" => "Email sudah terdaftar",
                "email.email" => "Email tidak valid",
                "type.required" => "Pilih user type",
            ]
        );

        if ($this->selected_user_id) {
            $user = User::find($this->selected_user_id);
            $user->update([
                "name" => $this->name,
                "username" => $this->username,
                "email" => $this->email,
                "type" => $this->type,
                "blocked" => $this->blocked,
                "gender" => $this->gender

            ]);



            // alert toaster
            $this->dispatch(
                "alert",
                type: "success",
                pesan: "Update user berhasil"
            );
            $this->dispatch("closeModalEditUser");
             $this->dispatch('updateUser');


        } else {
            // alert toaster
            $this->dispatch(
                "alert",
                type: "error",
                pesan: "Gagal update author",
                title: "Error"
            );
        }
    }
    // End update user

    // delete user
    public function delete_user($id){
        $deleted_user = User::find($id);
        $path = "/images/user_images/";
        $old_picture = $deleted_user->getAttributes()["picture"];

        if($old_picture != null && Storage::disk('public')->exists($path.$old_picture)){
            Storage::disk('public')->delete($path.$old_picture);
        }

        $deleted_user->delete();

        // Toastr alert
            $this->dispatch(
                "alert", type: "info", pesan: "Delete user $deleted_user->name berhasil"
            );

    }

    public function render()
    {
        return view('livewire.backend.users',[
            'users' => User::search($this->search)->paginate($this->perPage),
            'totaluser' => User::get()
        ]);
    }
}
