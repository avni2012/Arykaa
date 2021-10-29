<?php

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $template = EmailTemplate::where('keyword','CONTACT FORM NOTIFICATION TO ADMIN')->first();
        if(!$template) {
            $template = new EmailTemplate();
            $template->keyword = 'CONTACT FORM NOTIFICATION TO ADMIN';
            $template->subject = 'Contact Form Notification To Admin';
            $template->content = '<p>Hello Admin,</p>
<p><b>{{NAME}}</b> with <b>{{EMAIL}}</b> email has submitted his/her contact us query/message <i><b>{{MESSAGE}}</b></i> with you at <b>{{CREATED_AT}}</b>.</p>
<p>Regards,</p><p>{{APP_NAME}}</p>';
            $template->content_macro = '{{NAME}}, {{EMAIL}}, {{MESSAGE}}, {{CREATED_AT}}, {{APP_NAME}}';
            $template->save();
        }
    }
}
