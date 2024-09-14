<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users|email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string'
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('login')->with('success','Registration successful. Please login.');

    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            if(Auth::user()->role === 'packer'){
                return redirect()->route('products')->with('success','Login successful!');
            }else{
                return redirect()->route('add.product')->with('success','Login successful!');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials!'])->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Logout successful!');
    }
}
