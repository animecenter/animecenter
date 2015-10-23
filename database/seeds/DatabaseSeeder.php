<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

    	$this->call('UsersTableSeeder');
        $this->call('ClassificationsTableSeeder');
        $this->call('GenresTableSeeder');
        $this->call('ProducersTableSeeder');
        $this->call('StatusesTableSeeder');
        $this->call('TypesTableSeeder');
		$this->call('AnimesTableSeeder');
        $this->call('EpisodesTableSeeder');
        $this->call('MirrorsTableSeeder');

        Model::reguard();
	}
}
