<?php

use App\Http\Controllers\Auth\Students\{StudentLoginController, StudentLogoutController, StudentRegisterController};
use App\Http\Controllers\Contacts\StudentContactController;
use App\Http\Controllers\CourseBookMark\{StudentCourseSaveController};
use App\Http\Controllers\ContentComments\Students\{StudentCommentController};
use App\Http\Controllers\ContentReacts\{StudentReactController};
use App\Http\Controllers\ContentSolutions\Students\StudentSolutionController;
use App\Http\Controllers\CourseContents\Students\StudentContentController;
use App\Http\Controllers\Courses\Students\{StudentCourseController};
use App\Http\Controllers\Profiles\Students\{StudentProfileController, StudentUpdateProfileController};
use App\Http\Controllers\Teachers\StudentTeacherController;
use Illuminate\Support\Facades\Route;

try {

    //for student register links
    Route::controller(StudentRegisterController::class)->group(function () {
        Route::get('register', 'index')->name('student.register');
        Route::post('register/store', 'store')->name('student.register.store');
    });


    //for student login links
    Route::controller(StudentLoginController::class)->group(function () {
        Route::get('login', 'index')->name('student.login');
        Route::post('login/make', 'login')->name('student.login.generate');
    });


    //contacts links
    Route::controller(StudentContactController::class)->group(function () {
        Route::get('contacts/view', 'index')->name('student.contacts.view');
        Route::post('contacts/store', 'store')->name('student.contacts.store');
        Route::get('about/view', 'aboutView')->name('student.about.view');
    });

    //group on student authorization cases
    Route::group(
        [
            'middleware' => ['custome-auth:' . getStudentGaurd()],
        ],
        function () {

            //logout route
            Route::get('logout', [StudentLogoutController::class, 'logout'])->name('user.logout');

            //courses links
            Route::controller(StudentCourseController::class)->group(function () {
                Route::get('playlists/all/view', 'index')->name('student.playlists.all.view');
                Route::get('playlist/{id}', 'playlistDetailsView')->name('student.playlist');
                Route::get('playlists/search', 'search')->name('student.playlists.search');
            });

            //content watch links
            Route::controller(StudentContentController::class)->group(function () {
                Route::get('playlist/content/{id}/view', 'index')->name('student.playlist.content');
            });

            //comment links
            Route::controller(StudentCommentController::class)->group(function () {
                Route::post('playlist/content/comment/store/{id}', 'store')->name('student.content.comment.store');
                Route::delete('playlist/content/comment/delete/{id}', 'delete')->name('student.content.comment.delete');
                Route::put('playlist/content/comment/update', 'update')->name('student.content.comment.update');
                Route::get('playlist/comments/view', 'index')->name('student.playlist.comments.view');
            });

            //react links
            Route::controller(StudentReactController::class)->group(function () {
                Route::post('playlist/content/react/store/{id}', 'store')->name('student.content.react.store');
                Route::get('content/likes/view', 'index')->name('student.content.likes.view');
                Route::delete('content/like/delete/{id}', 'delete')->name('student.content.like.delete');
            });

            //course save links
            Route::controller(StudentCourseSaveController::class)->group(function () {
                Route::post('playlist/save/store/{id}', 'store')->name('student.playlist.save.store');
                Route::get('playlist/bookmark/view', 'index')->name('student.playlist.bookmark.view');
            });

            //profile links
            Route::controller(StudentProfileController::class)->group(function () {
                Route::get('profile/view', 'profileView')->name('student.profile.view');
            });

            Route::controller(StudentUpdateProfileController::class)->group(function () {
                Route::get('profile/update/view', 'index')->name('student.profile.update.view');
                Route::put('profile/update', 'update')->name('student.profile.update');
            });

            //teacher links
            Route::controller(StudentTeacherController::class)->group(function () {
                Route::get('teachers/all/view', 'index')->name('student.teachers.all.view');
                Route::get('teachers/profile/{id}', 'tutorProfileView')->name('student.teachers.profile');
                Route::get('teacher/search', 'search')->name('student.teachers.search');
            });

            //content solution links
            Route::controller(StudentSolutionController::class)->group(function () {
                Route::get('solution/add/{id}/view','index')->name('student.solution.add.view');
                Route::post('solution/add/{id}', 'store')->name('student.solution.add');
            });
        } //end fun
    );
} //end try
catch (Exception $ex) {
    return back();
}
