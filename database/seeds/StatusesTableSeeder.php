<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		$statuses = ['Not yet aired', 'Currently Airing', 'Finished Airing'];

		foreach ($statuses as $status) {
			AC\Models\Status::firstOrCreate(['name' => $status, 'active' => 1]);
		}
	}

}
