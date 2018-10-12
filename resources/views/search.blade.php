@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">
            @include('includes/sidebar')
            @include('includes/search-menu')
            
            <div class="content-container">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="title">Search results from Spotify Me</h3>
                  <p class="found-items">{{$Total}} Playlists found</p>
                </div>
              </div>
              <div class="playlists-items">
                <ul class="clearfix playlist-holder">


                <div id="search_results">

                  @foreach($Playlists as $playlist)
                    <li class="playlist-filter" 
                          data-instrumentalness="{{ $playlist->instrumentalness }}" 
                          data-liveness="{{ $playlist->liveness }}" 
                          data-loudness="{{ $playlist->loudness }}" 
                          data-speechiness="{{ $playlist->speechiness }}" 
                          data-tempo="{{ $playlist->tempo }}" 
                          data-popularity="{{ $playlist->popularity }}" 
                          data-danceability="{{ $playlist->danceability }}" 
                          data-energy="{{ $playlist->energy }}" 
                          data-valence="{{ $playlist->valence }}"
                          data-acousticness="{{$playlist->acousticness}}"
                    >
                  
                      <div class="play-box">
                          <div class="">
                              @if(file_exists('public/playlists/'.$playlist->id.'.jpg'))
                                <div class="play-img"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist->id.'.jpg') }});">
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

                </div>
                </ul>
              </div>
              <button class="play-btn dektop-play-btn loader" style="display:block;margin:0 auto;" onclick="getResults()" id ="more_results" >
                    Load More
                </button>
            </div>
          </div>
        </section>
        <script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>
        <script src="{{ URL::asset('public/js/jquery.nice-select.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>
        <script type="text/javascript">
            var results_start = 100;
            var results_limit = 100;
            var total_results = {{$Total}};
            var global_filters = "";


           if (results_start>=total_results)
                $("#more_results").hide();

            var temp = "{{$queryString}}";
    
            if (temp == "")
              var url = "{{ url('searchSimple?start=')}}" + results_start + "&limit=" + results_limit +"&queryString=";
            else
              var url = "{{ url('searchSimple?queryString=')}}'"+ "{{$queryString}}" +"'&start = " + results_start + "&limit=" + results_limit;
            function getResults(){

              $.ajax({
                  type: "get",
                  url: url,
                  success: function (data) {
                      $("#search_results").append(data);
                      if(global_filters == ''){
                            $(".playlist-holder li").fadeIn();
                            $(".search_message").fadeOut();
                      }else{
                            $(".playlist-holder li").fadeOut();
                            $(".playlist-holder li"+global_filters).fadeOut();
                            $(".search_message").fadeIn();
                      }

                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown, data) {
                      console.log("Status: " + textStatus);
                      console.log(data);
                  }
              });

              results_start += results_limit;
              if(results_start>=results_limit){
                  $("#more_results").hide();
              }
              }


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


              $(document).on('click', '#toggleAdvanced', function(e){
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
                      $("#filter-acousticness").val('0');
                      $(".range1 output").html('0');
                      $(".playlist-holder li").show();
                  }
              });
          });
          $(document).ready(function() {
            $('select').niceSelect(); 
          });

          $(document).on('input', '.filter-input', function(){
              $(".playlist-holder li").fadeOut();

              var instrumentalness = $("#filter-instrumentalness").val();
              var liveness         = $("#filter-liveness").val();
              var loudness         = $("#filter-loudness").val();
              var speechiness      = $("#filter-speechiness").val();
              var tempo            = $("#filter-tempo").val();
              var popularity       = $("#filter-popularity").val();
              var danceability     = $("#filter-danceability").val();
              var energy           = $("#filter-energy").val();
              var valence          = $("#filter-valence").val();
              var acousticness     = $("#filter-acousticness").val();
              
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
              
              if(acousticness != 0){
                filter_selectors  += "[data-acousticness=\""+acousticness+"\"]";
              }

              console.log(filter_selectors);
              global_filters = filter_selectors;

              if(filter_selectors == ""){
                  $(".search_message").fadeOut();
                  $(".playlist-holder li").fadeIn();
              }else{
                  $(".playlist-holder li"+filter_selectors).fadeIn();
              }
          });
        </script>
    </body>
</html>