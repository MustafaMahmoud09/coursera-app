<?php

namespace App\Http\Controllers\CourseContents\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseContents\AddCourseContentRequest;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\Course;
use App\Traits\Controllers\File\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorAddContentController extends Controller
{
    use UploadFile;

    //function for return add course content view
    public function index()
    {
        try {
            //get user auth
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get instructor courses
            $courses = $authUser->courses()
                ->orderByDesc('created_at')
                ->get(['id', 'title']);

            //get content types
            $contentTypes = ContentType::get();

            return view('instructors.add_content')
                ->with('playlists', $courses)
                ->with('types', $contentTypes);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index

    //function for store new content in course
    public function store(AddCourseContentRequest $request)
    {
        if ($request->type == '1') {
            $request->validate(
                [
                    'video' => 'required|mimes:mp4,mov,avi,flv'
                ]
            );
        } //end if
        else if ($request->type == '2') {
            $request->validate(
                [
                    'assignment' => 'required|mimes:pdf',
                    'date' => ['required', 'date', 'after:today']
                ]
            );
        } //end elseif
        else if ($request->type == '3') {
            $request->validate(
                [
                    'lesson' => 'required|mimes:pdf'
                ]
            );
        } //end elseif

        try {
            //get user auth here
            $authUser = Auth::guard(getInstructorGuard())->user();

            $course = Course::find($request->playlist);
            if (!$course) {
                return abort(404);
            } //end if

            if ($authUser->id != $course->instructor_id) {
                return abort(401);
            } //end if

            //store image in server here
            $coverPath = $this->uploadFile(
                request: $request,
                key: 'avatar',
                folder: 'content/' . $authUser->id . '/' . $request->playlist . '/'
            );

            $key = 'video';
            if ($request->type == 2) {
                $key = 'assignment';
            } //end if
            else if ($request->type == 3) {
                $key = 'lesson';
            } //else if

            //store video in server here
            $videoPath = $this->uploadFile(
                request: $request,
                key: $key,
                folder: 'content/' . $authUser->id . '/' . $request->playlist . '/'
            );

            //create new course here
            $course =  Content::create(
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'cover_path' => $coverPath,
                    'status' => $request->status,
                    'instructor_id' => $authUser->id,
                    'course_id' => $request->playlist,
                    'video_path' => $videoPath,
                    'dead_line' => $request->type == '2' ? $request->date : null,
                    'content_type_id' => $request->type
                ]
            );

            //back for last route with this message
            return back()->withErrors(
                [
                    'success' => 'new content created!'
                ]
            );
        } //ent try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store

}//end InstructorAddContentController
