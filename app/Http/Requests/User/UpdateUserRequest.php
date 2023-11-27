<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
use App\Support\Enum\UserStatus;
use App\Models\User;

class UpdateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();

        return [
            'email' => 'email|unique:users,email,' . $user->userid.',userid',
            'username' => 'nullable|unique:users,username,' . $user->userid.',userid',
            'password' => 'min:6|confirmed',
            'birthday' => 'nullable|date',
            'role_id' => 'exists:roles,id',
            'country_id' => 'exists:countries,id',
            'status' => Rule::in(array_keys(UserStatus::lists()))
        ];
    }
}
