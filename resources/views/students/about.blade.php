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

    <!-- about section starts  -->

    <section class="about">

        <div class="row">

            <div class="image">
                <img src="{{ asset('images/about-img.svg') }}" alt="">
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>We aim to create an engaging and informative online course that helps learners achieve the desired
                    learning outcomes</p>
                <a href="{{ route('student.playlists.all.view') }}" class="inline-btn">Our courses</a>
            </div>

        </div>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-graduation-cap"></i>
                <div>
                    <h3>+1k</h3>
                    <span>online courses</span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-user-graduate"></i>
                <div>
                    <h3>+25k</h3>
                    <span>brilliants students</span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-chalkboard-user"></i>
                <div>
                    <h3>+5k</h3>
                    <span>expert teachers</span>
                </div>
            </div>

            <div class="box">
                <i class="fas fa-briefcase"></i>
                <div>
                    <h3>100%</h3>
                    <span>job placement</span>
                </div>
            </div>

        </div>

    </section>

    @include('layouts.student-footer')

</body>

</html>
