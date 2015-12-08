<?php

namespace AC\Http\Controllers;

use AC\Repositories\EloquentAnimeRepository as Anime;
use AC\Repositories\EloquentCalendarSeasonRepository as CalendarSeason;
use AC\Repositories\EloquentClassificationRepository as Classification;
use AC\Repositories\EloquentEpisodeRepository as Episode;
use AC\Repositories\EloquentGenreRepository as Genre;
use AC\Repositories\EloquentProducerRepository as Producer;
use AC\Repositories\EloquentTypeRepository as Type;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    protected $data;

    /**
     * @var Anime
     */
    private $anime;

    /**
     * @var Classification
     */
    private $classification;

    /**
     * @var Episode
     */
    private $episode;

    /**
     * @var Genre
     */
    private $genre;

    /**
     * @var Producer
     */
    private $producer;

    /**
     * @var CalendarSeason
     */
    private $calendarSeason;

    /**
     * @var Type
     */
    private $type;

    /**
     * @param Anime          $anime
     * @param Classification $classification
     * @param Episode        $episode
     * @param Genre          $genre
     * @param Producer       $producer
     * @param CalendarSeason $calendarSeason
     * @param Type           $type
     */
    public function __construct(Anime $anime, Classification $classification, Episode $episode, Genre $genre, Producer $producer, CalendarSeason $calendarSeason, Type $type)
    {
        $this->anime = $anime;
        $this->classification = $classification;
        $this->episode = $episode;
        $this->genre = $genre;
        $this->producer = $producer;
        $this->calendarSeason = $calendarSeason;
        $this->type = $type;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $this->data['query'] = $request->except('page');
        $this->data['animes'] = $this->anime->searchBy($this->data['query'], $request);
        $this->data['classifications'] = $this->classification->all();
        $this->data['genres'] = $this->genre->all();
        $this->data['producers'] = $this->producer->all();
        $this->data['calendarSeasons'] = $this->calendarSeason->all();
        $this->data['types'] = $this->type->all();
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('app.anime.index', $this->data);
    }

    /**
     * Get anime by slug.
     *
     * @param string $animeSlug
     *
     * @return \Illuminate\View\View
     */
    public function getAnime($animeSlug = '')
    {
        $this->data['anime'] = $anime = $this->anime->getBySlug($animeSlug);
        $this->data['producersCount'] = $anime['producers']->count() - 1;
        $this->data['genresCount'] = $anime['genres']->count() - 1;
        $this->data['latestEpisode'] = $this->episode->getLatestEpisode($anime['id']);

        return view('app.anime.show', $this->data);
    }

    /**
     * Get episode by anime slug and by episode number.
     *
     * @param string $animeSlug
     * @param int    $episodeNumber
     * @param string $translation
     *
     * @return \Illuminate\View\View
     */
    public function getEpisode($animeSlug = '', $episodeNumber = 0, $translation = 'all')
    {
        $this->data['anime'] = $anime = $this->anime->getMirrors($animeSlug, $episodeNumber, $translation);
        $this->data['prevEpisode'] = $this->episode->getPreviousEpisode($anime['id'], $anime['episode']->number);
        $this->data['nextEpisode'] = $this->episode->getNextEpisode($anime['id'], $anime['episode']->number);

        // TODO: Update episode views + 1...
        // $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);

        // TODO: Get episode meta data.
        $this->data['pageTitle'] = $title = $anime['title'].' English Subbed/Dubbed in HD';
        $this->data['metaTitle'] = "Watch {$anime['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = 'Watch '.$title.' Online. Download '.$title.' Online. Watch '.
            $anime['title'].' English Sub/Dub HD';
        $this->data['metaKey'] = "Watch {$anime['title']}, {$anime['title']} English Subbed/Dubbed, Download ".
            "{$anime['title']} English Subbed/Dubbed, Watch {$anime['title']} Online";

        return view('app.episodes.show', $this->data);
    }

    /**
     * Get mirror for current anime episode.
     *
     * @param string $animeSlug
     * @param int    $episodeNumber
     * @param string $translation
     * @param string $mirrorID
     *
     * @return \Illuminate\View\View
     */
    public function getMirror($animeSlug = '', $episodeNumber = 0, $translation = '', $mirrorID = '')
    {
        $this->data['anime'] = $anime = $this->anime->getMirror($animeSlug, $episodeNumber, $translation, $mirrorID);

        // TODO: Update episode views + 1...
        // $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);

        $this->data['nextEpisode'] = $this->episode->getNextEpisode($anime->id, $anime->episode->number);
        $this->data['prevEpisode'] = $this->episode->getPreviousEpisode($anime->id, $anime->episode->number);

        $this->data['pageTitle'] = $title = $anime->episode['title'].' English Subbed/Dubbed in HD';
        $this->data['metaTitle'] = "Watch {$anime->episode['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = 'Watch '.$title.' Online. Download '.$title.' Online. Watch '.
            $anime->episode['title'].' English Sub/Dub HD';
        $this->data['metaKey'] = "Watch {$anime->episode['title']}, {$anime->episode['title']} English Subbed/Dubbed,".
            " Download {$anime->episode['title']} English Subbed/Dubbed, Watch {$anime->episode['title']} Online";

        return view('app.episodes.show', $this->data);
    }

    /**
     * Get random anime.
     *
     * @return \Illuminate\View\View
     */
    public function getRandom()
    {
        return $this->anime->getRandom();
    }

    public function getCurrentURL($letter = '')
    {
        return $letter ? str_replace('/'.$letter, '', request()->path()) : request()->path();
    }
}
