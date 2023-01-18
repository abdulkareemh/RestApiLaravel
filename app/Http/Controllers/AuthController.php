<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function store(Request $request){
      $user =  User::create([
         'name' => $request['name'],
         'email' => $request['email'],
         'password' => Hash::make($request['password']),
     ]);
     $token=$user->createToken('apptoken')->plainTextToken;

     $responce=[
      'user'=>$user,
      'token'=>$token,

     ];
     return response($responce,201);
   }

   public function login(loginRequest $request){
      $user = User::where('email', $request['email'])->first();

      // Check password
      if(!$user || !Hash::check($request['password'], $user->password)) {
          return response([
              'message' => 'Bad creds'
          ], 401);
      }

      $token = $user->createToken('myapptoken')->plainTextToken;

      $response = [
          'user' => $user,
          'token' => $token
      ];

      return response($response, 201);
   }

   public function get(){
      return User::all();
   }

   public function logout(Request $request){
      // $user = User::where();
      // $user->tokens()->where('id', $request[''])->delete();
      // return $user;
      // return Auth::user()->tokens()->delete();
      // auth('sanctum')->user()->tokens()->delete();
      if ($request->user()) { 
         $request->user()->tokens()->delete();
     }
 
     return response()->json(['message' => 'loccgged out'], 200);
      
   }
}
