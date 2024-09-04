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
    public function store(Request $request, $id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get content by id
            $course = Course::findOrFail($id);

            $isSaved = CourseSave::where('student_id', $authUser->id)
                ->where('course_id', $course->id)
                ->exists();
            if (!$isSaved && $request->type == '0') {

                //create new react on video here
                CourseSave::create(
                    [
                        'student_id' => $authUser->id,
                        'course_id' => $id
                    ]
                );
            } //end if
            else if ($isSaved && $request->type == '1') {
                //delete react if exist
                CourseSave::where('student_id', $authUser->id)
                    ->where('course_id', $course->id)
                    ->delete();
            } //end else

            return view('layouts.book-mark')
                ->with('isUserSaved', $request->type == '0');
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store

}//end StudentCourseSaveController
