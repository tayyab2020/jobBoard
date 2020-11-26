<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saveJob extends Model
{
    protected $table = 'saved_jobs';

    protected $fillable = ['id','job_id','user_id'];



	 public $timestamps = false;

}
