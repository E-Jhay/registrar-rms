<!DOCTYPE html>
<html>
<head>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Login</title>
  <link rel="icon" href="{{ asset('dist/img/psu_logo.png') }}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{ asset('custom-css/style.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{ asset('custom-img/waveee.png') }}">
	<div class="container">
		<div class="img">
			<img src="{{ asset('custom-img/log-in-bg.svg') }}">
		</div>
		<div class="login-content">
			<form method="POST" action="{{ route('login') }}">
        @csrf
				<fieldset>
				<legend><img src="{{ asset('custom-img/avatar.svg') }}"></legend>
				<h2 class="title">PSU-ACC</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">	
           		   		<h5>Email</h5>
           		   		<input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
           		   </div>
           		</div>
              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            	   </div>
            	</div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
              @if (Route::has('password.request'))
            	  <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
              @endif
            	<input type="submit" class="btn" value="Login">
			</fieldset>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('custom-js/main.js') }}"></script>
</body>
</html>
