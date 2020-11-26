<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\City;
use App\Jobs;
use App\saveJob;
use App\savecandidate;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Intervention\Image\Facades\Image;
use function Symfony\Component\VarDumper\Tests\Caster\reflectionParameterFixture;

class AdminController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

    }
    public function index()
    {
        return view('admin.pages.dashboard');
    }

	public function profile()
    {
    	$city_list = City::orderBy('city_name')->get();

        return view('admin.pages.profile',compact('city_list'));
    }

    public function updateProfile(Request $request)
    {


    	$user = User::findOrFail(Auth::user()->id);
        $jobs=Jobs::where('user_id', Auth::user()->id)->get();


	    $data =  \Request::except(array('_token')) ;

	    $rule=array(
		        'fname' => 'required',
		        'lname' => 'required',
		        'email' => 'required|email|max:75|unique:users,id',
		        'image_icon' => 'mimes:jpg,jpeg,gif,png'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages())->withInput($request->input());
            }


	    $inputs = $request->all();

		$icon = $request->file('user_icon');

        if($icon){

			\File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
		    \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');

            $tmpFilePath = 'upload/members/';

            $hardPath =  str_slug($inputs['fname'], '-').'-'.md5(time());

            $img = Image::make($icon);

//            $img->fit(376, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            $img->save($tmpFilePath.$hardPath.'-b.jpg');
            $img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->image_icon = $hardPath;
            foreach ($jobs as $job){
                $job->job_image = $hardPath;
                $job->save();
            }
        }


		$user->fname = $request->fname;
		$user->lname = $request->lname;
		$user->email = $request->email;
		$user->website = $request->website;
		$user->phone = $request->phone;
		$user->address = $request->address;
        $user->map_latitude = $request->address_latitude;
        $user->map_longitude = $request->address_longitude;
		$user->city= $request->city;
		$user->about = $request->about;
		$user->youtube = $request->youtube;
		$user->instagram = $request->instagram;
		$user->facebook = $request->facebook;
		$user->twitter = $request->twitter;
		$user->gplus = $request->gplus;
		$user->linkedin = $request->linkedin;
		$user->review1_name = $request->review1_name;
		$user->review2_name = $request->review2_name;
		$user->review3_name = $request->review3_name;
        $user->review1_function = $request->review1_function;
        $user->review2_function = $request->review2_function;
        $user->review3_function = $request->review3_function;
        $user->review1_saying = $request->review1_saying;
        $user->review2_saying = $request->review2_saying;
        $user->review3_saying = $request->review3_saying;
        $user->specialism = $request->specialism;
        $user->salary = $request->salary;
        $user->language = $request->language;
        $user->attainment = $request->attainment;
        $user->career_level = $request->career_level;
        $user->experience = $request->experience;
        $user->profession = $request->profession;
        $user->license = $request->license;
        $user->visible = $request->visible;
        $user->parttime_available = $request->parttime_available;
        $user->parttime_available_input = $request->parttime_available_input;
        $user->fulltime_available = $request->fulltime_available;
        $user->travel_distance = $request->travel_distance;
        $user->travel_city = $request->travel_city;
        $user->working_now = $request->working_now;
        $user->working_now_date = $request->working_now_date;
        $user->not_working_now = $request->not_working_now;
        $user->last_employer_name = $request->last_employer_name;
        $user->function_now = $request->function_now;
        $user->function_not_now = $request->function_not_now;
        $user->employer_name = $request->employer_name;
        $user->working_now_start_date = $request->working_now_start_date;
        $user->working_now_end_date = $request->working_now_end_date;
        $user->description_activity = $request->description_activity;
        $user->description_activity_old = $request->description_activity_old;

	    $user->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }

    public function getSavedJobs()
    {
        $jobs=saveJob::where('user_id', Auth::user()->id)->get();
        return view('admin.pages.savedjobs',compact('jobs'));
    }
    public function deletejob($id,$job_slug)
    {
        $job = saveJob::findOrFail($id);
        if($job){
            $job->delete();
            $job2=Jobs::where('job_slug', $job_slug)->first();
            $job2->saved_jobs=$job2->saved_jobs-1;
            $job2->save();
            $user=User::where('id', Auth::user()->id)->first();
            $user->views=$user->views-1;
            $user->save();
            \Session::flash('flash_message', 'Deleted');
        }
        return redirect('admin/savedjobs');
    }
    public function deletecandidate($id,$candidate_id)
    {
        $job = savecandidate::where('id',$id)->where('candidate_id',$candidate_id)->first();
        if($job){
            $job->delete();
            \Session::flash('flash_message', 'Deleted');
        }
        return redirect('admin/savedCandidates');
    }
    public function saveJob(Request $request)
    {
        $existingJobs=saveJob::where('job_slug',$request->job_slug)->where('user_id',$request->user_id)->first();
        if($existingJobs){
            $existingJobs->delete();
            $job2=Jobs::where('job_slug', $request->job_slug)->first();
            $job2->saved_jobs=$job2->saved_jobs-1;
            $job2->save();
            $user=User::where('id', Auth::user()->id)->first();
            $user->views=$user->views-1;
            $user->save();
            Session::flash('flash_message', 'Your Job has been Deleted From your Favorite Jobs');
        }
        else{
            $job = new saveJob;
            $job->job_slug = $request->job_slug;
            $job->user_id = $request->user_id;
            $job->save();
            $job2=Jobs::where('job_slug',$request->job_slug)->first();
            $job2->saved_jobs=$job2->saved_jobs+1;
            $job2->save();
            $user=User::where('id',$request->user_id)->first();
            $user->views=$user->views+1;
            $user->save();
            Session::flash('flash_message', 'Job Successfully Saved to Your Dashboard!');
        }
        return redirect()->back();
    }
    public function savecandidate(Request $request)
    {
        $existingcandidate=savecandidate::where('candidate_id',$request->candidate_id)->where('user_id',$request->user_id)->first();
        if($existingcandidate){
            Session::flash('flash_message', 'You have already Saved this Candidate');
        }
        else{
            $job = new savecandidate();
            $job->candidate_id = $request->candidate_id;
            $job->candidate_name = $request->candidate_name;
            $job->user_id = $request->user_id;
            $job->save();
            Session::flash('flash_message', 'Candidate Successfully Saved to Your Dashboard!');
        }
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {

    		//$user = User::findOrFail(Auth::user()->id);


		    $data =  \Request::except(array('_token')) ;
            $rule  =  array(
                    'password'       => 'required|confirmed',
                    'password_confirmation'       => 'required'
                ) ;

            $validator = \Validator::make($data,$rule);

            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }

	   		/* $val=$this->validate($request, [
                    'password' => 'required|confirmed',
            ]);  */

	    $credentials = $request->only('password', 'password_confirmation'
            );

        $user = \Auth::user();
        $user->password = bcrypt($credentials['password']);
        $user->save();

	    Session::flash('flash_message', 'Successfully updated!');

        return redirect()->back();
    }


}
