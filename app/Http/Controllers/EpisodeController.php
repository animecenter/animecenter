<?php

namespace AC\Http\Controllers;

use AC\Models\Anime;
use AC\Models\Episode;

class EpisodeController extends Controller
{
    /**
     * @var Episode
     */
    private $episode;

    /**
     * @var Anime
     */
    private $anime;

    /**
     * @param Episode $episode
     * @param Anime $anime
     */
    public function __construct(Episode $episode, Anime $anime)
    {
        $this->episode = $episode;
        $this->anime = $anime;
    }

    public function getLatest()
    {
        $this->data['episodes'] = $episode = $this->episode->with('anime')
            ->where('show', '=', '1')
            ->where('date', '>', strtotime('-1 month'))
            ->orderBy('date', 'DESC')
            ->paginate(24);
        $this->data['pageTitle'] = "Latest Episodes | Watch Anime Online Free";
        $this->data['metaTitle'] = "Watch the Latest Episode for Free Online | Watch Anime Online Free just in " .
            "Animecenter.tv";
        $this->data['metaDesc'] = "Watch Latest Anime Episodes added to the site! Latest English Subbed/Dubbed Anime";
        $this->data['metaKey'] = "Latest Anime Episodes, Watch Latest Anime Episodes, Watch on Iphone, Watch Anime" .
            " Online, English Subbed/Dubbed";

        return view('episodes.latest', $this->data);
    }
}
