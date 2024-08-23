<?php

namespace App\Http\Controllers\Courses\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\UpdateCourseRequest;
use App\Models\Course;
use App\Traits\Controllers\File\DeleteFile;
use App\Traits\Controllers\File\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorUpdateCourseController extends Controller
{
    use UploadFile, DeleteFile;

    //function for edit playlist by id
    public function edit($id)
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

            return view('instructors.update_playlist')->with('playlist', $playlist);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch

    } //end edit


    //function for update playlist
    public function update(UpdateCourseRequest $request, $id)
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

            $path =  $playlist->cover_path;
            //upload new path
            if ($request->hasFile('avatar')) {
                $path = $this->uploadFile(
                    request: $request,
                    key: 'avatar',
                    folder: 'courses/' . $authUser->id . '/'
                );
            } //end if

            Course::where('id', $id)->update(
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'cover_path' => $path,
                    'status' => $request->status,
                    'instructor_id' => $authUser->id
                ]
            );

            //delete old avatar
            if ($request->hasFile('avatar')) {
                $coverPath = $playlist->cover_path;
                $this->deleteFile($coverPath);
            } //end if

            //back for last route with this message
            return back()->withErrors(
                [
                    'success' => 'playlist updated!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end update

}//end InstructorUpdateCourseController
