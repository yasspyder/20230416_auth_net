<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexHomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function addUser(
        RegistrationRequest $request,
        User $user
    ) {
        if ($request->isMethod('post')) {
            $request = $request->validated();

            $user->fill([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);
            $user->save();
            return redirect()->route('index');
        }
        return view('registration');
    }

    public function account()
    {
        $user = Auth::user();
        return view('account', ['user' => $user]);
    }
}
