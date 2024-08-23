<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tutor's profile</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>


    @include('layouts.student-header')

    <!---->

    <!-- teachers profile section starts  -->

    <section class="tutor-profile">

        <h1 class="heading">profile details</h1>

        <div class="details">
            <div class="tutor">
                <img src="{{ asset('storage/' . $teacher->image_path) }}" alt="">
                <h3>
                    {{ $teacher->name }}
                </h3>
                <span>
                    {{ $teacher->profession->profession }}
                </span>
            </div>
            <div class="flex">
                <p>total playlists : <span>
                        {{ $teacher->courses_count }}
                    </span></p>
                <p>total videos : <span>
                        {{ $teacher->contents_count }}
                    </span></p>
                <p>total likes : <span>
                        {{ reactCount($teacher) }}
                    </span></p>
                <p>total comments : <span>
                        {{ commentCount($teacher) }}
                    </span></p>
            </div>
        </div>

    </section>

    <!-- teachers profile section ends -->

    <section class="courses">

        <h1 class="heading">latest courese</h1>

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
                <!--not found any course show this-->
                <p class="empty">no courses added yet!</p>
            @endif


        </div>

    </section>

    <!-- courses section ends -->

    <!---->

    @include('layouts.student-footer')

</body>

</html>
