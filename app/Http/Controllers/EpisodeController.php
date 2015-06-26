<?php

namespace App\Http\Controllers;

use App\Episodes\Episode;
use App\Options\Option;
use App\Pages\Page;

class EpisodeController extends Controller
{


    /**
     * @var Episode
     */
    private $episode;
    /**
     * @var Page
     */
    private $page;
    /**
     * @var Option
     */
    private $option;

    /**
     * @param Episode $episode
     * @param Page $page
     * @param Option $option
     */
    public function __construct(Episode $episode, Page $page, Option $option)
    {
        $this->episode = $episode;
        $this->page = $page;
        $this->option = $option;
    }

    public function getEpisode($slug)
    {
        $this->data['episode'] = $episode = $this->episode->with('anime')->where('slug', '=', $slug)->firstOrFail();
        $this->data['nextEpisode'] = $this->episode
            ->where('order', '=', $episode->order + 1)
            ->where('anime_id', '=', $episode->anime->id)
            ->first();
        $this->data['prevEpisode'] = $this->episode
            ->where('order', '=', $episode->order - 1)
            ->where('anime_id', '=', $episode->anime->id)
            ->first();
        $this->data['topPagesList'] = $this->page->where('position', '=', 'top')->orderBy('order')->get();
        $this->data['options'] = $this->option->all();

        return view('episodes.index', $this->data);
    }
}
