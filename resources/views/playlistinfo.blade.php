@include('includes/header')

        <section class="main-wrapper">
          <div class="container-fluid">
            <div class="sidebar">
              <ul class="sidebar-lists">
                <li class="active">
                  <a href="#">Wall</a>
                </li>
                <li>
                  <a href="#">Playlists</a>
                </li>
                <li>
                  <a href="#">Playlists</a>
                </li>
              </ul>
            </div>
            <div class="content-container">
              <div class="row">
                <div class="listsrow">
                  <div class="post-row clearfix">
                      <div class="post-width post-image"  style="background-image: url({{ URL::asset('playlists/'.$Playlist['id'].'.jpg') }});">
                      </div>
                      <div class="contentwidth">
                        <div class="postscontent">
                          <h2>{{ $Playlist['title'] }} <sub>({{ $Playlist['timeNow'] }})</sub></h2>
                          <!--<button class="follow-btn">Follow</button>-->
                          <p><img src= {{ URL::asset('images/refresh-icon.png') }}>  Refresh </p>
                        </div>
                        <p class="followers"><span>87</span> Followers</p>
                        <div class="rating">
                          <img src= {{ URL::asset('images/filstar.png') }}>
                          <img src= {{ URL::asset('images/filstar.png') }}>
                          <img src= {{ URL::asset('images/filstar.png') }}>
                          <img src= {{ URL::asset('images/filstar.png') }}>
                          <img src= {{ URL::asset('images/empty-star.png') }}>
                          <span>(230 Rate it)</span>
                        </div>
                        <div class="popular-lists">
                          <ul>
                            <li>
                              Popularity<br/>
                              <span>{{ $Playlist['popularity'] }}</span>
                            </li>
                            <li>
                              Danceability<br/>
                              <span>{{ $Playlist['danceability'] }}</span>
                            </li>
                            <li>
                              Energy<br/>
                              <span>{{ $Playlist['energy'] }}</span>
                            </li>
                            <li>
                              Valence<br/>
                              <span>{{ $Playlist['valence'] }}</span>
                            </li>
                          </ul>
                        </div>
                        <div class="tags">
                          <ul>
                            <li>
                              GENRES
                            </li>
                            <li>Rock</li>
                            <li>Jazz</li>
                            <li>Pop</li>
                          </ul>
                        </div>
                        <div class="taglists">
                          <div class="playimage" style="background-image: url('{{ URL::asset('images/profile.png') }}')"></div>
                          <div class="playname">
                            <p>Playlist By:</p>
                            <h3>Maurice Morgan</h3>
                          </div>
                        </div>
                      </div>
                  </div>
                  <h3 class="infor">Playlist Information</h3>
                </div>
              </div>

              <div class ="row">
                    <div class="info-table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tracks</th>
                                            <th>Artists</th>
                                            <th>Genre</th>
                                            <th>Year</th>
                                            <th>Popularity</th>
                                            <th>Danceability</th>
                                            <th>Energy</th>
                                            <th>Rock</th>
                                            <th>Instrumentalness</th>
                                            <th>Livenss</th>
                                            <th>Loudness</th>
                                            <th>Speechiness</th>
                                            <th>Temp</th>
                                        </tr>
                                    </thead>
                                    <tbody id="to_replace">

                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="loader">
                        <img src = "{{ URL::asset('/images/loading.gif') }}"/>
                    </div>
              </div>

              <div class ="row">
                  <div id="pagination-demo" class="m-pagination"></div>
              </div>
        </section>

        <script src= "{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('pagination/mricode.pagination.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.js') }}"></script>1

        <script type="text/javascript">

            var pageSizeGlobal = 25;

          $(document).ready(function () {

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

        });


        $(document).ready(function () {
            $.ajax({
                type: "get",
                url: "{{ url('playlist/table/'.$Playlist['id'])}}"+'?items=25&page=1',
                success: function (data) {
                    $(".loader").fadeOut();
                    $('#to_replace').html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            });

        });


        //end ready function

        $("#pagination-demo").on("pageClicked", function (event, data) {
            $(".loader").fadeIn();
            $.ajax({
                type: "get",
                url: "{{ url('playlist/table/'.$Playlist['id'])}}"+'?items='+data.pageSize+'&page='+(data.pageIndex +1),
                success: function (data) {
                    $(".loader").fadeOut();
                    $('#to_replace').html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            })
        });





        </script>
    </body>
</html>
