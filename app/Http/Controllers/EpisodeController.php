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
        $this->data['animeBanner'] = $this->anime->orderByRaw("RAND()")->where('type2', '=', 'subbed')->take(1)->first();
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
        $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);
        $this->data['nextEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '>', $episode['order'])
            ->orderBy('order')
            ->first();
        $this->data['prevEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '<', $episode['order'])
            ->orderBy('order', 'desc')
            ->first();
        $this->data['mainLink'] = $this->data['options'][4]['value'] . $episode['slug'];
        if ($episode['type2']) {
            switch ($episode['type2']) {
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
        $this->data['currentMirror'] = '';
        $this->data['cont'] = $cont;
        $this->data['pageTitle'] = $title = $episode['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$episode['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $episode['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$episode['title']}, {$episode['title']} English Subbed/Dubbed, Download " .
            "{$episode['title']} English Subbed/Dubbed, Watch {$episode['title']} Online";

        return view('episodes.show', $this->data);
    }

    public function getEpisodeMirror($slug, $mirror)
    {
        $mirrors = ['hd', 'mirror1', 'mirror2', 'mirror3', 'mirror4', 'raw', 'subdub'];
        if (!in_array($mirror, $mirrors)) {
            abort(404, "That is not a valid mirror!");
        }
        $this->data['episode'] = $episode = $this->episode->with('anime')
            ->where('slug', '=', $slug)->where($mirror, '<>', '')->firstOrFail();
        $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);
        $this->data['nextEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '>', $episode['order'])
            ->orderBy('order')
            ->first();
        $this->data['prevEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '<', $episode['order'])
            ->orderBy('order', 'desc')
            ->first();
        $this->data['mainLink'] = $this->data['options'][4]['value'] . $episode['slug'];
        if ($mirror) {
            switch ($mirror) {
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
        $this->data['currentMirror'] = $mirror;
        $this->data['pageTitle'] = $title = $episode['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$episode['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $episode['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$episode['title']}, {$episode['title']} English Subbed/Dubbed, Download " .
            "{$episode['title']} English Subbed/Dubbed, Watch {$episode['title']} Online";

        return view('episodes.show', $this->data);
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
