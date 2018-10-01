<!DOCTYPE html>
<html lang="en">

    <head>
      <title>Spotify</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href= {{ URL::asset('public/css/bootstrap.css') }}>
        <link rel="stylesheet" href= {{ URL::asset('public/css/nice-select.css') }}>
        <link rel="shortcut icon" type="image/png" href="<?php echo asset('public/images/favicon.png'); ?>"/>
      <link rel="stylesheet" href= {{ URL::asset('public/pagination/mricode.pagination.css') }}>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
     <link rel="stylesheet" href= {{ URL::asset('public/css/style.css') }}>
    </head>
    <body>
        <header class="main-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-2 col-sm-4 col-xs-4">
                <div class="logo">
                  <a href="{{url('/')}}"><img src="{{ URL::asset('public/images/logo.png') }}"/></a>
                </div>
              </div>
              <div class="col-md-5 hidden-sm hidden-xs">
                <div class="mobile-search">
                    <button class="btn search-btns">
                      <img src="{{ URL::asset('public/images/search.png') }}">
                    </button>
                  <!-- <form>
                    <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                  </form> -->
                </div>
                <div class="search">
                    {{ Form::open(array('url' => 'search', 'method' => 'get')) }}
                        <input  value="{{ isset($queryString)?$queryString:'' }}" type="text" name="queryString" class="serch-icons" placeholder="Search for a spotify albums...">
                    {{ Form::close() }}
                </div>

              </div>
              <div class="col-md-5 col-sm-8 col-xs-8">
                <div class="addplay-lists">
                    <button class="play-btn dektop-play-btn" data-toggle="modal" data-target="#playlists">
                        Add Playlist
                    </button>
                  <div class="profile-nav">
                            <a href="#" class="profile-nav-top">
                                @if(file_exists('public/users/'. session::get('UserInfo')['id'].'.jpg'))
                                    <figure style="background-image: url({{ URL::asset('public/users/'. session::get('UserInfo')['id'].'.jpg') }})"></figure>
                                @else
                                    <figure style="background-image: url({{ URL::asset('public/images/default_user.png') }})"></figure>
                                @endif
                                <span>{{ session::get('UserInfo')['display_name'] }}</span>
                                <i class="fa fa-sort-down"></i>
                            </a>
                            <ul class="profile-navi">
                                <!-- <li><a href="#">Profile</a></li> -->
                                <li><a href="{{ url('users/me') }}">My Profile</a></li>
                                <li><a href="{{ url('logout') }}">Logout</a></li>
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
                <button class="play-btn" id ="btn_add" data-toggle="modal" data-target="#playlists">
                    Add Playlist
                </button>
                <button class="btn search-btns">
                
                    <img src={{ URL::asset('public/images/search.png') }}>
                </button>
                <form class="search-form">
                {{ Form::open(array('url' => 'search', 'method' => 'get')) }}
                  <input type="text" name="" class="serch-icons" placeholder="Search for spotify albums...">
                  {{ Form::close() }}
                </form>
              </div>

          </div>
          </div>
        </header>
    </body>

    <div id="playlists" class="modal fade large-modal " role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content playmodal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><img src={{URL::asset('public/images/close-icon.png')}}></button>
                    <h4 class="modal-title" id ="modal_title">Add Playlist</h4>
                </div>
                <div class="modal-body">
                    <div class="loader" id ="loaderChota">
                        <img src = "{{ URL::asset('public//images/loading.gif') }}"/>
                    </div>
                    <div class="playform" id = "playform">
                        <form class="search-form">
                            <input  pattern=".{15,}" required title="15 characters minimum" type="text" id="url" class="search-playlists new-playlist-input" placeholder="Paste spotify playlist URL">
                            <button class="btn btn-playlists add-new-playlist" id="btn_add_playlist"><img src={{URL::asset('public/images/plus-icon.png')}}>  Add Playlist</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('public/js/custom.js') }}"></script>

    <script>

        $(document).ready(function(){

            $('#url').val("");
            $('#loaderChota').hide();

        });

        $('#btn_add').on('click', function(e){

            $('#modal_title').html("Add Playlist URL");
            $('#url').val("");

        });
        $('#btn_add_playlist').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{url('playlist/add?url=')}}" + $('#url').val(),
                success: function(data){

                    if(data['Success'] == true) {
                        $('#loaderChota').fadeIn();
                        $('#playform').fadeOut();
                        $('#modal_title').html("Playlist found.....adding to system");


                        $.ajax({
                            type: "get",
                            url: "{{url('playlist/insertSimple/')}}" +'/' + data['id'],
                            success: function (data) {

                                if (data['Success'] == true) {
                                    window.location = ('{{url('playlist/open-playlist/')}}' +'/' + data['id']);
                                }
                                else {

                                    $('#loaderChota').fadeOut();
                                    $('#playform').fadeIn();
                                }
                            },

                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                $('#modal_title').html("There was an error in importing playlist");
                                console.log("Status: " + textStatus);
                                $('#loaderChota').fadeOut();
                                $('#playform').fadeIn();
                            },
                        });

                    }
                    else if(data['Success'] == false)
                        $('#modal_title').html("Playlist not found......:(");

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#modal_title').html("Playlist not found");
                    console.log("Status: " + textStatus);
                    $('#loaderChota').fadeOut();
                    $('#playform').fadeIn();
                }
            });

        });

    </script>
</html>
