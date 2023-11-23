<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{

    // Admin profile
    public function adminProfile(){
        return view('backend.pages.admin-profile');
    }

    // change profile picture
    public function ChangeProfilePicture(Request $request){
        $user = User::find(auth('web')->id());
        $path = "/images/user_images/";
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $new_filename = 'AIMG'.'_'.$user->username.time().'.jpg';


        $upload = Storage::disk('public')->put($path.$new_filename, (string) file_get_contents($file));

        if($upload){
            $old_image = $user->getAttributes()['picture'];
            if($old_image !=null && Storage::disk('public')->exists($path.$old_image)){
                    Storage::disk('public')->delete($path.$old_image);
            }

            $user->update([
                'picture'=>$new_filename
            ]);
            return response()->json(['status'=>1, 'msg'=>'Profile Picture berhasil diganti']);
        }else {
            return response()->json(['status'=>0, 'msg'=>'Gagal mengganti profile picture']);
        }
    }

}
