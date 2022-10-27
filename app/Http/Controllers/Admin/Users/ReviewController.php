<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\User;
use Faker\Core\Number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    // quindi cosa fa? Ti permette di avere un posto dove centralizzare la query ed evitare di riscrivere codice utile nel caso di query custom come questa
    private function getBaseQuery()
    {
        // mostrami le reviews solo dell'utente loggato
        return Review::where('user_id', '=', Auth::user()->id)->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reviews = $this->getBaseQuery()->get();
        return view('admin.users.reviews.index', compact('reviews'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = $this->getBaseQuery()->where('id', '=', $id)->first();
        return view('admin.users.reviews.show', compact('review'));
    }
}
