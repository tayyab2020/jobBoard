<?php

namespace App\Http\Controllers;

use App\applicationTip;
use App\Blog;
use App\saveJobAlert;
use Auth;
use App\User;
use App\City;
use App\Jobs;
use App\CV;
use App\Testimonials;
use App\Subscriber;
use App\Partners;
use Mail;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use PDF;
use File;
use Image;

class IndexController extends Controller
{

    public function ViewCV($fileName) {
        $file="upload/PDFs/".$fileName.".pdf";
        return response()->download($file);
    }
    public function saveCV(Request $request) {
        $show = $request;
        $skills = explode(',', $show->skills);
        $file_name = 'cv_' . time();
        $tmpFilePath = 'upload/CV_images/';
        $image_file_name = $_FILES['myFile']['name'];
        $ext = pathinfo($image_file_name, PATHINFO_EXTENSION);
        $cv_image = $file_name.'.'.$ext;
        $img = Image::make($show->myFile);
        $img->save($tmpFilePath.$cv_image);
        ini_set('max_execution_time', '300');
        $pdf = PDF::loadView('cvPDF', compact('show','cv_image','skills'))->setOptions(['isRemoteEnabled' => TRUE, 'dpi' => 100])->setPaper('a4', 'portrait');
        $file = public_path('upload/PDFs/'.$file_name.'.pdf');
        // Save the PDF file into temp folder
        $pdf->save($file);
        /*$cv=new CV();
        $cv->userId=Auth::user()->id;
        $cv->name=$file_name;
        $cv->save();*/
        \Session::flash('flash_message', 'Your CV has been Created');
        return redirect('cv/view/'.$file_name);

    }

    public function redirect($service) {
        return Socialite::driver ( $service )->stateless()->redirect();
    }

    public function callback($service) {



        $user = Socialite::with ( $service )->stateless()->user();

        if(!$user->email)
        {


            return redirect()->back()->withErrors('Please link your facebook account with an email address.');

        }

        $user = $this->createUser($user,$service);

        auth()->login($user);
        if($user->usertype){
            return redirect('/');
        }
        else{
            return redirect('/admin/confirmUserType');
        }
    }

    public  function createUser($getInfo,$provider){


        $user = User::where('provider_id', $getInfo->id)->orWhere('email',$getInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'fname'     => isset($getInfo->name)?$getInfo->name:'',
                'email'    => $getInfo->email,
                'password' => bcrypt(Str::random(10)),
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'status' => 1
            ]);
        }
        return $user;

    }


    public function blogs(){
        $blogs = Blog::where('status',1)->orderBy('updated_at', 'desc')->get();
        return view('pages.blogsdetails',compact('blogs'));

    }
    public function blogdetails($id)
    {
        $blog = Blog::where('id',$id)->first();

        return view('pages.blogsdetailssingle',compact('blog'));
    }
    public function gettips()
    {
        $tips = applicationTip::get();

        return view('pages.alltips',compact('tips'));
    }
    public function index()
    {
    	if(!$this->alreadyInstalled()) {
            return redirect('install');
        }

    	$city_list = City::where('status','1')->orderBy('city_name')->get();

		$jobslist = Jobs::where('status','1')->orderBy('id', 'desc')->take(8)->get();

//		$testimonials = Testimonials::orderBy('id', 'desc')->get();

		$partners = Partners::orderBy('id', 'desc')->get();

		$topemployers = User::where('usertype','employer')->orderBy('created_jobs', 'desc')->take(3)->get();

		$testimonials = Blog::where('status',1)->orderBy('updated_at', 'desc')->take(10)->get();



        return view('pages.index',compact('jobslist','testimonials','partners','city_list','topemployers','testimonials'));
    }
    public function CreateCV()
    {
        return view('cv');
    }
    public function savejobalert(Request $request)
    {
        $existingJobs=saveJobAlert::where('user_email',$request->email)->where('radius',$request->radius)
            ->where('address',$request->address)->where('longitude',$request->longitude)->where('latitude',$request->latitude)
            ->where('job_type',$request->jobtype)->where('type',$request->type)
            ->first();
        if($existingJobs){
            return redirect('/')->with('flash_message', 'Your have already created Job Alert for this Search');
        }
        else{
            $job = new saveJobAlert;
            $job->user_email = $request->email;
            $job->radius = $request->radius;
            $job->job_type = $request->jobtype;
            $job->type = $request->type;
            $job->address = $request->address;
            $job->longitude = $request->longitude;
            $job->latitude = $request->latitude;
            $job->save();
            return redirect('/')->with('flash_message', 'Job Alert Created Successfully, You will now receive Emails for Simmilar Jobs');;
        }
    }

    public function subscribe(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'email' => 'required|email|max:75'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                echo '<p style="color: #db2424;font-size: 20px;">The email field is required.</p>';
                exit;
        }

    	$subscriber = new Subscriber;

    	$subscriber->email = $inputs['email'];
    	$subscriber->ip = $_SERVER['REMOTE_ADDR'];


	    $subscriber->save();

	    echo '<p style="color: #189e26;font-size: 20px;">Successfully subscribe</p>';
        exit;

    }

	/**
     * If application is already installed.
     *
     * @return bool
     */
    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }


	public function aboutus_page()
    {
        return view('pages.about');
    }

    public function careers_with_page()
    {
        return view('pages.careers');
    }

    public function terms_conditions_page()
    {
        return view('pages.terms_conditions');
    }

    public function privacy_policy_page()
    {
        return view('pages.privacy');
    }

    public function contact_us_page()
    {
        return view('pages.contact');
    }

    public function contact_us_sendemail(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'name' => 'required',
				'email' => 'required|email',
		        'user_message' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }



        Mail::send('emails.contact',
        array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'user_message' => $inputs['user_message']
        ), function($message)
	    {
	        $message->from(getcong('site_email'));
	        $message->to(getcong('site_email'), getcong('site_name'))->subject(getcong('site_name').' Contact');
	    });



 		 return redirect()->back()->with('flash_message', 'Thanks for contacting us!');
    }


    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
    	if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        return view('pages.login');
    }


    public function postLogin(Request $request)
    {


    //echo bcrypt('123456');
    //exit;

      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');


        $user = User::where('email', $request->email)->first();


        if(isset($user->provider_id) && $user->provider_id != NULL)
        {

            return redirect('/login')->withErrors('This Email ID is linked with Social Login. Use Social Login buttons to login.');

        }

         if (Auth::attempt($credentials, $request->has('remember'))) {

            if(Auth::user()->status=='0'){
                \Auth::logout();
                return redirect('/login')->withErrors('Your account is not activated yet, please check your email.');
            }


            return $this->handleUserWasAuthenticated($request);
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/login')->withErrors('The email or the password is invalid. Please try again.');

    }

     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/');
    }

    public function register()
    {
    	if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        $city_list = City::where('status','1')->orderBy('city_name')->get();

        return view('pages.register',compact('city_list'));
    }
    public function register_employer()
    {
    	if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        $city_list = City::where('status','1')->orderBy('city_name')->get();

        return view('pages.register_employer',compact('city_list'));
    }

    public function postRegister(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'fname' => 'required',
		        'lname' => 'required',
		        'lname' => 'required',
		        'phone' => 'required',
		        'city' => 'required',
		        'email' => 'required|email|max:75|unique:users',
		        'password' => 'required|min:3|confirmed'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }




        $user = new User;

		$string = Str::random(15);
		$user_fname= $request->fname;
		$user_lname= $request->lname;
		$user_email= $request->email;

		$user->usertype ='candidate';
		$user->fname = $user_fname;
		$user->lname = $user_lname;
		$user->email = $user_email;
		$user->password= bcrypt($request->password);
		$user->phone= $request->phone;
		$user->city= $request->city;

		$user->confirmation_code= $string;

	    $user->save();

		Mail::send('emails.register_confirm',
        array(
            'name' => $user_fname,
            'email' => $user_email,
            'password' => $request->password,
            'confirmation_code' => $string,
            'user_message' => 'test'
        ), function($message) use ($user_fname,$user_email)
	    {
	        $message->from(getcong('site_email'),getcong('site_name'));
	        $message->to($user_email,$user_fname)->subject('Registration Confirmation');
	    });



            \Session::flash('flash_message', 'Please verify your account. We\'ll send a verification link to the email address.');

            return \Redirect::back();


    }
    public function postRegister_employer(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'fname' => 'required',
		        'lname' => 'required',
		        'orgname' => 'required',
		        'kvk_number' => 'required',
		        'website_url' => 'required',
		        'zip_code' => 'required',
		        'city' => 'required',
		        'speciality' => 'required',
		        'phone' => 'required',
		        'email' => 'required|email|max:75|unique:users',
		        'password' => 'required|min:3|confirmed'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }




        $user = new User;

		$string = Str::random(15);
		$user_fname= $request->fname;
		$user_lname= $request->lname;
		$user_email= $request->email;

		$user->usertype = 'employer';
		$user->fname = $user_fname;
		$user->lname = $user_lname;
		$user->email = $user_email;
		$user->password= bcrypt($request->password);
		$user->phone= $request->phone;
		$user->city= $request->city;
		$user->zipCode= $request->zip_code;
		$user->webUrl= $request->website_url;
		$user->intermediary= $request->intermediary;
		$user->kvkNumber= $request->kvk_number;
		$user->specialism= $request->speciality;
		$user->orgName= $request->orgname;

		$user->confirmation_code= $string;

	    $user->save();

		Mail::send('emails.register_confirm',
        array(
            'name' => $user_fname,
            'email' => $user_email,
            'password' => $request->password,
            'confirmation_code' => $string,
            'user_message' => 'test'
        ), function($message) use ($user_fname,$user_email)
	    {
	        $message->from(getcong('site_email'),getcong('site_name'));
	        $message->to($user_email,$user_fname)->subject('Registration Confirmation');
	    });



            \Session::flash('flash_message', 'Please verify your account. We\'ll send a verification link to the email address.');

            return \Redirect::back();


    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        //return redirect('admin/');
        return redirect('/');
    }

    public function confirm($code)
    {

        $user = User::where('confirmation_code',$code)->first();

 		$user->status = '1';

 		$user->save();

 		\Session::flash('flash_message', 'Confirmation successful...');

        return view('pages.login');
    }

}
