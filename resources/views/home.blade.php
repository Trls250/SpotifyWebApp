
<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Spotify</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
     <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">     
     <style type="text/css">

     </style>
    </head>
    <body>
      <header class="main-login-header">
        <div class="container">
          <div class="row">
            <div class="col-md-12 log-column">
              <div class="logo">
                <img src="{{ URL::asset('images/logo.png') }}"/> 
                <h1 class="main-title">  <span>|</span> The Unfollower</h1>
              </div>
            </div>
          </div>
      </header>
      <section class="login-banner jumbotron">
        <div class="container">
          <div class="cus-row">
              <div id="jumbo-dialog" class="text-center">
                <h1 id="ttitle">The Unfollower</h1>
                <p id="ttext">
                    This app will make it easy for you to unfollow large numbers of
                    playlists.
                </p>
                <p>  Login with your Spotify account to get started</p>
                <a href="<?php echo url('auth/getCode') ?>" class="btn btn-primary green-btn" >Login with Spotify</a>
              </div>
          </div>
        </div>
      </section>
      <script src="{{ URL::asset('js/jquery.js') }}"></script>
      <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
      <script type="text/javascript">
        var heig = $( window ).height() - 94;
        $('.login-banner').css( "height",heig );
      </script>
    </body>
</html>