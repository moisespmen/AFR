<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (strpos($credentials['login'], '@') !== false) {
            $credentials['email'] = $request['login'];
            unset($credentials['login']);
        } else {
            $credentials['name'] = $request['login'];
            unset($credentials['login']);
        }

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['errors' => 'Erro ao autenticar, verifique seu usuário e senha'], 401);
        }
        $user = Auth::user();
        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
        return response()->json(['token' => $token, 'user' => $user ], 200);
    }

    public function alterarSenha(Request $request) {
        $user = Auth::user();
        if(!$user) {
            return redirect()->to('/');
        }

        if(!$request['nova'] || $request['confirmacao'] || $request['nova'] !== $request['confirmacao']) {
            return response()->json(['errors' => 'As senhas não conferem'], 422);
        }

        if (!Hash::check($request->atual, $user->password)) {
            return response()->json(['errors' => 'A senha atual está incorreta'], 400);
        }

        $user->password = Hash::make($request->nova);
        $user->save();
        return response()->json(['Senha alterada com sucesso!'], 200);
    }
}
