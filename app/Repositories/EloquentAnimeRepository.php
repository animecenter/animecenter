<?php

namespace AC\Repositories;

use AC\Models\Anime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EloquentAnimeRepository
{
    /**
     * @var Anime
     */
    private $anime;

    /**
     * @param Anime $anime
     */
    public function __construct(Anime $anime)
    {
        $this->anime = $anime;
    }

    public function all()
    {
        return $this->anime->has('episodes');
    }

    /**
     * Get anime by slug.
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBySlug($slug = '')
    {
        return $this->anime->with([
            'classification' => function ($query) {
                $query->select(['id', 'name']);
            }, 'episodes' => function ($query) {
                $query->orderBy('number', 'asc');
            }, 'genres' => function ($query) {
                $query->select(['id', 'name']);
            }, 'producers' => function ($query) {
                $query->select(['id', 'name']);
            }, 'season' => function ($query) {
                $query->select(['id', 'name']);
            }, 'type' => function ($query) {
                $query->select(['id', 'name']);
            }
        ])->where('slug', '=', $slug)->firstOrFail();
    }

    /**
     * @param $parameters
     * @param Request $request
     * @return mixed
     */
    public function searchBy($parameters, Request $request)
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $anime = $this->all();
        if (!$parameters) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->orderBy('id', 'DESC')->paginate(20);
        }
        if ($request->has('letter')) {
            $anime = $this->getByLetter($anime, $parameters['letter']);
        }
        if ($request->has('language')) {
            $anime = $this->getByLanguage($anime, $parameters['language']);
        }
        if ($request->has('type')) {
            $anime = $this->getByType($anime, $parameters['type']);
        }
        if ($request->has('season')) {
            $anime = $this->getBySeason($anime, $parameters['season']);
        }
        if ($request->has('year')) {
            $anime = $this->getByYear($anime, $parameters['year']);
        }
        if ($request->has('genres')) {
            $anime = $this->getByGenres($anime, $parameters['genres']);
        }
        if ($request->has('producer')) {
            $anime = $this->getByProducer($anime, $parameters['producer']);
        }
        if ($request->has('classification')) {
            $anime = $this->getByClassification($anime, $parameters['classification']);
        }
        if ($request->has('sortBy')) {
            $anime = $this->sortBy($anime, $parameters['sortBy']);
        } else {
            $anime = $this->sortBy($anime, 'latest');
        }

        return $anime->paginate(20);
    }

    /**
     * Get anime by letter.
     *
     * @param $anime
     * @param string $letter
     * @return mixed
     */
    public function getByLetter($anime, $letter = '')
    {
        if (!$letter === '0-9') {
            return $anime->whereRaw("title NOT REGEXP '^[[:alpha:]]'");
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $anime->where('title', 'like', $letter.'%');
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get anime by language.
     *
     * @param $anime
     * @param string $language
     * @return mixed
     */
    public function getByLanguage($anime, $language = '')
    {
        if ($language === 'subbed') {
            return $anime->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'subbed');
            });
        } else if ($language === 'dubbed') {
            return $anime->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'dubbed');
            });
        } else {
            abort(404, $language . ' was not found');
        }
    }

    /**
     * Get anime by type.
     *
     * @param $anime
     * @param int $id
     * @return mixed
     */
    public function getByType($anime, $id = 0)
    {
        return $anime->whereHas('type', function ($query) use ($id) {
            $query->where('types.id', '=', $id);
        });
    }

    /**
     * Get anime by season.
     *
     * @param $anime
     * @param int $id
     * @return mixed
     */
    public function getBySeason($anime, $id = 0)
    {
        return $anime->whereHas('season', function ($query) use ($id) {
            $query->where('seasons.id', '=', $id);
        });
    }

    /**
     * Get anime by Year.
     *
     * @param $anime
     * @param int $id
     * @return mixed
     */
    public function getByYear($anime, $id = 0)
    {
        return $anime->whereHas('year', function ($query) use ($id) {
            $query->where('years.id', '=', $id);
        });
    }

    /**
     * Get anime by genres.
     *
     * @param $anime
     * @param array $genres
     * @return mixed
     */
    public function getByGenres($anime, $genres = [])
    {
        return $anime->whereHas('genres', function ($query) use ($genres) {
            $query->whereIn('genres.id', $genres);
        });
    }

    /**
     * Get anime by producer.
     *
     * @param $anime
     * @param int $id
     * @return mixed
     */
    public function getByProducer($anime, $id = 0)
    {
        return $anime->whereHas('producers', function ($query) use ($id) {
            $query->where('producers.id', '=', $id);
        });
    }

    /**
     * Get anime by classification.
     *
     * @param $anime
     * @param int $id
     * @return mixed
     */
    public function getByClassification($anime, $id = 0)
    {
        return $anime->whereHas('classification', function ($query) use ($id) {
            $query->where('classifications.id', '=', $id);
        });
    }

    /**
     * Get anime by genres.
     *
     * @param $anime
     * @param string $sortBy
     * @return mixed
     */
    public function sortBy($anime, $sortBy = '')
    {
        if ($sortBy === 'upcoming') {
            return $anime->where('release_date', '>', Carbon::now()->toDateTimeString());
        } else if ($sortBy === 'latest') {
            return $anime->where('release_date', '<', Carbon::now()->toDateTimeString());
        } else {
            abort(404, $sortBy . " is not a valid value");
        }
    }

    /**
     * @param string $animeSlug
     * @param int $episodeNumber
     * @param string $translation
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getMirrors($animeSlug = '', $episodeNumber = 0, $translation = '')
    {
        $translations = ['all', 'subbed', 'dubbed'];
        if (!in_array($translation, $translations)) {
            // TODO: log current user trying to access unavailable translation...
            abort(404, "Unavailable translation");
        }
        if ($translation === 'all') {
            return $this->anime->with([
                'episode' => function ($query) use ($episodeNumber) {
                    $query->where('number', '=', $episodeNumber)->firstOrFail();
                },
                'episode.mirrors.mirrorSource'
            ])->where('slug', '=', $animeSlug)->firstOrFail();
        } elseif ($translation === 'subbed') {
            return $this->anime->with([
                'episode' => function ($query) use ($episodeNumber) {
                    $query->where('number', '=', $episodeNumber)->firstOrFail();
                },
                'episode.mirrors' => function ($query) {
                    $query->with('mirrorSource')->where('mirrors.translation', '=', 'subbed');
                }
            ])->where('slug', '=', $animeSlug)->firstOrFail();
        } else {
            return $this->anime->with([
                'episode' => function ($query) use ($episodeNumber) {
                    $query->where('number', '=', $episodeNumber)->firstOrFail();
                },
                'episode.mirrors' => function ($query) {
                    $query->with('mirrorSource')->where('mirrors.translation', '=', 'dubbed');
                }
            ])->where('slug', '=', $animeSlug)->firstOrFail();
        }
    }

    /**
     * Get current anime episode mirror by id.
     *
     * @param string $animeSlug
     * @param int $episodeNumber
     * @param string $translation
     * @param string $mirrorID
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getMirror($animeSlug = '', $episodeNumber = 0, $translation = '', $mirrorID = '')
    {
        return $this->anime->with(['episode.mirror'])->whereHas('episode.mirror', function($query) use ($episodeNumber, $translation, $mirrorID) {
            $query->where('mirrors.id', '=', $mirrorID)
                ->where('mirrors.translation', '=', $translation)->where('episodes.number', '=', $episodeNumber);
        })->where('slug', '=', $animeSlug)->firstOrFail();
    }

    /**
     * @return mixed
     */
    public function currentSeason()
    {
        $month = DATE('m');
        $year = DATE('Y');

        // Retrieve season
        if ($month >= '03' && $month <= '06') {
            $season = 'Spring';
        } elseif ($month >= '07' && $month <= '09') {
            $season = 'Summer';
        } elseif ($month >= '10' && $month <= '12') {
            $season = 'Fall';
        } else {
            $season = 'Winter';
        }

        $seasonName = $season . ' '  . $year;
        return $this->getBySeasonName($seasonName);
    }

    /**
     * @param string $seasonName
     * @return mixed
     */
    public function getBySeasonName($seasonName = '')
    {
        return $this->anime->has('episodes')->whereHas('season', function ($query) use ($seasonName) {
            $query->where('seasons.name', '=', $seasonName);
        })->where('release_date', '<', Carbon::now()->toDateTimeString())
            ->orderBy('release_date', 'DESC')->take(4)->get();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function search($query)
    {
        return $this->anime->where('title', 'LIKE', '%'.$query.'%')->orderBy('title', 'ASC')->get();
    }

    /**
     * Get random anime.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRandom()
    {
        return $this->anime->with([
            'classification' => function ($query) {
                $query->select(['id', 'name']);
            }, 'episodes' => function ($query) {
                $query->orderBy('number', 'asc');
            }, 'genres' => function ($query) {
                $query->select(['id', 'name']);
            }, 'producers' => function ($query) {
                $query->select(['id', 'name']);
            }, 'season' => function ($query) {
                $query->select(['id', 'name']);
            }, 'type' => function ($query) {
                $query->select(['id', 'name']);
            }
        ])->whereRaw('RAND()')->firstOrFail();
    }
}
