<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\TestRequest;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\User;

class MessageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        $data = $request->input();
        $item = (new Message())->create($data);

        $userId = TestRequest::find($data['test_request_id'])->user_id;
        $userEmail = User::find($userId)->email;

        if ($item) {

            if (Auth::user()->isAdmin) {
                Mail::send(['text'=>"mail_message_for_user"], ['name', ''], function ($message) use ($userEmail) {
                    $message->to($userEmail, '')->subject('Менеджер ответил');
                    $message->from(getenv('MAIL_USERNAME'), 'Менеджер ответил');
                }
                );          
            } else {
                Mail::send(['text'=>"mail_message_for_manager"], ['name', ''], function ($message) use ($userEmail) {
                    $message->to('dima.dmitry1234.maksimov@mail.ru', '')->subject('Клиент ответил');
                    $message->from(getenv('MAIL_USERNAME'), 'Клиент ответил');
                }
                );                 
            }

            return redirect()->route('requests.show', [$data['test_request_id']])->with(['success'=>'Успешно отправлено']);
        } else {
            return back()->withErrors(['msg'=>"Ошибка при отправке"])->withInput();           
        }  
    }

}
