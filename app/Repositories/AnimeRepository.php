<?php

namespace AC\Repositories;

use AC\Models\Anime;
use Carbon\Carbon;

class AnimeRepository
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
     * Get all animes.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->anime->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString())
            ->orderBy('id', 'DESC')->paginate(20);
    }

    public function latest()
    {
        return $this->anime->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString())
            ->orderBy('release_date', 'DESC')->paginate(20);
    }

    /**
     * @param string $letter
     * @return mixed
     */
    public function getAllByLetter($letter = '')
    {
        $timestamp = Carbon::now()->toDateTimeString();
        if (!$letter) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->where('title', 'like', 'a%')->orderBy('title', 'ASC')->paginate(20);
        } elseif ($letter === '0-9') {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")->orderBy('title', 'ASC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            return $this->anime->has('episodes')->where('release_date', '<', $timestamp)
                ->where('title', 'like', $letter.'%')->orderBy('title', 'ASC')->paginate(20);
        } else {
            abort(404, $letter . ' was not found');
        }
    }

    /**
     * Get all animes by producer id.
     *
     * @param int $id
     * @return mixed
     */
    public function getByProducer($id = 0)
    {
        return $this->anime->has('episodes')->whereHas(
            'producers', function ($query) use ($id) {
                $query->where('producers.id', '=', $id);
            }
        )->where('release_date', '<', Carbon::now()->toDateTimeString())
            ->orderBy('release_date', 'DESC')->paginate(20);
    }

    /**
     * Get all animes by genre id.
     *
     * @param int $id
     * @return mixed
     */
    public function getByGenre($id = 0)
    {
        return $this->anime->has('episodes')->whereHas(
            'genres', function ($query) use ($id) {
                $query->where('genres.id', '=', $id);
            }
        )->where('release_date', '<', Carbon::now()->toDateTimeString())
            ->orderBy('release_date', 'DESC')->paginate(20);
    }
}