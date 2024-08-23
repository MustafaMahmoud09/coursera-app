<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Instructor;
use Exception;
use Illuminate\Http\Request;

class StudentTeacherController extends Controller
{

    //function for return teachers view with all teachers
    public function index()
    {
        try {
            //get all instructors
            $instructors = Instructor::withCount('contents')
                ->withCount('courses')
                ->orderByDesc('contents_count')
                ->orderByDesc('created_at')
                ->get();

            return view('students.teachers')
                ->with('teachers', $instructors);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for search on teachers
    public function search(SearchRequest $request)
    {
        try {
            //get all instructors
            $instructors = Instructor::withCount('contents')
                ->where('name', 'like', '%' . $request->search . '%')
                ->withCount('courses')
                ->orderByDesc('contents_count')
                ->orderByDesc('created_at')
                ->get();

            return view('students.search_tutor')
                ->with('teachers', $instructors);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end search


    //function for provide tutor profile view
    public function tutorProfileView($id)
    {
        try {
            //get teacher by id
            $teacher = Instructor::withCount('contents')
                ->withCount('courses')
                ->findOrFail($id);

            //get teacher playlists
            $playlists = $teacher->courses()
                ->where('status', 1)
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();

            return view('students.tutor_profile')
                ->with('teacher', $teacher)
                ->with('playlists', $playlists);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end tutorProfileView

}//end StudentTeacherController
