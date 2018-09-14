@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">
            <div class="sidebar">
              <ul class="sidebar-lists">
                <li>
                  <a href="#">Wall</a>
                </li>
                <li class="active">
                  <a href="#">Playlists</a>
                </li>
                <li>
                  <a href="#">My Playlists</a>
                </li> 
              </ul>
            </div>
            <div class="searchbar">
              <div class="content-container">
                <div class="selectrow">
                  <form>
                    {{--<div class="form-group">--}}
                      {{--<div class="box">--}}
                        {{--<select>--}}
                          {{--<option value="type1">Type1</option>--}}
                          {{--<option value="type2">Type2</option>--}}
                        {{--</select>--}}
                      {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                      {{--<div class="box">--}}
                        {{--<select>--}}
                          {{--<option value="market">Market</option>--}}
                          {{--<option value="us">US</option>--}}
                          {{--<option value="mexician" >Mexician</option>--}}
                          {{--<option value="russian">Russian</option>--}}
                          {{--<option value="east">East</option>--}}
                          {{--<option value="west">West</option>--}}
                        {{--</select>--}}
                      {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                      {{--<div class="box">--}}
                        {{--<select>--}}
                          {{--<option value="genres">Genres</option>--}}
                          {{--<option value="genres2">Genres2</option>--}}
                        {{--</select>--}}
                      {{--</div>--}}
                    {{--</div>--}}
                   {{--<!--  <div class="form-group">--}}
                      {{--<select  id="search1" class="selectlists"  multiple="multiple">     --}}
                        {{--<option>Type1</option>--}}
                        {{--<option>Type2</option>--}}
                        {{--<option>Usman</option>--}}
                      {{--</select> --}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                      {{--<select  id="search2" class="selectlists"  multiple="multiple">     --}}
                        {{--<option>Type1</option>--}}
                        {{--<option>Type2</option>--}}
                        {{--<option>Usman</option>--}}
                      {{--</select> --}}
                    {{--</div> -->--}}
                    {{--<div >--}}
                      <button id='toggleAdvanced' class="btn play-follow playlists filter"> <i class="fas fa-filter"></i> Advance Filter</button>
                    </div>
                  </form>
                 </div> 
              </div>
            </div>
            <div id = 'advanced' class="rangesliders">
              <div class="content-container">
                <div class="range-row clearfix">
                  <div class="range1">
                    <label>Instrumentalness - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>  
                  </div>
                  <div class="range1">
                    <label>Livenss  - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>  
                  </div>
                  <div class="range1">
                    <label>Loudness - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div> 
                  </div>
                  <div class="range1">
                    <label>Speechiness - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Temp  - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Popularity - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Danceability - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Energy - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Valence  - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    
                  </div>  
                </div>
              </div>
            </div>
            
            <div class="content-container">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="title">Search results from Spotify Me</h3>
                  <p class="found-items">{{$Playlists->count()}} Playlists found</p>
                </div>
              </div>
              <div class="playlists-items">
                <ul class="clearfix">

                  @foreach($Playlists as $playlist)
                  <li>
                    <div class="play-box">
                      <div class="">
                        @if(file_exists('playlists/'.$playlist["id"].'.jpg'))
                          <div class="play-img"  style="background-image: url({{ URL::asset('playlists/'.$playlist['id'].'.jpg') }});">
                          </div>
                        @else
                          <div class="play-img"  style="background-image: url({{ URL::asset('images/default_playlist.jpg') }});">
                          </div>
                        @endif
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>{{$playlist->title}}</h4>
                          <p>{{$playlist->total_tracks}} Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                    @endforeach
                </ul>
              </div>
            </div>
          </div>
        </section>
        <script src= "{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.nice-select.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function () {

              $('#advanced').hide();
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
        </script>
        <script type="text/javascript">
          var flagAdvanced = false;
          $(document).ready(function () {
            $(function() {
              // var output = document.querySelectorAll('output')[0];
              $(document).on('input', 'input[type="range"]', function(e) {
                    console.log($(this).prev());
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
                $('.profile-nav-top').click(function () {
                    $(this).next('.profile-navi').slideToggle();
                });
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


              $('#toggleAdvanced').on('click', function(e){
                  e.preventDefault();
                  $('#advanced').toggle();
                  flagAdvanced = !flagAdvanced;
              });
          });
          $(document).ready(function() {
            $('select').niceSelect(); 
          });
        </script>
    </body>
</html>