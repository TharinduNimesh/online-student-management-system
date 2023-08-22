<?php

namespace App\Http\Controllers;

use App\Mail\setPassword;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OfficerController extends Controller
{
    public function create(Request $request)
    {
        $user = User::where('email', $request->email)
        ->first();

        if($user) {
            return redirect()->back()->with('error', 'Email already exists');
        }

        $officr = Officer::create([
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "city_id" => $request->city,
            "gender_id" => $request->gender
        ]);

        $data = [
            'name' => $request->name,
            'role' => 'teacher',
            'id' => $officr->id,
        ];

        Mail::to($request->email)->send(new setPassword($data));

        return redirect()->back()->with('success', 'Officer created successfully');
    }

    public function delete(Request $request)
    {
        $officer = Officer::find($request->id);

        $officer->delete();

        return redirect()->back()->with('success', 'Officer deleted successfully');
    }
}
