<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\MirrorSource
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|MirrorSource whereId($value)
 * @method static Builder|MirrorSource whereName($value)
 * @method static Builder|MirrorSource whereCreatedAt($value)
 * @method static Builder|MirrorSource whereUpdatedAt($value)
 * @method static Builder|MirrorSource whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|Mirror[] $mirrors
 */
class MirrorSource extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mirror_sources';

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
        'id'   => 'int',
        'name' => 'string'
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
     * Get mirrors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mirrors()
    {
        return $this->hasMany(Mirror::class, 'mirror_source_id', 'id');
    }
}
