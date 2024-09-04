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
    <section class="edit-comment" id="edit" style="display: none;">
        <h1 class="heading">edti comment</h1>
        <form>
            <input type="hidden" id="update_type" value="1" />
            <input type="hidden" id='comment_update_id' value="">
            <textarea id="comment_update" class="box" maxlength="1000" required placeholder="please enter your comment"
                cols="30" rows="10"></textarea>
            <div class="flex">
                <a id='cancel_button' class="inline-option-btn">cancel edit</a>
                <a id='update_comment_btn' class="inline-btn">update now</a>
            </div>
        </form>
    </section>


    <section class="comments">

        <h1 class="heading">your comments</h1>


        <div class="show-comments" id="comments-container">
            @include('layouts.auth-comments')
        </div>

    </section>

    @include('layouts.student-footer')
    @include('ajax.update-comment')

</body>

</html>
