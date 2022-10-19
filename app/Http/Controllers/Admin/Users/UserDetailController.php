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

    public function update(){

        return "test";
    }
}
