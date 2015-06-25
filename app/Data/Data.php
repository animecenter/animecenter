<?php

namespace App\Datas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
    protected $table = 'datas';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('s_add', 's_edit', 'e_add', 'e_edit');
    protected $visible = array('s_add', 's_edit', 'e_add', 'e_edit');
}
