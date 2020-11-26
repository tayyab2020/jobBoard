<?php

namespace App\Http\Controllers;

use App\Observers\JobsObserver;
use App\User;
use App\Jobs;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgentsController extends Controller
{


    public function index()
    {
		$agents = User::where('usertype','employer')->orderBy('id', 'desc')->paginate(9);;
		$usertype='employer';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function filter($alphabet)
    {
        if(strtolower($alphabet)=='all'){
            $agents = User::where('usertype','employer')->orderBy('id', 'desc')->paginate(9);
        }
        else{
            $agents = User::where('usertype','employer')->where('fname', 'LIKE', "$alphabet%")->orderBy('id', 'desc')->paginate(9);
        }
        $usertype='employer';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function employerDetail($id)
    {
        $agent = User::where('id',$id)->first();
        return view('pages.agentsingle',compact('agent'));
    }
    public function searchByName(Request $request)
    {
        $agents = User::where('usertype','employer')->where('fname','LIKE',"%$request->employee_name%")->orWhere('lname','LIKE',"%$request->employee_name%")->orderBy('id', 'desc')->paginate(9);
        $usertype='employer';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function searchByCity(Request $request)
    {
        $agents = User::where('usertype','employer')->where('city','LIKE',"%$request->employee_city%")->orWhere('address','LIKE',"%$request->employee_city%")->orderBy('id', 'desc')->paginate(9);
        $usertype='employer';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function employerjobs($id)
    {
        $jobs = Jobs::where('user_id',$id)->orderBy('created_at', 'desc')->paginate(9);
        return view('pages.jobs',compact('jobs'));
    }

    public function searchcandidate(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $activity=$inputs['activity'];
        $experience=$inputs['experience'];
        $name=$inputs['name'];
        $radius=$inputs['radius'];
        $address=$inputs['address'];
        $user_longitude=$inputs['address_longitude'];
        $user_latitude=$inputs['address_latitude'];
        if($radius==0){
            $query=User::query();
            if($address){
                $query=$query->where('address','like',$address);
            }
            if($name){
                $query=$query->where('fname','like',$name)->orWhere('lname','like',$name);
            }
            if($experience){
                $query=$query->where('experience','<=',intval($experience));
            }
            if($activity){
                if($activity==1){
                    $date=date('Y-m-d H:i:s',strtotime("-1 days"));
                }
                else if($activity==7){
                    $date=date('Y-m-d H:i:s',strtotime("-7 days"));
                }
                else if($activity==14){
                    $date=date('Y-m-d H:i:s',strtotime("-14 days"));
                }
                else if($activity==30){
                    $date=date('Y-m-d H:i:s',strtotime("-30 days"));
                }
                else{
                    $date=0;
                }
                if($date){
                    $query=$query->where("created_at",'>' ,$date);
                }
            }
            $users=$query->paginate(10);
        }
        else{
            $users=User::SearchByKeyword($name,$experience,$activity)->paginate(10);
        }
        $final_users=array();

        if(count($users)==0){
            $users=User::where('address','like',$data['address'])->get();
        }
        if($user_longitude && $user_latitude && $radius){
            foreach ($users as $key=>$job ) {
                $lat = isset($job->map_latitude)&&$job->map_latitude!=''?$job->map_latitude:'';
                $lng = isset($job->map_longitude)&&$job->map_longitude!=''?$job->map_longitude:'';
                if($lat && $lng){
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
                                array_push($final_users,$job);
                            }
                        }
                        else{
                            if ($distance <= $radius) {
                                array_push($final_users,$job);
                            }
                        }
                    }
                }
            }
        }
        else{
            $final_users=$users;
        }
        $agents=$final_users;
        $usertype='candidate';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function candidatesindex()
    {
        if(Auth::User()->usertype!="employer"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }
		$agents = User::where('usertype','candidate')->where('visible',1)->orderBy('id', 'desc')->paginate(9);;
        $usertype='candidate';
        return view('pages.agents',compact('agents','usertype'));
    }

    public function candidatesfilter($alphabet)
    {
        if(strtolower($alphabet)=='all'){
            $agents = User::where('usertype','candidate')->where('visible',1)->orderBy('id', 'desc')->paginate(9);
        }
        else{
            $agents = User::where('usertype','candidate')->where('visible',1)->where('fname', 'LIKE', "$alphabet%")->orderBy('id', 'desc')->paginate(9);
        }
        $usertype='candidate';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function candidatessearchbyname(Request $request)
    {
        $agents = User::where('usertype','candidate')->where('visible',1)->where('fname','LIKE',"%$request->employee_name%")->orWhere('lname','LIKE',"%$request->employee_name%")->orderBy('id', 'desc')->paginate(9);
        $usertype='candidate';
        return view('pages.agents',compact('agents','usertype'));
    }
    public function candidatessearchByCity(Request $request)
    {
        $agents = User::where('usertype','candidate')->where('visible',1)->where('city','LIKE',"%$request->employee_city%")->orWhere('address','LIKE',"%$request->employee_city%")->orderBy('id', 'desc')->paginate(9);
        $usertype='candidate';
        return view('pages.agents',compact('agents','usertype'));
    }


}
