<?php

use AC\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
        User::firstOrCreate([
            'username' => 'admin',
            'email' => 'admin@animecenter.tv',
            'password' => bcrypt('actvadmin'),
            'active' => 1
        ]);
		factory(User::class, 50)->create();
	}

}
