<?php

use AC\Models\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		$genres = [];
		$genres['animes'] = [
            'Action', 'Adventure', 'Cars', 'Comedy', 'Dementia', 'Demons', 'Drama', 'Ecchi', 'Fantasy', 'Game', 'Harem',
            'Hentai', 'Historical', 'Horror', 'Josei', 'Kids', 'Magic', 'Martial Arts', 'Mecha', 'Military', 'Music',
            'Mystery', 'Parody', 'Police', 'Psychological', 'Romance', 'Samurai', 'School', 'Sci-Fi', 'Seinen',
            'Shoujo', 'Shoujo Ai', 'Shounen', 'Shounen Ai', 'Slice of Life', 'Space', 'Sports', 'Super Power',
            'Supernatural', 'Thriller', 'Vampire', 'Yaoi', 'Yuri'
        ];

		foreach ($genres['animes'] as $genre) {
			Genre::firstOrCreate(['name' => $genre, 'model' => 'Anime', 'active' => 1]);
		}
	}

}
