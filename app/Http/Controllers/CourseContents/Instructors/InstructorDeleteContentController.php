<?php

namespace App\Http\Controllers\CourseContents\Instructors;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteContentJob;
use App\Models\Content;
use App\Traits\Controllers\File\DeleteFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorDeleteContentController extends Controller
{
    use DeleteFile;

    //function for delete course content
    public function delete($id)
    {
        try {
            //get user auth here
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get content
            $content = Content::find($id);

            if (!$content) {
                return abort(404);
            } //end if

            if ($content->instructor_id != $authUser->id) {
                return abort(401);
            } //end if

            //dispatch job for delete course content
            dispatch(new DeleteContentJob(
                content: $content
            ));

            return back()->withErrors(
                [
                    'success' => 'content deleted!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end delete

}//end InstructorDeleteContentController
