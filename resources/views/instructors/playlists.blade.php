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

        <h1 class="heading">added playlists</h1>

        <div class="box-container">

            <div class="box" style="text-align: center;">
                <h3 class="title" style="margin-bottom: .5rem;">create new playlist</h3>
                <a href="{{ route('instructor.add.playlist.view') }}" class="btn">add playlist</a>
            </div>


            @if (count($playlists)!=0)

                @foreach ($playlists as $playlist)
                    <div class="box">
                        <div class="flex">
                            <!--set this style if play list disactive-->
                            <!--color:red-->
                            <div><i class="fas fa-circle-dot"
                                    style="{{ provideStatusColor($playlist->status) }}"></i><span
                                    style="{{ provideStatusColor($playlist->status) }}">{{ provideStatusName($playlist->status) }}</span>
                            </div>
                            <div><i class="fas fa-calendar"></i><span>{{ formatDate($playlist->created_at) }}</span>
                            </div>
                        </div>
                        <div class="thumb">
                            <span>{{ $playlist->contents_count }}</span>
                            <img src="{{ asset('storage/' . $playlist->cover_path) }}" alt="">
                        </div>
                        <h3 class="title">{{ $playlist->title }}</h3>
                        <p class="description">{{ $playlist->description }}</p>
                        <form action="{{ route('instructor.delete.playlist', $playlist->id) }}" method="post"
                            class="flex-btn">
                            @csrf
                            @method('delete')
                            <a href="{{ route('instructor.edit.playlist', $playlist->id) }}"
                                class="option-btn">update</a>
                            <input type="submit" value="delete" class="delete-btn"
                                onclick="return confirm('delete this playlist?');" name="delete">
                        </form>
                        <a href="{{ route('instructor.playlist.details.view', $playlist->id) }}" class="btn">view playlist</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no playlist added yet!</p>
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
