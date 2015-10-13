<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\Episode
 *
 * @property integer $id
 * @property integer $anime_id
 * @property float $number
 * @property string $name
 * @property string $synopsis
 * @property boolean $active
 * @property \Carbon\Carbon $aired_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Anime $anime
 * @method static Builder|Episode whereId($value)
 * @method static Builder|Episode whereAnimeId($value)
 * @method static Builder|Episode whereNumber($value)
 * @method static Builder|Episode whereName($value)
 * @method static Builder|Episode whereSynopsis($value)
 * @method static Builder|Episode whereActive($value)
 * @method static Builder|Episode whereAiredAt($value)
 * @method static Builder|Episode whereCreatedAt($value)
 * @method static Builder|Episode whereUpdatedAt($value)
 * @method static Builder|Episode whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|Mirror[] $mirrors
 * @property-read \Illuminate\Database\Eloquent\Collection|View[] $views
 * @property-read \Illuminate\Database\Eloquent\Collection|Vote[] $votes
 */
class Episode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'episodes';

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
    protected $dates = ['aired_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'   => 'int',
        'anime_id' => 'int',
        'number' => 'float',
        'name' => 'string',
        'synopsis' => 'string',
        'active' => 'boolean'
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1'
    ];

    /**
     * Get anime that owns the episode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anime()
    {
        return $this->belongsTo(Anime::class, 'anime_id', 'id');
    }

    /**
     * Get mirror that belong to the episode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mirror()
    {
        return $this->hasOne(Mirror::class, 'episode_id', 'id');
    }

    /**
     * Get mirrors that belong to the episode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mirrors()
    {
        return $this->hasMany(Mirror::class, 'episode_id', 'id');
    }

    /**
     * Get views that belong to the episode.
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
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function getSlugAttribute()
    {
        return 'episode/' . $this->number;
    }
}
