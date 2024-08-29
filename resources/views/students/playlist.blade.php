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

    <!-- playlist section starts  -->

    <section class="playlist">

        <h1 class="heading">playlist details</h1>

        <div class="row">

            <div class="col">
                <form action="{{ route('student.playlist.save.store', $course->id) }}" method="post" class="save-list">
                    @csrf
                    @if ($isUserSaved)
                        <button type="submit" name="save_list"><i
                                class="fas fa-bookmark"></i><span>saved</span></button>
                    @else
                        <button type="submit" name="save_list"><i class="far fa-bookmark"></i><span>save
                                playlist</span></button>
                    @endif
                </form>
                <div class="thumb">
                    <span>
                        {{ $course->course_price }} EGP
                    </span>
                    <img src="{{ asset('storage/' . $course->cover_path) }}" alt="not found">
                </div>
            </div>

            <div class="col">
                <div class="tutor">
                    <img src="{{ asset('storage/' . $course->instructor->image_path) }}" alt="not found">
                    <div>
                        <h3>
                            {{ $course->instructor->name }}
                        </h3>
                        <span>
                            {{ $course->instructor->profession->profession }}
                        </span>
                    </div>
                </div>
                <div class="details">
                    <h3>
                        {{ $course->title }}
                    </h3>
                    <p>
                        {{ $course->description }}
                    </p>
                    <div class="date"><i class="fas fa-calendar"></i><span>
                            {{ formatDate($course->created_at) }}
                        </span></div>
                </div>
            </div>

            <!--if play list not found-->
            <!-- <p class="empty">this playlist was not found!</p> -->

        </div>

    </section>

    <!-- playlist section ends -->

    <!-- videos container section starts  -->

    <section class="videos-container">

        <div class="heading">

            <div class="tabs">
                <button class="tab-link" id = 'tab_videos' onclick="openTab(event, 'videos')">videos</button>
                <button class="tab-link" id = 'tab_lessons' onclick="openTab(event, 'lessons')">lessons</button>
                <button class="tab-link" id = 'tab_assignments'
                    onclick="openTab(event, 'assignments')">assignments</button>
            </div>

        </div>

        <div id ='videos' class="box-container">
            @if (count($videos) != 0)

                @foreach ($videos as $content)
                    <a href="{{ route('student.playlist.content', $content->id) }}" class="box">
                        <i class="fas fa-play"></i>
                        <img src="{{ asset('storage/' . $content->cover_path) }}" alt="">
                        <h3>
                            {{ $content->title }}
                        </h3>
                    </a>
                @endforeach
            @else
                <p class="empty">no videos added yet!</p>
            @endif

        </div>

        <div id ='lessons' class="box-container" style="visibility: hidden; position: absolute">
            @if (count($lessons) != 0)

                @foreach ($lessons as $content)
                    <a href="{{ route('student.playlist.content', $content->id) }}" class="box">
                        <i class="fas fa-play"></i>
                        <img src="{{ asset('storage/' . $content->cover_path) }}" alt="">
                        <h3>
                            {{ $content->title }}
                        </h3>
                    </a>
                @endforeach
            @else
                <p class="empty">no lessons added yet!</p>
            @endif
        </div>

        <div id ='assignments' class="box-container" style="visibility: hidden; position: absolute">
            @if (count($assignments) != 0)

                @foreach ($assignments as $content)
                    <a href="{{ route('student.playlist.content', $content->id) }}" class="box">
                        <i class="fas fa-play"></i>
                        <img src="{{ asset('storage/' . $content->cover_path) }}" alt="">
                        <h3>
                            {{ $content->title }}
                        </h3>
                    </a>
                @endforeach
            @else
                <p class="empty">no assignments added yet!</p>
            @endif
        </div>

    </section>

    <!-- videos container section ends -->

    @include('layouts.student-footer')

    <script>
        function openTab(evt, tabName) {
            var videos = document.getElementById('videos');
            var lessons = document.getElementById('lessons');
            var assignments = document.getElementById('assignments');

            if (tabName == 'videos') {
                assignments.style.visibility = 'hidden';
                assignments.style.position = 'absolute';
                lessons.style.visibility = 'hidden';
                lessons.style.position = 'absolute';
                videos.style.visibility = 'visible';
                videos.style.position = 'relative'; // أو إزالة 'absolute'
            } //end if
            else if (tabName == 'lessons') {
                videos.style.visibility = 'hidden';
                videos.style.position = 'absolute';
                assignments.style.visibility = 'hidden';
                assignments.style.position = 'absolute';
                lessons.style.visibility = 'visible';
                lessons.style.position = 'relative'; // أو إزالة 'absolute'
            } //end else if
            else if (tabName == 'assignments') {
                videos.style.visibility = 'hidden';
                videos.style.position = 'absolute';
                lessons.style.visibility = 'hidden';
                lessons.style.position = 'absolute';
                assignments.style.visibility = 'visible';
                assignments.style.position = 'relative'; // أو إزالة 'absolute'
            } //end else if


        }
    </script>

</body>

</html>
