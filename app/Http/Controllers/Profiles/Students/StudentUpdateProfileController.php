<?php

namespace App\Http\Controllers\Profiles\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\UpdateProfileRequest;
use App\Models\Student;
use App\Traits\Controllers\File\DeleteFile;
use App\Traits\Controllers\File\UploadFile;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentUpdateProfileController extends Controller
{
    use UploadFile, DeleteFile;

    //function for return update profile view
    public function index()
    {
        try {
            return view('students.update');
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for update student info
    public function update(UpdateProfileRequest $request)
    {
        //get auth user
        $authUser = Auth::guard(getStudentGaurd())->user();

        //validate
        $validated = $request->validate(
            [
                'email' => 'sometimes|nullable|unique:students,email,' . $authUser->id
            ]
        );

        try {
            //get instructor
            $student = Student::find($authUser->id);
            $oldPath = $student->image_path;

            if ($request->password) {
                $check = isPasswordCorrect(
                    plainPassword: $request->old_password ?: "",
                    hashedPassword: $student->password
                );

                if (!$check) {
                    return back()->withErrors(
                        [
                            'error' => 'old password not correct'
                        ]
                    );
                } //end if
            } //end if

            if ($request->name) {
                $student->name = $request->name;
            } //end if

            if ($request->email) {
                $student->email = $request->email;
            } //end if

            if ($request->password) {
                $student->password = encryptPassword($request->password);
            } //end if

            if ($request->avatar) {
                $path = $this->uploadFile(
                    request: $request,
                    key: 'avatar',
                    folder: 'students/' . $student->email
                );
                $student->image_path = $path;
            } //end if

            //save this update
            $student->save();

            if ($request->has('avatar')) {
                $this->deleteFile($oldPath);
            } //end if

            //back for last route with this message
            return back()->withErrors(
                [
                    'success' => 'profile updated!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch

    } //end update

}//end StudentUpdateProfileController
