<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(CalendarSeasonsTableSeeder::class);
        $this->call(ClassificationsTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ProducersTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(AnimesTableSeeder::class);
        $this->call(EpisodesTableSeeder::class);
        $this->call(MirrorsTableSeeder::class);
    }
}
