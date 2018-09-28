@include('includes/header')
<section class="main-wrapper">
    <div class="container-fluid">
        @include('includes/sidebar')
        <div class="content-container">
            <div class="row">
                <div class="listsrow">
                    <div class="post-row clearfix">
                        @if(file_exists('public/users/'.$UserInfo['id'].'.jpg'))
                            <figure class="post-width post-image"  style="background-image: url({{ URL::asset('public/users/'. $UserInfo['id'].'.jpg') }})"></figure>
                        @else
                            <figure class="post-width post-image"  style="background-image: url({{ URL::asset('public/images/default_user.png') }})"></figure>
                        @endif
                        </figure>
                        <div class="contentwidth">
                            <div class="postscontent">
                                <h2>{{ $UserInfo->name }}</h2>
                                {{--<button class="follow-btn">Follow</button>--}}
                            </div>
                            <p class="followers"><span>{{ $UserInfo->followers }}</span> Followers</p>
                            <div class="rating error-rating">
                                <?php for($i = 0; $i < 5 ; $i++){ ?>
                                <?php if($i < (int)$AvgRating){ ?>
                                <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/filstar.png'); ?>">
                                <?php }else{ ?>
                                <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/empty-star.png'); ?>">
                                <?php } ?>
                                <?php } ?>
                                    <span>Average Playlist Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="info-table">
                    <div class="table-responsive">
                        <h3  class="title">User FavoURLtes</h3>
                        <div class="head-ul-fav-row">
                            <div class="head-ul-fav-col">
                                <span>Most Played Tracks</span>
                        <ul>
                            @foreach($TrackInfo as $track)
                            <li>{{$track->name}}</li>
                                @endforeach
                        </ul>
                                @if(session::get('UserInfo')['id'] == $UserInfo->id)
                                <button class="play-btn dektop-play-btn" id="add_track" data-toggle="modal" data-target="#addtrack"></button>
                                    @endif
                        </div>
                            <div class="head-ul-fav-col">
                                <span>Most Played Artists</span>
                        <ul>
                            @foreach($ArtistInfo as $artist)
                                <li>{{$artist->name}}</li>
                            @endforeach
                        </ul>
                                @if(session::get('UserInfo')['id'] == $UserInfo->id)
                                <button class="play-btn dektop-play-btn" id ="add_artist" data-toggle="modal" data-target="#addartist"></button>
                                @endif

                            </div>
                                <div class="head-ul-fav-col">
                                    <span>Most Played Genres</span>
                        <ul>
                            @foreach($GenreInfo as $genre)
                                <li>{{$genre->name}}</li>
                            @endforeach
                        </ul>
                                    @if(session::get('UserInfo')['id'] == $UserInfo->id)
                                    <button class="play-btn dektop-play-btn" id="add_genre" data-toggle="modal" data-target="#addgenre"></button>
                                    @endif

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('playlists_user', ['id' => $UserInfo->id])
    </div>
</section>


<div id="addartist" class="modal fade large-modal " role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content playmodal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src={{URL::asset('public/images/close-icon.png')}}></button>
                <h4 class="modal-title" id ="modal_title_artist">Add a favorite artist</h4>
            </div>
            <div class="modal-body">
                <div class="playform" id = "playform">
                    <form class="search-form">
                        <input  pattern=".{15,}" required title="15 characters minimum" type="text" id="artist_url" class="search-playlists new-playlist-input" placeholder="Paste spotify artist URL">
                        <button class="btn btn-playlists add-new-playlist" id="btn_add_artist"><img src={{URL::asset('public/images/plus-icon.png')}}>  Add artist</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


<div id="addgenre" class="modal fade large-modal " role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content playmodal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src={{URL::asset('public/images/close-icon.png')}}></button>
                <h4 class="modal-title" id ="modal_title_genre">Add favorite genre</h4>
            </div>

            <div class="modal-body">
                <div class="playform" id = "playform">

                    <select id="genre_select">
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach($Genres as $gen)
                        <option  value="{{$gen->name}}">{{$gen->name}}</option>
                            @endforeach
                    </select>


                    <button class="btn btn-playlists add-new-playlist" id="btn_add_genre"><img src={{URL::asset('public/images/plus-icon.png')}}>  Add Genre</button>

                </div>
            </div>
        </div>

    </div>
</div>

<div id="addtrack" class="modal fade large-modal " role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content playmodal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src={{URL::asset('public/images/close-icon.png')}}></button>
                <h4 class="modal-title" id ="modal_title_track">Add favorite track</h4>
            </div>
            <div class="modal-body">
                <div class="playform" id = "playform">
                    <form class="search-form">
                        <input  pattern=".{15,}" required title="15 characters minimum" type="text" id="track_url" class="search-playlists new-playlist-input" placeholder="Paste spotify track URL">
                        <button class="btn btn-playlists add-new-playlist" id="btn_add_track"><img src={{URL::asset('public/images/plus-icon.png')}}>  Add Track</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="playlists" class="modal fade large-modal " role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content playmodal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="images/close-icon.png"></button>
                <h4 class="modal-title">Add Playlist</h4>
            </div>
            <div class="modal-body">
                <div class="playform">
                    <form>
                        <input type="text" class="search-playlists" placeholder="Paste spotify playlist URL">
                        <button class="btn btn-playlists"><img src="images/plus-icon.png">  Add Playlist</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script src= {{URL::asset("public/js/jquery.js")}}></script>
<script src={{URL::asset("public/js/bootstrap.js")}}></script>
<script type="text/javascript">






    $("#add_track").on('click', function (e) {


        $("#modal_title_track").html("Add favorite track");


    });

    $("#add_artist").on('click', function (e) {


        $("#modal_title_artist").html("Add favorite artist");


    });


    $("#add_genre").on('click', function (e) {


        $("#modal_title_genre").html("Add favorite genre");


    });

    $(document).ready(function () {

        $(".loader").hide();

        $('.search-btns').on('click', function() {
            $('.search-form').toggle("slow");
        });
        $(".menu-icons").on('click', function() {
            $(".sidebar").animate({
                width: "toggle"
            });
            $(this).toggleClass("open");
        });
        $('.profile-navi').hide();
        $('.profile-nav-top').click(function () {
            $(this).next('.profile-navi').slideToggle();
        });
    });


    $('#btn_add_genre').on('click', function(e) {
        e.preventDefault();
        $('#modal_title_genre').html("Adding...........");
        var e = document.getElementById("genre_select");
        var strUser = e.options[e.selectedIndex].text;


        $.ajax({
            type: "get",
            url: "{{url('user/addGenre?genre=')}}"+strUser,
            success: function(data){

                console.log(data);

                if(data['Success'] == true) {
                    location.reload();

                }
                else if(data['Success'] == false)
                    $('#modal_title_genre').html("There was an error adding this genre......:(");

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });

    });

    $('#btn_add_artist').on('click', function(e) {
        e.preventDefault();
        $('#modal_title_artist').html("Adding......");
        $.ajax({
            type: "get",
            url: "{{url('user/addArtist?artist_id=')}}"+$('#artist_url').val(),
            success: function(data){

                console.log(data);

                if(data['Success'] == true) {
                    location.reload();

                }
                else if(data['Success'] == false)
                    $('#modal_title_artist').html("There was an error adding this artist......:(");

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });

    });


    $('#btn_add_track').on('click', function(e) {
        e.preventDefault();
        $('#modal_title_track').html("Adding......");
        $.ajax({
            type: "get",
            url: "{{url('user/addTrack?track_id=')}}"+$('#track_url').val(),
            success: function(data){

                console.log(data);

                if(data['Success'] == true) {
                    location.reload();

                }
                else if(data['Success'] == false)
                    $('#modal_title_track').html("There was an error adding this track......:(");

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });

    });

</script>
</body>
</html>