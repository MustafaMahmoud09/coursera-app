<?php

namespace App\Http\Controllers\ContentReacts;

use App\Http\Controllers\Controller;
use App\Models\Buying;
use App\Models\Content;
use App\Models\React;
use App\Traits\Controllers\Response\SelectResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentReactController extends Controller
{
    use SelectResponse;

    //function for return likes view
    public function index()
    {
        try {
            //get student auth
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get student auth reacts
            $reacts = $authUser->reacts()
                ->whereHas('content', function ($query) {
                    $query->where('status', 1)
                        ->whereHas('course', function ($subQuery) {
                            $subQuery->where('status', 1);
                        });
                })
                ->orderByDesc('created_at')
                ->get();

            return view('students.likes')
                ->with('reacts', $reacts);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for store new react on content
    public function store(Request $request, $id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get content by id
            $content = Content::findOrFail($id);

            $isBuying = Buying::where('course_id', $content->course_id)
                ->where('student_id', $authUser->id)
                ->exists();

            //if not student buying this course
            if (!$isBuying) {
                return makePaymentSession(
                    course: $content->course,
                    contentid: $content->id
                );
            } //end if

            $isReacted = React::where('student_id', $authUser->id)
                ->where('content_id', $content->id)
                ->exists();
            if (!$isReacted && $request->type == '0') {
                //create new react on video here
                React::create(
                    [
                        'student_id' => $authUser->id,
                        'content_id' => $id
                    ]
                );
            } //end if
            else if ($isReacted && $request->type == '1') {
                //delete react if exist
                React::where('student_id', $authUser->id)
                    ->where('content_id', $content->id)
                    ->delete();
            } //end else

            $reactCount = count($content->reacts);

            return $this->SelectResponse(
                data: [
                    'view' => view('layouts.content-react')
                        ->with('isUserReacted', $request->type == '0')
                        ->with('content', $content)
                        ->render(),
                    'reactCount' => $reactCount
                ],
                type: 'react'
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store


    //function for delete react
    public function delete(Request $request,$id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            $react = React::findOrFail($id);

            if ($authUser->id != $react->student_id) {
                return abort(401);
            } //end if

            //delete react here
            $react->delete();

            //get student auth reacts
            $reacts = $authUser->reacts()
                ->whereHas('content', function ($query) {
                    $query->where('status', 1)
                        ->whereHas('course', function ($subQuery) {
                            $subQuery->where('status', 1);
                        });
                })
                ->orderByDesc('created_at')
                ->get();

            return view('layouts.auth-reacts')
                ->with('reacts', $reacts);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end delete

}//end StudentReactController
