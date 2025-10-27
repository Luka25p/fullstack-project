<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Manga;
use App\Models\User;
use App\Models\Followers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $profile = User::findOrFail($userId);

        $manga = Manga::where('user_id', $userId)->latest()->get();
        $posts = Community::where('user_id', $userId)->latest()->get();

        $followers = Followers::where('following_id', $userId)->with('follower')->get();
        $following = Followers::where('follower_id', $userId)->with('following')->get();

        $followersCount = $followers->count();
        $postCount = $posts->count();

        $dates = Community::selectRaw('DATE(created_at) as date')
            ->distinct()
            ->orderByDesc('date')
            ->get();

        return view('dashboard', compact(
            'manga',
            'profile',
            'followers',
            'following',
            'followersCount',
            'postCount',
            'posts',
            'dates'
        ));
    }
}
