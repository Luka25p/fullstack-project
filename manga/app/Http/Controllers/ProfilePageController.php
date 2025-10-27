<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    public function showProfile($id)
    {
        $profile = User::findOrFail($id);

        $posts = Community::where('user_id', $profile->id)->get();

        $isFollowing = false;

        if (auth()->check() && auth()->id() !== $profile->id) {
            $isFollowing = \App\Models\Followers::where('follower_id', auth()->id())
                ->where('following_id', $profile->id)
                ->exists();
        }
        $followers = \App\Models\Followers::where('following_id', $profile->id)
        ->with('follower') 
        ->get();
        $following = \App\Models\Followers::where('follower_id', $profile->id)
        ->with('following') 
        ->get();


        $followersCount = $profile->followers()->count();

        $postCount = $posts->count();

        return view('pages.profile', compact(
            'profile',
            'isFollowing',
            'followersCount',
            'postCount',
            'posts',
            'followers',
            'following'
        ));
    }
}
