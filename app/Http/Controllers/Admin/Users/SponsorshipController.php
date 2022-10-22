<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Sponsorship;

class SponsorshipController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('admin.users.sponsorships.show', compact('user'));
    }

    public function create()
    {
        $user = Auth::user();
        $sponsor_plans = Sponsorship::all();
        return view('admin.users.sponsorships.create', compact('user','sponsor_plans'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $sponsor_plans = Sponsorship::all();
        return redirect()->route('admin.users.sponsorships.show');
    }
}

