<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Models\MirrorReport
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $mirror_id
 * @property boolean $verified
 * @property boolean $broken
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static Builder|MirrorReport whereId($value)
 * @method static Builder|MirrorReport whereUserId($value)
 * @method static Builder|MirrorReport whereMirrorId($value)
 * @method static Builder|MirrorReport whereVerified($value)
 * @method static Builder|MirrorReport whereBroken($value)
 * @method static Builder|MirrorReport whereCreatedAt($value)
 * @method static Builder|MirrorReport whereUpdatedAt($value)
 * @method static Builder|MirrorReport whereDeletedAt($value)
 * @property-read Mirror $mirror
 * @property-read User $user
 */
class MirrorReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mirror_reports';

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
        'id'        => 'int',
        'user_id'   => 'int',
        'mirror_id' => 'int',
        'verified'  => 'boolean',
        'broken'    => 'boolean'
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
     * Get mirror.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mirror()
    {
        return $this->belongsTo(Mirror::class, 'id', 'mirror_id');
    }

    /**
     * Get user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
