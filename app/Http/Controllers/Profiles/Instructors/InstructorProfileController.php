<?php

namespace App\Http\Controllers\Profiles\Instructors;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorProfileController extends Controller
{

    //function for return admin dashboard view
    public function index()
    {
        return $this->customView('instructors.dashboard');
    } //end index


    //function for return profile view
    public function profileView()
    {
        return $this->customView('instructors.profile');
    } //end profileView


    private function customView($view)
    {
        try {
            //get user auth
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get basic info for auth user
            $instructor = Instructor::where('id', $authUser->id)
                ->withCount('contents')
                ->withCount('courses')
                ->first();

            $comments = collect();
            $reacts = collect();
            $assignments = collect();
            $purchases = collect();
            $courses = Instructor::where('id', $authUser->id)->first()->courses;

            foreach ($courses as $course) {

                $contents = $course->contents;
                $purchases = $purchases->merge($course->buyings()->distinct('student_id')->get());

                foreach ($contents as $content) {
                    $comments = $comments->merge($content->comments);
                    $reacts = $reacts->merge($content->reacts);
                    $assignments = $assignments->merge($content->solutions);
                }
            }

            //get react count
            $reactCounts = count($reacts);

            //get comment count
            $commentCounts = count($comments);

            //get solution count
            $solutionCounts = count($assignments);

            //get purchases count
            $purchasesCount = count($purchases);

            return view($view)
                ->with('instructor', $instructor)
                ->with('commentCount', $commentCounts)
                ->with('reactCount', $reactCounts)
                ->with('solutionCounts', $solutionCounts)
                ->with('purchasesCount', $purchasesCount);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end customView

}//end InstructorProfileController
