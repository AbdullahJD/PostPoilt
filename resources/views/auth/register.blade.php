<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Register</title>
      <link rel="stylesheet" href="{{ asset('asset/style.css') }}">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Register Form
         </div>
         <form method="POST" action="/register">
            @csrf
            <div class="field">
               <input type="text" name="name" placeholder="Full Name" required>
            </div>
            <div class="field">
               <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="field">
               <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="field">
               <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <div class="field">
               <input type="submit" value="Register">
            </div>
            <div class="signup-link">
               Already have an account? <a href="{{ URL('Login') }}">Login now</a>
            </div>
         </form>
      </div>
   </body>
</html>