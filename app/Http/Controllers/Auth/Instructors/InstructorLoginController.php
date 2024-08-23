<?php

namespace App\Http\Controllers\Auth\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorLoginController extends Controller
{

    //function for return login view
    public function index()
    {
        return view('instructors.login');
    } //end index


    //function for login for instructor
    public function login(LoginRequest $request)
    {

        //validate on student info exist in request or no
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //
        if (Auth::guard(getInstructorGuard())->attempt($credentials)) {
            //generate session for store student info
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        } //end if

        return back()->withErrors([
            'email' => 'The email or password you entered is incorrect. Please try again.',
        ]);
    } //end login

}//end InstructorLoginController
