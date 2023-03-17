<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id=null)
    {
        if($id){
            $user_chat = User::find($id);
            $messages = Message::where(function($query) use($user_chat){
                $query->where('sender_id',auth()->id())->where('receiver_id',$user_chat->id);
            })->orWhere(function($query)use($user_chat){
                $query->where('receiver_id',auth()->id())->where('sender_id',$user_chat->id);
            })->get();
        }else{
            $user_chat = new User();
            $messages = new Message();
        }
        $users = User::where('id','!=',auth()->id())->get();
        return view('home',compact('users','user_chat','messages'));
    }
    public function message_store(Request $request, User $user)
    {
        $request->validate([
            'message'=>['required']
        ]);
        Message::create([
            'sender_id'=>auth()->id(),
            'receiver_id'=>$user->id,
            'message'=>$request->message
        ]);
        return back();
    }
}
