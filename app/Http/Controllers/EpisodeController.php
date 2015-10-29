<?php

namespace AC\Http\Controllers;

use AC\Repositories\EloquentEpisodeRepository as Episode;

class EpisodeController extends Controller
{
    /**
     * @var Episode
     */
    private $episode;

    /**
     * @param Episode $episode
     */
    public function __construct(Episode $episode)
    {
        $this->episode = $episode;
    }

    public function getLatest()
    {
        $this->data['episodes'] = $this->episode->latestPaginate();

        // TODO: Get metadata...
        $this->data['pageTitle'] = 'Latest Episodes | Watch Anime Online Free';
        $this->data['metaTitle'] = 'Watch the Latest Episode for Free Online | Watch Anime Online Free just in '.
            'Animecenter.tv';
        $this->data['metaDesc'] = 'Watch Latest Anime Episodes added to the site! Latest English Subbed/Dubbed Anime';
        $this->data['metaKey'] = 'Latest Anime Episodes, Watch Latest Anime Episodes, Watch on Iphone, Watch Anime'.
            ' Online, English Subbed/Dubbed';

        return view('app.episodes.latest', $this->data);
    }
}
