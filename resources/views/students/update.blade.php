<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

    @include('layouts.student-header')

    <section class="form-container" style="min-height: calc(100vh - 19rem);">

        <form action="{{ route('student.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <h3>update profile</h3>
            <div class="flex">
                <div class="col">
                    <p>your name</p>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="enter your name"
                        maxlength="100" class="box">
                    <p>your email</p>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="enter your email"
                        maxlength="100" class="box">
                    <p>update pic</p>
                    <input type="file" name="avatar" accept="image/*" class="box">
                </div>
                <div class="col">
                    <p>old password</p>
                    <input type="password" name="old_password" placeholder="enter your old password" maxlength="50"
                        class="box">
                    <p>new password</p>
                    <input type="password" name="password" placeholder="enter your new password" maxlength="50"
                        class="box">
                    <p>confirm password</p>
                    <input type="password" name="password_confirmation" placeholder="confirm your new password"
                        maxlength="50" class="box">
                </div>
            </div>
            <input type="submit" name="submit" value="update profile" class="btn">
        </form>

    </section>

    <!-- update profile section ends -->

    @include('layouts.student-footer')

</body>

</html>
