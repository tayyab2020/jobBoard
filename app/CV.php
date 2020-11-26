<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    protected $table = 'cv';

    protected $fillable = ['id','name','userId'];
    public $timestamps = true;

}
