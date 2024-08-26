<?php

namespace App\Http\Controllers\Courses\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Course;
use App\Models\CourseSave;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{

    //function for return all courses view
    public function index()
    {
        try {
            //get all courses
            $courses = Course::where('status', 1)
                ->withCount('coursesSaved')
                ->orderByDesc('courses_saved_count')
                ->get();

            return view('students.courses')
                ->with('playlists', $courses);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for search on courses
    public function search(SearchRequest $request)
    {
        try {
            //search on courses
            $courses = Course::where('status', 1)
                ->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                })
                ->withCount('coursesSaved')
                ->orderByDesc('courses_saved_count')
                ->get();

            return view('students.search_course')
                ->with('playlists', $courses);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end search


    //function for return playlist view with playlist content
    public function playlistDetailsView($id)
    {
        try {
            //get course by id
            $course = Course::withCount('contents')->findOrFail($id);

            if ($course->status == 0) {
                return abort(404);
            } //end

            //get auth user
            $uathUser = Auth::guard(getStudentGaurd())->user();

            //check auth user is saved course or no
            $isUserSaved = CourseSave::where('course_id', $id)
                ->where('student_id', $uathUser->id)
                ->count() > 0;

            //get course contents
            $videos =  $course->contents()
                ->where('status', 1)
                ->where('content_type_id', 1)
                ->get();

            $assignments = $course->contents()
                ->where('status', 1)
                ->where('content_type_id', 2)
                ->get();

            $lessons = $course->contents()
                ->where('status', 1)
                ->where('content_type_id', 3)
                ->get();

            return view('students.playlist')
                ->with('course', $course)
                ->with('isUserSaved', $isUserSaved)
                ->with('videos', $videos)
                ->with('assignments', $assignments)
                ->with('lessons', $lessons);

        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end playlistDetails

}//end StudentCourseController
