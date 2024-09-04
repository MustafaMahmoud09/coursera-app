<?php

namespace App\Http\Controllers\CourseBuyings;

use App\Http\Controllers\Controller;
use App\Models\Buying;
use App\Models\Course;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorBuyingCourseController extends Controller
{

    //function for provide instructor students
    public function index()
    {
        try {
            //get auth user
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get instructor courses
            $courses = $authUser->courses()->pluck('id');

            //get all courses buyings
            $buyings = Buying::whereIn('course_id', $courses)
                ->selectRaw('student_id,COUNT(*) as total_purchases, SUM(course_price) as total_amount')
                ->groupBy('student_id')
                ->orderByDesc('total_amount')
                ->get();

            return view('instructors.students')
                ->with('buyings', $buyings);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for return purchases course view
    public function purchasesCourseView($id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get student by id
            $student = Student::findOrFail($id);

            //get instructor courses
            $courses = $authUser->courses()->pluck('id');

            //get student purchases
            $buyings = $student->buyings()
                ->whereIn('course_id', $courses)
                ->distinct('course_id')
                ->get();

            return view('instructors.student_courses_purchases')
                ->with('buyings', $buyings);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end purchasesCourseView


    //function for provide course students
    public function courseStudents($id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get course by id
            $course = Course::findOrFail($id);

            if ($authUser->id != $course->instructor_id) {
                return abort(401);
            } //end if

            //get all student course
            $students = Buying::where('course_id', $id)
                ->distinct('student_id')
                ->pluck('student_id');

            //get all courses buyings
            $buyings = Buying::whereIn('student_id', $students)
                ->whereHas('course', function ($query) {
                    //get auth user
                    $authUser = Auth::guard(getInstructorGuard())->user();
                    $query->where('instructor_id', $authUser->id);
                })
                ->selectRaw('student_id,COUNT(*) as total_purchases, SUM(course_price) as total_amount')
                ->groupBy('student_id')
                ->orderByDesc('total_amount')
                ->get();


            return view('instructors.students')
                ->with('buyings', $buyings);
        } //end try
        catch (Exception $ex) {
            abort(500);
        } //end catch
    } //end courseStudents

}//end InstructorBuyingCourseController
