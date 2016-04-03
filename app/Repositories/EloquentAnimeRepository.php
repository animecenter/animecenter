<?php

namespace AC\Repositories;

use AC\Models\Anime;
use AC\Repositories\EloquentUserRepository as User;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EloquentAnimeRepository
{
    /**
     * @var Anime
     */
    private $anime;

    /**
     * @var EloquentUserRepository
     */
    private $user;

    /**
     * @param Anime $anime
     * @param User  $user
     */
    public function __construct(Anime $anime, User $user)
    {
        $this->anime = $anime;
        $this->user = $user;
    }

    /**
     * Get all animes that have episodes.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->anime->has('episodes');
    }

    public function latest()
    {
        return $this->all()->where('release_date', '<', Carbon::now()->toDateTimeString())
            ->orderBy('animes.release_date', 'DESC')->take(10)->get();
    }

    /**
     * Get anime by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBySlug($slug = '')
    {
        // TODO: Update number of views
        $this->updateViews($slug);

        return $this->anime->with([
            'classification' => function ($query) {
                $query->select(['id', 'name']);
            }, 'episodes' => function ($query) {
                $query->orderBy('number', 'asc');
            }, 'genres' => function ($query) {
                $query->select(['id', 'name']);
            }, 'producers' => function ($query) {
                $query->select(['id', 'name']);
            }, 'calendarSeason' => function ($query) {
                $query->select(['id', 'name']);
            }, 'type' => function ($query) {
                $query->select(['id', 'name']);
            },
        ])->where('slug', '=', $slug)->firstOrFail();
    }

    /**
     * @param array $parameters
     * @param Request $request
     *
     * @return mixed
     */
    public function searchBy($parameters = [], Request $request)
    {
        $timestamp = Carbon::now()->toDateTimeString();
        $anime = $this->all();
        if (!$parameters) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->orderBy('id', 'DESC')->paginate(20);
        }
        if ($request->has('alphabetical')) {
            $anime = $this->getByLetter($anime, $parameters['alphabetical']);
        }
        if ($request->has('language')) {
            $anime = $this->getByLanguage($anime, $parameters['language']);
        }
        if ($request->has('type')) {
            $anime = $this->getByType($anime, $parameters['type']);
        }
        if ($request->has('calendarSeason')) {
            $anime = $this->getByCalendarSeason($anime, $parameters['calendarSeason']);
        }
        if ($request->has('year')) {
            $anime = $this->getByYear($anime, $parameters['year']);
        }
        if ($request->has('genres')) {
            $anime = $this->getByGenres($anime, explode(',', $parameters['genres']));
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
     *
     * @return mixed
     */
    public function getByLetter($anime, $letter = '')
    {
        if (!$letter === '0-9') {
            return $anime->whereRaw("title NOT REGEXP '^[[:alpha:]]'");
        }
        if (preg_match('/^([a-z])$/', $letter) === 1) {
            return $anime->where('title', 'like', $letter.'%');
        }
        if ($letter === 'all') {
            return $anime;
        }
        abort(404, $letter.' was not found');
    }

    /**
     * Get anime by language.
     *
     * @param $anime
     * @param string $language
     *
     * @return mixed
     */
    public function getByLanguage($anime, $language = '')
    {
        if ($language === 'subbed') {
            return $anime->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'subbed');
            });
        }
        if ($language === 'dubbed') {
            return $anime->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'dubbed');
            });
        }
        abort(404, $language.' was not found');
    }

    /**
     * Get anime by type.
     *
     * @param $anime
     * @param int $id
     *
     * @return mixed
     */
    public function getByType($anime, $id = 0)
    {
        return $anime->whereHas('type', function ($query) use ($id) {
            $query->where('types.id', '=', $id);
        });
    }

    /**
     * Get anime by calendar season.
     *
     * @param $anime
     * @param int $id
     *
     * @return mixed
     */
    public function getByCalendarSeason($anime, $id = 0)
    {
        return $anime->whereHas('calendarSeason', function ($query) use ($id) {
            $query->where('calendar_seasons.id', '=', $id);
        });
    }

    /**
     * Get anime by Year.
     *
     * @param $anime
     * @param int $id
     *
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
     *
     * @return mixed
     */
    public function getByGenres($anime, $genres = [])
    {
        return $anime->whereHas('genres', function ($query) use ($genres) {
            foreach ($genres as $genre) {
                $query->where('genres.id', $genre);
            }
        })->get();
    }

    /**
     * Get anime by producer.
     *
     * @param $anime
     * @param int $id
     *
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
     *
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
     *
     * @return mixed
     */
    public function sortBy($anime, $sortBy = '')
    {
        if ($sortBy === 'upcoming') {
            return $anime->where('release_date', '>', Carbon::now()->toDateTimeString());
        }
        if ($sortBy === 'latest') {
            return $anime->where('release_date', '<', Carbon::now()->toDateTimeString());
        }
        abort(404, $sortBy.' is not a valid value');
    }

    /**
     * @param string $animeSlug
     * @param int    $episodeNumber
     * @param string $translation
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getMirrors($animeSlug = '', $episodeNumber = 0, $translation = '')
    {
        $translations = ['all', 'subbed', 'dubbed'];
        if (!in_array($translation, $translations)) {
            // TODO: log current user trying to access unavailable translation...
            abort(404, 'Unavailable translation');
        }
        if ($translation === 'all') {
            return $this->anime->with([
                'episode' => function ($query) use ($episodeNumber) {
                    $query->where('number', '=', $episodeNumber)->firstOrFail();
                },
                'episode.mirrors.mirrorSource',
            ])->where('slug', '=', $animeSlug)->firstOrFail();
        }
        if ($translation === 'subbed') {
            return $this->anime->has('episode.mirrors.mirrorSource')->with([
                'episode' => function ($query) use ($episodeNumber) {
                    $query->where('episodes.number', '=', $episodeNumber)->firstOrFail();
                },
                'episode.mirrors' => function ($query) {
                    $query->with(['mirrorSource' => function($query) {
                        $query->orderBy('mirror_sources.id', 'ASC');
                    }])->where('mirrors.translation', '=', 'subbed');
                },
            ])->where('slug', '=', $animeSlug)->firstOrFail();
        }
        return $this->anime->with([
            'episode' => function ($query) use ($episodeNumber) {
                $query->where('number', '=', $episodeNumber)->firstOrFail();
            },
            'episode.mirrors' => function ($query) {
                $query->with(['mirrorSource' => function($query) {
                    $query->orderBy('mirror_sources.id', 'ASC');
                }])->where('mirrors.translation', '=', 'dubbed');
            },
        ])->where('slug', '=', $animeSlug)->firstOrFail();
    }

    /**
     * Get current anime episode mirror by id.
     *
     * @param string $animeSlug
     * @param int    $episodeNumber
     * @param string $translation
     * @param string $mirrorID
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getMirror($animeSlug = '', $episodeNumber = 0, $translation = '', $mirrorID = '')
    {
        return $this->anime->with(['episode.mirror'])->whereHas('episode.mirror', function ($query) use ($episodeNumber, $translation, $mirrorID) {
            $query->where('mirrors.id', '=', $mirrorID)
                ->where('mirrors.translation', '=', $translation)->where('episodes.number', '=', $episodeNumber);
        })->where('slug', '=', $animeSlug)->firstOrFail();
    }

    /**
     * @return mixed
     */
    public function currentCalendarSeason()
    {
        $month = DATE('m');
        $year = DATE('Y');

        // Retrieve calendar season
        if ($month >= '03' && $month <= '06') {
            $calendarSeason = 'Spring';
        } elseif ($month >= '07' && $month <= '09') {
            $calendarSeason = 'Summer';
        } elseif ($month >= '10' && $month <= '12') {
            $calendarSeason = 'Fall';
        } else {
            $calendarSeason = 'Winter';
        }

        return $this->getByCalendarSeasonName($calendarSeason);
    }

    /**
     * @param string $seasonName
     *
     * @return mixed
     */
    public function getByCalendarSeasonName($seasonName = '')
    {
        return $this->anime->has('episodes')->where('calendar_season_id', '=', $seasonName)
            ->orderBy('animes.release_date', 'DESC')->take(8)->get();
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function search($query)
    {
        return $this->anime->where('title', 'LIKE', '%'.$query.'%')->orderBy('title', 'ASC')->get();
    }

    /**
     * Get random anime.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function getRandom()
    {
        return redirect()->to($this->anime->orderByRaw('RAND()')->firstOrFail(['slug'])->slug);
    }

    /**
     * Update number of anime views by slug.
     *
     * @param string $slug
     */
    public function updateViews($slug = '')
    {
        $userID = $this->user->getCurrentUserID();
        $minutes = 1440;
        if ($userID) {
            Cache::remember($userID.'/'.$slug, $minutes, function () use ($slug) {
                $this->anime->where('slug', '=', $slug)->increment('views');
            });
        }
    }
}
