<?php

namespace App\Http\Controllers\CourseBookMark;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSave;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseSaveController extends Controller
{

    //function for return bookmark view
    public function index()
    {
        try {
            //get student auth
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get student auth book mark
            $bookMarks = $authUser->coursesSaved()
                ->whereHas('course', function ($query) {
                    $query->where('status', 1);
                })
                ->orderByDesc('created_at')
                ->get();

            return view('students.bookmark')
                ->with('bookMarks', $bookMarks);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for save course by student
    public function store($id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get content by id
            $course = Course::findOrFail($id);

            $isSaved = CourseSave::where('student_id', $authUser->id)
                ->where('course_id', $course->id)
                ->exists();
            if (!$isSaved) {

                //create new react on video here
                CourseSave::create(
                    [
                        'student_id' => $authUser->id,
                        'course_id' => $id
                    ]
                );

                return back()->withErrors(
                    [
                        'error' => 'course saved!'
                    ]
                );
            } //end if
            else {
                //delete react if exist
                CourseSave::where('student_id', $authUser->id)
                    ->where('course_id', $course->id)
                    ->delete();

                return back()->withErrors(
                    [
                        'error' => 'course save deleted!'
                    ]
                );
            } //end else
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store

}//end StudentCourseSaveController
