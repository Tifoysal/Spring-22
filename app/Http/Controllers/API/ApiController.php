<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getAllUsers()
    {
        $users=User::all();
        $data=UserResource::collection($users);
       return $this->responseWithSuccess($data,'User List loaded');
    }

    public function createUser(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);

        if($validate->fails())
        {
            return $this->responseWithError($validate->getMessageBag());
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        return $this->responseWithSuccess($user,'User created.');

    }

    public function viewUser($id)
    {
        $user=User::find($id);
        if($user)
        {
            return $this->responseWithSuccess(UserResource::make($user),'Single user loaded.');
        }
        return $this->responseWithError('No user found.');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->responseWithSuccess(['token'=>$token,$user],'User logged in successful.');
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'Bearer',
//        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return $this->responseWithSuccess([],'User log out successful.');
    }
}
