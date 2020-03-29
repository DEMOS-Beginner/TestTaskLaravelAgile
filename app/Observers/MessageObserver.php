<?php

namespace App\Observers;
use App\Models\Message;
use App\Models\TestRequest;
use Mail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Config;

class MessageObserver
{
    /**
     * Handle the test request "created" event.
     *
     * @param  \App\Models\Message  $msg
     * @return void
     */
    public function created(Message $msg)
    {
        $userId = TestRequest::find($msg->test_request_id)->user_id;
        $userEmail = User::find($userId)->email;

        if (Auth::user()->isAdmin) {
            Mail::send(['text'=>"mail_message_for_user"], ['name', ''], function ($message) use ($userEmail) {
                $message->to($userEmail, '')->subject('Менеджер ответил');
                $message->from(getenv('MAIL_USERNAME'), 'Менеджер ответил');
            }
            );          
        } else {
            Mail::send(['text'=>"mail_message_for_manager"], ['name', ''], function ($message) use ($userEmail) {
                $message->to(Config::get('constants.emails.manager_email'), '')->subject('Клиент ответил');
                $message->from(getenv('MAIL_USERNAME'), 'Клиент ответил');
            }
            );                 
        }
    }
}
