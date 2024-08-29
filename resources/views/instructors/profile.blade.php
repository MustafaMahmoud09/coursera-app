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
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">

</head>

<body>

    @include('layouts.instructor-header')
    <!-- side bar section ends -->

    <section class="tutor-profile" style="min-height: calc(100vh - 19rem);">

        <h1 class="heading">profile details</h1>

        <div class="details">
            <div class="tutor">
                <img src="{{ asset('storage/'.$instructor->image_path) }}" alt="">
                <h3>{{ $instructor->name }}</h3>
                <span>{{ $instructor->profession->profession }}</span>
                <a href="{{ route('instructor.update.profile.view') }}" class="inline-btn">update profile</a>
            </div>
            <div class="flex">
                <div class="box">
                    <span>{{ $instructor->courses_count }}</span>
                    <p>total playlists</p>
                    <a href="{{ route('instructor.playlists.view') }}" class="btn">view playlists</a>
                </div>
                <div class="box">
                    <span>{{ $instructor->contents_count }}</span>
                    <p>total contents</p>
                    <a href="{{ route('instructor.playlist.contents.view') }}" class="btn">view contents</a>
                </div>
                <div class="box">
                    <span>{{ $purchasesCount }}</span>
                    <p>total purchases</p>
                    <a href="{{ route('instructor.course.buyings.students.view') }}" class="btn">view students</a>
                </div>
                <div class="box">
                    <span>{{ $reactCount }}</span>
                    <p>total likes</p>
                    <a href="{{ route('instructor.playlist.contents.view') }}" class="btn">view contents</a>
                </div>
                <div class="box">
                    <span>{{ $commentCount }}</span>
                    <p>total comments</p>
                    <a href="{{ route('instructor.playlist.content.comments.view') }}" class="btn">view comments</a>
                </div>
                <div class="box">
                    <span>{{ $solutionCounts }}</span>
                    <p>total assignments</p>
                    <a href="{{ route('instructor.playlist.content.assigments.view') }}" class="btn">view assignments</a>
                </div>
            </div>
        </div>

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
