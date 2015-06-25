<?php

namespace App\Images;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    protected $table = 'images';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('bigtitle', 'smalltitle', 'content', 'file', 'link', 'date');
    protected $visible = array('bigtitle', 'smalltitle', 'content', 'file', 'link', 'date');
}
