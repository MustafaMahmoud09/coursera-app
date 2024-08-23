<?php

namespace App\Http\Controllers\Auth\Instructors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorLogoutController extends Controller
{

    //function for generate user logout
    public function logout(Request $request)
    {

        Auth::guard(getInstructorGuard())->logout();

        return redirect()->route('home');

    } //end logout

}//end InstructorLogoutController
