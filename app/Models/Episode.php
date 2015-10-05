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
 * @property boolean $status
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
 * @method static Builder|Episode whereStatus($value)
 * @method static Builder|Episode whereAiredAt($value)
 * @method static Builder|Episode whereCreatedAt($value)
 * @method static Builder|Episode whereUpdatedAt($value)
 * @method static Builder|Episode whereDeletedAt($value)
 * @property boolean $active
 * @method static \Illuminate\Database\Query\Builder|\AC\Models\Episode whereActive($value)
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
        'status' => 'boolean'
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
     * Get the anime that owns the episode.
     */
    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
