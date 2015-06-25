<?php

namespace App\Episodes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    protected $table = 'episodes';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
