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
       $input = '';
       if($request->isJson()){
           $input = $request->json()->all();
       }else {
           $input = $request->all();
       }
        // $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors() , 400);
        }

        $input['password'] = bcrypt($input['password']);
        try{
            $user = User::create($input);
            $success['token'] = $user->createToken($user->name)->accessToken;
            return response()->json($success, $this->successStatus);

        }catch(\Illuminate\Database\QueryException  $exception){
            return response()->json($exception, 400);
        }



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
