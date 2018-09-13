<!DOCTYPE html>
<html lang="en">

    <head>
      <title>Spotify</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href= {{ URL::asset('css/bootstrap.css') }}>
      <link rel="stylesheet" href= {{ URL::asset('pagination/mricode.pagination.css') }}>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
     <link rel="stylesheet" href= {{ URL::asset('css/style.css') }}>
    </head>
    <body>
        <header class="main-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-2 col-sm-4 col-xs-4">
                <div class="logo">
                  <img src="{{ URL::asset('images/logo.png') }}"/>
                </div>
              </div>
              <div class="col-md-5 hidden-sm hidden-xs">
                <div class="mobile-search">
                    <button class="btn search-btns">
                      <img src="{{ URL::asset('images/search.png') }}">
                    </button>
                  <!-- <form>
                    <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                  </form> -->
                </div>
                <div class="search">
                  <form>
                    <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                  </form>
                </div>

              </div>
              <div class="col-md-5 col-sm-8 col-xs-8">
                <div class="addplay-lists">
                  <div class="profile-nav">
                            <a href="#" class="profile-nav-top">
                                @if(file_exists('users/'. session::get('UserInfo')['id'].'.jpg'))
                                    <figure style="background-image: url({{ URL::asset('users/'. session::get('UserInfo')['id'].'.jpg') }})"></figure>
                                @else
                                    <figure style="background-image: url({{ URL::asset('images/default_user.png') }})"></figure>
                                @endif
                                <span>{{ session::get('UserInfo')['display_name'] }}</span>
                                <i class="fa fa-sort-down"></i>
                            </a>
                            <ul class="profile-navi">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </div>
                </div>
              </div>
            </div>
            <div class=" mobile-row">
              <div class="menu-icons" id="menu-icons">
                <span class="sr-onlys"></span>
                <span class="sr-onlys"></span>
                <span class="sr-onlys"></span>
                <span class="close-icons"></span>
              </div>
              <div class="playlists-rows">
                <button class="play-btn">
                    Add Playlist
                </button>
                <button class="btn search-btns">
                    <img src={{ URL::asset('images/search.png') }}>
                </button>
                <form class="search-form">
                  <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                </form>
              </div>

          </div>
        </header>
    </body>
</html>
