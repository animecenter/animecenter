<?php

namespace App\Episodes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Episodes\Episode
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $subdub
 * @property integer $show
 * @property string $not_yet_aired
 * @property string $raw
 * @property string $hd
 * @property string $mirror1
 * @property string $mirror2
 * @property string $mirror3
 * @property string $mirror4
 * @property integer $anime_id
 * @property integer $date
 * @property integer $date2
 * @property float $rating
 * @property integer $votes
 * @property integer $visits
 * @property integer $order
 * @property string $coming_date
 * @method static Builder|Episode whereId($value)
 * @method static Builder|Episode whereTitle($value)
 * @method static Builder|Episode whereSubdub($value)
 * @method static Builder|Episode whereShow($value)
 * @method static Builder|Episode whereNotYetAired($value)
 * @method static Builder|Episode whereRaw($value)
 * @method static Builder|Episode whereHd($value)
 * @method static Builder|Episode whereMirror1($value)
 * @method static Builder|Episode whereMirror2($value)
 * @method static Builder|Episode whereMirror3($value)
 * @method static Builder|Episode whereMirror4($value)
 * @method static Builder|Episode whereSeries($value)
 * @method static Builder|Episode whereDate($value)
 * @method static Builder|Episode whereDate2($value)
 * @method static Builder|Episode whereRating($value)
 * @method static Builder|Episode whereVotes($value)
 * @method static Builder|Episode whereVisits($value)
 * @method static Builder|Episode whereOrder($value)
 * @method static Builder|Episode whereComingDate($value)
 * @property-read \App\Anime\Anime $anime
 * @method static Builder|Episode whereAnimeId($value)
 * @method static Builder|Episode whereSlug($value)
 */
class Episode extends Model
{
    protected $table = 'episodes';

    public $timestamps = false;

    protected $fillable = [
        'title', 'slug', 'subdub', 'show', 'not_yet_aired', 'raw', 'hd', 'mirror1', 'mirror2', 'mirror3', 'mirror4',
        'anime_id', 'date', 'date2', 'rating', 'votes', 'visits', 'order', 'coming_date'
    ];

    protected $visible = [
        'title', 'slug', 'subdub', 'show', 'not_yet_aired', 'raw', 'hd', 'mirror1', 'mirror2', 'mirror3', 'mirror4',
        'anime_id', 'date', 'date2', 'rating', 'votes', 'visits', 'order', 'coming_date'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the anime that owns the episode.
     */
    public function anime()
    {
        return $this->belongsTo('App\Anime\Anime');
    }
}
