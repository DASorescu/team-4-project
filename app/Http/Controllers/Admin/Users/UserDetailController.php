<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

                'phone' => ['nullable','regex:^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$^'],

                'city' => ['nullable','string', "in_array:cities"]
            ],
            [
                'city.in_array' => ' Pippo '
            ],
        );

        $data = $request->all();

        $user->update($data);


        return redirect()->route('admin.users.edit', compact('user'))->with('message','dati modificati con successo' );
    }
}
