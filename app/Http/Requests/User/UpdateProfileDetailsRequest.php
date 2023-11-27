<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Models\User;

class UpdateProfileDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'birthday' => 'nullable|date',
        ];
    }
}
