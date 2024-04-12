<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class messageController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (!$user) {
            return view('profile.usernotfound');
        }

        return view('user', [
            'user' => $user
        ]);
    }

    public function showMessages()
    {
        $user = Auth::user();
        $messages = Message::where('user_id', $user->id)->get();

        return view('messages', [
            'messages' => $messages
        ]);
    }

    public function messageDetail($id)
    {
        $user = Auth::user();

        $message = Message::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$message) {
            return redirect()->back()->with('error', 'Message not found or unauthorized access.');
        }

        return view('message_detail', compact('message'));
    }


    public function sendMessage(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (!$user) {
            return view('userNotFound');
        }

        $validate = $request->validate([
            'message_sender' => ['string', 'max:28'],
            'message_title' => ['string', 'max:32'],
            'message_content' => ['required', 'string', 'max:255'],
        ], [
            'max:28' => 'The message sender may not be greater than 28 characters.',
            'max:32' => 'The message title may not be greater than 32 characters.',
            'max:255' => 'The message content may not be greater than 255 characters.',
        ]);

        $message = [
            'user_id' => $user->id,
            'message_sender' => $request->message_sender,
            'message_title' => $request->message_title,
            'message_content' => $request->message_content,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Message::create($message);

        return back()->with('success', 'Document data created successfully');
    }
}
