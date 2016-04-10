<?php

use AC\Models\Meta;
use Illuminate\Database\Seeder;

class MetasTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $metas = [
            [
                'route' => '/',
                'title' => 'AnimeCenter: Watch Anime English Subbed/Dubbed Online in HD',
                'keywords' => 'Watch Anime Online, Anime Subbed/Dubbed, Anime Episodes, Anime Stream, Subbed Anime, Dubbed Anime',
                'description' => 'Watch Anime English Subbed/Dubbed Online in HD at AnimeCenter! Over 41000 Episodes, and 2,146 Anime Series!',
                'active' => 1,
            ],
            [
                'route' => 'anime',
                'title' => 'Watch Anime Online / Subbed Anime List / Dubbed Anime List | Watch Anime Online Free',
                'keywords' => 'Watch Anime, Anime Subbed, Anime Dubbed, Watch Anime on iphone, Free Anime',
                'description' => 'Watch Anime Online / Subbed/Dubbed Anime List | Watch Anime Online Free! Watch English Subbed/Dubbed, Watch English Sub/Dub, \r\nDownload Anime for free. Watch Online English Subbed/Dubbed Online for Free only at Anime Center',
                'active' => 1,
            ],
            [
                'route' => 'episodes/latest',
                'title' => 'Latest Episodes | Watch Anime Online Free',
                'keywords' => 'Latest Anime Episodes, Watch Latest Anime Episodes, Watch on Iphone, Watch Anime Online, English Subbed/Dubbed',
                'description' => 'Watch Latest Anime Episodes added to the site! Latest English Subbed/Dubbed Anime',
                'active' => 1,
            ],
            [
                'route' => 'anime/watch/{animeSlug}',
                'title' => 'Watch $1 Online for Free | Watch Anime Online Free',
                'keywords' => 'Watch $1, $1 English Subbed/Dubbed, Download $1 English Subbed/Dubbed, Watch $1 Online',
                'description' => 'Watch $1 English Subbed/Dubbed in HD Online. Download $1 English Subbed/Dubbed in HD Online. Watch $1 English Sub/Dub HD',
                'active' => 1,
            ],
            [
                'route' => 'anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}',
                'title' => 'Watch $1 English Subbed/Dubbed in HD Online for Free | Watch Anime Online Free',
                'keywords' => 'Watch $1, $1 English Subbed/Dubbed, Download $1 English Subbed/Dubbed, Watch $1 Online',
                'description' => 'Watch $1 English Subbed/Dubbed in HD Online. Download $1 English Subbed/Dubbed in HD Online. Watch $1 English Sub/Dub HD',
                'active' => 1,
            ],
            [
                'route' => 'anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}/{mirrorID}',
                'title' => 'Watch $1 English Subbed/Dubbed in HD Online for Free | Watch Anime Online Free',
                'keywords' => 'Watch $1, $1 English Subbed/Dubbed, Download $1 English Subbed/Dubbed, Watch $1 Online',
                'description' => 'Watch $1 English Subbed/Dubbed in HD Online. Download $1 English Subbed/Dubbed in HD Online. Watch $1 English Sub/Dub HD',
                'active' => 1,
            ],
            [
                'route' => 'search',
                'title' => 'Animecenter.co | Watch Anime Online Free',
                'keywords' => 'Download $1, Watch $1 on iphone, watch anime online, English Subbed/Dubbed, English Sub/Dub, Watch Anime for free, Download Anime, High Quality Anime',
                'description' => 'Watch $1!, Watch $1! English Subbed/Dubbed, Watch $1 English Sub/Dub, Download $1 for free, Watch $1! Online English Subbed and Dubbed for Free Online only at Anime Center',
                'active' => 1,
            ]
        ];

        foreach ($metas as $meta) {
            Meta::firstOrCreate($meta);
        }
    }
}