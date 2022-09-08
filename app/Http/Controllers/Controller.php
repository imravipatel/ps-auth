<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }

    public function getUsersWithAuth(){
        $users = User::all();
        return response()->json($users, 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            $responseArray = [];
            $responseArray['token'] = $user->createToken('MyApp');
            $responseArray['name'] = $user->name;

            return response()->json($responseArray, 200);
        }else{
            return response()->json(['error'=>'Unauthenticated'], 203);
        }
    }
    
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),202);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $responseArray = [];
        $responseArray['token'] = $user->createToken('temp')->accessToken;
        $responseArray['name'] = $user->name;

        return response()->json($responseArray, 200);
    }
}
