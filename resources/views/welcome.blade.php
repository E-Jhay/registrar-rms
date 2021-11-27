<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Registrar Office') }}</title>
  <link rel="icon" href="{{ asset('dist/img/psu_logo.png') }}" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="wrapper">
        <section class="welcome" style="background-image: url('{{ asset('psu.jpg')}}');">
          <div class="navbar">
            <div class="navbar-content">
              <a href="{{route('login')}}">Login</a>
            </div>
          </div>
          <div class="top-triangle">
            
          </div>
          <div class="top-triangle-2">
            
          </div>
          <div class="bottom-triangle">

          </div>
          <div class="bottom-triangle-2">

          </div>
          <div class="title">
            <div class="title-content">
              <h1>Office of the University Registrar</h1>
              <h3>Pangasinan State University</h3>
            </div>
          <div>
        </section>
    </div>
</body>
</html>
