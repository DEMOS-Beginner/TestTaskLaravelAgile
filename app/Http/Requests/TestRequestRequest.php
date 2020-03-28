<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TestRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|min:5|max:200',
            'text'    => 'required'
        ];
    }

    /**
    * Array have error messages which will be showed 
    * @return array
    */
    public function messages() {
        return [
            'subject.required' => 'Введите тему заявки',
            'subject.min'      => 'Тема должна быть больше :min символов',
            'subject.max'      => 'Тема должна быть не больше :max символов',
            'text.required'  => 'Введите текст заявки'
        ];
    }

}
