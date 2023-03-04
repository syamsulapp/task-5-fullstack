<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Auth extends Controller
{

    protected $login;

    protected $user;
    public function __construct(Login $login, User $user)
    {
        $this->user = $user;
        $this->login = $login;
    }

    public function login(Request $login)
    {
        $costum = [
            'email' => ':attribute jangan di kosongkan',
            'password' => ':attribute jangan di kosongkan',
        ];

        $validate = Validator::make($login->all(), [
            'email' => 'required|string|min:4|email',
            'password' => 'required|string|min:4',
        ], $costum);

        if ($validate->fails()) {
            $result = $this->customError(collect($validate->errors()));
        } else {
            $email = $this->login->where('email', $login->email)->first();
            if (!$email) :
                $result = $this->resBuilder($login->email, 422, 'email salah');
            else :
                $password = Hash::check($login->password, $email->password);
                if (!$password) :
                    $result = $this->resBuilder('password salah', 422, 'Unsuccessfuly Data');
                else :
                    $result = $this->resBuilder(
                        array('user' => $email, 'token' => $this->user->createToken('task-5-fullstack')->accessToken)
                    );
                endif;
            endif;
        }

        return $result;
    }
    public function register(Request $register)
    {
        $costum = [
            'email' => ':attribute jangan di kosongkan',
            'password' => ':attribute jangan di kosongkan',
        ];

        $validate = Validator::make($register->all(), [
            'email' => 'required|string|min:4|email',
            'name' => 'required|string|min:4',
            'password' => 'required|string|min:4',
            'confirm_pass' => 'required|same:password'
        ], $costum);

        if (!$validate->fails()) {
            $submitReg = $register->only('email', 'name', 'password');
            $submitReg['password'] = Hash::make($register->password);

            if (!$this->user->where('email', $register->email)->first()) :
                $result = $this->resBuilder($this->user->create($submitReg));
            else :
                $result = $this->resBuilder($register->email, 'email sudah terdaftar', 422);
            endif;
        } else {
            $result = $this->customError(collect($validate->errors()));
        }

        return $result;
    }
}
