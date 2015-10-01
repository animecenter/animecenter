<?php

namespace AC\Anime;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Anime\Anime
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\AC\Episodes\Episode[] $episodes
 * @property-read \Illuminate\Database\Eloquent\Collection|\AC\Genres\Genre[] $genres
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $age
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
 * @property integer $mal_id
 * @property string $synopsis
 * @property integer $type_id
 * @property string $release_date
 * @property string $end_date
 * @property string $duration
 * @property integer $season_id
 * @property integer $classification_id
 * @property string $created_at
 * @property string $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|Anime whereMalId($value)
 * @method static Builder|Anime whereSynopsis($value)
 * @method static Builder|Anime whereTypeId($value)
 * @method static Builder|Anime whereReleaseDate($value)
 * @method static Builder|Anime whereEndDate($value)
 * @method static Builder|Anime whereDuration($value)
 * @method static Builder|Anime whereSeasonId($value)
 * @method static Builder|Anime whereClassificationId($value)
 * @method static Builder|Anime whereCreatedAt($value)
 * @method static Builder|Anime whereUpdatedAt($value)
 * @method static Builder|Anime whereDeletedAt($value)
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
        return $this->hasMany('AC\Episodes\Episode', 'anime_id');
    }

    public function genres()
    {
        return $this->belongsToMany('AC\Genres\Genre', 'anime_genre', 'anime_id', 'genre_id');
    }
}
