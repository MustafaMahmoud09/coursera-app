<?php

namespace App\Http\Controllers\CourseContents\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseContents\UpdateContentRequest;
use App\Models\Content;
use App\Models\ContentType;
use App\Traits\Controllers\File\DeleteFile;
use App\Traits\Controllers\File\UploadFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorUpdateContentController extends Controller
{
    use UploadFile, DeleteFile;

    //function for return update content view
    public function edit($id)
    {
        try {

            //get user auth here
            $authUser = Auth::guard(getInstructorGuard())->user();

            //find playlist or fail
            $content = Content::find($id);

            if (!$content) {
                return abort(404);
            } //end if

            //conditon auth user is playlist owner or no
            if ($authUser->id != $content->instructor_id) {
                return abort(401);
            } //end if

            //get instructor courses
            $courses = $authUser->courses()
                ->orderByDesc('created_at')
                ->get(['id', 'title']);

            //get content types
            $contentTypes = ContentType::get();

            return view('instructors.update_content')
                ->with('content', $content)
                ->with('playlists', $courses)
                ->with('types', $contentTypes);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end edit

    //function for update playlist content
    public function update(UpdateContentRequest $request, $id)
    {

        //get auth user
        $authUser = Auth::guard(getInstructorGuard())->user();

        //get course content by id
        $content = Content::find($id);

        if (!$content) {
            return abort(404);
        } //end if

        if ($request->type == '1') {
            $request->validate(
                [
                    'video' => ($content->content_type_id != '1' ? 'required|' : '') . 'mimes:mp4,mov,avi,flv'
                ]
            );
        } //end if
        else if ($request->type == '2') {
            $request->validate(
                [
                    'assignment' => ($content->content_type_id != '2' ? 'required|' : '') . 'mimes:pdf',
                    'date' => ($content->content_type_id != '2' ? 'required|' : '') . 'date'
                ]
            );
        } //end elseif

        try {
            if ($authUser->id != $content->instructor_id) {
                return abort(401);
            } //end if

            //get old files paths
            $coverPath = $content->cover_path;
            $videoPath = $content->video_path;

            //upload new cover if exist
            if ($request->hasFile('avatar')) {
                $coverPath = $this->uploadFile(
                    request: $request,
                    key: 'avatar',
                    folder: 'content/' . $authUser->id . '/' . $request->playlist . '/',
                );
            } //end if

            $key = "video";
            if ($request->type == '2') {
                $key = "assignment";
            } //end if
            //upload new video if exisy
            if ($request->hasFile($key)) {
                $videoPath = $this->uploadFile(
                    request: $request,
                    key: $key,
                    folder: 'content/' . $authUser->id . '/' . $request->playlist . '/',
                );
            } //end if

            //update playlist content here
            Content::where('id', $id)->update(
                [
                    'content_type_id' => $request->type,
                    'title' => $request->title,
                    'description' => $request->description,
                    'cover_path' => $coverPath,
                    'status' => $request->status,
                    'course_id' => $request->playlist,
                    'video_path' => $videoPath,
                    'dead_line' => $request->type == '2'? $request->date : null
                ]
            );

            //delete old cover
            if ($request->hasFile('avatar')) {
                $this->deleteFile($content->cover_path);
            } //end if

            //delete old video
            if ($request->hasFile($key)) {
                $this->deleteFile($content->video_path);
            } //end if

            //back for last route with this message
            return back()->withErrors(
                [
                    'success' => 'playlist content updated!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end update

}//end InstructorUpdateContentController
