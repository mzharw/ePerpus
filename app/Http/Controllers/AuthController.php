<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\User;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { 
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $rules = [
            'username'                 => 'required|string',
            'password'              => 'required|string'
        ];

        $messages = [
            'username.required'        => 'Username wajib diisi',
            'username.string'           => 'Username tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'username'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            Session::put('username',$data['username']);
            return redirect()->route('dashboard');
        } else { 
            Session::flash('error', 'Username atau password salah');
            return redirect()->route('login');
        }

    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
