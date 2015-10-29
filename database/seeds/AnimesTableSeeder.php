<?php

use AC\Models\Anime;
use Illuminate\Database\Seeder;

class AnimesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        factory(Anime::class, 100)->create();
    }
}
