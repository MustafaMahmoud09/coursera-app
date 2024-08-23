<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookmarks</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    @include('layouts.student-header')

    <section class="courses">

        <h1 class="heading">bookmarked playlists</h1>

        <div class="box-container">

            @if (count($bookMarks) != 0)

                @foreach ($bookMarks as $bookMark)
                    <div class="box">
                        <div class="tutor">
                            <img src="{{ asset('storage/' . $bookMark->course->instructor->image_path) }}" alt="">
                            <div>
                                <h3>{{ $bookMark->course->instructor->name }}</h3>
                                <span>{{ formatDate($bookMark->course->created_at) }}</span>
                            </div>
                        </div>
                        <img src="{{ asset('storage/'. $bookMark->course->cover_path) }}" class="thumb" alt="">
                        <h3 class="title">{{ $bookMark->course->title }}</h3>
                        <a href="{{ route('student.playlist', $bookMark->course->id) }}" class="inline-btn">view playlist</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no courses added yet!</p>
            @endif
        </div>

    </section>

    @include('layouts.student-footer')

</body>

</html>
