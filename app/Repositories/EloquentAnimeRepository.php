<?php

namespace AC\Repositories;

use AC\Models\Anime;
use Carbon\Carbon;

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
     * Get anime by letter.
     *
     * @param string $letter
     * @return mixed
     */
    public function getAllByLetter($letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->orderBy('id', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")->orderBy('id', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->where('title', 'like', $letter.'%')->orderBy('id', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get latest anime by letter.
     *
     * @param string $letter
     * @return mixed
     */
    public function getLatestByLetter($letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->where('title', 'like', $letter.'%')->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get subbed anime by letter.
     *
     * @param string $letter
     * @return mixed
     */
    public function getSubbedByLetter($letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'Subbed');
            })->where('release_date', '<', $timestamp)->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'Subbed');
            })->where('release_date', '<', $timestamp)->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'Subbed');
            })->where('release_date', '<', $timestamp)->where('title', 'like', $letter.'%')
                ->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get dubbed anime by letter.
     *
     * @param string $letter
     * @return mixed
     */
    public function getDubbedByLetter($letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'Dubbed');
            })->where('release_date', '<', $timestamp)->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'Dubbed');
            })->where('release_date', '<', $timestamp)->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->whereHas('episodes.mirrors', function ($query) {
                $query->where('mirrors.translation', '=', 'Dubbed');
            })->where('release_date', '<', $timestamp)->where('title', 'like', $letter.'%')
                ->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get anime by producer id and letter.
     *
     * @param int $id
     * @param string $letter
     * @return mixed
     */
    public function getByProducerAndLetter($id = 0, $letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->whereHas('producers', function ($query) use ($id) {
                $query->where('producers.id', '=', $id);
            })->where('release_date', '<', $timestamp)->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->whereHas('producers', function ($query) use ($id) {
                $query->where('producers.id', '=', $id);
            })->where('release_date', '<', $timestamp)->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->whereHas('producers', function ($query) use ($id) {
                $query->where('producers.id', '=', $id);
            })->where('release_date', '<', $timestamp)->where('title', 'like', $letter.'%')
                ->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get anime by genre id and letter.
     *
     * @param int $id
     * @param string $letter
     * @return mixed
     */
    public function getByGenreAndLetter($id = 0, $letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->whereHas('genres', function ($query) use ($id) {
                $query->where('genres.id', '=', $id);
            })->where('release_date', '<', $timestamp)->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->whereHas('genres', function ($query) use ($id) {
                $query->where('genres.id', '=', $id);
            })->where('release_date', '<', $timestamp)->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->whereHas('genres', function ($query) use ($id) {
                $query->where('genres.id', '=', $id);
            })->where('release_date', '<', $timestamp)->where('title', 'like', $letter.'%')
                ->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get anime by type id and letter.
     *
     * @param int $id
     * @param string $letter
     * @return mixed
     */
    public function getByTypeAndLetter($id = 0, $letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->whereHas('type', function ($query) use ($id) {
                $query->where('types.id', '=', $id);
            })->where('release_date', '<', $timestamp)->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->whereHas('type', function ($query) use ($id) {
                $query->where('types.id', '=', $id);
            })->where('release_date', '<', $timestamp)->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->whereHas('type', function ($query) use ($id) {
                $query->where('types.id', '=', $id);
            })->where('release_date', '<', $timestamp)->where('title', 'like', $letter.'%')
                ->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get anime by classification id and letter.
     *
     * @param int $id
     * @param string $letter
     * @return mixed
     */
    public function getByClassificationAndLetter($id = 0, $letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->whereHas('classification', function ($query) use ($id) {
                $query->where('classifications.id', '=', $id);
            })->where('release_date', '<', $timestamp)->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->whereHas('classification', function ($query) use ($id) {
                $query->where('classifications.id', '=', $id);
            })->where('release_date', '<', $timestamp)->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->whereHas('classification', function ($query) use ($id) {
                $query->where('classifications.id', '=', $id);
            })->where('release_date', '<', $timestamp)->where('title', 'like', $letter.'%')
                ->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get anime by classification id and letter.
     *
     * @param int $id
     * @param string $letter
     * @return mixed
     */
    public function getBySeasonAndLetter($id = 0, $letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->whereHas('season', function ($query) use ($id) {
                $query->where('seasons.id', '=', $id);
            })->where('release_date', '<', $timestamp)->orderBy('release_date', 'DESC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->whereHas('season', function ($query) use ($id) {
                $query->where('seasons.id', '=', $id);
            })->where('release_date', '<', $timestamp)->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('release_date', 'DESC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->whereHas('season', function ($query) use ($id) {
                $query->where('seasons.id', '=', $id);
            })->where('release_date', '<', $timestamp)->where('title', 'like', $letter.'%')
                ->orderBy('release_date', 'DESC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * @param string $animeSlug
     * @param int $episodeNumber
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getMirrors($animeSlug = '', $episodeNumber = 0)
    {
        return $this->anime->with([
            'episode' => function ($query) use ($episodeNumber) {
                $query->where('number', '=', $episodeNumber)->firstOrFail();
            },
            'episode.mirrors.mirrorSource'
        ])->where('slug', '=', $animeSlug)->firstOrFail();
    }

    public function currentSeason()
    {
        $month = DATE('m');
        $year = DATE('Y');

        // Retrieve season
        if ($month >= '03' && $month <= '06') {
            $season = 'Spring';
        } else if ($month >= '07' && $month <= '09') {
            $season = 'Summer';
        } else if ($month >= '10' && $month <= '12') {
            $season = 'Fall';
        } else {
            $season = 'Winter';
        }

        $seasonName = $season . ' '  . $year;
        return $this->getBySeason($seasonName);
    }

    public function getBySeason($seasonName = '')
    {
        return $this->anime->has('episodes')->whereHas('season', function ($query) use ($seasonName) {
            $query->where('seasons.name', '=', $seasonName);
        })->where('release_date', '<', Carbon::now()->toDateTimeString())
            ->orderBy('release_date', 'DESC')->take(12)->get();
    }
}
