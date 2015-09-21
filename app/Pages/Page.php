<?php

namespace App\Pages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Pages\Page
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $link
 * @property integer $order
 * @property string $position
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereTitle($value)
 * @method static Builder|Page whereContent($value)
 * @method static Builder|Page whereLink($value)
 * @method static Builder|Page whereOrder($value)
 * @method static Builder|Page wherePosition($value)
 */
class Page extends Model
{
    protected $table = 'pages';

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'content', 'link'];

    protected $visible = ['title', 'content', 'link'];
}
