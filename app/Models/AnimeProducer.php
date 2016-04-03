<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AC\Models\AnimeProducer.
 *
 * @property int $id
 * @property int $anime_id
 * @property int $producer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|AnimeProducer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeProducer whereAnimeId($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeProducer whereProducerId($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeProducer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeProducer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|AnimeProducer whereDeletedAt($value)
 */
class AnimeProducer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime_producer';

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
        'anime_id'    => 'int',
        'producer_id' => 'int',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'id' => 'required|integer|min:1',
    ];
}
