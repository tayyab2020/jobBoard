<?php

namespace App\Http\Controllers\Admin;

use App\Enquire;
use Auth;
use App\User;
use App\City;
use App\Types;
use App\Jobs;
use App\savecandidate;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function jobslist()
    {


    	if(Auth::user()->usertype=='Admin')
        {
        	$jobslist = Jobs::orderBy('id')->get();
        }
        else
        {
        	$user_id=Auth::user()->id;

			$jobslist = Jobs::where('user_id',$user_id)->orderBy('id')->get();
		}
        if(Auth::User()->usertype!="Admin")
        {
            $user_id=Auth::user()->id;

            $inquirieslist = Enquire::where('agent_id',$user_id)->orderBy('id')->get();
        }
        else
        {
            $inquirieslist = Enquire::orderBy('id')->get();
        }

        $data=array('Jobs'=>$jobslist,'inquiries'=>$inquirieslist);


        return view('admin.pages.jobs',compact('data'));
    }
    public function candidateslist()
    {
    	if(Auth::user()->usertype=='Admin')
        {
        	$candidateslist = savecandidate::orderBy('id')->get();
        }
        else
        {
        	$user_id=Auth::user()->id;
			$candidateslist = savecandidate::where('user_id',$user_id)->orderBy('id')->get();
		}
        return view('admin.pages.candidates',compact('candidateslist'));
    }

	 public function addeditjob()
	 {

        $types = Types::orderBy('types')->get();

        $city_list = City::where('status','1')->orderBy('city_name')->get();

        return view('admin.pages.addeditjob',compact('city_list','types'));
    }

    public function editjob($id)
    {
          $job = Jobs::findOrFail($id);

          $types = Types::orderBy('types')->get();

          $city_list = City::where('status','1')->orderBy('city_name')->get();

          return view('admin.pages.addeditjob',compact('job','city_list','types'));

    }

    public function delete($id)
    {


        $job = Jobs::findOrFail($id);

		\File::delete(public_path() .'/upload/members/'.$job->job_image.'-b.jpg');
		\File::delete(public_path() .'/upload/members/'.$job->job_image.'-s.jpg');

//		\File::delete(public_path() .'/upload/members/'.$job->job_images1.'-b.jpg');
//		\File::delete(public_path() .'/upload/members/'.$job->job_images2.'-b.jpg');
//		\File::delete(public_path() .'/upload/members/'.$job->job_images3.'-b.jpg');
//		\File::delete(public_path() .'/upload/members/'.$job->job_images4.'-b.jpg');
//		\File::delete(public_path() .'/upload/members/'.$job->job_images5.'-b.jpg');


		$job->delete();

        $user=User::where('id', Auth::user()->id)->first();
        $user->created_jobs=$user->created_jobs-1;
        $user->save();

        \Session::flash('flash_message', 'Job Deleted');

        return redirect()->back();

    }


    public function addnew(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();
        $inputs['job_slug'] = $request->title;

        $rule=array(
            'title' => 'required',
            'description' => 'required',
            'job_type' => 'required',
            'specialism' => 'required',
            'salary' => 'required',
            'education' => 'required',
            'link' => 'required',
            'date' => 'required',
            'address' => 'required',
            'city' => 'required',
            'job_image' => 'mimes:jpg,jpeg,gif,png'
        );

        // Validate url
        /*$url = "https://jobhart.nl";
         if (filter_var($url, FILTER_VALIDATE_URL)) {
            $bool=false;
        } else {
            $bool=true;
        }
        if(!$bool){
            return back()->with('error','URL is not Valid');
        }*/

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages())->withInput($request->input());
        }

        if(!empty($inputs['id'])){

            $job = Jobs::findOrFail($inputs['id']);

        }else{

            $job = new Jobs;

        }


        /*	//job featured image
            $urgent_image = $request->file('featured_image');

            if($featured_image){

                \File::delete(public_path() .'/upload/members/'.$job->featured_image.'-b.jpg');
                \File::delete(public_path() .'/upload/members/'.$job->featured_image.'-s.jpg');


                $tmpFilePath = 'upload/members/';

                $hardPath =  Str::slug($inputs['job_name'], '-').'-'.md5(rand(0,99999));

                $img = Image::make($featured_image);

                $img->fit(640, 425)->save($tmpFilePath.$hardPath.'-b.jpg');
                $img->fit(358, 238)->save($tmpFilePath.$hardPath.'-s.jpg');

                $job->featured_image = $hardPath;

            }

            //job image 1
            $job_images1 = $request->file('job_images1');

            if($job_images1){

                \File::delete(public_path() .'/upload/members/'.$job->job_images1.'-b.jpg');


                $tmpFilePath = 'upload/members/';

                $hardPath =  Str::slug($inputs['job_name'], '-').'-'.md5(rand(0,99999));

                $img = Image::make($job_images1);

                $img->fit(640, 425)->save($tmpFilePath.$hardPath.'-b.jpg');


                $job->job_images1 = $hardPath;

            }

            //job image 2
            $job_images2 = $request->file('job_images2');

            if($job_images2){

                \File::delete(public_path() .'/upload/members/'.$job->job_images2.'-b.jpg');


                $tmpFilePath = 'upload/members/';

                $hardPath =  Str::slug($inputs['job_name'], '-').'-'.md5(rand(0,99999));

                $img = Image::make($job_images2);

                $img->fit(640, 425)->save($tmpFilePath.$hardPath.'-b.jpg');


                $job->job_images2 = $hardPath;

            }

            //job image 3
            $job_images3 = $request->file('job_images3');

            if($job_images3){

                \File::delete(public_path() .'/upload/members/'.$job->job_images3.'-b.jpg');


                $tmpFilePath = 'upload/members/';

                $hardPath =  Str::slug($inputs['job_name'], '-').'-'.md5(rand(0,99999));

                $img = Image::make($job_images3);

                $img->fit(640, 425)->save($tmpFilePath.$hardPath.'-b.jpg');


                $job->job_images3 = $hardPath;

            }

            //job image 4
            $job_images4 = $request->file('job_images4');

            if($job_images4){

                \File::delete(public_path() .'/upload/members/'.$job->job_images4.'-b.jpg');


                $tmpFilePath = 'upload/members/';

                $hardPath =  Str::slug($inputs['job_name'], '-').'-'.md5(rand(0,99999));

                $img = Image::make($job_images4);

                $img->fit(640, 425)->save($tmpFilePath.$hardPath.'-b.jpg');


                $job->job_images4 = $hardPath;

            }*/

        //job image 5
        $job_image = $request->file('job_image');

        /*if($job_image){

            \File::delete(public_path() .'/upload/members/'.$job->job_image.'-b.jpg');


            $tmpFilePath = 'upload/members/';

            $hardPath =  Str::slug($inputs['title'], '-').'-'.md5(rand(0,99999));

            $img = Image::make($job_image);

//            $img->fit(640, 425)->save($tmpFilePath.$hardPath.'-b.jpg');
            $img->save($tmpFilePath.$hardPath.'-b.jpg');


            $job->job_image = $hardPath;

        }*/

        if($inputs['job_slug']=="")
        {
            $job_slug  = Str::slug($inputs['title'], "-");
        }
        else
        {
            $job_slug =Str::slug($inputs['job_slug'], "-");
        }

        $city = City::where('city_name', 'like', '%' . $request->city)->first();

        if($city)
        {
            $city_id = $city->id;
        }
        else
        {
            $city = new City;
            $city->city_name = $request->city;
            $city->status = 1;
            $city->save();

            $city_id = $city->id;
        }

        $user_id=Auth::user()->id;
        $job->job_image = Auth::user()->image_icon;
        $job->user_id = $user_id;
        $job->job_name = $request->title;
        $job->job_slug = $job_slug;
        $job->career_level = $request->career;
        $job->city_id = $city_id;
        $job->job_type = $request->job_type;
        $job->specialism = $request->specialism;
        $job->salary = $request->salary;
        $job->hours = $request->hours;
        $job->education_attainment = $request->education;
        $job->qualification = $request->qualification;
        $job->experience = $request->experience;
        $job->urgent = isset($request->urgent)?$request->urgent:'off';
        $job->workfromhome = isset($request->workfromhome)?$request->workfromhome:'off';
        $job->link = $request->link;
        $job->coffeedate = isset($request->coffeedate)?$request->coffeedate:'off';
        $job->deadlineDate = $request->date;
        $job->address = $request->address;
        $job->map_latitude = $request->address_latitude;
        $job->map_longitude = $request->address_longitude;
        $job->keywords = $request->keywords;
        $job->description = $request->description;
        $job->save();

        $user=User::where('id', Auth::user()->id)->first();
        $user->created_jobs=$user->created_jobs+1;
        $user->save();
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back()->withInput($request->input());
        }else{

            \Session::flash('flash_message', 'Job Added');

            return \Redirect::back()->withInput($request->input());

        }



    }


    public function status($id)
    {
        $job = Jobs::findOrFail($id);

       	if(Auth::User()->id!=$job->user_id and Auth::User()->usertype!="Admin")
       	{

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

		if($job->status==1)
		{
			$job->status='0';
	   		$job->save();

	   		\Session::flash('flash_message', 'Unpublished');
		}
		else
		{
			$job->status='1';
	   		$job->save();

	   		\Session::flash('flash_message', 'Published');
		}

        return redirect()->back();

    }

	public function urgentjob($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $job = Jobs::findOrFail($id);

		if($job->urgent=='on')
		{
			$job->urgent_job='off';
	   		$job->save();

	   		\Session::flash('flash_message', 'Job unset from urgent');
		}
		else
		{
			$job->urgent_job='on';
	   		$job->save();

	   		\Session::flash('flash_message', 'Job set as urgent');
		}

        return redirect()->back();

    }


}
