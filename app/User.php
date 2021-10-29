<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'country_code', 'mobile_no', 'resume_fullname', 'resume_email', 'email_verified_at', 'industry', 'is_admin', 'gender', 'status', 'date_of_birth', 'google_id', 'facebook_id', 'work_experience', 'education_level', 'address', 'profile_picture'
    ];

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
    public function restore()
    {
        $this->restoreA();
    }

    public function roleUser()
    {
        return $this->belongsTo('App\RoleUser','id','user_id');
    }

    public function ActivePlan()
    {
        $today_date = date('Y-m-d');
        return $this->hasOne(Models\PricingSubscription::class,'user_id','id')
                ->where('payment_status', 1)
                ->where('expiry_date_of_plan','>=',$today_date);

    }

    public function user_resumes()
    {
        return $this->hasMany('App\Models\Resume\UserResume','user_id','id');
    }
}
