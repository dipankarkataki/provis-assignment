<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['error' => 'Oops! ' . $validator->errors()->first()]);
        } else {
            try {

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                    if (Auth::user()->login_user_ip == $_SERVER['REMOTE_ADDR']) {
                        if ($request->close_session != null) {
                            Auth::logoutOtherDevices($request->password);
                            User::where('email', $request->email)->update([
                                'login_user_ip' => $_SERVER['REMOTE_ADDR']
                            ]);
                            return redirect()->route('user.get.dashboard');
                        }
                        return back()->with(['session_active' => 'A session is already active'])->withInput($request->all());
                    } else {
                        User::where('email', $request->email)->update([
                            'login_user_ip' => $_SERVER['REMOTE_ADDR']
                        ]);
                        return redirect()->route('user.get.dashboard');
                    }
                } else {
                    return back()->withErrors(['error' => 'Invalid credentials']);
                }
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Oops! Something went wrong']);
            }
        }
    }
}
