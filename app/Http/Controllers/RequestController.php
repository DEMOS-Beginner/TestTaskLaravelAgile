<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequestRequest;
use App\Models\TestRequest;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\User;

class RequestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id; //Only authentificated users can use this method (Auth 100%)
        
        $columns = ['id', 'title', 'parent_id'];
        if (!Auth::user()->isAdmin) {
            $userRequests = TestRequest::all()->where('user_id', '==', $userId);
        } else {
            $userRequests = TestRequest::all();            
        }
        return view('requests.index', compact('userRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequestRequest $request)
    {
        $data = $request->input();
        $file = $request->file('filename');
        if ($file) {
            $path = $file->store('uploads', 'public');
            $data['filename'] = $path;
        }


        $item = new TestRequest();
        $item->fill($data);
        $item->save();

        if ($item) {
/*            Mail::send(['text'=>"mail"], ['name', ''], function ($message) {
                $message->to('dima.dmitry1234.maksimov@mail.ru', '')->subject('Новая заявка');
                $message->from(getenv('MAIL_USERNAME'), 'Новая заявка');
            }
            );*/

            return redirect()->route('requests.index', [$item->id])->with(['success'=>'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();           
        }       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemRequest = TestRequest::find($id);
        return view('requests.show', compact('itemRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = TestRequest::find($id)->user_id;

        $result = TestRequest::destroy($id);
        if (Auth::user()->isAdmin) {
            $userEmail = User::find($userId)->email;
/*            Mail::send(['text'=>"mail_destroy"], ['name', ''], function ($message) use ($userEmail) {
                $message->to($userEmail, '')->subject('Заявка закрыта');
                $message->from(getenv('MAIL_USERNAME'), 'Заявка закрыта');
            }
            );         */
        }

        if ($result) {
            return redirect()->route('requests.index')->with(['success'=>"Заявка $id закрыта"]);
        }
        return back()->withErrors(['msg'=>'Ошибка удаления']);
    }
}
