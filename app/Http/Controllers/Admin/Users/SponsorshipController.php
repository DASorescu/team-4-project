<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Sponsorship;
use Carbon\Carbon;

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
        $intent = $user->createSetupIntent();
        return view('admin.users.sponsorships.create', compact('user', 'sponsor_plans', 'intent'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        $plan_id = '';
        if($request->plan === 'price_1LzentDdebw56msOoppkEEQP') $plan_id = 1;
        else if($request->plan === 'price_1LzentDdebw56msO6LNW6c47') $plan_id = 2;
        else if($request->plan === 'price_1LzentDdebw56msO04NaOxbz') $plan_id = 3;

        $user->newSubscription($plan_id,$request->plan)->create($request->stripeToken);

        $sponsorship = Sponsorship::findOrFail($plan_id);

        $user->sponsorship_id = $sponsorship->id;

        if ($user->sponsorships()) $user->sponsorships()->detach();
        $user->sponsorships()->attach($sponsorship, ['ends_at' => Carbon::now()->addHours($sponsorship->duration)]);

        return redirect()->route('admin.users.sponsorships.show');
    }
}

