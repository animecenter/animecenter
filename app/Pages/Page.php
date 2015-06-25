<?php

namespace App\Pages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Pages\Page
 *
 * @property integer $id 
 * @property string $title 
 * @property string $content 
 * @property string $link 
 * @property integer $order 
 * @property string $position 
 * @method static \Illuminate\Database\Query\Builder|\App\Pages\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pages\Page whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pages\Page whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pages\Page whereLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pages\Page whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pages\Page wherePosition($value)
 */
class Page extends Model
{
    protected $table = 'pages';

    public $timestamps = false;

//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'content', 'link'];

    protected $visible = ['title', 'content', 'link'];
}
