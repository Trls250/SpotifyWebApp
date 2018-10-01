
<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Spotify</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" type="image/png" href="<?php echo asset('public/images/favicon.png'); ?>"/>
      <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.css') }}">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
     <link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
     <style type="text/css">

     </style>
    </head>
    <body>
      <header class="main-login-header">
        <div class="container">
          <div class="row">
            <div class="col-md-12 log-column">
              <div class="logo">
                <img src="{{ URL::asset('public/images/logo.png') }}"/>
                <h1 class="main-title">  <span>|</span> Spotify</h1>
              </div>
            </div>
          </div>
      </header>
      <section class="login-banner jumbotron">
        <div class="container">
          <div class="cus-row">
              <div id="jumbo-dialog" class="text-center">
                <h1 id="ttitle">Spotify</h1>
                <p>  Login with your Spotify account to get started</p>
                <a href="<?php echo url('auth/getCode') ?>" class="btn btn-primary green-btn" >Login with Spotify</a>
              </div>
          </div>
        </div>
      </section>
      <script src="{{ URL::asset('public/js/jquery.js') }}"></script>
      <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>
      <script type="text/javascript">
        var heig = $( window ).height() - 94;
        $('.login-banner').css( "height",heig );
      </script>
    </body>
</html>