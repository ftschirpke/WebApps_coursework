<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function index()
    {
        return view('friends.index', ['user' => Auth::user()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|numeric|exists:App\Models\User,id'
        ]);
        if ($validatedData['user_id'] != $request->user()->id) {
            $request->user()->users_friend_requests_sent_to()
            ->attach($validatedData['user_id']);
        }
        $msg = "Friend Request sent";
        if ($request->user()->friends()->contains($validatedData['user_id'])) {
            $msg = "Friend added";
        }
        return redirect()->route('friends.index', ['user' => $request->user()])
            ->with('flash_msg', $msg);
    }

    public function destroy(Request $request, User $user) {
        $msg = "Friend Request taken back";
        if ($request->user()->friends()->contains($user)) {
            $msg = "User unfriended";
        }
        $request->user()->users_friend_requests_sent_to()->detach($user);
        return redirect()->route('friends.index', ['user' => $request->user()])
            ->with('flash_msg', $msg);
    }
}
