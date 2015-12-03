<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Anime.
 *
 * @property int $id
 * @property int $mal_id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $synopsis
 * @property int $type_id
 * @property int $number_of_episodes
 * @property int $status_id
 * @property string $release_date
 * @property string $end_date
 * @property string $duration
 * @property int $calendar_season_id
 * @property int $classification_id
 * @property float $rating
 * @property \Illuminate\Database\Eloquent\Collection|View[] $views
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Classification $classification
 * @property-read Episode $episode
 * @property-read \Illuminate\Database\Eloquent\Collection|Episode[] $episodes
 * @property-read \Illuminate\Database\Eloquent\Collection|Genre[] $genres
 * @property-read \Illuminate\Database\Eloquent\Collection|Producer[] $producers
 * @property-read \Illuminate\Database\Eloquent\Collection|Relation[] $relations
 * @property-read CalendarSeason $calendarSeason
 * @property-read \Illuminate\Database\Eloquent\Collection|Title[] $titles
 * @property-read Type $type
 * @property-read \Illuminate\Database\Eloquent\Collection|Vote[] $votes
 * @property-read mixed $photo
 * @property-read mixed $short_title
 *
 * @method static Builder|Anime whereId($value)
 * @method static Builder|Anime whereMalId($value)
 * @method static Builder|Anime whereTitle($value)
 * @method static Builder|Anime whereSlug($value)
 * @method static Builder|Anime whereImage($value)
 * @method static Builder|Anime whereSynopsis($value)
 * @method static Builder|Anime whereTypeId($value)
 * @method static Builder|Anime whereNumberOfEpisodes($value)
 * @method static Builder|Anime whereStatusId($value)
 * @method static Builder|Anime whereReleaseDate($value)
 * @method static Builder|Anime whereEndDate($value)
 * @method static Builder|Anime whereDuration($value)
 * @method static Builder|Anime whereCalendarSeasonId($value)
 * @method static Builder|Anime whereClassificationId($value)
 * @method static Builder|Anime whereRating($value)
 * @method static Builder|Anime whereViews($value)
 * @method static Builder|Anime whereActive($value)
 * @method static Builder|Anime whereCreatedAt($value)
 * @method static Builder|Anime whereUpdatedAt($value)
 * @method static Builder|Anime whereDeletedAt($value)
 */
class Anime extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'animes';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var string[]
     */
    protected $hidden = [''];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'                 => 'int',
        'mal_id'             => 'int',
        'title'              => 'string',
        'slug'               => 'string',
        'image'              => 'string',
        'synopsis'           => 'string',
        'type_id'            => 'int',
        'episodes'           => 'int',
        'status_id'          => 'int',
        'release_date'       => 'string',
        'end_date'           => 'string',
        'duration'           => 'string',
        'calendar_season_id' => 'int',
        'classification_id'  => 'int',
        'active'             => 'boolean',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1',
    ];

    /**
     * Get classification.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classification()
    {
        return $this->belongsTo(Classification::class, 'classification_id', 'id');
    }

    /**
     * Get episode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function episode()
    {
        return $this->hasOne(Episode::class, 'anime_id');
    }

    /**
     * Get episodes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function episodes()
    {
        return $this->hasMany(Episode::class, 'anime_id');
    }

    /**
     * Get genres.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'anime_genre', 'anime_id', 'genre_id');
    }

    /**
     * Get image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'images');
    }

    /**
     * Get producers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function producers()
    {
        return $this->belongsToMany(Producer::class, 'anime_producer', 'anime_id', 'producer_id');
    }

    /**
     * Get relations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function relations()
    {
        return $this->morphMany(Relation::class, 'relations');
    }

    /**
     * Get calendar season.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function calendarSeason()
    {
        return $this->belongsTo(CalendarSeason::class, 'calendar_season_id', 'id');
    }

    /**
     * Get titles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function titles()
    {
        return $this->morphMany(Title::class, 'titles');
    }

    /**
     * Get type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    /**
     * Get views.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function views()
    {
        return $this->morphMany(View::class, 'viewable');
    }

    /**
     * Get votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votes');
    }

    /**
     * Get the anime's duration.
     *
     * @param string $value
     *
     * @return string
     */
    public function getDurationAttribute($value)
    {
        if (!$value) {
            return 'Unknown';
        }
        $value = explode(':', $value);
        $hours = str_replace([0], '', $value[0]);
        $minutes = str_replace([0], '', $value[1]);
        $secs = str_replace([0], '', $value[2]);

        return ($hours ? $hours.' hr. ' : '').($minutes ? $minutes.' min. per episode' : '');
    }

    /**
     * Get number of episodes attribute.
     *
     * @param $value
     *
     * @return string
     */
    public function getNumberOfEpisodesAttribute($value)
    {
        return $value ? $value : 'Unknown';
    }

    public function getSlugAttribute($value)
    {
        return 'anime/watch/'.$value;
    }

    public function getPhotoAttribute()
    {
        return $this->image ? $this->image : 'https://placehold.it/225x320';
    }

    public function getShortTitleAttribute()
    {
        return (strlen($this->title) > 18) ? mb_substr($this->title, 0, 15).'...' : $this->title;
    }
}
