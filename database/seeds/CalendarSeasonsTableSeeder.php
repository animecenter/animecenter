<?php

use AC\Models\CalendarSeason;
use Illuminate\Database\Seeder;

class CalendarSeasonsTableSeeder extends Seeder
{
    public function run()
    {
        $calendarSeasons = ['Spring', 'Summer', 'Fall', 'Winter'];

        foreach ($calendarSeasons as $calendarSeason) {
            CalendarSeason::firstOrCreate(['name' => $calendarSeason, 'active' => 1]);
        }
    }
}
