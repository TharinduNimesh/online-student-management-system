<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
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

    protected function register(Request $request) {
        // check if user already exists
        $user = User::where('email', $request->email)->first();
        if($user) {
            return redirect()->back()->with('error', 'User already exists With this email');
        }

        $modal = null;
        if($request->role == 'student') {
            $modal = Student::class;
            $role_id = 5;
        } else if($request->role == 'teacher') {
            // $modal = Teacher::class;
            $role_id = 4;
        } else if($request->role == 'officer') {
            // $modal = Officer::class;
            $role_id = 3;
        }

        // create user
        $modal::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'city_id' => $request->city,
            'gender_id' => $request->gender,
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Your request has been sent successfully. Please wait for the admin to verify your account.');
    }

    protected function setPassword(Request $request) {
        // update user as verified
        if ($request->role == 5) {
            $student = Student::find($request->id);
            $student->update([
                'verified_at' => Carbon::now()->toDate(),
            ]);
        } else if ($request->role == 4) {
            $teacher = Teacher::find($request->id);
            $teacher->update([
                'verified_at' => Carbon::now()->toDate(),
            ]);
        } else if ($request->role == 3) {
            // $officer = Officer::find($request->id);
            // $officer->update([
            //     'verified_at' => Carbon::now()->toDate(),
            // ]);
        }


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
