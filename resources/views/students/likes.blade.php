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

    <!-- courses section starts  -->

    <section class="liked-videos">

        <h1 class="heading">liked videos</h1>

        <div class="box-container" id='react_container'>
            @include('layouts.auth-reacts')
        </div>

    </section>

    <!---->

    @include('layouts.student-footer')

</body>

</html>
