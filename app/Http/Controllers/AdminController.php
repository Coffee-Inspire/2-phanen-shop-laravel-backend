<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        return Admin::all();
    }

    public function show(Admin $admin)
    {
        return $admin;
    }

    public function store(Request $request)
    {
        return Admin::create($request->all());
    }

    public function update(Request $request)
    {
        $admin = JWTAuth::user();

        $credentials = (['username' => $request->username_old, 'password' => $request->password_old]);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
            // if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 200);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'string|max:255',
            // 'email' => 'sometimes|required|string|email|max:255|unique:admins',
            // 'password' => 'required|string|min:6|confirmed',
            'password' => 'sometimes|required|string|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        //check if user want to change pass
        if(array_key_exists("password", $request->all())){
            $request->merge([
                'password' => Hash::make($request->get('password'))
            ]);
        }

        $admin->update($request->all());

        return response()->json($admin, 200);
    }

    public function getUser()
    {
		return JWTAuth::parseToken()->toUser();
		// return JWTAuth::parseToken()->toUser()['id'];
        // $user = Admin::select('*')->where('id', 1)->get();
        // return ['user' => $user];
    }

    public function logout()
    {
        // return auth()->logout();
        if (auth('api')->check()){
			JWTAuth::invalidate(JWTAuth::getToken());
		}

        // error_log("tes");

        // auth()->logout();
		return response()->json(['msg' => "Successfully logged out"], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 200);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // $user = Auth::user();
        $user = JWTAuth::user();
        $token  = 'Bearer ' . $token;
        return response()->json(compact('user', 'token'), 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:admins',
            // 'password' => 'required|string|min:6|confirmed',
            'password' => 'required|string|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = Admin::create([
            'username' => $request->get('username'),
            // 'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        // $token = JWTAuth::fromUser($user);      //create token

        // return response()->json(compact('user','token'),201); // I dont want give token when register
        return response()->json(compact('user'),201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('admin'));
    }
}
