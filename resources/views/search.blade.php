@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">
            @include('includes/sidebar')
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
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-instrumentalness" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>  
                  </div>
                  <div class="range1">
                    <label>Livenss  - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-liveness" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>  
                  </div>
                  <div class="range1">
                    <label>Loudness - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-loudness" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div> 
                  </div>
                  <div class="range1">
                    <label>Speechiness - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-speechiness" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>BPM  - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-tempo" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Popularity - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-popularity" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Danceability - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-danceability" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Energy - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-energy" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                  <div class="range1">
                    <label>Valence  - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-valence" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
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
                <ul class="clearfix playlist-holder">


                  @foreach($Playlists as $playlist)
                    <li class="playlist-filter" 
                          data-instrumentalness="{{ $playlist['instrumentalness'] }}" 
                          data-liveness="{{ $playlist['liveness'] }}" 
                          data-loudness="{{ $playlist['loudness'] }}" 
                          data-speechiness="{{ $playlist['speechiness'] }}" 
                          data-tempo="{{ $playlist['tempo'] }}" 
                          data-popularity="{{ $playlist['popularity'] }}" 
                          data-danceability="{{ $playlist['danceability'] }}" 
                          data-energy="{{ $playlist['energy'] }}" 
                          data-valence="{{ $playlist['valence'] }}"
                    >
                  
                      <div class="play-box">
                          <div class="">
                              @if(file_exists('public/playlists/'.$playlist["id"].'.jpg'))
                                <div class="play-img"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist['id'].'.jpg') }});">
                                </div>
                              @else
                                  <div class="play-img"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                                  </div>
                              @endif
                          </div>
                          <div class="play-content">
                              <h4><a href="{{url('playlist/open-playlist/'.$playlist->id)}}">{{$playlist->title}}</a></h4>
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
        <script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/js/jquery.nice-select.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>
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
                // $('.profile-navi').hide();
                // $('.profile-nav-top').click(function () {
                //     $(this).next('.profile-navi').slideToggle();
                // });


          });
        </script>
        <script type="text/javascript">
          var flagAdvanced = false;
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
                  if(!flagAdvanced){
                      $("#filter-instrumentalness").val('0');
                      $("#filter-liveness").val('0');
                      $("#filter-loudness").val('0');
                      $("#filter-speechiness").val('0');
                      $("#filter-tempo").val('0');
                      $("#filter-popularity").val('0');
                      $("#filter-danceability").val('0');
                      $("#filter-energy").val('0');
                      $("#filter-valence").val('0');
                      $(".range1 output").html('0');
                      $(".playlist-holder li").show();
                  }
              });
          });
          $(document).ready(function() {
            $('select').niceSelect(); 
          });

          $(document).on('input', '.filter-input', function(){
              $(".playlist-holder li").hide();

              var instrumentalness = $("#filter-instrumentalness").val();
              var liveness         = $("#filter-liveness").val();
              var loudness         = $("#filter-loudness").val();
              var speechiness      = $("#filter-speechiness").val();
              var tempo            = $("#filter-tempo").val();
              var popularity       = $("#filter-popularity").val();
              var danceability     = $("#filter-danceability").val();
              var energy           = $("#filter-energy").val();
              var valence          = $("#filter-valence").val();
              
              var filter_selectors = "";

              if(instrumentalness != 0){
                  filter_selectors += "[data-instrumentalness=\""+instrumentalness+"\"]";                  
              }

              if(liveness != 0){
                  filter_selectors += "[data-liveness=\""+liveness+"\"]";                  
              }

              if(loudness != 0){
                  filter_selectors += "[data-loudness=\""+loudness+"\"]";                  
              }

              if(speechiness != 0){
                  filter_selectors += "[data-speechiness=\""+speechiness+"\"]";                  
              }

              if(tempo != 0){
                  filter_selectors += "[data-tempo=\""+tempo+"\"]";                  
              }

              if(popularity != 0){
                  filter_selectors += "[data-popularity=\""+popularity+"\"]";                  
              }

              if(danceability != 0){ 
                  filter_selectors += "[data-danceability=\""+danceability+"\"]";                  
              }

              if(energy != 0){
                  filter_selectors += "[data-energy=\""+energy+"\"]";                  
              }

              if(valence != 0){
                  filter_selectors += "[data-valence=\""+valence+"\"]";                  
              }

              if(filter_selectors == ""){
                  $(".playlist-holder li").show();
              }else{
                  $(".playlist-holder li"+filter_selectors).show();
              }
          });
        </script>
    </body>
</html>