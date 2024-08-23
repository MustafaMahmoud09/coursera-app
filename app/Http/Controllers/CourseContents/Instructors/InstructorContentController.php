<?php

namespace App\Http\Controllers\CourseContents\Instructors;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorContentController extends Controller
{

    //function for return course content view
    public function index()
    {
        try {
            //get user auth
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get user courses contents
            $courseContents = $authUser->contents()
                ->orderByDesc('created_at')
                ->get();

            return view('instructors.contents')
                ->with('contents', $courseContents);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for return content view for owner
    public function contentDetailsView($id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get course content by id
            $content = Content::withCount('comments')->withCount('reacts')->find($id);

            if (!$content) {
                return abort(404);
            } //end if

            if ($authUser->id != $content->instructor_id) {
                return abort(401);
            } //end if

            //get content comments
            $comments = $content->comments()->orderByDesc('created_at')->get();

            return view('instructors.view_content')
                ->with('content', $content)
                ->with('comments', $comments);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end contentDetailsView

}//end InstructorContentController
