<?php

namespace AC\Http\Controllers;

use AC\Repositories\EloquentAnimeRepository as Anime;
use AC\Repositories\EloquentClassificationRepository as Classification;
use AC\Repositories\EloquentEpisodeRepository as Episode;
use AC\Repositories\EloquentGenreRepository as Genre;
use AC\Repositories\EloquentProducerRepository as Producer;
use AC\Repositories\EloquentSeasonRepository as Season;
use AC\Repositories\EloquentTypeRepository as Type;

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
     * @var Season
     */
    private $season;

    /**
     * @var Type
     */
    private $type;

    /**
     * @param Anime $anime
     * @param Classification $classification
     * @param Episode $episode
     * @param Genre $genre
     * @param Producer $producer
     * @param Season $season
     * @param Type $type
     */
    public function __construct(Anime $anime, Classification $classification, Episode $episode, Genre $genre, Producer $producer, Season $season, Type $type)
    {
        $this->anime = $anime;
        $this->classification = $classification;
        $this->episode = $episode;
        $this->genre = $genre;
        $this->producer = $producer;
        $this->season = $season;
        $this->type = $type;

        $this->data['classifications'] = $this->classification->all();
        $this->data['genres'] = $this->genre->all();
        $this->data['producers'] = $this->producer->all();
        $this->data['seasons'] = $this->season->all();
        $this->data['types'] = $this->type->all();
    }

    public function getIndex($letter = '')
    {
        $this->data['animes'] = $this->anime->getAllByLetter($letter);
        $this->data['currentURL'] = $this->getCurrentURL($letter);

        return view('anime.index', $this->data);
    }

    /**
     * Get anime by slug.
     *
     * @param string $animeSlug
     * @return \Illuminate\View\View
     */
    public function getAnime($animeSlug = '')
    {
        $this->data['anime'] = $anime = $this->anime->getBySlug($animeSlug);
        $this->data['producersCount'] = $anime['producers']->count() - 1;

        // TODO: Update number of views
        // $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);

        $this->data['lastEpisode'] = $this->episode->getLastEpisode($anime['id']);

        return view('anime.show', $this->data);
    }

    /**
     * Get episode by anime slug and by episode number.
     *
     * @param string $animeSlug
     * @param int $episodeNumber
     * @param string $translation
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
        $this->data['pageTitle'] = $title = $anime['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$anime['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $anime['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$anime['title']}, {$anime['title']} English Subbed/Dubbed, Download " .
            "{$anime['title']} English Subbed/Dubbed, Watch {$anime['title']} Online";

        return view('episodes.show', $this->data);
    }

    public function getMirror($animeSlug = '', $mirrorID = '')
    {
        $this->data['episode'] = $episode = $this->episode->with('anime')->where('id', '=', $mirrorID)->firstOrFail();

        // TODO: Update episode views + 1...
        // $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);

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
        $this->data['animes'] = $this->anime->getLatestByLetter();
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getLatestByLetter($letter)
    {
        $this->data['animes'] = $this->anime->getLatestByLetter($letter);
        $this->data['currentURL'] = $this->getCurrentURL($letter);

        return view('anime.index', $this->data);
    }

    public function getByClassificationID($id = 0)
    {
        $this->data['animes'] = $this->anime->getByClassificationAndLetter($id);
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getByClassificationIDAndLetter($id = 0, $letter = '')
    {
        $this->data['animes'] = $this->anime->getByClassificationAndLetter($id, $letter);
        $this->data['currentURL'] = $this->getCurrentURL($letter);

        return view('anime.index', $this->data);
    }

    public function getByGenreID($id = 0)
    {
        $this->data['animes'] = $this->anime->getByGenreAndLetter($id);
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getByGenreIDAndLetter($id = 0, $letter = '')
    {
        $this->data['animes'] = $this->anime->getByGenreAndLetter($id, $letter);
        $this->data['currentURL'] = $this->getCurrentURL($letter);

        return view('anime.index', $this->data);
    }

    public function getByProducerID($id = 0)
    {
        $this->data['animes'] = $this->anime->getByProducerAndLetter($id);
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getByProducerIDAndLetter($id = 0, $letter = '')
    {
        $this->data['animes'] = $this->anime->getByProducerAndLetter($id, $letter);
        $this->data['currentURL'] = $this->getCurrentURL($letter);

        return view('anime.index', $this->data);
    }

    public function getBySeasonID($id = 0)
    {
        $this->data['animes'] = $this->anime->getBySeasonAndLetter($id);
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getBySeasonIDAndLetter($id = 0, $letter = '')
    {
        $this->data['animes'] = $this->anime->getBySeasonAndLetter($id, $letter);
        $this->data['currentURL'] = $this->getCurrentURL($letter);

        return view('anime.index', $this->data);
    }

    public function getByTypeID($id = 0)
    {
        $this->data['animes'] = $this->anime->getByTypeAndLetter($id);
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getByTypeIDAndLetter($id = 0, $letter = '')
    {
        $this->data['animes'] = $this->anime->getByTypeAndLetter($id, $letter);
        $this->data['currentURL'] = $this->getCurrentURL($letter);

        return view('anime.index', $this->data);
    }

    public function getSubbed()
    {
        $this->data['animes'] = $this->anime->getSubbedByLetter();
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getSubbedByLetter($letter = '')
    {
        $this->data['animes'] = $this->anime->getSubbedByLetter($letter);
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getDubbed()
    {
        $this->data['animes'] = $this->anime->getDubbedByLetter();
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getDubbedByLetter($letter = '')
    {
        $this->data['animes'] = $this->anime->getDubbedByLetter($letter);
        $this->data['currentURL'] = $this->getCurrentURL();

        return view('anime.index', $this->data);
    }

    public function getCurrentURL($letter = '')
    {
        return $letter ? str_replace('/' . $letter, '', request()->path()) : request()->path();
    }
}
