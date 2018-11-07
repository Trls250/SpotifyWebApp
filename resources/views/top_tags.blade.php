@include('includes/header')
<meta name="csrf-token" content="{{ csrf_token() }}" />

        <section class="main-wrapper search-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')
              @include('includes/tags');
            <div  class="content-container">
              <div class="row ">
                <div class="col-md-12 column-flex">
                  <h3  class="title">{{$Title}}</h3>
                  <div class="flex-column">
                  </div>
                </div>
              </div>
            
            <div id ="wall_records">
                @foreach($Playlists as $playlist)
                      <div class="row playlist-filter">
                          <div class="post-row clearfix">                   
                              @if(file_exists('public/playlists/'.$playlist['object']->id.'.jpg'))
                                  <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist['object']->id.'.jpg') }});">
                                  </div>
                              @else
                                  <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                                  </div>
                              @endif

                              <div class="contentwidth">
                                  <div class="postscontent" >

                                      <a href="<?php echo URL::to('/playlist/open-tagged-playlist/'.$playlist['object']->id); ?>"><h2>{{ $playlist['object']->title }}</h2></a>

                                  @if(isset($playlist['object']->tagged_by_user_id))
                                      @if($playlist['object']->tagged_by_user_name != null && $playlist['object']->tagged_by_user_name != '')
                                          <h6 class="tag-titles"><span>Tagged By </span><a href="{{url('users/get').'/'.$playlist['object']->tagged_by_user_id}}">{{$playlist['object']->tagged_by_user_name}}</a></h6>
                                      @else
                                          <h6 class="tag-titles"><span>Tagged By </span><a href="{{url('users/get').'/'.$playlist['object']->tagged_by_user_id}}">{{$playlist['object']->tagged_by_user_id}}</a></h6>
                                      @endif
                                  @endif
                        
                                      <!--<button class="follow-btn">Follow</button>-->
                                  </div>
                                  <p class="followers"><span>{{$playlist['object']->total_tracks}}</span> Tracks <span> - </span>
                                  <span>{{$playlist['object']->followers}}</span> Followers</p>
                                  <p><?php echo $playlist['object']->description ?></p>
                                  <div class="rating">

                                      @for($i=0; $i<ceil($playlist['object']->rating); $i++)
                                          <img src= {{ URL::asset('public/images/filstar.png') }}>
                                      @endfor
                                      @for($i=0; $i<5 - ceil($playlist['object']->rating); $i++)
                                          <img src= {{ URL::asset('public/images/empty-star.png') }}>
                                      @endfor


                                      <span>({{$playlist['object']->rating_count}} Rated it)</span>
                                  </div>
                                  <div class="popular-lists">
                                      <ul>
                                          <li>
                                              Popularity<br/>
                                              @if ( $playlist['object']->popularity >= 90 )
                                              <span> It's a Hit! </span>
                                              @else
                                              <span>{{ number_format($playlist['object']->popularity,0) }}%</span>
                                              @endif
                                          </li>
                                          <li>
                                              Danceability<br/>
                                              <span>{{ number_format($playlist['object']->danceability,0)}}%</span>
                                          </li>
                                          <li>
                                              Energy<br/>
                                              <span>{{ number_format($playlist['object']->energy,0)}}%</span>
                                          </li>
                                          <li>
                                              Valence<br/>
                                              <span>{{ number_format($playlist['object']->valence,0)}}%</span>
                                          </li>
                                          <li>
                                              Instrumentalness<br/>
                                              <span>{{ number_format($playlist['object']->instrumentalness,0)}}%</span>
                                          </li>
                                          <li>
                                              Liveness<br/>
                                              <span>{{ number_format($playlist['object']->liveness,0)}}%</span>
                                          </li>
                                          <li>
                                              Loudness<br/>
                                              <span>{{ number_format($playlist['object']->loudness,0)}}%</span>
                                          </li>
                                          <li>
                                              Speechiness<br/>
                                              <span>{{ number_format($playlist['object']->speechiness,0)}}%</span>
                                          </li>
                                          <li>
                                              BPM<br/>
                                              <span>{{ number_format($playlist['object']->tempo,0)}}%</span>
                                          </li>
                                          <li>
                                              Acousticeness<br/>
                                              <span>{{ number_format($playlist['object']->acousticness,0)}}%</span>
                                          </li>
                                      </ul>
                                  </div>
                                  <div class="tags tags-cus-row">
                                      <div class="tags-cus-col">
                                          <p>Top Artists:</p>
                                          <span>{{$playlist['object']->repeated_artist}}</span>
                                      </div>
                                      <div class="tags-cus-col">
                                          <p>Added By:</p>
                                          @if(isset($playlist['object']->added_by_name))
                                              <span><a href="{{url('users/get').'/'.$playlist['object']->added_by}}">{{$playlist['object']->added_by_name}}</a></span>
                                          @else
                                              <span><a href="{{url('users/get').'/'.$playlist['object']->added_by}}">{{$playlist['object']->added_by}}</a></span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="taglists">
                                  <!--<div class="playimage" style="background-image: url('{{ URL::asset('public/images/profile.png') }}')"></div>-->
                                      <div class="playname">
                                          <p>Top Genres:</p>
                                          <span>{{$playlist['object']->repeated_genre}}</span>
                                      </div>
                                      <div class="playname">
                                          <p>Playlist By:</p>
                                          @if(isset($playlist['object']->creator_name))
                                              <span><a href="{{url('users/get').'/'.$playlist['object']->creator_id}}">{{$playlist['object']->creator_name}}</a></span>
                                          @else
                                              <span><a href="{{url('users/get').'/'.$playlist['object']->creator_id}}">{{$playlist['object']->creator_id}}</a></span>
                                          @endif
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                  @endforeach



            </div>
          </div>
            
          </div>
        </section>


        <script src="{{ URL::asset('public/js/jquery.nice-select.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>   
        
        <script type="text/javascript">


            $('input[type=checkbox]').removeAttr('checked');
            $(".table-responsive").hide();
            $("#toggleAdvanced").hide();



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