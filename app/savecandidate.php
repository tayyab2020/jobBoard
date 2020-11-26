<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class savecandidate extends Model
{
    protected $table = 'saved_candidates';

    protected $fillable = ['id','candidate_id','user_id'];
	 public $timestamps = true;

}
