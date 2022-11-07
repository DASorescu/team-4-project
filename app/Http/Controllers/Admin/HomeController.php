<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\UserDetails;
use App\MOdels\Message;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;


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
        $details = $user->userDetail;

        $chart_options = [
            'chart_title' => 'messages by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Message',
            'group_by_field' => 'date',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        
        if(!$details){
            return redirect()->route('admin.users.create');
        }else{
            return view('admin.home', compact('user','chart1'));  
        }
    }
}
