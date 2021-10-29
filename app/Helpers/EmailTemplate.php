<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailTemplate
{
    public static function email_template_replace_tags($template, $placeholders)
    {
        try {
            $placeholders = array_merge($placeholders, ['<?' => '', '?>' => '']);

            return str_replace(array_keys($placeholders), $placeholders, $template);
        } catch (\Exception $e) {
            Log::error('email_template_replace_tags', ['Exception' => $e->getMessage()]);
        }
    }

    public static function sendMail($emailtemplate, $email, $subject = null)
    {
        try {
            if (env('APP_ENV') == 'production') {
                //
            } else {
                Mail::send('mail-template', ["body_text" => $emailtemplate->content],
                    function ($message) use ($emailtemplate, $email, $subject) {
                        $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                        $message->to($email)->subject($subject ?? $emailtemplate->subject);
                    });
            }
            return true;
        } catch (\Exception $e) {
            Log::error('sendEMail', ['Exception' => $e->getMessage()]);
        }
    }
}
