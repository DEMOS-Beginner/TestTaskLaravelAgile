<?php

namespace App\Observers;

use App\Models\TestRequest;
use Mail;
use Config;
use Illuminate\Support\Facades\Auth;

class RequestObserver
{
    /**
     * Handle the test request "created" event.
     *
     * @param  \App\Models\TestRequest  $testRequest
     * @return void
     */
    public function created(TestRequest $testRequest)
    {
        if (Auth::user()) {
            Mail::send(['text'=>"mail"], ['name', ''], function ($message) {
                $message->to(Config::get('constants.emails.manager_email'), '')->subject('Новая заявка');
                $message->from(getenv('MAIL_USERNAME'), 'Новая заявка');
            }
            );            
        }

    }

    /**
     * Handle the test request "deleted" event.
     *
     * @param  \App\Models\TestRequest  $testRequest
     * @return void
     */
    public function deleted(TestRequest $testRequest)
    {
        if (Auth::user()) {
            Mail::send(['text'=>"mail_close"], ['name', ''], function ($message) {
                $message->to(Config::get('constants.emails.manager_email'), '')->subject('Заявка закрыта');
                $message->from(getenv('MAIL_USERNAME'), 'Новая заявка');
            }
            );           
        }

    }
}
