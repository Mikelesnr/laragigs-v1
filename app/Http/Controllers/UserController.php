<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Resgister/Create Form
    public function create(){
        return view('users.register');
    }

    //Create New usser
    public function store(Request $request){
        $formFields= $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','confirmed','min:6']
            
        ]);

        //Hash password
        $formFields['passwords'] = bcrypt($formFields['password']);

        // Create user
        $user= User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/')->with('message','User created and logged in');

    }

    // logout
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with("message",'You\'ve been logged out');
    }

    // Show Login Form
    public function login(){
        return view('users.login');
    }

    //Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email'=>['required','email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message',"You have logged in!");
        }
        
        return back()->withErrors(['email'=> 'Invalid Credentials'])->onlyInput('email');

    }
}
