<?php

use Illuminate\Database\Seeder;

class MirrorsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		$mirrorSources = [
			'Mp4upload', 'Mp4stream', 'Novamov', 'Auengine', 'Videonest', 'Vidbull', 'Videoweed', 'Arkvid', 'Trollvid',
			'Mp4edge'
        ];

		foreach ($mirrorSources as $mirrorSource) {
			AC\Models\MirrorSource::firstOrCreate(['name' => $mirrorSource, 'active' => 1]);
		}

        $users = AC\Models\User::all(['id']);
        $episodes = AC\Models\Episode::all(['id']);
        $mirrorSources = AC\Models\MirrorSource::all(['id']);
        $translations = collect(['subbed', 'dubbed']);
        $qualities = collect(['SD', 'HD']);
        $urls = collect([
            'http://www.mp4upload.com/embed-'
        ]);
        $faker = Faker\Factory::create();

        foreach ($episodes as $episode) {
            $numberOfMirrors = rand(1, 5);
            for ($x = 1; $x < $numberOfMirrors; $x++) {
                AC\Models\Mirror::firstOrCreate([
                    'user_id' => $users->random()->id,
                    'episode_id' => $episode->id,
                    'mirror_source_id' => $mirrorSources->random()->id,
                    'language_id' => 1,
                    'url' => $urls->random() . $faker->uuid . '.html',
                    'translation' => $translations->random(),
                    'quality' => $qualities->random(),
                    'mobile_friendly' => rand(0, 1),
                    'active' => 1
                ]);
            }
        }
	}

}
