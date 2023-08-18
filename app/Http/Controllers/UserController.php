<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $response = [
                "status" => "success",
            ];

            if($user->role_id == 1 || $user->role_id == 2) {
                $response['role'] = 'admin';
            } else if($user->role_id == 3) {
                $response['role'] = 'officer';
            } else if($user->role_id == 4) {
                $response['role'] = 'teacher';
            } else {
                $response['role'] = 'student';
            }

            return response()->json($response);
        } else {
            return response()->json([
                'status' => 'failed',
                'password' => Hash::make($request->password)
            ]);
        }
    }
}
