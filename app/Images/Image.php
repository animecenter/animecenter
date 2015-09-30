<?php

namespace AC\Images;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * AC\Images\Image
 *
 * @property integer $id
 * @property string $bigtitle
 * @property string $smalltitle
 * @property string $desc
 * @property string $file
 * @property string $link
 * @property string $date
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereBigtitle($value)
 * @method static Builder|Image whereSmalltitle($value)
 * @method static Builder|Image whereDesc($value)
 * @method static Builder|Image whereFile($value)
 * @method static Builder|Image whereLink($value)
 * @method static Builder|Image whereDate($value)
 */
class Image extends Model
{
    protected $table = 'images';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = ['bigtitle', 'smalltitle', 'content', 'file', 'link', 'date'];

    protected $visible = ['bigtitle', 'smalltitle', 'content', 'file', 'link', 'date'];
}
