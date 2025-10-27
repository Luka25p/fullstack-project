<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{

    public function definition()
    {
        return [
            'manga_id' => null,
            'user_id' => 1,
            'number' => 1, // will set sequentially in seeder
            'title' => $this->faker->sentence(3), // only the title, no "Chapter X"
        ];
    }
}
