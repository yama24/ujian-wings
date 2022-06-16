<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function actionlogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $data = Login::where('User', $username)->first();
        if ($data) {
            if (password_verify($password, $data->Password)) {
                session(['username' => $username]);
                return redirect('/products');
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
