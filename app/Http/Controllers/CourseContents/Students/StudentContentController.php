<?php

namespace App\Http\Controllers\CourseContents\Students;

use App\Http\Controllers\Controller;
use App\Models\Buying;
use App\Models\Content;
use App\Models\React;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

class StudentContentController extends Controller
{

    //function for return video watch view
    public function index($id)
    {
 
            //get content by id
            $content = Content::withCount('reacts')->findOrFail($id);

            if ($content->status == 0 || $content->course->status == 0) {
                return abort(404);
            } //end if

            //get auth user
            $uathUser = Auth::guard(getStudentGaurd())->user();

            $isBuying = Buying::where('course_id', $content->course_id)
                ->where('student_id', $uathUser->id)
                ->exists();

            //if not student buying this course
            if (!$isBuying) {
                return makePaymentSession(
                    course: $content->course,
                    contentid: $content->id
                );
            } //end if

            //check auth user is saved course or no
            $isUserReact = React::where('content_id', $id)
                ->where('student_id', $uathUser->id)
                ->count() > 0;

            //get course contents
            $comments =  $content->comments()->orderByDesc('created_at')->get();

            $isAssigmentAvialable = $content->content_type_id == '2';
            if ($isAssigmentAvialable) {
                $today = Carbon::today();
                $isAssigmentAvialable = $isAssigmentAvialable && Carbon::parse($content->dead_line)->gte($today);
            } //end if

            return view('students.watch_video')
                ->with('content', $content)
                ->with('isUserReacted', $isUserReact)
                ->with('comments', $comments)
                ->with('isAssigmentAvialable', $isAssigmentAvialable);

    } //end index

}//end StudentContentController
