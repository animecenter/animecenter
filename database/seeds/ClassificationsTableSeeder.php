<?php

use Illuminate\Database\Seeder;

class ClassificationsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		$classifications = [
			'G - All Ages', 'PG - Children', 'PG-13 - Teens 13 or older', 'R - 17+ (violence & profanity)',
            'R+ - Mild Nudity', 'Rx - Hentai'
        ];

		foreach ($classifications as $classification) {
			AC\Models\Classification::firstOrCreate(['name' => $classification, 'active' => 1]);
		}
	}

}
