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

    <section class="playlist-details">

        <h1 class="heading">playlist details</h1>

        <div class="row">
            <div class="thumb">
                <span>{{ $playlist->contents_count }}</span>
                <img src="{{ asset('storage/' . $playlist->cover_path) }}" alt="">
            </div>
            <div class="details">
                <h3 class="title">{{ $playlist->title }}</h3>
                <div class="date"><i class="fas fa-calendar"></i><span>{{ formatDate($playlist->created_at) }}</span>
                </div>
                <div class="description">{{ $playlist->description }}</div>
                <form action="{{ route('instructor.delete.playlist', $playlist->id) }}" method="post" class="flex-btn">
                    @csrf
                    @method('delete')
                    <a href="{{ route('instructor.edit.playlist', $playlist->id) }}" class="option-btn">update
                        playlist</a>
                    <input type="submit" value="delete playlist" class="delete-btn"
                        onclick="return confirm('delete this playlist?');" name="delete">
                </form>
            </div>
        </div>

        <!--<p class="empty">no playlist found!</p> -->

    </section>

    <section class="contents">

        <h1 class="heading">playlist contents</h1>

        <div class="box-container">


            @if (count($contents) != 0)

                @foreach ($contents as $content)
                    <div class="box">
                        <div class="flex">
                            <div><i class="fas fa-dot-circle"
                                    style="{{ provideStatusColor($content->status) }}"></i><span
                                    style="{{ provideStatusColor($content->status) }}">{{ provideStatusName($content->status) }}</span>
                            </div>
                            <div><i class="fas fa-calendar"></i><span>{{ formatDate($content->created_at) }}</span>
                            </div>
                        </div>
                        <img src="{{ asset('storage/' . $content->cover_path) }}" class="thumb" alt="">
                        <h3 class="title">{{ $content->title }}</h3>
                        <form action="{{ route('instructor.delete.playlist.content', $content->id) }}" method="post"
                            class="flex-btn">
                            @csrf
                            @method('delete')
                            <a href="{{ route('instructor.edit.playlist.content', $content->id) }}" class="option-btn">update</a>
                            <input type="submit" value="delete" class="delete-btn"
                                onclick="return confirm('delete this video?');" name="delete_video">
                        </form>
                        <a href="{{ route('instructor.playlist.content.details.view', $content->id) }}" class="btn">watch {{ $content->type->type }}</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no contents added yet! <a href="{{ route('instructor.add.playlist.content.view') }}"
                        class="btn" style="margin-top: 1.5rem;">add contents</a></p>
            @endif

        </div>

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
