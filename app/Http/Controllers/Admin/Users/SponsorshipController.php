<?php

namespace App\Http\Controllers\Admin\Users;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sponsorship;

class SponsorshipController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $sponsor_plans = Sponsorship::all();
        return view('admin.users.sponsorships.create', compact('user','sponsor_plans'));
    }
}
