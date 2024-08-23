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

      <form action="{{ route('instructor.login.generate') }}" method="post" enctype="multipart/form-data" class="login">
        @csrf
        <h3>welcome back!</h3>
         <p>your email <span>*</span></p>
         <input type="email" name="email" value="{{ old('email') }}" placeholder="enter your email"  maxlength="40" required class="box">
         <p>your password <span>*</span></p>
         <input type="password" name="password" value="{{ old('password') }}" placeholder="enter your password" maxlength="20" required class="box">
         <p class="link">don't have an account? <a href="{{ route('instructor.register') }}">register new</a></p>
         <input type="submit" name="submit" value="login now" class="btn">
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
