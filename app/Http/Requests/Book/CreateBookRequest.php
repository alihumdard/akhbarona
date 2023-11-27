<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\Request;

class CreateBookRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'=>'required|unique:books,code',
            'name' => 'required'
        ];
    }
}
