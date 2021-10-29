<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table ="general_settings";

    protected $fillable = ['auth_key','auth_secret','facebook_key','facebook_secret','facebook_callback_url','google_key','google_secret','google_callback_url',
        'twitter_link','facebook_link','twitter_link','twitter_link','mob_no','web_email','logo','sign_ups_per_day_starts_with','resume_built_starts_with'];
}
