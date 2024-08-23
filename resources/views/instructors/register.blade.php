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

<body style="padding-left: 0;">


    @include('layouts.fetch-error')


    <!-- register section starts  -->

    <section class="form-container">

        <form class="register" action="{{ route('instructor.register.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <h3>register new</h3>
            <div class="flex">
                <div class="col">
                    <p>your name <span>*</span></p>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="eneter your name"
                        maxlength="50" required class="box">
                    <p>your profession <span>*</span></p>
                    <select name="profession" class="box" required>
                        <option value="" disabled selected>-- select your profession</option>

                        <!--foreach on professions-->
                        @foreach ($professions as $profession)
                            <option value="{{ $profession->id }}"
                                {{ old('profession') == $profession->id ? 'selected' : '' }}>{{ $profession->profession }}
                            </option>
                        @endforeach

                    </select>
                    <p>your email <span>*</span></p>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="enter your email" maxlength="40" required
                        class="box">
                </div>
                <div class="col">
                    <p>your password <span>*</span></p>
                    <input type="password" name="password" value="{{ old('password') }}" placeholder="enter your password" maxlength="20" required
                        class="box">
                    <p>confirm password <span>*</span></p>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="confirm your password"
                        maxlength="20" required class="box">
                    <p>select pic <span>*</span></p>
                    <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*" required class="box">
                </div>
            </div>
            <p class="link">already have an account? <a href="{{ route('instructor.login') }}">login now</a></p>
            <input type="submit" name="submit" value="register now" class="btn">
        </form>

    </section>

    <!-- registe section ends -->

    <script>
        let darkMode = localStorage.getItem('dark-mode');
        let body = document.body;

        const enabelDarkMode = () => {
            body.classList.add('dark');
            localStorage.setItem('dark-mode', 'enabled');
        }

        const disableDarkMode = () => {
            body.classList.remove('dark');
            localStorage.setItem('dark-mode', 'disabled');
        }

        if (darkMode === 'enabled') {
            enabelDarkMode();
        } else {
            disableDarkMode();
        }
    </script>

</body>

</html>
