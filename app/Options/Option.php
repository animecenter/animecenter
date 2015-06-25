<?php

namespace App\Options;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    protected $table = 'options';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('value');
    protected $visible = array('value');
}
