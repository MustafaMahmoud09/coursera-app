<?php

namespace App\Http\Controllers\ContentSolutions\Instructors;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Solution;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorSolutionController extends Controller
{

    //function for return assigments view
    public function index()
    {
        try {
            //get auth user
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get instructor solutions
            $solutions = Solution::whereHas('content', function ($query) use ($authUser) {
                $query->where('instructor_id', $authUser->id);
            })->orderByDesc('created_at')
                ->get();

            return view('instructors.assignments')
                ->with('solutions', $solutions);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for return content solutions view
    public function contentSolutionsView($id)
    {
        try {
            //get auth user
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get content by id
            $content = Content::findOrFail($id);

            if ($content->instructor_id != $authUser->id || $content->content_type_id != '2') {
                return abort(401);
            } //end if

            //get content solutions
            $contentSolutions = $content->solutions;

            return view('instructors.content_assignments')
                ->with('solutions',  $contentSolutions);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end contentSolutionsView

}//end InstructorSolutionController
