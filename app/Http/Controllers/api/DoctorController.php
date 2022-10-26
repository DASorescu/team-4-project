<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id)->userDetail);
    }

    //prendo le review dell'utente specififcato dall'id
    public function reviews($id)
    {
        return response()->json(User::find($id)->reviews);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function addReview(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate(
            [
                'content' => 'string|min:10|max:2048',

                'guest_name' => 'string|min:3|max:50',

                'guest_email' => 'string|min:3|max:50',

                'rating' => 'number|min:1|max:5',
            ],
            [
                'content' => 'err_content',

                'guest_name' => "err_guest_name",

                'guest_email' => "err_guest_email",

                'rating' => 'err_rating',
            ],
        );
        $data = $request->all();

        $new_review = new Review();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
