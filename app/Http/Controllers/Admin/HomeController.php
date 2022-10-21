<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\UserDetails;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $details = $user->UserDetail;

        
        if(!$details){
            return redirect()->route('admin.users.create');
        }else{
            return view('admin.home', compact('user'));  
        }
    }
}
