<?php

namespace App\Http\Controllers\Auth\Students;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLogoutController extends Controller
{

    //function for generate user logout
    public function logout(Request $request)
    {
        try {
            Auth::guard(getStudentGaurd())->logout();

            return redirect()->route('home');
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end logout


}//end LogoutController
