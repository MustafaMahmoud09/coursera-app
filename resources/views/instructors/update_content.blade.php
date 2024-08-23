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

    <section class="video-form">

        <h1 class="heading">update content</h1>

        <form action="{{ route('instructor.update.playlist.content', $content->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <p>update type</p>
            <select name="type" id ="type" class="box" required>
                <option value="" selected disabled>-- select type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $content->content_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->type }}</option>
                @endforeach
            </select>
            <p>update status <span>*</span></p>
            <select name="status" class="box" required>
                <option value="1" {{ $content->status == '1' ? 'selected' : '' }}>active</option>
                <option value="0" {{ $content->status == '0' ? 'selected' : '' }}>deactive</option>
            </select>
            <p>update title <span>*</span></p>
            <input type="text" name="title" maxlength="100" required placeholder="enter video title" class="box"
                value="{{ $content->title }}">
            <p>update description <span>*</span></p>
            <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30"
                rows="10">{{ $content->description }}</textarea>
            <p>update playlist</p>
            <select name="playlist" class="box">

                @foreach ($playlists as $playlist)
                    <option value="{{ $playlist->id }}" {{ $playlist->id == $content->course_id ? 'selected' : '' }}>
                        {{ $playlist->title }}</option>
                @endforeach

            </select>
            <img src="{{ asset('storage/' . $content->cover_path) }}" alt="">
            <p>update thumbnail</p>
            <input type="file" name="avatar" accept="image/*" class="box">
            @if ($content->content_type_id == '1')
                <video src="{{ asset('storage/' . $content->video_path) }}" controls></video>
            @elseif ($content->content_type_id == '2')
                <div class="image-container">
                    <img src="{{ asset('storage/' . $content->cover_path) }}" class="pdf" alt="cover image">
                    <a href="{{ asset('storage/' . $content->video_path) }}" download
                        class="download-button">Download</a>
                </div>
            @endif
            <p id ='video_p' style="display: none;">update video</p>
            <input type="file" name="video" id='video' accept="video/*"
                class="box" style="display: none;">
            <p id="assignment_p" style="display: none;">update assignment</p>
            <input type="file" name="assignment" id='assignment'
                accept="application/pdf" class="box" style="display: none;">
            <p id="date_p" style="display: none;">update assignment deadline</p>
            <input type="date" id='date' name="date" @if($content->content_type_id == '2')value="{{ $content->dead_line }}"@endif maxlength="100"
                placeholder="enter assignment deadline" class="box" style="display: none;">
            <input type="submit" value="update content" name="update" class="btn">
            <div class="flex-btn">
                <a href="{{ route('instructor.playlist.content.details.view', $content->id) }}" class="option-btn">view
                    content</a>
            </div>
        </form>


        <!-- <p class="empty">video not found! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">add videos</a></p> -->


    </section>

    @include('layouts.instructor-footer')

</body>

</html>
