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

    <section class="video-form">

        <h1 class="heading">upload content</h1>

        <form action="{{ route('instructor.add.playlist.content') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>content type <span>*</span></p>
            <select name="type" id ="type" class="box" required>
                <option value="" selected disabled>-- select type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>
                        {{ $type->type }}</option>
                @endforeach
            </select>
            <p>content status <span>*</span></p>
            <select name="status" class="box" required>
                <option value="" selected disabled>-- select status</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>deactive</option>
            </select>
            <p>content title <span>*</span></p>
            <input type="text" name="title" value="{{ old('title') }}" maxlength="100" required
                placeholder="enter content title" class="box">
            <p>content description <span>*</span></p>
            <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30"
                rows="10">{{ old('description') }}</textarea>
            <p>content playlist <span>*</span></p>
            <select name="playlist" class="box" required>
                <option value="" disabled selected>--select playlist</option>

                @foreach ($playlists as $playlist)
                    <option value="{{ $playlist->id }}" {{ old('playlist') == $playlist->id ? 'selected' : '' }}>
                        {{ $playlist->title }}</option>
                @endforeach

            </select>
            <p>select thumbnail <span>*</span></p>
            <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*" required class="box">
            <p id ='video_p' style="display: none;">select video <span>*</span>
            </p>
            <input type="file" name="video" id='video' value="{{ old('video') }}" accept="video/*"
                class="box" style="display: none;">
            <p id="assignment_p" style="display: none;">select assignment <span>*</span></p>
            <input type="file" name="assignment" id='assignment' value="{{ old('assignment') }}"
                accept="application/pdf" class="box" style="display: none;">
            <p id="date_p" style="display: none;">assignment deadline <span>*</span></p>
            <input type="date" id='date' name="date" value="{{ old('date') }}" maxlength="100"
                placeholder="enter assignment deadline" class="box" style="display: none;">
            <p id="lesson_p" style="display: none;">select lesson <span>*</span></p>
            <input type="file" name="lesson" id='lesson' value="{{ old('lesson') }}"
                accept="application/pdf" class="box" style="display: none;">
            <input type="submit" value="upload content" name="submit" class="btn">
        </form>

    </section>

    @include('layouts.instructor-footer')


</body>

</html>
