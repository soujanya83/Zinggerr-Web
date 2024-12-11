
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('pageTitle', config('app.name', 'Zinggerr LMS'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zinggerr Learning Management System">
    <meta name="author" content="Zinggerr">
    
    <link rel="icon" href="/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" >
    <link rel="stylesheet" href="/fonts/tabler-icons.min.css" >
    <link rel="stylesheet" href="/fonts/feather.css" >
    <link rel="stylesheet" href="/fonts/fontawesome.css" >
    <link rel="stylesheet" href="/fonts/material.css" >
    <link rel="stylesheet" href="/css/style.css" id="main-style-link" >
    <link rel="stylesheet" href="/css/style-preset.css" >
  </head>
  <body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    
    @yield('content')

    <script src="/js/plugins/popper.min.js"></script>
    <script src="/js/plugins/simplebar.min.js"></script>
    <script src="/js/plugins/bootstrap.min.js"></script>
    <script src="/js/fonts/custom-font.js"></script>
    <script src="/js/pcoded.js"></script>
    <script src="/js/plugins/feather.min.js"></script>
  </body>
</html>
