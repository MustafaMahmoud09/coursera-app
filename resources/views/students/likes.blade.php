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

    <!---->
    @include('layouts.student-header')
    <!---->

    <!-- courses section starts  -->

    <section class="liked-videos">

        <h1 class="heading">liked videos</h1>

        <div class="box-container">

            @if (count($reacts) != 0)
                @foreach ($reacts as $react)
                    <div class="box">
                        <div class="tutor">
                            <img src="{{ asset('storage/' . $react->content->instructor->image_path) }}" alt="not found">
                            <div>
                                <h3>{{ $react->content->instructor->name }}</h3>
                                <span>{{ formatDate($react->content->created_at) }}</span>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $react->content->cover_path) }}" alt="not found" class="thumb">
                        <h3 class="title">{{ $react->content->title }}</h3>
                        <form action="{{ route('student.content.like.delete', $react->id) }}" method="post"
                            class="flex-btn">
                            @csrf
                            @method('delete')
                            <a href="{{ route('student.playlist.content', $react->content->id) }}"
                                class="inline-btn">watch
                                video</a>
                            <input type="submit" value="remove" class="inline-delete-btn" name="remove">
                        </form>
                    </div>
                @endforeach
            @else
                <p class="empty">nothing added to likes yet!</p>
            @endif

            <!--     <p class="emtpy">content was not found!</p>    -->

            <!--<p class="empty">nothing added to likes yet!</p> -->


        </div>

    </section>

    <!---->

    @include('layouts.student-footer')

</body>

</html>
