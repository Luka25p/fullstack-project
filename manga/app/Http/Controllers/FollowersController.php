<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewFollowerNotification;

class FollowersController extends Controller
{
    public function toggleFollow(Request $request)
    {
        
        $request->validate([
            'following_id' => 'required|exists:users,id|different:' . Auth::id(),
        ]);

        $followerId = Auth::id();
        $followingId = $request->following_id;

        $existing = Followers::where('follower_id', $followerId)
            ->where('following_id', $followingId)
            ->first();

        if ($existing) {
            $existing->delete();
            return redirect()->back()->with('message', 'Unfollowed successfully');
        } else {
            Followers::create([
                'follower_id' => $followerId,
                'following_id' => $followingId,
            ]);

            $follower = Auth::user();
            $userToNotify = User::findOrFail($followingId);
            $userToNotify->notify(new NewFollowerNotification($follower));

            return redirect()->back()->with('message', 'Followed successfully');
        }
    }
}
