<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Jobs;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class urgentJobsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function jobslist()
    {
    	$jobslist = Jobs::where('urgent','on')->orderBy('id')->get();

        return view('admin.pages.urgentjob',compact('jobslist'));
    }

}
