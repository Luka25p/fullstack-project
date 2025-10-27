<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manga;
use App\Models\Chapter;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create users fi
        \App\Models\User::factory(10)->create();

        Manga::factory(40)->create()->each(function ($manga) {
            $chapterCount = rand(5, 15);

            $chapters = Chapter::factory($chapterCount)->make()->each(function ($chapter, $i) use ($manga) {
                $chapter->manga_id = $manga->id;
                $chapter->user_id = $manga->user_id;
                $chapter->number = $i + 1;
                $chapter->save();
            });
        });



        // then followers
        \App\Models\Followers::factory(30)->create();

        \App\Models\Community::factory(15)->create();

    }

}
