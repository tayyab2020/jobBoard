<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{

    protected $table = 'jobs';

    protected $fillable = ['user_id','job_name','job_type','job_purpose','sale_price','rent_price','address','map_latitude','map_longitude','bathrooms','bedrooms','area','description','job_image','views'];

	public function scopeSearchByKeyword($query,$type,$keyword)
    {
        $query->where(function ($query) use ($type,$keyword) {
            if($keyword && $type){
                $query->where("job_type", "$type")
                    ->where("is_expired",'0')
                    ->where("job_name",'LIKE', "%$keyword%")
                    ->where("job_slug",'LIKE', "%$keyword%")
                    ->orWhere("keywords",'LIKE', "%$keyword%");
            }
            elseif(!$keyword && $type){
                $query->where("job_type", "$type")
                    ->where("is_expired",'0');
            }
            elseif(!$type && $keyword){
                $query->where("is_expired",'0')
                    ->where("job_name",'LIKE', "%$keyword%")
                    ->orWhere("keywords",'LIKE', "%$keyword%");
            }
            else{
                $query->where("is_expired",'0');
            }
        });
        return $query;
    }

    protected static function boot()
    {
        parent::boot();
        static::retrieved(function ($model) {});
    }

}
