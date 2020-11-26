<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['provider','provider_id','status','usertype','name', 'email', 'password','phone','fax','about','facebook','twitter','gplus','linkedin','image_icon'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUserInfo($id)
    {
        return User::find($id);
    }

    public function scopeSearchByKeyword($query,$name,$experience,$activity)
    {
        $query->where(function ($query) use ($name,$experience,$activity) {
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
            }
            if($name && $experience && $date){
                $query->where("created_at",'>' ,$date)
                    ->where("experience",'<=',$experience)
                    ->where("usertype",'candidate')
                    ->where("fname",'LIKE', "%$name%")
                    ->orWhere("lname",'LIKE', "%$name%");
            }
            elseif($name && $experience && !$date){
                $query->where("experience",'<=',$experience)
                    ->where("usertype",'candidate')
                    ->where("fname",'LIKE', "%$name%")
                    ->orWhere("lname",'LIKE', "%$name%");
            }
            elseif($name && !$experience && !$date){
                $query->where("usertype",'candidate')
                    ->where("fname",'LIKE', "%$name%")
                    ->orWhere("lname",'LIKE', "%$name%");
            }
            elseif($name && !$experience && $date){
                $query->where("created_at",'>' ,$date)
                    ->where("usertype",'candidate')
                    ->where("fname",'LIKE', "%$name%")
                    ->orWhere("lname",'LIKE', "%$name%");
            }
            elseif(!$name && !$experience && $date){
                $query->where("created_at",'>' ,$date)
                    ->where("usertype",'candidate');
            }
            elseif(!$name && $experience && $date){
                $query->where("created_at",'>' ,$date)
                    ->where("usertype",'candidate')
                    ->where("experience",'<=',$experience);
            }
            else{
                $query->where("usertype",'candidate');
            }
        });
        $query=$query->where('visible',1);
        return $query;
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPassword($token));
    }
}

class CustomPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url=url('admin/password/reset/'.$this->token);

        return (new MailMessage)
            ->subject('Reset Password')
            ->from(getcong('site_email'), getcong('site_name'))
            /*->line('We are sending this email because we recieved a forgot password request.')
            ->action('Reset Password', $url)
            ->line('If you did not request a password reset, no further action is required. Please contact us if you did not submit this request.');*/
            ->view('emails.password',['url'=>$url]);
    }
}
