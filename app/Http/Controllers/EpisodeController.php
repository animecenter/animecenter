<?php

namespace App\Http\Controllers;

use App\Anime\Anime;
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
     * @var Anime
     */
    private $anime;

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
     * @param Anime $anime
     * @param Page $page
     * @param Option $option
     */
    public function __construct(Episode $episode, Anime $anime, Page $page, Option $option)
    {
        $this->episode = $episode;
        $this->anime = $anime;
        $this->page = $page;
        $this->option = $option;
        $this->data['topPagesList'] = $this->page->where('position', '=', 'top')->orderBy('order')->get();
        $this->data['bottomPagesList'] = $this->page->where('position', '=', 'bottom1')->orderBy('order')->get();
        $this->data['bottomPagesList2'] = $this->page->where('position', '=', 'bottom2')->orderBy('order')->get();
        $this->data['bottomPagesList3'] = $this->page->where('position', '=', 'bottom3')->orderBy('order')->get();
        $this->data['options'] = $this->option->all();
    }

    public function getEpisode($slug)
    {
        $this->data['episode'] = $episode = $this->episode->with('anime')
            ->where('slug', '=', $slug)->firstOrFail();
        $this->data['nextEpisode'] = $this->episode
            ->where('order', '=', $episode->order + 1)
            ->where('anime_id', '=', $episode->anime->id)
            ->first();
        $this->data['prevEpisode'] = $this->episode
            ->where('order', '=', $episode->order - 1)
            ->where('anime_id', '=', $episode->anime->id)
            ->first();
        $this->data['animeBanner'] = $this->anime->orderByRaw("RAND()")->take(1)->first();

        $this->data['mainLink'] = $this->data['options'][4]['value'] . $episode['slug'];
        if (isset($type[2])) {
            switch ($type[2]) {
                case 'mirror1':
                    $cont = $episode['mirror1'];
                    break;
                case 'mirror2':
                    $cont = $episode['mirror2'];
                    break;
                case 'mirror3':
                    $cont = $episode['mirror3'];
                    break;
                case 'mirror4':
                    $cont = $episode['mirror4'];
                    break;
                case 'raw':
                    $cont = $episode['raw'];
                    break;
                case 'hd':
                    $cont = $episode['hd'];
                    break;
                default:
                    $cont = ($episode['mirror1'] == null) ? $episode['raw'] : $episode['mirror1'];
            }
        } else {
            $cont = ($episode['mirror1'] == null) ? $episode['raw'] : $episode['mirror1'];
        }
        $this->data['cont'] = $cont;

        return view('episodes.index', $this->data);
    }
}
