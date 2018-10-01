@include('includes/header')

        <section class="main-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')


            <div id="fullpage_loader">
                  <img  class= 'center-block loader-img' src = "{{ URL::asset('public//images/loading.gif') }}"/>
            </div>
              
            <div class="content-container" id ="all_info_container">
              <div class="row">
                  <div class="detail-page">


                <div class="listsrow" id="playlist_thump">
                  <div class="post-row clearfix">
                      @if(file_exists('playlists/'.$Playlist["id"].'.jpg'))
                          <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/playlists/'.$Playlist['id'].'.jpg') }});">
                          </div>
                      @else
                          <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                          </div>
                      @endif

                      <div class="contentwidth">
                        <div class="postscontent">
                          <h2>{{ $Playlist['title'] }} <sub>({{ $Playlist['timeNow'] }})</sub></h2>
                          <!--<button class="follow-btn">Follow</button>-->
                          <p id="refresh_playlist"><img  src= {{ URL::asset('public/images/refresh-icon.png') }}>  Refresh </p>
                        </div>
                        <p class="followers"><span>{{$Playlist['followers']}}</span> Followers</p>
                        <div class="rating">

                            @for($i=0; $i<ceil($Playlist['rating']); $i++)
                                <img src= {{ URL::asset('public/images/filstar.png') }}>
                            @endfor
                            @for($i=0; $i<5 - ceil($Playlist['rating']); $i++)
                                    <img src= {{ URL::asset('public/images/empty-star.png') }}>
                                @endfor


                          <span>({{$Playlist['rating_count']}} Rated it)</span>
                        </div>
                        <div class="popular-lists">
                        <ul>
                        <li>
                            Popularity<br/>
                            @if ( $Playlist->popularity >= 90 )
                            <span> It's a Hit! </span>
                            @else
                            <span>{{ number_format($Playlist->popularity,0) }}%</span>
                            @endif
                        </li>
                        <li>
                            Danceability<br/>
                            <span>{{ number_format($Playlist->danceability,0)}}%</span>
                        </li>
                        <li>
                            Energy<br/>
                            <span>{{ number_format($Playlist->energy,0)}}%</span>
                        </li>
                        <li>
                            Valence<br/>
                            <span>{{ number_format($Playlist->valence,0)}}%</span>
                        </li>
                        <li>
                            Instrumentalness<br/>
                            <span>{{ number_format($Playlist->instrumentalness,0)}}%</span>
                        </li>
                        <li>
                            Liveness<br/>
                            <span>{{ number_format($Playlist->liveness,0)}}%</span>
                        </li>
                        <li>
                            Loudness<br/>
                            <span>{{ number_format($Playlist->loudness,0)}}%</span>
                        </li>
                        <li>
                            Speechiness<br/>
                            <span>{{ number_format($Playlist->speechiness,0)}}%</span>
                        </li>
                        <li>
                            BPM<br/>
                            <span>{{ number_format($Playlist->tempo,0)}}%</span>
                        </li>
                    </ul>
                        </div>
                        <div class="tags">
                          <!--<ul>
                            <li>
                              GENRES
                            </li>
                            <li>Rock</li>
                            <li>Jazz</li>
                            <li>Pop</li>
                          </ul>-->
                            <p>Most Repeated Artist:</p>
                            <span>{{$Playlist['repeated_artist']}}</span>
                        </div>
                        <div class="taglists">
                          <!--<div class="playimage" style="background-image: url('{{ URL::asset('public/images/profile.png') }}')"></div>-->
                          <div class="playname">
                            <p>Playlist By:</p>
                            <span>{{$Playlist['creator_name']}}</span>
                          </div>
                        </div>
                      </div>
                  </div>
                  <h3 class="infor">Playlist Information</h3>
                </div>
                  </div>
                  
              </div>

                
              <div class ="row">
                    <div class="info-table" id="tracks_table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tracks</th>
                                            <th>Artists</th>
                                            <th>Genre</th>
                                            <th>Popularity</th>
                                            <th>Danceability</th>
                                            <th>Energy</th>
                                            <th>Valence</th>
                                            <th>Instrumentalness</th>
                                            <th>Livenss</th>
                                            <th>Loudness</th>
                                            <th>Speechiness</th>
                                            <th>BPM</th>
                                            <th>Acousticness</th>
                                            <th>Length</th>
                                        </tr>
                                    </thead>
                                    <tbody id="to_replace">

                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div  id ="loaderChota" class="loader">
                        <img src = "{{ URL::asset('public//images/loading.gif') }}"/>
                    </div>
              </div>

              <div class ="row">
                  <div id="pagination-demo" class="m-pagination"></div>
              </div>
        </section>


        <script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/pagination/mricode.pagination.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>

        <script type="text/javascript">

            var pageSizeGlobal = 25;

          $(document).ready(function () {

              $('#fullpage_loader').hide();
              $("#loaderChota").hide();

            $("#pagination-demo").pagination({
                pageIndex: 0,
                pageSize: pageSizeGlobal,
                total: {{ $Playlist['total_tracks'] }},
                pageBtnCount: 9,
                showFirstLastBtn: true,
                firstBtnText: 'First',
                lastBtnText: 'Last',
                prevBtnText: "&laquo;",
                nextBtnText: "&raquo;",
                loadFirstPage: true,
                pageElementSort: ['$page', '$size', '$jump', '$info'],
                showInfo: false,
                infoFormat: '{start} ~ {end} of {total} entires',
                noInfoText: '0 entires',
                showJump: false,
                jumpBtnText: 'Go',
                showPageSizes: false,
                pageSizeItems: [5, 10, 15, 20],
                debug: false
              });


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


                $("#loaderChota").fadeIn();
              $.ajax({
                  
                  type: "get",
                  url: "{{ url('playlist/table/'.$Playlist['id'])}}"+'?items=25&page=1',
                  success: function (data) {
                    $("#loaderChota").hide();
                    $(".loader").hide();
                      if(data.Status == "404"){

                          $("#tracks_table").replaceWith("Sorry, currently there is no track in this playlist.")
                      }
                      else {
                          $('#to_replace').html(data);
                      }
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                      console.log("Status: " + textStatus); alert("Error: " + errorThrown);
                  }
              });

        });

        $("#refresh_playlist").on("click", function () {
            // show main loader here

            $('#all_info_container').hide();
            $('#fullpage_loader').fadeIn();
            $('.loader').fadeIn();
            $('#loader_chota').hide();
            //$("#all_info_container").html("<div class='loader'> <img class= 'center-block loader-img' src = '{{ URL::asset('public//images/loading.gif') }}'/> </div>");
            $.ajax({
                type: "get",
                url: "{{ url('playlist/calculate/'.$Playlist['id'])}}",
                success: function (data) {

                       window.location = "{{URL::to('playlist/calculate/'.$Playlist['id'])}}"

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            })
        });

        //end ready function

        $("#pagination-demo").on("pageClicked", function (event, data) {
            $("#loader_chota").fadeIn();
            $('.loader').fadeIn();
            $('#main_loader').fadeIn();
            $.ajax({
                type: "get",
                url: "{{ url('playlist/table/'.$Playlist['id'])}}"+'?items='+data.pageSize+'&page='+(data.pageIndex +1),
                success: function (data) {
                    $("#loader_chota").fadeOut();
                    $(".loader").fadeOut();
                    $('#to_replace').html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            })
        });
        </script>
    </body>
</html>
