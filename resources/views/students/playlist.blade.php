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
                        {{ $course->contents_count }} videos
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

        <h1 class="heading">playlist videos</h1>

        <div class="box-container">
            @if (count($contents) != 0)

                @foreach ($contents as $content)
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

    </section>

    <!-- videos container section ends -->

    @include('layouts.student-footer')

</body>

</html>
