<?php

use App\Http\Controllers\Auth\Instructors\{InstructorLoginController, InstructorLogoutController, InstructorRegisterController};
use App\Http\Controllers\ContentComments\Instructors\InstructorCommentController;
use App\Http\Controllers\ContentSolutions\Instructors\InstructorSolutionController;
use App\Http\Controllers\CourseContents\Instructors\{InstructorAddContentController, InstructorContentController, InstructorDeleteContentController, InstructorUpdateContentController};
use App\Http\Controllers\Courses\Instructor\{InstructorAddCourseController, InstructorCourseController, InstructorDeleteCourseController, InstructorUpdateCourseController};
use App\Http\Controllers\Profiles\Instructors\{InstructorProfileController, InstructorUpdateProfileController};
use Illuminate\Support\Facades\Route;

try {

    //for instructor register links
    Route::controller(InstructorRegisterController::class)->group(function () {
        Route::get('register', 'index')->name('instructor.register');
        Route::post('register/store', 'store')->name('instructor.register.store');
    });


    //for instructor login links
    Route::controller(InstructorLoginController::class)->group(function () {
        Route::get('login', 'index')->name('instructor.login');
        Route::post('login/make', 'login')->name('instructor.login.generate');
    });


    //group on instructor authorization cases
    Route::group(
        [
            'middleware' => ['custome-auth:' . getInstructorGuard()],
        ],
        function () {

            //profile links
            Route::controller(InstructorProfileController::class)->group(function () {
                Route::get('dashboard', 'index')->name('admin.dashboard');
                Route::get('profile', 'profileView')->name('instructor.profile');
            });

            Route::controller(InstructorUpdateProfileController::class)->group(function () {
                Route::get('profile/update/view', 'index')->name('instructor.update.profile.view');
                Route::put('profile/update', 'update')->name('instructor.update.profile');
            });

            //logout route
            Route::get('logout', [InstructorLogoutController::class, 'logout'])->name('instructor.logout');

            //for instructor playlists links
            Route::controller(InstructorCourseController::class)->group(function () {
                Route::get('playlists/view', 'index')->name('instructor.playlists.view');
                Route::get('playlist/details/{id}', 'playlistDetailsView')->name('instructor.playlist.details.view');
                Route::get('playlist/search', 'search')->name('instructor.playlist.search');
            });

            Route::controller(InstructorAddCourseController::class)->group(function () {
                Route::get('playlists/add/view', 'index')->name('instructor.add.playlist.view');
                Route::post('playlists/add', 'store')->name('instructor.add.playlist');
            });

            Route::controller(InstructorUpdateCourseController::class)->group(function () {
                Route::get('playlist/edit/{id}', 'edit')->name('instructor.edit.playlist');
                Route::put('playlist/update/{id}', 'update')->name('instructor.update.playlist');
            });

            Route::controller(InstructorDeleteCourseController::class)->group(function () {
                Route::delete('playlists/delete/{id}', 'delete')->name('instructor.delete.playlist');
            });


            //for instructor playlists contents links
            Route::controller(InstructorContentController::class)->group(function () {
                Route::get('playlists/contents/view', 'index')->name('instructor.playlist.contents.view');
                Route::get('playlist/content/details/view/{id}', 'contentDetailsView')->name('instructor.playlist.content.details.view');
            });

            Route::controller(InstructorAddContentController::class)->group(function () {
                Route::get('playlist/content/add/view', 'index')->name('instructor.add.playlist.content.view');
                Route::post('playlist/content/add', 'store')->name('instructor.add.playlist.content');
            });

            Route::controller(InstructorDeleteContentController::class)->group(function () {
                Route::delete('playlist/content/delete/{id}', 'delete')->name('instructor.delete.playlist.content');
            });

            Route::controller(InstructorUpdateContentController::class)->group(function () {
                Route::get('playlist/content/edit/{id}', 'edit')->name('instructor.edit.playlist.content');
                Route::put('playlist/content/update/{id}', 'update')->name('instructor.update.playlist.content');
            });


            //comments links
            Route::controller(InstructorCommentController::class)->group(function () {
                Route::get('playlist/contents/comments/view', 'index')->name('instructor.playlist.content.comments.view');
                Route::delete('playlist/content/comment/delete/{id}', 'delete')->name('instructor.playlist.content.comment.delete');
            });

            //assigments links
            Route::controller(InstructorSolutionController::class)->group(function (){
                Route::get('playlist/content/assigments/view', 'index')->name('instructor.playlist.content.assigments.view');
                Route::get('playlist/content/{id}/solutions','contentSolutionsView')->name('instructor.playlist.content.solutions');
            });
        } //end fun
    );
} //end try
catch (Exception $ex) {
    return back();
}//end catch
