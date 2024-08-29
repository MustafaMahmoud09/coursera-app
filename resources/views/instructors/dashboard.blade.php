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

    <section class="dashboard">

        <h1 class="heading">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <h3>welcome!</h3>
                <p>{{ $instructor->name }}</p>
                <a href="{{ route('instructor.profile') }}" class="btn">view profile</a>
            </div>

            <div class="box">
                <h3>{{ $instructor->contents_count }}</h3>
                <p>total contents</p>
                <a href="{{ route('instructor.add.playlist.content.view') }}" class="btn">add new content</a>
            </div>

            <div class="box">
                <h3>{{ $instructor->courses_count }}</h3>
                <p>total playlists</p>
                <a href="{{ route('instructor.add.playlist.view') }}" class="btn">add new playlist</a>
            </div>

            <div class="box">
                <h3>{{ $purchasesCount }}</h3>
                <p>total purchases</p>
                <a href="{{ route('instructor.course.buyings.students.view') }}" class="btn">view students</a>
            </div>

            <div class="box">
                <h3>{{ $reactCount }}</h3>
                <p>total likes</p>
                <a href="{{ route('instructor.playlist.contents.view') }}" class="btn">view contents</a>
            </div>

            <div class="box">
                <h3>{{ $commentCount }}</h3>
                <p>total comments</p>
                <a href="{{ route('instructor.playlist.content.comments.view') }}" class="btn">view comments</a>
            </div>

            <div class="box">
                <h3>{{ $solutionCounts }}</h3>
                <p>total assignments</p>
                <a href="{{ route('instructor.playlist.content.assigments.view') }}" class="btn">view assignments</a>
            </div>

        </div>

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
