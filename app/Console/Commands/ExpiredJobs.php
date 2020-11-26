<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Jobs;
use DateTime;
use DateTimeZone;
use Mail;

class ExpiredJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:cron';

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
        $jobs=Jobs::where('is_expired','0')->get();
        foreach ($jobs as $k=>$job){
            $deadline = strtotime($job->deadlineDate);
            $date = new DateTime("now", new DateTimeZone('Europe/Amsterdam') );
            $today_date = strtotime($date->format('Y-m-d'));
            $secs = $deadline - $today_date;// == <seconds between the two times>
            if($secs<=0){
                $job->is_expired=1;
                $job->save();
            }
/*            $userId=$job->user_id;
            $user=User::where('id',$userId)->first();
            if($user->provider!='facebook'){
                $sender_email=$user->email;
                Mail::send('emails.jobalert',
                    array(
                        'jobs' => $jobs,
                    ),  function ($message) use($jobs,$sender_email) {
                        $message->from(getcong('site_email'),getcong('site_name'));
                        $message->to($sender_email)
                            ->subject('Weekly  Job Alert Jobs by Jobhart.nl');
                    });
            }*/
        }
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}
