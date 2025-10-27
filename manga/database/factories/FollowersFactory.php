<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class FollowersFactory extends Factory
{
    protected $model = \App\Models\Followers::class;

    public function definition()
    {
        $follower = User::inRandomOrder()->first()?->id ?? 1;
        $following = User::inRandomOrder()->first()?->id ?? 2;

        // prevent a user following themselves
        while ($follower == $following) {
            $following = User::inRandomOrder()->first()?->id ?? 2;
        }

        return [
            'follower_id' => $follower,
            'following_id' => $following,
        ];
    }
}
