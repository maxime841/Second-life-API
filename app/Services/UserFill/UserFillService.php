<?php

declare(strict_types=1);

namespace App\Services\UserFill;

use Illuminate\Support\Facades\Hash;
use App\Services\Contracts\UserFillContract;

class UserFillService implements UserFillContract
{
    /**
     * create object for register user
     *
     * @param array $input
     * @return void
     */
    public function fillRegister(array $input)
    {
        return [
            // 'first_name' => $input['first_name'],
            // 'last_name' => $input['last_name'],
            // 'pseudo' => $input['pseudo'],
            'name' => $input['name'],
            // 'address' => $input['address'],
            // 'code_post' => $input['code_post'],
            // 'city' => $input['city'],
            // 'phone' => $input['phone'],
            'avatar' => null,
            'email_verified_at' => null,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ];
    }
}
