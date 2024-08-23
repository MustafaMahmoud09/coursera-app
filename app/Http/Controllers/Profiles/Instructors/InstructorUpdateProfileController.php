<?php

namespace App\Http\Controllers\Profiles\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\UpdateProfileRequest;
use App\Models\Instructor;
use App\Models\Profession;
use App\Traits\Controllers\File\DeleteFile;
use App\Traits\Controllers\File\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorUpdateProfileController extends Controller
{
    use UploadFile, DeleteFile;

    //function for return update profile view
    public function index()
    {
        try {
            //get auth instructor
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get new data for this instructor
            $instructor = Instructor::findOrFail($authUser->id);

            //get all professions
            $professions = Profession::get();

            return view('instructors.update')
                ->with('instructor', $instructor)
                ->with('professions', $professions);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index

    //function for update instructor info
    public function update(UpdateProfileRequest $request)
    {
        //get auth user
        $authUser = Auth::guard(getInstructorGuard())->user();

        //validate
        $request->validate(
            [
                'profession' => 'sometimes|nullable|numeric|exists:professions,id',
                'email' => 'sometimes|nullable|unique:instructors,email,' . $authUser->id
            ]
        );

        try {
            //get instructor
            $instructor = Instructor::find($authUser->id);
            $oldPath = $instructor->image_path;

            if ($request->password) {
                $check = isPasswordCorrect(
                    plainPassword: $request->old_password ?: "",
                    hashedPassword: $instructor->password
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
                $instructor->name = $request->name;
            } //end if

            if ($request->email) {
                $instructor->email = $request->email;
            } //end if

            if ($request->password) {
                $instructor->password = encryptPassword($request->password);
            } //end if

            if ($request->avatar) {
                $path = $this->uploadFile(
                    request: $request,
                    key: 'avatar',
                    folder: 'instructor/' . $instructor->email
                );
                $instructor->image_path = $path;
            } //end if

            $instructor->profession_id = $request->profession;

            //save this update
            $instructor->save();

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

}//end InstructorUpdateProfileController
