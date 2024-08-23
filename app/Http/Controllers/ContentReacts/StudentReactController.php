<?php

namespace App\Http\Controllers\ContentReacts;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\React;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentReactController extends Controller
{

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
    public function store($id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get content by id
            $content = Content::findOrFail($id);

            $isReacted = React::where('student_id', $authUser->id)
                ->where('content_id', $content->id)
                ->exists();
            if (!$isReacted) {

                //create new react on video here
                React::create(
                    [
                        'student_id' => $authUser->id,
                        'content_id' => $id
                    ]
                );

                return back()->withErrors(
                    [
                        'error' => 'react created!'
                    ]
                );
            } //end if
            else {
                //delete react if exist
                React::where('student_id', $authUser->id)
                    ->where('content_id', $content->id)
                    ->delete();

                return back()->withErrors(
                    [
                        'error' => 'react deleted!'
                    ]
                );
            } //end else
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store


    //function for delete react
    public function delete($id)
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

            return back()->withErrors(
                [
                    'error' => 'react deleted!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end delete

}//end StudentReactController
