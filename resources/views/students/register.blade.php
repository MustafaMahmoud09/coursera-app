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
    <section class="form-container">

        <form class="register" action="{{ route('student.register.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <h3>create account</h3>
            <div class="flex">
                <div class="col">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="eneter your name"
                        maxlength="50" required class="box">
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="enter your email"
                        maxlength="50" required class="box">
                </div>
                <div class="col">
                    <p>your password <span>*</span></p>
                    <input type="password" name="password" value="{{ old('password') }}"
                        placeholder="enter your password" maxlength="20" required class="box">
                    <p>confirm password <span>*</span></p>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                        placeholder="confirm your password" maxlength="20" required class="box">
                </div>
            </div>
            <p>select pic <span>*</span></p>
            <input type="file" name="avatar" accept="image/*" value="{{ old('avatar') }}" required class="box">
            <p class="link">already have an account? <a href="{{ route('student.login') }}">login now</a></p>
            <input type="submit" name="submit" value="register now" class="btn">
        </form>

    </section>


    <!---->

    @include('layouts.student-footer')

    <!---->

</body>

</html>
