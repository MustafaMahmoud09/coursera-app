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

    @include('layouts.student-header')
    <!-- side bar section ends -->

    <section class="playlist-form">

        <h1 class="heading">submit assignment</h1>

        <form action="{{ route('student.solution.add', $content->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>assignment solution <span>*</span></p>
            <input type="file" name="pdf" value = "{{ old('pdf') }}" accept="application/pdf" required
                class="box">
            <input type="submit" value="submit assignment" name="submit" class="btn">
        </form>

    </section>

    @include('layouts.student-footer')

</body>

</html>
