<?php

namespace Database\Seeders;

use App\Models\MailTemplate;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailTemplate::truncate();
        MailTemplate::create([
            'identifier' => 'user_forgot_password',
            'subject' => 'Forgot Password Recovery Email',
            'body' =>
                '<p>Hello [USER_NAME],</p><br><p>A request has been made to recover password for your account. </p>
                 <p>Please follow below Code to confirm your email and generate new password for your account :</p>
                 <br>[CODE]<br><p>In case you have not requested new password for your account, please ignore this email.</p>
                 <br><br>
                 <p>Thank you,</p>
                 <p>[APP_NAME]</p>',
            'wildcards' => '[USER_NAME],[CODE],[APP_NAME]',
            'from' => 'admin@example.com'
        ]);

        MailTemplate::create([
            'identifier' => 'signup_confirmation',
            'subject' => 'Thank You For Signing Up',
            'body' =>
                '<p>Hello [USER_NAME],</p><br><h4>Thanks for signing up [APP_NAME]. </h4>
                 <p>Please take a second to confirm [USER_NAME] :</p>
                 <p>as your email address:</p>
                 <br><a href="[CONFIRMATION_LINK]">[CONFIRMATION_LINK]</a><br>
                 <br>
                 <p>Thank You</p>
                 <p>[APP_NAME]</p>',
            'wildcards' => '[USER_NAME],[CONFIRMATION_LINK],[APP_NAME]',
            'from' => 'admin@example.com'
        ]);

        MailTemplate::create([
            'identifier' => 'news_letter',
            'subject' => 'Newsletter - Stay updated with our latest advancements',
            'body' =>
                '<p>Hello [EMAIL],</p><br><h4>Thanks for signing up for newsletter. </h4>
                 <p>This is Test newsletter content :</p>
                 <br>
                 <p>Thank You</p>
                 <p>[APP_NAME]</p>',
            'wildcards' => '[EMAIL],[APP_NAME]',
            'from' => 'admin@example.com'
        ]);
    }
}
