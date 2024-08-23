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

    <!-- quick select section starts  -->

    <section class="quick-select">

        <h1 class="heading">quick options</h1>

        <div class="box-container">


            @if (isStudentAuth())
                <div class="box">
                    <h3 class="title">likes and comments</h3>
                    <p>total likes : <span>
                            {{ $reactCounts }}
                        </span></p>
                    <a href="{{ route('student.content.likes.view') }}" class="inline-btn">view likes</a>
                    <p>total comments : <span>
                            {{ $commentCounts }}
                        </span></p>
                    <a href="{{ route('student.playlist.comments.view') }}" class="inline-btn">view comments</a>
                    <p>saved playlist : <span>
                            {{ $courseSaveCounts }}
                        </span></p>
                    <a href="{{ route('student.playlist.bookmark.view') }}" class="inline-btn">view bookmark</a>
                </div>
            @else
                <div class="box" style="text-align: center;">
                    <h3 class="title">please login or register</h3>
                    <div class="flex-btn" style="padding-top: .5rem;">
                        <a href="{{ route('student.login') }}" class="option-btn">login</a>
                        <a href="{{ route('student.register') }}" class="option-btn">register</a>
                    </div>
                </div>
            @endif

            <!-- <div class="box">
         <h3 class="title">top categories</h3>
         <div class="flex">
            <a href="search_course.php?"><i class="fas fa-code"></i><span>development</span></a>
            <a href="#"><i class="fas fa-chart-simple"></i><span>business</span></a>
            <a href="#"><i class="fas fa-pen"></i><span>design</span></a>
            <a href="#"><i class="fas fa-chart-line"></i><span>marketing</span></a>
            <a href="#"><i class="fas fa-music"></i><span>music</span></a>
            <a href="#"><i class[="]fas fa-camera"></i><span>photography</span></a>
            <a href="#"><i class="fas fa-cog"></i><span>software</span></a>
            <a href="#"><i class="fas fa-vial"></i><span>science</span></a>
         </div>
      </div>

      <div class="box">
         <h3 class="title">popular topics</h3>
         <div class="flex">
            <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
            <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
            <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
            <a href="#"><i class="fab fa-react"></i><span>react</span></a>
            <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
            <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
         </div>
      </div> -->

            <div class="box tutor">
                <h3 class="title">become a tutor</h3>
                <p>If you wanna be with us come and fill the form.</p>
                <a href="{{ route('instructor.register') }}" class="inline-btn">get started</a>
            </div>

        </div>

    </section>

    <!-- quick select section ends -->

    <!-- courses section starts  -->

    <section class="courses">

        <h1 class="heading">latest courses</h1>

        <div class="box-container">

            @if (count($playlists) != 0)
                @foreach ($playlists as $playlist)
                    <div class="box">
                        <div class="tutor">
                            <img src="{{ asset('storage/' . $playlist->instructor->image_path) }}" alt="">
                            <div>
                                <h3>
                                    {{ $playlist->instructor->name }}
                                </h3>
                                <span>
                                    {{ formatDate($playlist->created_at) }}
                                </span>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $playlist->cover_path) }}" class="thumb" alt="">
                        <h3 class="title">
                            {{ $playlist->title }}
                        </h3>
                        <a href="{{ route('student.playlist', $playlist->id) }}" class="inline-btn">view playlist</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no courses added yet!</p>
            @endif

        </div>

        <div class="more-btn">
            <a href="{{ route('student.playlists.all.view') }}" class="inline-option-btn">view more</a>
        </div>

    </section>

    <!-- courses section ends -->
    @include('layouts.student-footer')

</body>

</html>
