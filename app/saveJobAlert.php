<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saveJobAlert extends Model
{
    protected $table = 'saved_job_alerts';

    protected $fillable = ['id','user_email'];

	 public $timestamps = false;

}
