<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserDetailController extends Controller
{
    public function edit(){

        $user = Auth::user()->UserDetail;
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request){



        $user = Auth::user()->UserDetail;


        $cities = config('cities');

        $request->validate(
            [
                'first_name' => 'nullable|string|min:3|max:50',

                'last_name' => 'nullable|string|min:3|max:50',

                'cv' => 'nullable|file|mimes:pdf|max:10000',

                'image' => 'nullable|mimes:jpg,jpeg,png|file',

                'phone' => ['nullable','regex:^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$^'],

                'city' => ['nullable','string', "in_array:cities"]
            ],
            [
                'city.in_array' => ' Pippo ',

                'cv' => "il formato del file dev'essere PDF",

                'image' => "il formato dev'essere jpg,jpeg o png"
            ],
        );

        $data = $request->all();

        if(array_key_exists('cv', $data))
        {
            if($user->cv) Storage::delete($user->cv);
            $cv_url = Storage::put('user_cvs', $data['cv']);
            $user->cv = $cv_url;
        }

        if(array_key_exists('image', $data))
        {
            if($user->image) Storage::delete($user->image);
            $image_url = Storage::put('user_images', $data['image']);
            $user->image = $image_url;
        }

            
        $user->update($data);



        return redirect()->route('admin.users.edit', compact('user'))->with('message','dati modificati con successo' );
    }
}
