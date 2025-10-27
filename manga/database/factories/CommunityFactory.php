<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CommunityFactory extends Factory
{
    protected $model = \App\Models\Community::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),       // e.g., "Fun Anime Club"
            'descr' => $this->faker->paragraph(),          // description
            'author' => $this->faker->name(),             // author name
            'user_id' => User::inRandomOrder()->first()?->id ?? 1, // assign a user
        ];
    }
}
