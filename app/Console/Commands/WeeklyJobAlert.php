<?php

namespace App\Console\Commands;

use App\Jobs;
use App\saveJobAlert;
use Illuminate\Console\Command;
use Mail;

class WeeklyJobAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:weeklyjobAlert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobalerts=saveJobAlert::where('type','1')->get();
        foreach ($jobalerts as $key=>$jobalert){
            $type=$jobalert->job_type;
            $keyword=$jobalert->keyword;
            $jobs=Jobs::SearchByKeyword($type,$keyword)->get();
            $final_jobs=array();
            $radius=$jobalert->radius;
            $address=$jobalert->address;
            $user_longitude=$jobalert->longitude;
            $user_latitude=$jobalert->latitude;
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
            $sender_email=$jobalert->user_email;
            Mail::send('emails.jobalert',
                array(
                    'jobs' => $jobs,
                ),  function ($message) use($jobs,$sender_email) {
                    $message->from(getcong('site_email'),getcong('site_name'));
                    $message->to($sender_email)
                        ->subject('Monthly Job Alert Jobs by Jobhart.nl');
                });
        }
    }
}
