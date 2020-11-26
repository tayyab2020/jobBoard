<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Types;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function typeslist()
    {
    	$alltypes = Types::orderBy('id')->get();

        return view('admin.pages.types',compact('alltypes'));
    }

	 public function addedittypes()    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addedittypes');
    }

    public function addnew(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'job_type' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }

		if(!empty($inputs['id'])){

            $types = Types::findOrFail($inputs['id']);

        }else{

            $types = new Types;

        }

		if($inputs['slug']=="")
		{
			$slug  = Str::slug($inputs['job_type'], "-");
		}
		else
		{
			$slug = Str::slug($inputs['slug'], "-");
		}

		$types->types = $inputs['job_type'];
		$types->slug = $slug;


	    $types->save();

		if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }


    }

    public function edittypes($id)
    {
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

          $type = Types::findOrFail($id);

          return view('admin.pages.addedittypes',compact('type'));

    }

    public function delete($id)
    {

    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $type = Types::findOrFail($id);



		$type->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }


}
