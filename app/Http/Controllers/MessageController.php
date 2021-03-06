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

        if ($item) {
            return redirect()->route('requests.show', [$data['test_request_id']])->with(['success'=>'Успешно отправлено']);
        } else {
            return back()->withErrors(['msg'=>"Ошибка при отправке"])->withInput();           
        }  
    }

}
