<?php

namespace App\Http\Controllers\Auth\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Instructor;
use App\Models\Profession;
use App\Traits\Controllers\File\UploadFile;
use Illuminate\Http\Request;

class InstructorRegisterController extends Controller
{

    use UploadFile;

    //function for return register view
    public function index()
    {
        //get professions from gdb
        $professions = Profession::get(['id', 'profession']);

        return view('instructors.register')->with('professions', $professions);
    } //end index


    //function for create new instructor in global db
    public function store(RegisterRequest $request)
    {

        $request->validate(
            [
                'profession' => 'required|numeric|exists:professions,id',
                'email' => 'unique:instructors,email'
            ]
        );

        //upload instructor photo in server here
        $path = $this->uploadFile(
            request: $request,
            key: 'avatar',
            folder: 'instructor/' . $request->email
        );

        //create new instructor in global database
        $student = Instructor::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'image_path' => $path,
                'profession_id' => $request->profession,
                'password' => encryptPassword(
                    password: $request->password
                )
            ]
        );

        //redirct for login page
        return redirect()->route('instructor.login');
    } //end store


}//end InstructorRegisterController
