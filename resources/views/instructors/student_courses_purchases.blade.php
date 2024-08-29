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

    <section class="playlists">

        <h1 class="heading">purchased courses</h1>

        <div class="box-container">

            @if (count($buyings) != 0)
                @foreach ($buyings as $buying)
                    <div class="box">
                        <div class="flex">
                            <div><i class="fas fa-calendar"></i><span>{{ formatDate($buying->created_at) }}</span></div>
                        </div>
                        <div class="thumb">
                            <span>{{ $buying->course_price }} EGP</span>
                            <img src="{{ asset('storage/'.$buying->course->cover_path) }}" alt="">
                        </div>
                        <h3 class="title">{{ $buying->course->title }}</h3>
                        <p class="description">{{ $buying->course->description }}</p>
                        <form action="{{ route('instructor.delete.playlist', $buying->course->id) }}" method="post"
                            class="flex-btn">
                            @csrf
                            @method('delete')
                            <a href="{{ route('instructor.edit.playlist', $buying->course->id) }}"
                                class="option-btn">update</a>
                            <input type="submit" value="delete" class="delete-btn"
                                onclick="return confirm('delete this playlist?');" name="delete">
                        </form>
                        <a href="{{ route('instructor.playlist.details.view', $buying->course->id) }}" class="btn">view playlist</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no playlists found!</p>
            @endif
        </div>

    </section>

    @include('layouts.instructor-footer')

    <script>
        document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
            if (content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
        });
    </script>

</body>

</html>
