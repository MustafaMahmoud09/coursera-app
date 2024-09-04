<?php

namespace App\Http\Controllers\Auth\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorLoginController extends Controller
{

    //function for return login view
    public function index()
    {
        try {
            return view('instructors.login');
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for login for instructor
    public function login(LoginRequest $request)
    {
        //validate on student info exist in request or no
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {

            //
            if (Auth::guard(getInstructorGuard())->attempt($credentials)) {
                //generate session for store student info
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            } //end if

            return back()->withErrors([
                'email' => 'The email or password you entered is incorrect. Please try again.',
            ]);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end login

}//end InstructorLoginController
