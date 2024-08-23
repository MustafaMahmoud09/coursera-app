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


    <section class="comments">

        <h1 class="heading">user comments</h1>


        <div class="show-comments">

            @if (count($comments) != 0)

                @foreach ($comments as $comment)
                    <div class="box" style="order:-1">
                        <div class="content"><span>
                            {{ formatDate($comment->created_at) }}
                            </span>
                            <p> - {{ $comment->student->name }} -
                            </p><a href="{{ route('instructor.playlist.content.details.view', $comment->content->id) }}">view content</a>
                        </div>
                        <p class="text">
                            {{ $comment->comment }}
                        </p>
                        <form action="{{ route('instructor.playlist.content.comment.delete', $comment->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" name="delete_comment" class="inline-delete-btn"
                                onclick="return confirm('delete this comment?');">delete comment</button>
                        </form>
                    </div>
                @endforeach
            @else
                <!-- if comments empty -->
                <p class="empty">no comments added yet!</p>
            @endif

        </div>

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
