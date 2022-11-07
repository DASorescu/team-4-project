<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\UserDetails;
use App\Models\Message;
use App\Models\Review;

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

        $messages_chart_options = [
            'chart_title' => 'Messages by month',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Message',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '255,79,21',
        ];
        $messages_chart = new LaravelChart($messages_chart_options);
        
        $reviews_chart_options = [
            'chart_title' => 'Reviews ',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Review',
            'group_by_field' => 'rating',
            // 'group_by_period' => 'month',
            'chart_type' => 'line',
            'chart_color' => '98,100,255',
        ];
        $reviews_chart = new LaravelChart($reviews_chart_options);
        
        if(!$details){
            return redirect()->route('admin.users.create');
        }else{
            return view('admin.home', compact('user','messages_chart','reviews_chart'));  
        }
    }
}
