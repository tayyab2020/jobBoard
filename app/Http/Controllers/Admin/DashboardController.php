<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Jobs;
use App\Enquire;
use App\Partners;
use App\Subscriber;
use App\applicationTip;

use App\Http\Requests;
use Illuminate\Http\Request;


class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

    }
    public function index()
    {
    	if(Auth::user()->usertype=='Admin')
    	{
			$jobs_count = Jobs::count();

			$publish_jobs = Jobs::where('status','1')->count();

	    	$unpublish_jobs = Jobs::where('status','0')->count();

	    	$urgent_jobs = Jobs::where('urgent', 'on')->count();
	    	$inquiries = Enquire::count();

	    	$agents = User::where('usertype', 'employer')->count();

	    	$testimonials = applicationTip::count();

	    	$subscriber = Subscriber::count();

	    	$partners = Partners::count();

	    	return view('admin.pages.dashboard',compact('jobs_count','urgent_jobs','inquiries','agents','testimonials','subscriber','partners','publish_jobs','unpublish_jobs'));

		}
		else
		{
			$user_id=Auth::user()->id;

	    	$jobs_count = Jobs::where(['user_id' => $user_id])->count();

	    	$publish_jobs = Jobs::where(['user_id' => $user_id,'status' => '1'])->count();

	    	$unpublish_jobs = Jobs::where(['user_id' => $user_id,'status' => '0'])->count();

	    	$inquiries = Enquire::where(['agent_id' => $user_id])->count();

			return view('admin.pages.dashboard',compact('jobs_count','inquiries','publish_jobs','unpublish_jobs'));
		}



    }



}
