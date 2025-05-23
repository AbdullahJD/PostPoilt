<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="stylesheet" href="{{asset('asset/style.css')}}">
   </head>
   <body>
      <div class="wrapper">
         <div class="title">
            Login Form
         </div>
         <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
               <input type="email" name="email" placeholder="Email">
            </div>
            <div class="field">
               <input type="password" name="password" placeholder="Password">
            </div>
            <div class="content">
               <div class="checkbox">
                  <input type="checkbox" id="remember-me">
                  <label for="remember-me">Remember me</label>
               </div>
               <div class="pass-link">
                  <a href="#">Forgot password?</a>
               </div>
            </div>
            <div class="field">
                <input type="submit" value="Login">
            </div>
            <div class="signup-link">
               Not a member? <a href="{{ URL('register') }}">Signup now</a>
            </div>
         </form>
      </div>
   </body>
</html>