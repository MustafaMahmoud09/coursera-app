<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>React</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>


    @include('layouts.student-header')
    <!---->

    <section class="profile">

        <h1 class="heading">profile details</h1>

        <div class="details">

            <div class="user">
                <img src="{{ asset('storage/' . auth()->guard(getStudentGaurd())->user()->image_path) }}"
                    alt="not found">
                <h3>{{ auth()->guard(getStudentGaurd())->user()->name }}</h3>
                <p>student</p>
                <a href="{{ route('student.profile.update.view') }}" class="inline-btn">update profile</a>
            </div>

            <div class="box-container">

                <div class="box">
                    <div class="flex">
                        <i class="fas fa-bookmark"></i>
                        <div>
                            <h3>{{ $courseSaveCounts }}</h3>
                            <span>saved playlists</span>
                        </div>
                    </div>
                    <a href="{{ route('student.playlist.bookmark.view') }}" class="inline-btn">view playlists</a>
                </div>

                <div class="box">
                    <div class="flex">
                        <i class="fas fa-heart"></i>
                        <div>
                            <h3>{{ $reactCounts }}</h3>
                            <span>liked tutorials</span>
                        </div>
                    </div>
                    <a href="{{ route('student.content.likes.view') }}" class="inline-btn">view liked</a>
                </div>

                <div class="box">
                    <div class="flex">
                        <i class="fas fa-comment"></i>
                        <div>
                            <h3>{{ $commentCounts }}</h3>
                            <span>video comments</span>
                        </div>
                    </div>
                    <a href="{{ route('student.playlist.comments.view') }}" class="inline-btn">view comments</a>
                </div>

            </div>

        </div>

    </section>

    <!-- profile section ends -->



    <!-- footer section starts  -->

    @include('layouts.student-footer')

</body>

</html>
