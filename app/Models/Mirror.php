<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * AC\Models\Mirror.
 *
 * @property int $id
 * @property int $user_id
 * @property int $episode_id
 * @property int $mirror_source_id
 * @property int $language_id
 * @property string $url
 * @property string $translation
 * @property string $quality
 * @property bool $mobile_friendly
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read Episode $episode
 * @property-read MirrorSource $mirrorSource
 * @property-read \Illuminate\Database\Eloquent\Collection|MirrorReport[] $mirrorReports
 * @property-read mixed $slug
 *
 * @method static \Illuminate\Database\Query\Builder|Mirror whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereEpisodeId($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereMirrorSourceId($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereLanguageId($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereTranslation($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereQuality($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereMobileFriendly($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Mirror whereDeletedAt($value)
 */
class Mirror extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mirrors';

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
        'id'               => 'int',
        'user_id'          => 'int',
        'episode_id'       => 'int',
        'mirror_source_id' => 'int',
        'language_id'      => 'int',
        'url'              => 'string',
        'translation'      => 'string',
        'quality'          => 'string',
        'mobile_friendly'  => 'boolean',
        'active'           => 'boolean',
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
     * Get episode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function episode()
    {
        return $this->belongsTo(Episode::class, 'id', 'episode_id');
    }

    /**
     * Get mirror source.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mirrorSource()
    {
        return $this->belongsTo(MirrorSource::class, 'mirror_source_id', 'id');
    }

    /**
     * Get mirror reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mirrorReports()
    {
        return $this->hasMany(MirrorReport::class, 'mirror_id', 'id');
    }

    public function getSlugAttribute()
    {
        return strtolower($this->translation).'/'.$this->id;
    }
}
