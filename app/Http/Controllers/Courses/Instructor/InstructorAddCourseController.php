<?php

namespace App\Http\Controllers\Courses\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\AddCourseRequest;
use App\Models\Course;
use App\Traits\Controllers\File\DeleteFile;
use App\Traits\Controllers\File\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorAddCourseController extends Controller
{
    use UploadFile, DeleteFile;

    //function for return add playlist view
    public function index()
    {
        try {
            return view('instructors.add_playlist');
        } //end try
        catch (Exception $ex) {
            return abort(500);
        }
    } //end showAddPlaylistView

    //function for store new course for auth inst
    public function store(AddCourseRequest $request)
    {
        try {

            //get user auth here
            $authUser = Auth::guard(getInstructorGuard())->user();

            //store imahe in server here
            $path = $this->uploadFile(
                request: $request,
                key: 'avatar',
                folder: 'courses/' . $authUser->id . '/'
            );

            //create new course here
            $course =  Course::create(
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'cover_path' => $path,
                    'status' => $request->status,
                    'instructor_id' => $authUser->id,
                    'course_price' => $request->price
                ]
            );

            //back for last route with this message
            return back()->withErrors(
                [
                    'success' => 'new playlist created!'
                ]
            );
        } //ent try
        catch (Exception $ex) {
            return abort(500);
        }
    } //end store

}//end InstructorAddCourseController
