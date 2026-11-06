<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();

            return redirect()->intended('dashboard');
        }

        return view('auth.login');
    }

    public function login_auth(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|string',
                'password' => 'required|min:8|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }

            $remember = $request->has('remember');

            if (Auth::attempt($request->only('email', 'password'), $remember)) {
                $user = Auth::user();

                if($user->two_factor_enabled)
                {
                    $user->generateTwoFactorCode();
                    $user->notify(new TwoFactorCodeNotification());

                    Auth::logout();
                    $request->session()->put('2fa_user_id', $user->id);

                    return response()->json([
                        'redirect' => url('/2fa/challenge')
                    ]);
                }

                $request->session()->regenerate();

                return response()->json([
                    'redirect' => url('dashboard')
                ]);
            }

            return response()->json(['message' => ['email' => ['Invalid credentials!']]], 422);

        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $user = User::findOrFail($id);
            $user->is_online = false;
            $user->last_seen_at  = now();
            $user->save();
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
