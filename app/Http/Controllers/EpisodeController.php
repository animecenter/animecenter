<?php

namespace AC\Http\Controllers;

use AC\Models\Meta;
use AC\Repositories\EloquentEpisodeRepository as Episode;

class EpisodeController extends Controller
{
    /**
     * @var Episode
     */
    private $episode;

    /**
     * @var Meta
     */
    private $meta;

    /**
     * @param Episode $episode
     * @param Meta    $meta
     */
    public function __construct(Episode $episode, Meta $meta)
    {
        $this->episode = $episode;
        $this->meta = $meta;
    }

    /**
     * Method for the episodes/latest route.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLatest()
    {
        $this->data['meta'] = $this->meta->whereRoute('episodes/latest')->orderBy('route')
            ->firstOrFail(['title', 'keywords', 'description']);
        $this->data['episodes'] = $this->episode->latestPaginate();

        return view('app.episodes.latest', $this->data);
    }
}
