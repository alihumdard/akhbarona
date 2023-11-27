<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Models\User;

class UpdateLoginDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->getUserForUpdate();

        return [
            'email' => 'required|email|unique:users,email,' . $user->userid.',userid',
            'username' => 'nullable|unique:users,username,' . $user->userid.',userid',
            'password' => 'nullable|min:6|confirmed'
        ];
    }

    /**
     * @return \Illuminate\Routing\Route|object|string
     */
    protected function getUserForUpdate()
    {
        return $this->route('user');
    }
}
