<?php

namespace App\Helpers;

class PricingIncludes
{
    public static function plans(){
        return [
            'Resume-Builder' => 'Resume Builder',
            'Cover-Note-Creator' => 'Cover Note Creator',
            'Email-Templates' => 'Email Templates'  
            /*'Job-Search-Plan' => 'Job Search Plan',
            'Job-Search-Coaching' => 'Job Search Coaching',
            'Job-Search-Training' => 'Job Search Training'*/
        ];
    }
    public static function JobSearchplans(){
        return [
            'Job-Search-Plan' => 'Job Search Plan',
            'Job-Search-Coaching' => 'Job Search Coaching',
            'Job-Search-Training' => 'Job Search Training'
        ];
    }
}
