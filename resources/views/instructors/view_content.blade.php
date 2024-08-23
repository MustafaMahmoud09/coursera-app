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
    <section class="view-content">

        <div class="container">
            @if ($content->content_type_id == '1')
                <video src="{{ asset('storage/' . $content->video_path) }}" autoplay controls
                    poster="{{ asset('storage/' . $content->cover_path) }}" class="video"></video>
            @elseif ($content->content_type_id == '2')
                <div class="image-container">
                    <img src="{{ asset('storage/' . $content->cover_path) }}" class="pdf" alt="cover image">
                    <a href="{{ asset('storage/' . $content->video_path) }}" download
                        class="download-button">Download</a>
                </div>
            @endif
            <div class="date"><i class="fas fa-calendar"></i><span>{{ formatDate($content->created_at) }}</span></div>
            <h3 class="title">{{ $content->title }}</h3>
            <div class="flex">
                <div><i class="fas fa-heart"></i><span>{{ $content->reacts_count }}</span></div>
                <div><i class="fas fa-comment"></i><span>{{ $content->comments_count }}</span></div>
            </div>
            <div class="description">{{ $content->description }}</div>
            <form action="{{ route('instructor.delete.playlist.content', $content->id) }}" method="post">
                @csrf
                @method('delete')
                <div class="flex-btn">
                    <a href="{{ route('instructor.edit.playlist.content', $content->id) }}"
                        class="option-btn">update</a>
                    <input type="submit" value="delete" class="delete-btn"
                        onclick="return confirm('delete this video?');" name="delete_video">
                    @if ($content->content_type_id == '2')
                        <a href="{{ route('instructor.playlist.content.solutions', $content->id) }}"
                            class="option-btn">solve assignment</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- <p class="empty">no contents added yet! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">add videos</a></p> -->

    </section>

    <section class="comments">

        <h1 class="heading">user comments</h1>


        <div class="show-comments">


            @if (count($comments) != 0)
                @foreach ($comments as $comment)
                    <div class="box">
                        <div class="user">
                            <img src="{{ asset('storage/' . $comment->student->image_path) }}" alt="">
                            <div>
                                <h3>{{ $comment->student->name }}</h3>
                                <span>{{ formatDate($comment->created_at) }}</span>
                            </div>
                        </div>
                        <p class="text">{{ $comment->comment }}</p>
                        <form action="{{ route('instructor.playlist.content.comment.delete', $comment->id) }}"
                            method="post" class="flex-btn">
                            @csrf
                            @method('delete')
                            <button type="submit" name="delete_comment" class="inline-delete-btn"
                                onclick="return confirm('delete this comment?');">delete comment</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="empty">no comments added yet!</p>
            @endif

        </div>

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
