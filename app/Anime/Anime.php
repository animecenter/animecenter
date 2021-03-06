<?php

namespace App\Anime;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Anime\Anime
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Episodes\Episode[] $episodes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Genres\Genre[] $genres
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $age
 * @property string $type2
 * @property string $status
 * @property string $prequel
 * @property string $sequel
 * @property string $story
 * @property string $side_story
 * @property string $spin_off
 * @property string $alternative
 * @property string $other
 * @property string $position
 * @property string $description
 * @property string $alternative_title
 * @property string $image
 * @property float $rating
 * @property integer $votes
 * @property integer $visits
 * @property integer $date
 * @property integer $date2
 * @property string $slug
 * @method static Builder|Anime whereId($value)
 * @method static Builder|Anime whereTitle($value)
 * @method static Builder|Anime whereContent($value)
 * @method static Builder|Anime whereGenres($value)
 * @method static Builder|Anime whereEpisodes($value)
 * @method static Builder|Anime whereType($value)
 * @method static Builder|Anime whereAge($value)
 * @method static Builder|Anime whereType2($value)
 * @method static Builder|Anime whereStatus($value)
 * @method static Builder|Anime wherePrequel($value)
 * @method static Builder|Anime whereSequel($value)
 * @method static Builder|Anime whereStory($value)
 * @method static Builder|Anime whereSideStory($value)
 * @method static Builder|Anime whereSpinOff($value)
 * @method static Builder|Anime whereAlternative($value)
 * @method static Builder|Anime whereOther($value)
 * @method static Builder|Anime wherePosition($value)
 * @method static Builder|Anime whereDescription($value)
 * @method static Builder|Anime whereAlternativeTitle($value)
 * @method static Builder|Anime whereImage($value)
 * @method static Builder|Anime whereRating($value)
 * @method static Builder|Anime whereVotes($value)
 * @method static Builder|Anime whereVisits($value)
 * @method static Builder|Anime whereDate($value)
 * @method static Builder|Anime whereDate2($value)
 * @method static Builder|Anime whereSlug($value)
 */
class Anime extends Model
{
    protected $table = 'animes';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'slug', 'content', 'genres', 'episodes', 'type', 'age', 'type2', 'status', 'prequel', 'sequel',
        'story', 'side_story', 'spin_off', 'alternative', 'other', 'position', 'description', 'alternative_title',
        'image', 'rating', 'votes', 'visits', 'date', 'date2'
    ];

    protected $visible = [
        'title', 'slug', 'content', 'genres', 'episodes', 'type', 'age', 'type2', 'status', 'prequel', 'sequel',
        'story', 'side_story', 'spin_off', 'alternative', 'other', 'position', 'description', 'alternative_title',
        'image', 'rating', 'votes', 'visits', 'date', 'date2'
    ];

    public function episodes()
    {
        return $this->hasMany('App\Episodes\Episode', 'anime_id');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genres\Genre', 'anime_genre', 'anime_id', 'genre_id');
    }
}
