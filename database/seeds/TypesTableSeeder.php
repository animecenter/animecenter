<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        $types = [];
		$types['animes'] = ['TV', 'OVA', 'Movie', 'Special', 'ONA', 'Music'];

		foreach ($types['animes'] as $animeType) {
			AC\Models\Type::firstOrCreate(['name' => $animeType, 'model' => 'Anime', 'active' => 1]);
		}
	}

}
