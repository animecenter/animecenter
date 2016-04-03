<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\MirrorSource.
 *
 * @property int $id
 * @property string $name
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Mirror[] $mirrors
 *
 * @method static \Illuminate\Database\Query\Builder|MirrorSource whereId($value)
 * @method static \Illuminate\Database\Query\Builder|MirrorSource whereName($value)
 * @method static \Illuminate\Database\Query\Builder|MirrorSource whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|MirrorSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|MirrorSource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|MirrorSource whereDeletedAt($value)
 */
class MirrorSource extends Model
{
    use SoftDeletes;

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
     * Get mirrors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mirrors()
    {
        return $this->hasMany(Mirror::class, 'mirror_source_id', 'id');
    }
}
