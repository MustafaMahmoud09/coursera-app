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

        <h1 class="heading">create playlist</h1>

        <form action="{{ route('instructor.add.playlist') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>playlist status <span>*</span></p>
            <select name="status" class="box" required>
                <option value="" selected disabled>-- select status</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>deactive</option>
            </select>
            <p>playlist title <span>*</span></p>
            <input type="text" name="title" value="{{ old('title') }}" maxlength="100" required
                placeholder="enter playlist title" class="box">
            <p>playlist description <span>*</span></p>
            <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30"
                rows="10">{{ old('description') }}</textarea>
            <p>playlist price <span>*</span></p>
            <input type="number" name="price" value="{{ old('price') }}" maxlength="100" required
                placeholder="enter playlist price" class="box">
            <p>playlist thumbnail <span>*</span></p>
            <input type="file" name="avatar" value = "{{ old('avatar') }}" accept="image/*" required class="box">
            <input type="submit" value="create playlist" name="submit" class="btn">
        </form>

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
