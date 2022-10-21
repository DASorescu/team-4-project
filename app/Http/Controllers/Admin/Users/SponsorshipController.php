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
}
