@include('includes/header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <section class="main-wrapper search-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')
     
            <div  class="content-container">
              <div class="row ">
                <div class="col-md-12 column-flex">
                  <h3  class="title">{{$Title}}</h3>
                  <div class="flex-column">
                  </div>
                </div>
              </div>
            
            <div id ="wall_records">
            <div class="playlist_records latest-activity">
                <p class="popular-user">Popular Users</p>
              <div class="table-responsive">


              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                            Users
                            </th>
                            <th>
                            Followers
                            </th>
                            
                            <th>
                            Avg Playlist Rating
                            </th>
                            <th>
                            User's Playlists
                            </th>
                            </tr>
                            </thead>
                            <tbody id="table_append_pop_users">
                            @foreach($Users as $user)
                              <tr>
                                  <td>
                                      <div class="spotify-image-row">
                                      @if(file_exists('public/users/'.$user->id.'.jpg'))
                                          <div class="spotify-image-profile" style="background-image: url({{ URL::asset('public/users/'. $user->id.'.jpg')}})">
                                      @else
                                          <div class="spotify-image-profile" style="background-image: url({{ URL::asset('public/images/default_user.png')}})">
                                      @endif
                                          </div>
                                          <div class="spotify-image-content">
                                              <h6>
                                              <a href="{{url('users/get').'/'.$user->id}}">{{ $user->name }}</a>
                                              </h6>
                                          </div>
                                      </div>
                                  </td>
                                  <td>
                                  {{ $user->followers }}
                                  </td>
                                  
                                  <td>
                                  
                                      <div class="avg-playlist-rating" style="justify-content: center;">
                                          <div class="rating-column">
                                          <?php for($i = 0; $i < 5 ; $i++){ ?>
                                          <?php if($i < (int)$user->AvgRating){ ?>
                                          <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/filstar.png'); ?>">
                                          <?php }else{ ?>
                                          <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/empty-star.png'); ?>">
                                          <?php } ?>
                                          <?php } ?>
                                          </div>
<!--                                          <div class="rating-column">
                                              <a href="{{url('playlist/getUserWall'.'/'.$user->name.'/'.$user->id)}}" class="see-play-list">See Playlists <img src="http://localhost/spotify/public/images/go-arrow.png"></a>
                                          </div>-->
                                      </div>
                                  </td>
                                  <td>
                                      <div class="rating-column" style="width: auto;">
                                              <a href="{{url('playlist/getUserWall'.'/'.$user->name.'/'.$user->id)}}" class="see-play-list">See Playlists </a>
                                          </div>
                                  </td>
                              </tr>

                        @endforeach
                  </tbody>
                </table>
              </div>
                

              <p class="popular-user">New Playlists</p>
              <table class="table">
                  <thead>
                      <tr>
                          <th>
                              Name
                          </th>
                          <th>
                              Popularity
                          </th>
                          <th>
                              Danceability
                          </th>
                          <th>
                              Energy
                          </th>
                          <th>
                              Valence
                          </th>
                          <th>
                              Instrumentalness
                          </th>
                          <th>
                              Liveness
                          </th>
                          <th>
                              Loudness
                          </th>
                          <th>
                              Speechiness
                          </th>
                          <th>
                              BPM
                          </th>
                          <th>
                              Acousticeness
                          </th>
                      </tr>
                  </thead>
                  <tbody id = "table_append_new_playlists">

                    @foreach($PlaylistsNew as $playlist)
                    <tr>
                        <td>
                            <h6 class="spotify-image-content">
                                @if(isset($playlist->playlist_id))
                                    <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->playlist_id); ?>">{{$playlist->title}}</a>
                                @else
                                <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->id); ?>">{{$playlist->title}}</a>
                                @endif
                                </h6>
                        </td>
                        <td>
                                    @if ( $playlist->popularity >= 90 )
                                    <span> It's a Hit! </span>
                                    @else
                                    <span>{{ number_format($playlist->popularity,0) }}%</span>
                                    @endif
                        </td>
                        <td>
                        <span>{{ number_format($playlist->danceability,0)}}%</span>

                        </td>
                        <td>
                        <span>{{ number_format($playlist->energy,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->valence,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->instrumentalness,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->liveness,0)}}%</span>                    
                        </td>
                        <td>
                        <span>{{ number_format($playlist->loudness,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->speechiness,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->tempo,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->acousticness,0)}}%</span>
                        </td>
                    </tr>
                    @endforeach

                  </tbody>
              </table>
              </div>

              <div class="table-responsive">

              <p class="popular-user">Top Rated Playlists</p>
              <table class="table">
                  <thead>
                      <tr>
                          <th>
                              Name
                          </th>
                          <th>
                              Popularity
                          </th>
                          <th>
                              Danceability
                          </th>
                          <th>
                              Energy
                          </th>
                          <th>
                              Valence
                          </th>
                          <th>
                              Instrumentalness
                          </th>
                          <th>
                              Liveness
                          </th>
                          <th>
                              Loudness
                          </th>
                          <th>
                              Speechiness
                          </th>
                          <th>
                              BPM
                          </th>
                          <th>
                              Acousticeness
                          </th>
                      </tr>
                  </thead>
                  <tbody id="table_append_top_playlists">

                    @foreach($PlaylistsTop as $playlist)
                    <tr>
                        <td>
                            <h6 class="spotify-image-content">
                                @if(isset($playlist->playlist_id))
                                    <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->playlist_id); ?>">{{$playlist->title}}</a>
                                @else
                                <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->id); ?>">{{$playlist->title}}</a>
                                @endif
                                </h6>
                        </td>
                        <td>
                                    @if ( $playlist->popularity >= 90 )
                                    <span> It's a Hit! </span>
                                    @else
                                    <span>{{ number_format($playlist->popularity,0) }}%</span>
                                    @endif
                        </td>
                        <td>
                        <span>{{ number_format($playlist->danceability,0)}}%</span>

                        </td>
                        <td>
                        <span>{{ number_format($playlist->energy,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->valence,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->instrumentalness,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->liveness,0)}}%</span>                    
                        </td>
                        <td>
                        <span>{{ number_format($playlist->loudness,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->speechiness,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->tempo,0)}}%</span>
                        </td>
                        <td>
                        <span>{{ number_format($playlist->acousticness,0)}}%</span>
                        </td>
                    </tr>
                    @endforeach


                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
        </section>


        <script src="{{ URL::asset('public/js/jquery.nice-select.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>   
        
        <script type="text/javascript">


            $('input[type=checkbox]').removeAttr('checked');




            $(document).ready(function () {
                $(function() {
                // var output = document.querySelectorAll('output')[0];
                $(document).on('input', 'input[type="range"]', function(e) {
                        // console.log($(this).prev());
                        $(this).parents('.range1').find('label output').html(e.currentTarget.value);
                        // output.innerHTML = e.currentTarget.value;
                });
                $('input[type=range]').rangeslider({
                    polyfill: false
                });
                });
                // $('#toggle-search').on('click', function() {
                //   $('#searchBar').toggle("slow");
                // });
                $('.profile-navi').hide();

                $("#search1").select2({
                  width: "100%",
                  allowClear: true,
                });
                $("#search2").select2({
                  width: "100%",
                  allowClear: true,
                });
                $("#search3").select2({
                  width: "100%",
                  allowClear: true,
                });

              //   $('select:not(.ignore)').niceSelect();      
              // FastClick.attach(document.body);
                 
          
          
                
          $(document).ready(function() {
            $('select').niceSelect(); 
            $("#advanced").show();
            getRecords();
          });
          
          $(document).ready(function () {
                $(".menu-icons").on('click', function() {
                  $(".sidebar").animate({
                    width: "toggle"
                  });
                  $(this).toggleClass("open");
                });



          });


            });
        </script>
        

    </body>
</html>