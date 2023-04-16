<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(ProfileRequest $request)
    {
        $request = $request->validated();
        $user = Auth::user();
        if (Hash::check($request['password'], $user->getAuthPassword())) {
            if (isset($request['role'])) {
                $user->fill([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'role' => $request['role'],
                    'password' => Hash::make($request['password_new'])
                ]);
            } else {
                $user->fill([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password_new'])
                ]);
            }
            $user->save();
        }
        return redirect()->back();
    }
}
