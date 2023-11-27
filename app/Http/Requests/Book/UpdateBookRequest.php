<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\Request;

class UpdateBookRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $book = $this->getBookDetail();
        return [
            'code'=>'required|unique:books,code,'.$book->id,
            'name' => 'required'
        ];
    }
    protected function getBookDetail() {
        return $this->route('book');
    }
}
