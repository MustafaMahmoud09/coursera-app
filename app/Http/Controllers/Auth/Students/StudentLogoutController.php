<?php

namespace App\Http\Controllers\Auth\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLogoutController extends Controller
{

    //function for generate user logout
    public function logout(Request $request)
    {

        Auth::guard(getStudentGaurd())->logout();

        return redirect()->route('home');

    } //end logout


}//end LogoutController
