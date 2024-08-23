<?php

namespace App\Http\Controllers\ContentComments\Instructors;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorCommentController extends Controller
{

    //function for return comments view
    public function index()
    {
        try {
            //get auth user here
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get all content commetns relation with instructor
            $comments = Comment::whereHas('content', function ($query) use ($authUser) {
                $query->where('instructor_id', $authUser->id);
            })->orderBy('created_at', 'desc')->get();

            return view('instructors.comments')
                ->with('comments', $comments);
        } //end try
        catch (Exception) {
            return abort(500);
        } //end catch
    } //end index


    //function for delete comment
    public function delete($id)
    {
        try {
            //get auth user here
            $authUser = Auth::guard(getInstructorGuard())->user();

            //find or fail comment
            $comment = Comment::findOrFail($id);

            //get comment content
            $commentContent = $comment->content;

            if ($commentContent->instructor_id != $authUser->id) {
                return abort(401);
            } //end if

            $comment->delete();

            return back()->withErrors(
                [
                    'error' => 'comment deleted!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end delete

}//end InstructorCommentController
