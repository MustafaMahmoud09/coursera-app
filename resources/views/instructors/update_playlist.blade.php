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

    <section class="playlist-form">

        <h1 class="heading">update playlist</h1>

        <form action="{{ route('instructor.update.playlist', $playlist->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <p>playlist status <span>*</span></p>
            <select name="status" class="box" required>
                <option value="1" {{ $playlist->status == '1' ? 'selected' : '' }}>active</option>
                <option value="0" {{ $playlist->status == '0' ? 'selected' : '' }}>deactive</option>
            </select>
            <p>playlist title <span>*</span></p>
            <input type="text" name="title" maxlength="100" required placeholder="enter playlist title"
                value="{{ $playlist->title }}" class="box">
            <p>playlist description <span>*</span></p>
            <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30"
                rows="10">{{ $playlist->description }}</textarea>
            <p>playlist price <span>*</span></p>
            <input type="number" name="price" value="{{ $playlist->course_price }}" maxlength="100" required
                placeholder="enter playlist price" class="box">
            <p>playlist thumbnail <span>*</span></p>
            <div class="thumb">
                <span>0</span>
                <img src="{{ asset('storage/' . $playlist->cover_path) }}" alt="">
            </div>
            <input type="file" name="avatar" accept="image/*" class="box">
            <input type="submit" value="update playlist" name="submit" class="btn">

            <div class="flex-btn">
                <a href="{{ route('instructor.playlist.details.view', $playlist->id) }}" class="option-btn">view
                    playlist</a>
            </div>

        </form>

        <!--<p class="empty">no playlist added yet!</p> -->

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
