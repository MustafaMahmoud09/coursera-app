<?php

namespace App\Http\Controllers\ContentSolutions\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentSolutions\AddSolutionRequest;
use App\Models\Buying;
use App\Models\Content;
use App\Models\Solution;
use App\Traits\Controllers\File\DeleteFile;
use App\Traits\Controllers\File\UpdateFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentSolutionController extends Controller
{
    use UpdateFile, DeleteFile;

    //function for return submit solution view
    public function index($id)
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

            if ($content->content_type_id != '2') {
                return abort(401);
            } //end if

            return view('students.submit_solution')
                ->with('content', $content);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for store new content solution
    public function store(AddSolutionRequest $request, $id)
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

            if ($content->content_type_id != '2') {
                return abort(401);
            } //end if

            $oldSubmit = Solution::where('student_id', $authUser->id)
                ->where('content_id', $content->id)
                ->first();

            //upload new solution
            $path = $this->uploadFile(
                request: $request,
                key: 'pdf',
                folder: 'solution/' . $authUser->id . '/' . $content->id . '/',
            );

            if ($oldSubmit) {
                //update old solution
                Solution::where('student_id', $authUser->id)
                    ->where('content_id', $content->id)->update(
                        [
                            'file_path' => $path,
                        ]
                    );

                $this->deleteFile($oldSubmit->file_path);
            } //end if
            else {
                //create new solution
                Solution::create(
                    [
                        'file_path' => $path,
                        'content_id' => $id,
                        'student_id' => $authUser->id
                    ]
                );
            } //end else

            return back()->withErrors(
                [
                    'errors' => 'assignment solution added'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store

}//end StudentSolutionController
