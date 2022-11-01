<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\User;
use Illuminate\Http\Request;

class SearchDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Ema -> prendo i miei utenti
        $users = User::all();
        return response()->json(Specialization::find($specialization_id)->users);
        return response()->json($users);
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
    public function show($specialization_id)
    {

        // ciclo su tutti gli utenti per mapparli. Cosi devo fare solo una chiamata json che sarà più veloce
        $users = Specialization::find($specialization_id)->users;
        $users_mapped = [];
        foreach ($users as $user) {
            $users_mapped[] = [
                "id" => $user->id,
                "email" => $user->email,
                "detail" => $user->userDetail,
                "reviews" => $user->reviews,
            ];
        }
        // cerco la specializzazione richiesta e restituisco i dottori con la specializzazione richiesta
        return response()->json($users_mapped);
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
