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
                          data-rating="{{$playlist->rating}}"
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

           let speechiness = [0, 100];
           let valence = [0, 100];
           let instrumentalness = [0, 100];
           let liveness = [0, 100];
           let loudness = [0, 100];
           let tempo = [0, 100];
           let popularity = [0, 100];
           let danceability = [0, 100];
           let energy = [0, 100];
           let acousticness = [0, 100];
           let rating =[0,5];
           
            $( function() {
                    $( ".slider-range" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-rating" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                  
                  //  from here addition
                    $( function() {
            $( ".slider-rating" ).slider({
              range: true,
              min: 0,
              max: 5,
              values: [ 0, 5 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
                  
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-ratings'){
                 rating[0] = ui.values[0];
                 rating[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(rating != 0){
                filter_selectors += "[data-rating=\""+rating+"\"]";                  
            }
            
                    
                    
                    
                    global_filters = filter_selectors;

              if(filter_selectors == ""){
                    $(".search_message").fadeOut();
                     //console.log("174");
                    
                  $(".playlist-filter").fadeIn();
              }else{
                //  $(".playlist-filter"+filter_selectors).fadeIn();
                  
                  
                  
                  $(".playlist-filter").filter(function () {
                      
                                   temp=[] 
                                   temp['valence']=parseInt($(this).attr('data-valence'), 10) >= valence[0] && parseInt($(this).attr('data-valence'), 10) <= valence[1];
                                   temp['acousticness']=parseInt($(this).attr('data-acousticness'), 10) >= acousticness[0] && parseInt($(this).attr('data-acousticness'), 10) <= acousticness[1];
                                   temp['instrumentalness']=parseInt($(this).attr('data-instrumentalness'), 10) >= instrumentalness[0] && parseInt($(this).attr('data-instrumentalness'), 10) <= instrumentalness[1];
                                   temp['liveness']=parseInt($(this).attr('data-liveness'), 10) >= liveness[0] && parseInt($(this).attr('data-liveness'), 10) <= liveness[1];
                                   temp['loudness']=parseInt($(this).attr('data-loudness'), 10) >= loudness[0] && parseInt($(this).attr('data-loudness'), 10) <= loudness[1];
                                   temp['tempo']=parseInt($(this).attr('data-tempo'), 10) >= tempo[0] && parseInt($(this).attr('data-tempo'), 10) <= tempo[1];
                                   temp['popularity']=parseInt($(this).attr('data-popularity'), 10) >= popularity[0] && parseInt($(this).attr('data-popularity'), 10) <= popularity[1];
                                   temp['danceability']=parseInt($(this).attr('data-danceability'), 10) >= danceability[0] && parseInt($(this).attr('data-danceability'), 10) <= danceability[1];
                                   //console.log(temp['danceability']);
                                   temp['energy']=parseInt($(this).attr('data-energy'), 10) >= energy[0] && parseInt($(this).attr('data-energy'), 10) <= energy[1];
                                   temp['speechiness']=parseInt($(this).attr('data-speechiness'), 10) >= speechiness[0] && parseInt($(this).attr('data-speechiness'), 10) <= speechiness[1];
                                   temp['rating']=parseInt($(this).attr('data-rating'), 10) >= rating[0] && parseInt($(this).attr('data-rating'), 10) <= rating[1];
                                   
                                   if(temp['speechiness'] && temp['rating'] && temp['valence'] && temp['acousticness'] && temp['instrumentalness'] && temp['liveness'] && temp['loudness'] && temp['tempo'] && temp['popularity'] && temp['danceability'] && temp['energy'])
                                    return true ;
                                    else return false;
                                 }).fadeIn();
                                 
                  
              }
                    
            }

          });
      });
                  
                  
                  //end
          
          $( function() {
            $( ".slider-range" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-speechiness'){
                 speechiness[0] = ui.values[0];
                 speechiness[1] = ui.values[1];
            }
            if ($(this).attr('id') == 'filter-valence'){
                     valence[0] =   ui.values[0];
                     valence[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-instrumentalness'){
                     instrumentalness[0] =   ui.values[0];
                     instrumentalness[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-liveness'){
                     liveness[0] =   ui.values[0];
                     liveness[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-loudness'){
                     loudness[0] =   ui.values[0];
                     loudness[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-tempo'){
                     tempo[0] =   ui.values[0];
                     tempo[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-popularity'){
                     popularity[0] =   ui.values[0];
                     popularity[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-danceability'){
                     danceability[0] =   ui.values[0];
                     danceability[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-energy'){
                     energy[0] =   ui.values[0];
                     energy[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-acousticness'){
                     acousticness[0] =   ui.values[0];
                     acousticness[1] =   ui.values[1];
            }
            
                var filter_selectors = "";

            if(speechiness != 0){
                filter_selectors += "[data-speechiness=\""+speechiness+"\"]";                  
            }
            if(energy != 0){
                filter_selectors += "[data-energy=\""+energy+"\"]";                  
            }
            if(danceability != 0){
                filter_selectors += "[data-danceability=\""+danceability+"\"]";                  
            }
            if(popularity != 0){
                filter_selectors += "[data-popularity=\""+popularity+"\"]";                  
            }
            if(tempo != 0){
                filter_selectors += "[data-tempo=\""+tempo+"\"]";                  
            }
            if(loudness != 0){
                filter_selectors += "[data-loudness=\""+loudness+"\"]";                  
            }
            if(liveness != 0){
                filter_selectors += "[data-liveness=\""+liveness+"\"]";                  
            }
            if(instrumentalness != 0){
                filter_selectors += "[data-instrumentalness=\""+instrumentalness+"\"]";                  
            }
            if(acousticness != 0){
                filter_selectors += "[data-acousticness=\""+acousticness+"\"]";                  
            }
            if(valence != 0){
                filter_selectors += "[data-valence=\""+valence+"\"]";                  
            }
             if(rating != 0){
                filter_selectors += "[data-raitng=\""+rating+"\"]";                  
            }
                    
                    
                    
                    global_filters = filter_selectors;

              if(filter_selectors == ""){
                    $(".search_message").fadeOut();
                     //console.log("174");
                    
                  $(".playlist-filter").fadeIn();
              }else{
                //  $(".playlist-filter"+filter_selectors).fadeIn();
                  
                  
                  
                  $(".playlist-filter").filter(function () {
                      
                                   temp=[] 
                                   temp['valence']=parseInt($(this).attr('data-valence'), 10) >= valence[0] && parseInt($(this).attr('data-valence'), 10) <= valence[1];
                                    console.log(parseInt($(this).attr('data-valence')));
                                    temp['acousticness']=parseInt($(this).attr('data-acousticness'), 10) >= acousticness[0] && parseInt($(this).attr('data-acousticness'), 10) <= acousticness[1];
                                   temp['instrumentalness']=parseInt($(this).attr('data-instrumentalness'), 10) >= instrumentalness[0] && parseInt($(this).attr('data-instrumentalness'), 10) <= instrumentalness[1];
                                   temp['liveness']=parseInt($(this).attr('data-liveness'), 10) >= liveness[0] && parseInt($(this).attr('data-liveness'), 10) <= liveness[1];
                                   temp['loudness']=parseInt($(this).attr('data-loudness'), 10) >= loudness[0] && parseInt($(this).attr('data-loudness'), 10) <= loudness[1];
                                   temp['tempo']=parseInt($(this).attr('data-tempo'), 10) >= tempo[0] && parseInt($(this).attr('data-tempo'), 10) <= tempo[1];
                                   temp['popularity']=parseInt($(this).attr('data-popularity'), 10) >= popularity[0] && parseInt($(this).attr('data-popularity'), 10) <= popularity[1];
                                   temp['danceability']=parseInt($(this).attr('data-danceability'), 10) >= danceability[0] && parseInt($(this).attr('data-danceability'), 10) <= danceability[1];
                                   console.log(temp['danceability']);
                                   temp['energy']=parseInt($(this).attr('data-energy'), 10) >= energy[0] && parseInt($(this).attr('data-energy'), 10) <= energy[1];
                                   temp['speechiness']=parseInt($(this).attr('data-speechiness'), 10) >= speechiness[0] && parseInt($(this).attr('data-speechiness'), 10) <= speechiness[1];
                                   temp['rating']=parseInt($(this).attr('data-rating'), 10) >= rating[0] && parseInt($(this).attr('data-rating'), 10) <= rating[1];
                                   if(temp['speechiness'] &&  temp['rating'] &&  temp['valence'] && temp['acousticness'] && temp['instrumentalness'] && temp['liveness'] && temp['loudness'] && temp['tempo'] && temp['popularity'] && temp['danceability'] && temp['energy']){
            console.log("416");                        
            return true ;}
                                    else return false;
                                 }).fadeIn();
                                 
                  
              }
                    
            }

          });
      });
        </script>
    </body>
</html>