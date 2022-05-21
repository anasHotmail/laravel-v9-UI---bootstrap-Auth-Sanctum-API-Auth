<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8'],
            'c_password'=> 'required|same:password'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validate Error',$validator->errors() );
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('AnasEidDalal')->plainTextToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User registered Successfully!' );
    }



    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User Login Successfully!' );
        }
       else{
            return $this->sendError('Unauthorised',['error','Unauthorised'] );
        }

    }

    //---------------------------------- Test Function -----------------------------------------
    public function test()
    {
        $user = Auth::user();
            $success['name'] = $user->name;
            $success['id'] = $user->id;

        return $this->sendResponse($success, 'Your Test Grand Successfully!' );

    }

    //---------------------------------- Test2 Function All user info---------------------------
    public function test2()
    {
        $user = Auth::user();

            $success = $user;

        return $this->sendResponse($success, 'All info Grand Successfully!' );

    }




}
