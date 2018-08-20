<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function login(){

        $email = request('email');
        $password = request('password');
        $credentials = compact('email', 'password');
        if(!$token = Auth::attempt($credentials)){
            return response()->json(['error'=>'Your email or password is not correct.'], 401);
        }
        return  $this->respondWithToken($token);
//        return response()->json($token, 200);
    }

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:200|min:2|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        $user = User::create(compact('name', 'email', 'password'));
        return $this->login($request);

    }
    //extract user info when logged in
    public function me()
    {
        return response(auth()->user(), 200);
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }
}
