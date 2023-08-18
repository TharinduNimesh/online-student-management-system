<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected function login(Request $request) {
        // get credentials from request
        $credentials = $request->only('email', 'password');

        // attempt to login
        if (Auth::attempt($credentials)) {
            // if success, create success response
            $user = Auth::user();
            $response = [
                "status" => "success",
            ];

            // check user role
            if($user->role_id == 1 || $user->role_id == 2) {
                $response['role'] = 'admin';
            } else if($user->role_id == 3) {
                $response['role'] = 'officer';
            } else if($user->role_id == 4) {
                $response['role'] = 'teacher';
            } else {
                $response['role'] = 'student';
            }

            // return response
            return response()->json($response);
        } else {
            // if failed, return failed response
            return response()->json([
                'status' => 'failed',
                'password' => Hash::make($request->password)
            ]);
        }
    }

    protected function setPassword(Request $request) {
        // update student as verified
        $student = Student::find($request->id);
        $student->update([
            'verified_at' => Carbon::now()->toDate(),
        ]);

        // create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);

        // return response
        return response()->json([
            'status' => 'success',
        ]);
    }

    protected function logout() {
        // logout user and redirect to home
        Auth::logout();
        return redirect()->route('home.index');
    }
}
