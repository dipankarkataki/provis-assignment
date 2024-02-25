<?php

namespace App\Http\Controllers\Logout;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
        User::where('email', Auth::user()->email)->update([
            'login_user_ip' => null
        ]);

        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
