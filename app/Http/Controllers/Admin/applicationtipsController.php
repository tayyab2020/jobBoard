<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\applicationTip;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class applicationtipsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function applicationtipslist()
    {
    	$allapplicationtips = applicationtip::orderBy('id')->get();

        return view('admin.pages.applicationtips',compact('allapplicationtips'));
    }

	 public function addeditapplicationtips()    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditapplicationtip');
    }

    public function addnew(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'name' => 'required',
				'applicationtip' => 'required',
		        'image_name' => 'mimes:jpg,jpeg,gif,png'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }

		if(!empty($inputs['id'])){

            $applicationtip = applicationtip::findOrFail($inputs['id']);

        }else{

            $applicationtip = new applicationTip;

        }


		//Slide image
		$t_user_image = $request->file('t_user_image');

        if($t_user_image){

            \File::delete(public_path() .'/upload/applicationtip/'.$applicationtip->t_user_image.'.jpg');


            $tmpFilePath = 'upload/applicationtip/';

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($t_user_image);

            $img->fit(200, 200)->save($tmpFilePath.$hardPath.'.jpg');

            $applicationtip->t_user_image = $hardPath;

        }


		$applicationtip->name = $inputs['name'];
		$applicationtip->testimonial = $inputs['applicationtip'];


	    $applicationtip->save();

		if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }


    }

    public function editapplicationtip($id)
    {
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

          $applicationtip = applicationtip::findOrFail($id);

          return view('admin.pages.addeditapplicationtip',compact('applicationtip'));

    }

    public function delete($id)
    {

    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $applicationtip = applicationtip::findOrFail($id);

		\File::delete(public_path() .'/upload/applicationtip/'.$applicationtip->t_user_image.'.jpg');

		$applicationtip->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


}
