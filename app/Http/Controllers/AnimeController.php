<?php

namespace AC\Http\Controllers;

use AC\Models\Meta;
use AC\Models\Mirror;
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
     * @var Mirror
     */
    private $mirror;
    /**
     * @var Meta
     */
    private $meta;

    /**
     * @param Anime          $anime
     * @param Classification $classification
     * @param Episode        $episode
     * @param Genre          $genre
     * @param Producer       $producer
     * @param CalendarSeason $calendarSeason
     * @param Type           $type
     * @param Mirror         $mirror
     * @param meta           $meta
     */
    public function __construct(Anime $anime, Classification $classification, Episode $episode, Genre $genre, Producer $producer, CalendarSeason $calendarSeason, Type $type, Mirror $mirror, Meta $meta)
    {
        $this->anime = $anime;
        $this->classification = $classification;
        $this->episode = $episode;
        $this->genre = $genre;
        $this->producer = $producer;
        $this->calendarSeason = $calendarSeason;
        $this->type = $type;
        $this->mirror = $mirror;
        $this->meta = $meta;
    }

    /**
     * Route anime.
     *
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
        $this->data['meta'] = $this->meta->whereRoute('anime')->orderBy('route')
            ->firstOrFail(['title', 'keywords', 'description']);

        return view('app.anime.index', $this->data);
    }

    /**
     * Get anime by slug.
     * Route anime/watch/{animeSlug}.
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
        $this->data['meta'] = $this->meta->whereRoute('anime/watch/{animeSlug}')->orderBy('route')
            ->firstOrFail(['title', 'keywords', 'description'])->replaceAll('$1', $anime->title);

        return view('app.anime.show', $this->data);
    }

    /**
     * Get episode by anime slug and by episode number.
     * Route anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}.
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
        $this->data['meta'] = $this->meta->whereRoute('anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}')
            ->orderBy('route')->firstOrFail(['title', 'keywords', 'description'])
            ->replaceAll('$1', $anime['title']);

        return view('app.episodes.show', $this->data);
    }

    /**
     * Get mirror for current anime episode.
     * Route anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}/{mirrorID}.
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
        $this->data['currentMirror'] = $this->mirror->with(['mirrorSource'])->whereId($mirrorID)->first();
        $this->data['anime'] = $anime = $this->anime->getMirrors($animeSlug, $episodeNumber, $translation);
        $this->data['nextEpisode'] = $this->episode->getNextEpisode($anime['id'], $anime->episode->number);
        $this->data['prevEpisode'] = $this->episode->getPreviousEpisode($anime['id'], $anime->episode->number);
        $this->data['meta'] = $this->meta->whereRoute(
            'anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}/{mirrorID}'
        )->orderBy('route')->firstOrFail(['title', 'keywords', 'description'])
            ->replaceAll('$1', $anime['title'].' '.$anime->episode->number);

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
