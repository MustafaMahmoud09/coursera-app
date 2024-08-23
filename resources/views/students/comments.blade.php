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

    <section class="comments">

        <h1 class="heading">your comments</h1>


        <div class="show-comments">

            @if (count($comments) != 0)
                @foreach ($comments as $comment)
                    <div class="box" style="order:-1">
                        <div class="content"><span>{{ formatDate($comment->created_at) }}</span>
                            <p> - {{ $comment->content->instructor->name }} - </p><a
                                href="{{ route('student.playlist.content', $comment->content->id) }}">view
                                content</a>
                        </div>
                        <p class="text">{{ $comment->comment }}</p>

                        <form action="{{ route('student.content.comment.delete', $comment->id) }}" method="post"
                            class="flex-btn">
                            @csrf
                            @method('delete')
                            <a id="edit_button_{{ $comment->id }}" class="inline-option-btn">edit comment</a>
                            <button type="submit" name="delete_comment" class="inline-delete-btn"
                                onclick="return confirm('delete this comment?');">delete comment</button>
                        </form>
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


    @include('layouts.student-footer')

    <script>
        document.getElementById('cancel_button').addEventListener('click', function() {
            var edit = document.getElementById('edit');
            edit.style.display = 'none';
        });
    </script>

</body>

</html>
