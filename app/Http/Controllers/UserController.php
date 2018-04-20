<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    //
    public $successStatus = 200;

    public function register(Request $request) {
        
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken($user->name)->accessToken;
        // $success['name'] = $user->name;

        return response()->json($success, $this->successStatus);
    }

    public function login() {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] = $user->createToken($user->name)->accessToken;
            return response()->json($success, $this->successStatus);
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function details () {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
