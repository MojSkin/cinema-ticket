<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\IranMobile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $tokenString = 'MovieTicketByMojSkin';

    public function showLoginForm() {
        return view('auth.login');
    }

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function login(Request $request) {
        $request->validate([
            'mobile' => ['required', 'string', 'min:9', 'max:14', new IranMobile],
            'password' => 'required',
        ]);

        // User is exists?
        $user = User::whereMobile($this->prepareMobile($request->mobile))->first();
        if (!$user or !Hash::check($request->password, $user->password)) {
            return response(['status' => false, 'message' => 'Invalid credentials.'], 401);
        }

        // Login user
        Auth::loginUsingId($user->id, true);

        // Associate authenticate token for API uses
        $user_token = Auth::user()->createToken($this->tokenString)->plainTextToken;

        return response(['status' => true, 'token' => $user_token], 200);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => ['required', 'string', 'min:9', 'max:14', 'unique:users,mobile', new IranMobile],
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'mobile' => $this->prepareMobile($request->mobile),
            'password' => bcrypt($request->password),
        ]);

        Auth::loginUsingId($user->id, true);
        $user_token = $user->createToken($this->tokenString)->plainTextToken;

        return response(['status' => true, 'token' => $user_token], 201);
    }

    public function logout(Request $request) {
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
            Auth::logout();
        }
        return redirect()->route('welcome');
    }

    public function prepareMobile($value) {
        $preparedMobile = '';
        if ((bool) preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || (bool) preg_match('/^(9){1}[0-9]{9}+$/', $value)) {
            $preparedMobile = '+98'.substr($value, strlen($value)-10);
        }
        return $preparedMobile;
    }
}
