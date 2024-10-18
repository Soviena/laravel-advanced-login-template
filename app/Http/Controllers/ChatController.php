<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\UserChatUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user()->load('user_data');
        $chatUsers = $user->chatUsers();
        return view('chat',compact('user','chatUsers'));
    }
    public function chat(Request $request, $toId)
    {
        $user = Auth::user()->load('user_data');
        $aite = User::findOrFail($toId)->load('user_data');
        $chatUsers = $user->chatUsers();
        $messages = UserChatUser::where(function($query) use ($user, $toId) {
            $query->where('from_id', $user->id)
                  ->where('to_id', $toId);
        })->orWhere(function($query) use ($user, $toId) {
            $query->where('from_id', $toId)
                  ->where('to_id', $user->id);
        })->with('chat')->get();

        return view('chat',compact('user','messages', 'aite' ,'chatUsers'));
    }
    public function sendChat(Request $request)
    {
        $user = Auth::user();
        $chat = new Chat;
        $chat->body = $request->input('body');
        $chat->save();
        $userChatUser = new UserChatUser;
        $userChatUser->from_id = $user->id;
        $userChatUser->to_id = $request->to_id;
        $userChatUser->chat_id = $chat->id;
        $userChatUser->save();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
