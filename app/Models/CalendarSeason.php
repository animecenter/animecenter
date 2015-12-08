<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\CalendarSeason.
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Anime[] $animes
 *
 * @method static \Illuminate\Database\Query\Builder|CalendarSeason whereId($value)
 * @method static \Illuminate\Database\Query\Builder|CalendarSeason whereName($value)
 * @method static \Illuminate\Database\Query\Builder|CalendarSeason whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|CalendarSeason whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CalendarSeason whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CalendarSeason whereDeletedAt($value)
 */
class CalendarSeason extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calendar_seasons';

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
        'id'     => 'int',
        'name'   => 'string',
        'active' => 'boolean',
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
     * Get animes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function animes()
    {
        return $this->hasMany(Anime::class, 'calendar_season_id', 'id');
    }
}
