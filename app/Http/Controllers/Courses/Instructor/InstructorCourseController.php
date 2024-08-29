<?php

namespace App\Http\Controllers\Courses\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\Auth;

class InstructorCourseController extends Controller
{

    //function for return playlist view
    public function index()
    {
        try {
            //get auth instructor
            $authUser = Auth::guard(getInstructorGuard())->user();

            //get auth playlists
            $playlists = $authUser->courses()
                ->withCount('contents')
                ->orderByDesc('created_at')
                ->get();

            return view('instructors.playlists')->with('playlists', $playlists);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for search on playlist
    public function search(SearchRequest $request)
    {
        try {
            //get auth instructor
            $authUser = Auth::guard(getInstructorGuard())->user();

            //search on instructor courses
            $courses = $authUser->courses()
                ->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                })
                ->withCount('contents')
                ->orderByDesc('created_at')
                ->get();

            return view('instructors.search_page')
                ->with('playlists', $courses);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end search


    //function for return playlist details view
    public function playlistDetailsView($id)
    {
        try {

            //get auth instructor
            $authUser = Auth::guard(getInstructorGuard())->user();

            //find playlist or fail
            $playlist = Course::withCount('contents')->find($id);

            if (!$playlist) {
                return abort(404);
            } //end if

            //conditon auth user is playlist owner or no
            if ($authUser->id != $playlist->instructor_id) {
                return abort(401);
            } //end if

            //get playlist contents
            $contents = $playlist->contents;

            return view('instructors.view_playlist')
                ->with('playlist', $playlist)
                ->with('contents', $contents);
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch

    } //end playlistDetailsView


}//end InstructorCourseController
