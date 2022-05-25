<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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
}
