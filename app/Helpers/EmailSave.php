<?php

namespace App\Helpers;
use Illuminate\Support\Facades\File;
use App\Models\EmailHistory;

class EmailSave
{
    public static function EmailSave($bladeHtml,$user_id,$subject)
    {    
        try{
               $email_history = new EmailHistory;
               $email_history->user_id = $user_id;
               $email_history->subject = $subject;
               $email_history->contain = $bladeHtml;
               $email_history =  $email_history->save();
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}