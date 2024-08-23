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

    <section class="teachers">

        <h1 class="heading">expert tutors</h1>

        <form action="{{ route('student.teachers.search') }}" method="get" class="search-tutor">
            @csrf
            <input type="text" name="search" maxlength="100" placeholder="search tutor..." required>
            <button type="submit" class="fas fa-search"></button>
        </form>

        <div class="box-container">

            @if (count($teachers) != 0)
                @foreach ($teachers as $teacher)
                    <div class="box">
                        <div class="tutor">
                            <img src="{{ asset('storage/' . $teacher->image_path) }}" alt="">
                            <div>
                                <h3>{{ $teacher->name }}</h3>
                                <span>
                                    {{ $teacher->profession->profession }}
                                </span>
                            </div>
                        </div>
                        <p>playlists : <span>
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
                        <a href="{{ route('student.teachers.profile', $teacher->id) }}" class="inline-btn">view
                            profile</a>
                    </div>
                @endforeach
            @else
                <!--not found tutors-->
                <p class="empty">no tutors found!</p>
            @endif

        </div>

    </section>

    <!-- teachers section ends -->

    @include('layouts.student-footer')

</body>

</html>
