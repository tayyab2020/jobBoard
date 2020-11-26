<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Blog;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

		 parent::__construct();

    }
    public function bloglist()
    {
    	$allblogs = Blog::orderBy('id')->get();

        return view('admin.pages.blogs',compact('allblogs'));
    }


	 public function addeditblog()    {

        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        return view('admin.pages.addeditblog');
    }

    public function addnew(Request $request)
    {

    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    $rule=array(
		        'text' => 'required',
		        'image' => 'required'
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }

		if(isset($inputs['id'])){
            $blog = Blog::findOrFail($inputs['id']);
        }else{
            $blog = new Blog;
        }


		$hardPath='';
        $tmpFilePath = 'upload/blogs/';
        $icon = $request->file('image');
        if($icon){
            $hardPath =  str_slug($inputs['image'], '-').'-'.md5(time());
            $img = Image::make($icon);
            $img->save($tmpFilePath.$hardPath.'.jpg');
        }
        $blog->details = $inputs['text'];
        $blog->image = $hardPath;
        $blog->save();


		if(isset($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }


    }

    public function editblog($id)
    {
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

          $blog = Blog::findOrFail($id);

          return view('admin.pages.addeditblog',compact('blog'));

    }

    public function delete($id)
    {

    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

        $blog = Blog::findOrFail($id);

		$blog->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }

    public function status($id)
    {
        $blog = Blog::findOrFail($id);

       	if(Auth::User()->usertype!="Admin")
       	{

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');

        }

		if($blog->status==1)
		{
			$blog->status='0';
	   		$blog->save();

	   		\Session::flash('flash_message', 'Unpublished');
		}
		else
		{
			$blog->status='1';
	   		$blog->save();

	   		\Session::flash('flash_message', 'Published');
		}

        return redirect()->back();

    }


}
