<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:25',
            'content' => 'required',
        ];

    }

        public function attributes(){
            return [
            'title' => 'Title',
            'content' => 'Content',
            ];


    }

    public function messages()
    {
        return [

            'title' => 'The :attribute is necessary',
            'content' => 'The :attribute is necessary',
        ];

    }
}
