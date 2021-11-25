<?php

namespace App\Http\Controllers\Api\v1;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   /**
    * Register
    */
   public function register(Request $request)
   {
      try {
         $user = new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->phone = $request->phone;
         $user->password = Hash::make($request->password);
         $user->admin = $request->admin;
         $user->save();

         $success = true;
         $message = 'User register successfully';
      } catch (\Illuminate\Database\QueryException $ex) {
         $success = false;
         $message = $ex->getMessage();
      }

      $response = [
         'success' => $success,
         'message' => $message,
      ];
      return response()->json($response);
   }

   /**
    * Login
    */
   public function login(Request $request)
   {
      $credentials = [
         'email' => $request->email,
         'password' => $request->password,
      ];

      $success = Auth::attempt($credentials) ? true : false;

      $response = [
         'success' => $success,
      ];
      return response()->json($response)->setStatusCode(200);
   }

   /**
    * Logout
    */
   public function logout()
   {
      try {
         Session::flush();
         $success = true;
         $message = 'Successfully logged out';
      } catch (\Illuminate\Database\QueryException $ex) {
         $success = false;
         $message = $ex->getMessage();
      }

      $response = [
         'success' => $success,
         'message' => $message,
      ];
      return response()->json($response)->setStatusCode(200);
   }
}
