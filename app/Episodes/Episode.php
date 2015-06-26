<?php

namespace App\Episodes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Episodes\Episode
 *
 * @property integer $id 
 * @property string $title 
 * @property string $subdub 
 * @property integer $show 
 * @property string $not_yeird 
 * @property string $raw 
 * @property string $hd 
 * @property string $mirror1 
 * @property string $mirror2 
 * @property string $mirror3 
 * @property string $mirror4 
 * @property integer $series 
 * @property integer $date 
 * @property integer $date2 
 * @property float $rating 
 * @property integer $votes 
 * @property integer $visits 
 * @property integer $order 
 * @property string $coming_date 
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereSubdub($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereShow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereNotYeird($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereRaw($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereHd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereMirror1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereMirror2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereMirror3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereMirror4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereSeries($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereDate2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereVotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereVisits($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Episodes\Episode whereComingDate($value)
 */
class Episode extends Model
{
    protected $table = 'episodes';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Get the anime that owns the episode.
     */
    public function anime()
    {
        return $this->belongsTo('App\Anime\Anime');
    }

}
