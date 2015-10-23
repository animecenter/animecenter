<?php

use Illuminate\Database\Seeder;

class AnimesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        factory(AC\Models\Anime::class, 100)->create();
	}

}
