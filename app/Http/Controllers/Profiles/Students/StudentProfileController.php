<?php

namespace App\Http\Controllers\Profiles\Students;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{

    //function for return student dashboard
    public function index()
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get last 10 courses
            $courses = Course::where('status', 1)
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();

            $reactCounts = 0;
            $commentCounts = 0;
            $courseSaveCounts = 0;
            $coursesBuyingsCount = 0;
            if ($authUser) {
                $reactCounts = count($authUser->reacts);
                $commentCounts = count($authUser->comments);
                $courseSaveCounts = count($authUser->coursesSaved);
                $coursesBuyingsCount = count($authUser->buyings()->distinct('course_id')->get());
            } //end if

            return view('welcome')
                ->with('playlists', $courses)
                ->with('reactCounts', $reactCounts)
                ->with('commentCounts', $commentCounts)
                ->with('courseSaveCounts', $courseSaveCounts)
                ->with('coursesBuyingsCount', $coursesBuyingsCount);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    public function profileView()
    {
        try {
            //get auth user
            $authUser = Auth::guard(getStudentGaurd())->user();

            //get student info
            $reactCounts = count($authUser->reacts);
            $commentCounts = count($authUser->comments);
            $courseSaveCounts = count($authUser->coursesSaved);
            $coursesBuyingsCount = count($authUser->buyings()->distinct('course_id')->get());

            return view('students.profile')
                ->with('reactCounts', $reactCounts)
                ->with('commentCounts', $commentCounts)
                ->with('courseSaveCounts', $courseSaveCounts)
                ->with('coursesBuyingsCount', $coursesBuyingsCount);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end profileView

}//end StudentProfileController
