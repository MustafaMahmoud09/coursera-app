<?php

namespace App\Http\Controllers\ContentComments\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseContentComments\AddCommentRequest;
use App\Http\Requests\CourseContentComments\UpdateCommentRequest;
use App\Models\Buying;
use App\Models\Comment;
use App\Models\Content;
use App\Traits\Controllers\Response\SelectResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCommentController extends Controller
{
    use SelectResponse;

    //function for return comment view
    public function index()
    {
        try {
            //get student auth
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get student auth comments
            $comments = $authUser->comments()
                ->whereHas('content', function ($query) {
                    $query->where('status', 1)
                        ->whereHas('course', function ($subQuery) {
                            $subQuery->where('status', 1);
                        });
                })
                ->orderByDesc('created_at')
                ->get();

            return view('students.comments')
                ->with('comments', $comments);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for store new comment on course video
    public function store(AddCommentRequest $request, $id)
    {
        try {
            //get auth user
            $userAuth = Auth::guard(getStudentGaurd())->user();

            //get course content by id
            $content = Content::findOrFail($id);

            $isBuying = Buying::where('course_id', $content->course_id)
                ->where('student_id', $userAuth->id)
                ->exists();

            //if not student buying this course
            if (!$isBuying) {
                return makePaymentSession(
                    course: $content->course,
                    contentid: $content->id
                );
            } //end if

            //create new comment on course video
            Comment::create(
                [
                    'comment' => $request->comment,
                    'student_id' => $userAuth->id,
                    'content_id' => $id
                ]
            );

            //get content comments
            $comments = Content::find($id)
                ->comments()
                ->orderByDesc('created_at')
                ->get();

            return view('layouts.content-comments')
                ->with('comments', $comments);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store


    //function for delete course comment
    public function delete(Request $request, $id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get comment by id
            $comment = Comment::findOrFail($id);

            if ($comment->student_id != $authUser->id) {
                return abort(401);
            } //end if

            //delete comment here
            $comment->delete();

            //get content comments
            return $this->provideCommentsWithView($request->type, $comment->content_id);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end delete


    //function for update course comment
    public function update(UpdateCommentRequest $request)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get comment by id
            $comment = Comment::findOrFail($request->id);

            if ($comment->student_id != $authUser->id) {
                return abort(401);
            } //end if

            //update comment here
            $comment->comment = $request->comment;
            $comment->save();

            return $this->provideCommentsWithView($request->type, $comment->content_id);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end update


    private function provideCommentsWithView($type, $contentId = null)
    {
        if ($type == 0) {
            //get content comments
            $comments = Content::find($contentId)
                ->comments()
                ->orderByDesc('created_at')
                ->get();

            return view('layouts.content-comments')
                ->with('comments', $comments);
        } //end if
        else {
            //get student auth
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get student auth comments
            $comments = $authUser->comments()
                ->whereHas('content', function ($query) {
                    $query->where('status', 1)
                        ->whereHas('course', function ($subQuery) {
                            $subQuery->where('status', 1);
                        });
                })
                ->orderByDesc('created_at')
                ->get();

            return view('layouts.auth-comments')
                ->with('comments', $comments);
        } //end else

    } //end provideCommentsWithView

}//end StudentCommentController
