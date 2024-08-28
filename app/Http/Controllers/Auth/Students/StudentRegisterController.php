<?php

namespace App\Http\Controllers\Auth\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Student;
use App\Traits\Controllers\File\UploadFile;
use Exception;
use Illuminate\Http\Request;

class StudentRegisterController extends Controller
{

    use UploadFile;

    //function for return register view
    public function index()
    {
        try {
            return view("students.register");
        } //end try
        catch (Exception $ex) {
            return abort(400);
        } //end catch
    } //end index


    //function for create new student in global db
    public function store(RegisterRequest $request)
    {
        try {
            $request->validate(
                [
                    'email' => 'unique:students,email'
                ]
            );

            //upload student photo in server here
            $path = $this->uploadFile(
                request: $request,
                key: 'avatar',
                folder: 'students/' . $request->email
            );

            //create new student in global database
            $student = Student::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'image_path' => $path,
                    'password' => encryptPassword(
                        password: $request->password
                    )
                ]
            );

            //redirct for login page
            return redirect()->route('student.login');
        } //end try
        catch (Exception $ex) {
            return abort(400);
        } //end catch
    } //end store

}//end StudentRegisterController
