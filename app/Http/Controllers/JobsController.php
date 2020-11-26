<?php

namespace App\Http\Controllers;

use App\City;
use App\User;
use App\Jobs;
use App\Enquire;
use App\Types;
use DateTime;
use DateTimeZone;
use Mail;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobsController extends Controller
{

    public function index()
    {
    	$jobs = Jobs::where('status','1')->where('is_expired','0')->orderBy('id', 'desc')->paginate(9);
        return view('pages.jobs',compact('jobs'));
    }
    public function jobsuser($id,$jobid)
    {
    	$jobs = Jobs::where('status','1')->where('user_id',$id)->where('id','!=',$jobid)->orderBy('id', 'desc')->paginate(10);
        return view('pages.jobs',compact('jobs'));
    }

    public function urgentjobs()
    {
    	$jobs = Jobs::where('urgent','on')->where('status','1')->orderBy('id', 'desc')->paginate(9);;
        return view('pages.urgentjobs',compact('jobs'));
    }

    public function coffeedatejobs()
    {
    	$jobs = Jobs::where('coffeedate','on')->where('status','1')->orderBy('id', 'desc')->paginate(9);;
        return view('pages.coffeedatejobs',compact('jobs'));
    }

    public function rentjobs()
    {
    	$jobs = Jobs::where('job_purpose','Rent')->where('status','1')->orderBy('id', 'desc')->paginate(9);;
        return view('pages.rentjobs',compact('jobs'));
    }

    public function jobsbytype($slug)
    {
    	$type_data=Types::where('slug',$slug)->first();
    	$jobs = Jobs::where('job_type',$type_data->id)->where('status','1')->orderBy('id', 'desc')->paginate(9);
    	if(!$jobs){
            abort('404');
        }
    	$type=$slug;
        return view('pages.jobsbytype',compact('jobs','type'));
    }

    public function jobsingle($slug)
    {
    	$job = Jobs::where("job_slug", $slug)->first();
        $job->views =$job->views+1;
        $job->save();
    	$jobs_count = Jobs::where('user_id', '=', $job->user_id)->get()->count();
        if(!$job){
            abort('404');
        }
    	$agent = User::findOrFail($job->user_id);
        return view('pages.jobsingle',compact('job','agent','jobs_count'));
    }

	public function agentscontact(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;
	    $inputs = $request->all();
	    $rule=array(
		        'name' => 'required',
				'email' => 'required',
		        'message' => 'required'
		   		 );
	   	 $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }
    	$enquire = new Enquire;
    	$enquire->job_id = $inputs['job_id'];
    	$enquire->job_name = $inputs['job_name'];
    	$enquire->job_slug =$inputs['job_slug'];
    	$enquire->agent_id = $inputs['agent_id'];
    	$enquire->name = $inputs['name'];
    	$enquire->email = $inputs['email'];
    	$enquire->phone = $inputs['phone'];
    	$enquire->message = $inputs['message'];
	    $enquire->save();
	    $email=$inputs['agent_email'];
        Mail::send('emails.inquiry',
            array(
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'message' => $inputs['message']
            ), function ($message) use($request,$email) {
                $message->to($email)->subject('Job Enquiry Mail');
            });
	    \Session::flash('flash_message', 'Message send successfully');
         return \Redirect::back();
    }
	public function agentscontactpersonal(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;
	    $inputs = $request->all();
	    $rule=array(
		        'name' => 'required',
				'email' => 'required',
		        'message' => 'required'
		   		 );
	   	 $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }
	    $email=$inputs['agent_email'];
        Mail::send('emails.inquiry',
            array(
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'message' => $inputs['message']
            ), function ($message) use($request,$email) {
                $message->to($email)->subject('Job Enquiry Mail');
            });
	    \Session::flash('flash_message', 'Message send successfully');
         return \Redirect::back();
    }

    public function searchjobs(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;
	    $inputs = $request->all();
	 	$type=$inputs['type'];
	 	$keyword=$inputs['keyword'];
        $jobs=Jobs::SearchByKeyword($type,$keyword)->get();
        $final_jobs=array();
        $radius=$inputs['radius'];
        $address=$inputs['address'];
        $user_longitude=$inputs['address_longitude'];
        $user_latitude=$inputs['address_latitude'];
        if(count($jobs)==0){
            $jobs=Jobs::where('address','like',$address)->get();
        }
        if($radius>0){
            foreach ($jobs as $key=>$job ) {
                $lat = $job->map_latitude;
                $lng = $job->map_longitude;
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".urlencode($user_latitude).",".urlencode($user_longitude)."&destinations=".urlencode($lat).",".urlencode($lng)."&key=AIzaSyDFPa3LVeBRpaGafuUtk4znrty6IIqtMUw";
                $result_string = file_get_contents($url);
                $result = json_decode($result_string, true);
                if($result['rows'][0]['elements'][0]['status'] == 'OK')
                {
                    $property_radius = $result['rows'][0]['elements'][0]['distance']['value'];
                    $property_radius = $property_radius / 1000;
                    $distance = round($property_radius);
                    if($radius==0){
                        if($distance<1){
                            array_push($final_jobs,$job);
                        }
                    }
                    else{
                        if ($distance <= $radius) {
                            array_push($final_jobs,$job);
                        }
                    }
                }
            }
            $jobs=$final_jobs;
        }
        return view('pages.searchjobs',compact('jobs','inputs'));
    }

    public function searchkeywordjobs(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;
	    $inputs = $request->all();
    	$jobs = DB::table('jobs')
                       ->where('status','1')
    				   ->where('job_type', '=', $inputs['type'])
    				   ->where('job_purpose', '=', $inputs['purpose'])
    				   ->where('job_name', 'like', '%'.$inputs['keyword'].'%')
    				   ->orderBy('id', 'desc')
    				   ->get();

        return view('pages.searchjobs',compact('jobs'));
    }

}
