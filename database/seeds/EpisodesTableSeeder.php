<?php

use AC\Models\Anime;
use AC\Models\Episode;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EpisodesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $animes = Anime::all(['id', 'number_of_episodes', 'release_date', 'end_date']);
        $faker = Factory::create();

        foreach ($animes as $anime) {
            for ($x = 1; $x < $anime->number_of_episodes; $x++) {
                Episode::firstOrCreate([
                    'anime_id' => $anime->id,
                    'number'   => $x,
                    'title'    => rand(0, 1) === 1 ? $faker->name : null,
                    'synopsis' => rand(0, 1) === 1 ? $faker->text() : null,
                    'active'   => 1,
                    'aired_at' => ($x === 1) ? $anime->release_date : $faker->dateTimeBetween(),
                ]);
            }
        }
    }
}
