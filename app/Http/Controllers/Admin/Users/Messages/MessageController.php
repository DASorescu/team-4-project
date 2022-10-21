<?php

namespace App\Http\Controllers\Admin\Users\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $messages = Message::orderBy('created_at', 'DESC')->where('user_id', "$user->id")->get();
        return view('admin.users.messages.index', compact('messages', 'user'));
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
     * @param  Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('admin.users.messages.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Message  $messsage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.users.messages.index' )
        ->with('message','Messaggio eliminato');
    }
}
