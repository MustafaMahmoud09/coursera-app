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


    <!-- contact section starts  -->

    <section class="contact">

        <div class="row">

            <div class="image">
                <img src="{{ asset('images/contact-img.svg') }}" alt="">
            </div>

            <form action="{{ route('student.contacts.store') }}" method="post">
                @csrf
                <h3>get in touch</h3>
                <input type="text" value="{{ old('name') }}" placeholder="enter your name" required maxlength="100" name="name"
                    class="box">
                <input type="email" value="{{ old('email') }}" placeholder="enter your email" required maxlength="100" name="email"
                    class="box">
                <input type="number" value="{{ old('phone_number') }}" min="0" max="9999999999" placeholder="enter your number" required
                    maxlength="10" name="phone_number" class="box">
                <textarea name="message" class="box" placeholder="enter your message" required cols="30" rows="10"
                    maxlength="1000">{{ old('message') }}</textarea>
                <input type="submit" value="send message" class="inline-btn" name="submit">
            </form>

        </div>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-phone"></i>
                <h3>phone number</h3>
                <a href="tel:01025824895">01025824895</a>
                <a href="tel:01272698670">01272698670</a>
            </div>

            <div class="box">
                <i class="fas fa-envelope"></i>
                <h3>email address</h3>
                <a href="mailto:mustafa45salem@gmail.com">mustafa45salem@gmail.com</a>
                <a href="mailto:mustafamahmoud12444@gmail.com">mustafamahmoud12444@gmail.com</a>
            </div>



        </div>

    </section>

    <!-- contact section ends -->


    @include('layouts.student-footer')

</body>

</html>
