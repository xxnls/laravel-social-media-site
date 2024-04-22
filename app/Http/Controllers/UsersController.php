<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class UsersController extends Controller
{
    //Show register/create form
    public function create(){
        return view('users.register', ["pageTitle"=>"Register"]);
    }

    //Store new user
    public function store(Request $request){
        $formFields = $request->validate([
            //'name' => ['required', 'min:5'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'first_name' => ['required', 'min:2', 'max:100'],
            'last_name' => ['required', 'min:2', 'max:100'],
            'gender' => ['required'],
            'date_of_birth' => ['required', 'date']
        ]);

        //Create username
        $formFields['name'] = strtolower(substr($request->input('first_name'), 0, 3) . substr($request->input('last_name'), 0, 3) . mt_rand(10000, 99999));

        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create new user
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/home')->with('message', 'User created successfully.');
    }

    //Logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home')->with('message', 'User logged out successfully.');
    }

    //Show login form
    public function login(){
        return view('users.login', ["pageTitle"=>"Login"]);
    }

    //Authenticate user
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($credentials)){
            $request->session()->regenerate();

            return redirect('/home')->with('message', 'User logged in successfully.');
        }

        return back()->withErrors(['login_info' => 'The provided credentials do not match our records.',])->onlyInput();}
    }
