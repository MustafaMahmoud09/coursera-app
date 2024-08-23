<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>watch video</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    @include('layouts.student-header')

    <!---->

    <section class="edit-comment" id="edit" style="display: none;">
        <h1 class="heading">edti comment</h1>
        <form action="{{ route('student.content.comment.update') }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" id= 'id' value="">
            <textarea name="comment" id ="comment_update" class="box" maxlength="1000" required
                placeholder="please enter your comment" cols="30" rows="10"></textarea>
            <div class="flex">
                <a id = 'cancel_button' class="inline-option-btn">cancel edit</a>
                <input type="submit" value="update now" name="update_now" class="inline-btn">
            </div>
        </form>
    </section>


    <!-- watch video section starts  -->
    <section class="watch-video">

        <div class="video-details">
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
            <h3 class="title">
                {{ $content->title }}
            </h3>
            <div class="info">
                <p><i class="fas fa-calendar"></i><span>{{ formatDate($content->created_at) }}</span></p>
                <p><i class="fas fa-heart"></i><span>{{ $content->reacts_count }} likes</span></p>
                @if ($isAssigmentAvialable)
                    <a href="{{ route('student.solution.add.view', $content->id) }}" class="btn">Submit Assignment</a>
                @endif
            </div>
            <div class="tutor">
                <img src="{{ asset('storage/' . $content->instructor->image_path) }}" alt="">
                <div>
                    <h3>{{ $content->instructor->name }}</h3>
                    <span>{{ $content->instructor->profession->profession }}</span>
                </div>
            </div>
            <form action="{{ route('student.content.react.store', $content->id) }}" method="post" class="flex">
                @csrf
                <a href="{{ route('student.playlist', $content->course->id) }}" class="inline-btn">view playlist</a>

                @if ($isUserReacted)
                    <!--show this button if user liked video before-->
                    <button type="submit" name=""><i class="fas fa-heart"></i><span>liked</span></button>
                @else
                    <!--show this button if user not liked video before-->
                    <button type="submit" name="like_content"><i class="far fa-heart"></i><span>like</span></button>
                @endif

            </form>
            <div class="description">
                <p>
                    {{ $content->description }}
                </p>
            </div>
        </div>

    </section>

    <!-- watch video section ends -->

    <!-- comments section starts  -->

    <section class="comments">

        <h1 class="heading">add a comment</h1>

        <form action="{{ route('student.content.comment.store', $content->id) }}" method="post" class="add-comment">
            @csrf
            <textarea name="comment" required placeholder="write your comment..." maxlength="1000" cols="30" rows="10"></textarea>
            <input type="submit" value="add comment" name="add_comment" class="inline-btn">
        </form>

        <h1 class="heading">user comments</h1>


        <div class="show-comments">


            @if (count($comments) > 0)

                @foreach ($comments as $comment)
                    <div class="box" style="order:-1">
                        <div class="user">
                            <img src="{{ asset('storage/' . $comment->student->image_path) }}" alt="">
                            <div>
                                <h3>
                                    {{ $comment->student->name }}
                                </h3>
                                <span>
                                    {{ formatDate($comment->created_at) }}
                                </span>
                            </div>
                        </div>
                        <p class="text">
                            {{ $comment->comment }}
                        </p>


                        @if (auth()->guard(getStudentGaurd())->user()->id == $comment->student_id)
                            <form action="{{ route('student.content.comment.delete', $comment->id) }}" method="post"
                                class="flex-btn">
                                @csrf
                                @method('delete')
                                <a type="" id="edit_button_{{ $comment->id }}" class="inline-option-btn">edit
                                    comment</a>
                                <button type="submit" name="delete_comment" class="inline-delete-btn"
                                    onclick="return confirm('delete this comment?');">delete comment</button>
                            </form>
                        @endif
                    </div>

                    <script>
                        document.getElementById('edit_button_{{ $comment->id }}').addEventListener('click', function() {
                            var edit = document.getElementById('edit');
                            edit.style.display = 'block';
                            document.getElementById('id').value = {{ $comment->id }}
                            document.getElementById('comment_update').value = @json($comment->comment);
                            window.scroll({
                                top: 0,
                                behavior: 'smooth' // لجعل التمرير سلسًا
                            });
                        });
                    </script>
                @endforeach
            @else
                <!--show this not comments exist -->
                <p class="empty">no comments added yet!</p>
            @endif

        </div>

    </section>

    <!-- comments section ends -->
    <!---->

    @include('layouts.student-footer')

    <script>
        document.getElementById('cancel_button').addEventListener('click', function() {
            var edit = document.getElementById('edit');
            edit.style.display = 'none';
        });
    </script>

</body>

</html>
