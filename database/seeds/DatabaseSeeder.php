<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

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
        $this->call('CalendarSeasonsTableSeeder');
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
