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

        <h1 class="heading">solve assignment</h1>


        <div class="show-comments">

            @if (count($solutions) != 0)
                @foreach ($solutions as $solution)
                    <div class="box" style="order:-1">
                        <div class="user">
                            <img src="{{ asset('storage/' . $solution->student->image_path) }}" alt="">
                            <div>
                                <h3>{{ $solution->student->name }}</h3>
                                <span>{{ formatDate($solution->created_at) }}</span>
                            </div>
                        </div>
                        <iframe id="pdf-frame"
                            src="{{ asset('storage/'. $solution->file_path) }}"
                            width="100%">
                        </iframe>
                    </div>
                @endforeach
            @else
                <!-- if comments empty -->
                <p class="empty">no solve assignment added</p>
            @endif

        </div>

    </section>

    @include('layouts.instructor-footer')

</body>

</html>
