<?php

namespace App\Images;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Images\Image
 *
 * @property integer $id 
 * @property string $bigtitle 
 * @property string $smalltitle 
 * @property string $desc 
 * @property string $file 
 * @property string $link 
 * @property string $date 
 * @method static \Illuminate\Database\Query\Builder|\App\Images\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Images\Image whereBigtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Images\Image whereSmalltitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Images\Image whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Images\Image whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Images\Image whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Images\Image whereDate($value)
 */
class Image extends Model
{
    protected $table = 'images';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['bigtitle', 'smalltitle', 'content', 'file', 'link', 'date'];

    protected $visible = ['bigtitle', 'smalltitle', 'content', 'file', 'link', 'date'];
}
