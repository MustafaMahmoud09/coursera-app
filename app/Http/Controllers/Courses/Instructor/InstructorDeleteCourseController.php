<?php

namespace App\Http\Controllers\Courses\Instructor;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteCourseJob;
use App\Models\Course;
use App\Traits\Controllers\File\DeleteFile;
use App\Traits\Controllers\File\UploadFile;
use Exception;
use Illuminate\Support\Facades\Auth;

class InstructorDeleteCourseController extends Controller
{
    use UploadFile, DeleteFile;

    //function for delete course
    public function delete($id)
    {
        try {
            //get user auth here
            $authUser = Auth::guard(getInstructorGuard())->user();

            //find playlist or fail
            $playlist = Course::find($id);

            if (!$playlist) {
                return abort(404);
            } //end if

            //conditon auth user is playlist owner or no
            if ($authUser->id != $playlist->instructor_id) {
                return abort(401);
            } //end if

            //dispatch job for delete course with course files
            dispatch(new DeleteCourseJob(
                playlist: $playlist
            ));

            return back()->withErrors(
                [
                    'success' => 'playlist deleted!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end delete

}//end InstructorDeleteCourseController
