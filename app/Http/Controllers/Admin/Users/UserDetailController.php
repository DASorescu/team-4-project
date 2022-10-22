<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// Importato Rule
use Illuminate\Validation\Rule;
use App\User;
use App\Models\UserDetail;

class UserDetailController extends Controller
{
    public function create()
    {

        $user = Auth::user();
        return view('admin.users.create', compact('user'));
    }

    public function edit()
    {

        // passo user anziché solo i dettagli in caso di form più complessi in futuro
        $user = Auth::user();

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request)
    {


        // anche qui separo lo user dai dettagli aiutandomi con una seconda variabile, per leggibilità
        $user = Auth::user();
        $detail = $user->userDetail;


        $cities = config('cities');

        $request->validate(
            [
                'first_name' => 'nullable|string|min:3|max:50',

                'last_name' => 'nullable|string|min:3|max:50',

                'cv' => 'nullable|file|mimes:pdf|max:10000',

                'image' => 'nullable|mimes:jpg,jpeg,png|file',

                'phone' => ['nullable', 'regex:^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$^'],

                'city' => ['nullable', 'string', "in_array:cities"]
            ],
            [
                'city.in_array' => ' Pippo ',

                'cv' => "il formato del file dev'essere PDF",

                'image' => "il formato dev'essere jpg,jpeg o png"
            ],
        );

        $data = $request->all();


        // qui uso $detail per le operazioni, come detto sopra
        if (array_key_exists('cv', $data)) {
            if ($detail->cv) Storage::delete($detail->cv);
            $cv_url = Storage::put('user_cvs', $data['cv']);
            $detail->cv = $cv_url;
        }

        if (array_key_exists('image', $data)) {
            if ($detail->image) Storage::delete($detail->image);
            $image_url = Storage::put('user_images', $data['image']);
            $detail->image = $image_url;
        };

        // aggiungo il phone (che non è più in fillable) in caso mi dovessero passare la chiave del campo phone
        if (array_key_exists('phone', $data)) {
            $detail->phone = $data['phone'];
        }

        $detail->update($data);


        // alla fine passo comunque lo user intero per eventuali paginazioni complesse del profilo (reviews ecc)
        return redirect()->route('admin.users.edit')->with('message', 'dati modificati con successo');
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $cities = config('cities');

        // fixata la validazione (i campi non sono più nullabili, Rule::in controlla che sia parte dell'array dichiarato)
        $request->validate(
            [
                'first_name' => 'string|min:3|max:50',

                'last_name' => 'string|min:3|max:50',

                'address' => ['string', Rule::in($cities)]
            ],
            [
                'address.in_array' => 'Localita non valida ',
            ],
        );

        $data = $request->all();

        $new_userDetail = new UserDetail();

        $new_userDetail->user_id = $user->id;

        $new_userDetail->first_name = $data['first_name'];
        $new_userDetail->last_name = $data['last_name'];
        $new_userDetail->address = $data['address'];

        // ! MAIN FIX - non avevamo salvato il nuovo oggetto UserDetail
        $new_userDetail->save();

        return redirect()->route('admin.users.edit')->with('message', 'dati inseriti con successo');
    }
}
