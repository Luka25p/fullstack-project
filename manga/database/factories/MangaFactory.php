<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Manga;
use App\Models\Chapter;
use App\Models\User;

class MangaFactory extends Factory
{
    protected $model = Manga::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'descr' => $this->faker->paragraph(),
            'auth' => $this->faker->name(),
            'chapter' => 0,
            'image' => 'uploads/manga/1757271273.jpg',
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Manga $manga) {
            $chapterCount = rand(5, 15);

            for ($i = 1; $i <= $chapterCount; $i++) {
                Chapter::factory()->create([
                    'manga_id' => $manga->id,
                    'number' => $i,
                    'title' => "Chapter $i - " . fake()->sentence(2),
                ]);
            }

            // update manga's chapter count
            $manga->update(['chapter' => $chapterCount]);
        });
    }
}
