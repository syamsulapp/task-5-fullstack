<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthData;
use App\Models\DeleteToken;
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
            'min' => 'minimal 4 karakter'
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
                if (AuthData::attempt(['email' => $login->email, 'password' => $login->password])) {
                    $user = $this->user->user();
                    $data = array('user' => $user, 'token' => $user->createToken('task-5-fullstack')->accessToken);
                    $result = $this->resBuilder($data);
                } else {
                    $result = $this->resBuilder('password salah', 422, 'wrong password');
                }
            endif;
        }

        return $result;
    }
    public function register(Request $register)
    {
        $costum = [
            'email' => ':attribute jangan di kosongkan',
            'password' => ':attribute jangan di kosongkan',
            'min' => 'minimal 4 karakter'
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
            // check if email registered
            !$this->user->where('email', $register->email)->first() ?
                $result = $this->resBuilder($this->user->create($submitReg)) :
                $result = $this->resBuilder($register->email, 422, 'email sudah terdaftar');
        } else {
            $result = $this->customError(collect($validate->errors()));
        }

        return $result;
    }

    public function logout()
    {
        $user = $this->user->user()->id;
        DeleteToken::where('user_id', $user)->delete();
        return $this->resBuilder('Berhasil Logout');
    }

    public function user()
    {
        return $this->user->user();
    }
}
