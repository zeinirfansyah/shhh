<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class messageController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (!$user) {
            return view('profile.usernotfound');
        }

        return view('user', [
            'user' => $user,
        ]);
    }

    // public function showMessages()
    // {
    //     $user = Auth::user();
    //     $messages = Message::where('user_id', $user->id)
    //         ->orderBy('created_at', 'asc')
    //         ->get();

    //     return view('messages', [
    //         'messages' => $messages,
    //     ]);
    // }

    public function showMessages()
    {
        $user = Auth::user();

        $messages = Message::where('user_id', $user->id)
            ->orderBy('created_at', 'asc') // Sort by created_at in ascending order
            ->get();

        // Prioritize unread messages
        $unreadMessages = $messages->filter(function ($message) {
            return $message->status === 'unread';
        });

        $readMessages = $messages->diff($unreadMessages); // Keep read messages

        // Combine unread and read messages (unread first)
        $messages = $unreadMessages->merge($readMessages);

        return view('messages', [
            'messages' => $messages,
        ]);
    }

    public function messageDetail($id)
    {
        $user = Auth::user();

        $message = Message::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if (!$message) {
            return redirect()->back()->with('error', 'Message not found or unauthorized access.');
        }

        return view('message_detail', compact('message'));
    }

    public function updateMessageStatus($id)
    {
        $user = Auth::user();

        $message = Message::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if (!$message) {
            return redirect()->back()->with('error', 'Message not found or unauthorized access.');
        }

        if ($message->status !== 'read') {
            $message->update(['status' => 'read']);
        }

        return Redirect::route('messageDetail', $id)->with('success', 'Message status updated successfully.');
    }

    public function sendMessage(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (!$user) {
            return view('userNotFound');
        }

        $validate = $request->validate(
            [
                'message_sender' => ['string', 'max:28'],
                'message_title' => ['string', 'max:32'],
                'message_content' => ['required', 'string', 'max:255'],
            ],
            [
                'max:28' => 'The message sender may not be greater than 28 characters.',
                'max:32' => 'The message title may not be greater than 32 characters.',
                'max:255' => 'The message content may not be greater than 255 characters.',
            ],
        );

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
