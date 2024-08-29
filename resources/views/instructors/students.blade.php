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

    @include('layouts.instructor-header')

    <!---->

    <!-- teachers section starts  -->

    <section class="teachers">

        <h1 class="heading">your students</h1>

        <div class="box-container">

            @if (count($buyings) != 0)

                @foreach ($buyings as $buying)
                    <div class="box">
                        <div class="tutor">
                            <img src="{{ asset('storage/' . $buying->student->image_path) }}" alt="">
                            <div>
                                <h3>
                                    {{ $buying->student->name }}
                                </h3>
                                <span>
                                    {{ $buying->student->email }}
                                </span>
                            </div>
                        </div>
                        <p>playlists : <span>
                                {{ $buying->total_purchases }}
                            </span></p>
                        <p>purchase value : <span>
                                {{ $buying->total_amount }}
                            </span></p>
                        <p>total likes : <span>
                            {{ studentReactCount($buying->student) }}
                            </span></p>
                        <p>total comments : <span>
                                {{ studentCommentCount($buying->student) }}
                            </span></p>
                        <a href="{{ route('instructor.course.buyings.student.edit', $buying->student->id) }}" class="inline-btn">view
                            courses</a>
                    </div>
                @endforeach
            @else
                <!--not found tutors-->
                <p class="empty">no tutors found!</p>
            @endif


        </div>

    </section>

    <!-- teachers section ends -->

    @include('layouts.instructor-footer')

</body>

</html>
