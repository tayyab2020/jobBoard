<?php
use App\Settings;
use App\User;
use App\Jobs;
use App\Types;


if (! function_exists('getcong')) {

    function getcong($key)
    {

        $settings = Settings::findOrFail('1');

        return $settings->$key;
    }
}

if (!function_exists('classActivePath')) {
    function classActivePath($path)
    {
        $path = explode('.', $path);
        $segment = 2;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if (!function_exists('classActivePathPublic')) {
    function classActivePathPublic($path)
    {
        $path = explode('.', $path);
        $segment = 1;
        foreach($path as $p) {
            if((request()->segment($segment) == $p) == false) {
                return '';
            }
            $segment++;
        }
        return ' active';
    }
}

if (! function_exists('getUserInfo')) {
	function getUserInfo($id)
	{
		return User::find($id);
	}
}

if (! function_exists('countJobType')) {
	function countJobType($type_id)
	{
		return Jobs::where('job_type',$type_id)->count();
	}
}

if (! function_exists('JobTypeName')) {
	function getJobTypeName($id)
	{
		return Types::find($id);
	}
}
