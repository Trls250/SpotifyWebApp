@include('includes/header')

        <section class="main-wrapper search-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')
              @include('includes/search-menu')

     
            <div id ="wall_records" class="content-container">
              <div class="row ">
                <div class="col-md-12">
                  <h3 id ="title_replace" class="title">Latest Activity</h3>
                </div>
              </div>
            </div>
              
            
          </div>

            <div class="loader page_end_div">
                <img  id = "main_loader" class="center-block loader-img" src = "{{ URL::asset('public/images/loading.gif') }}"/>
            </div>
            <button class="play-btn dektop-play-btn loader" style="display:block;margin:0 auto;" onclick="getRecords()" id ="more_results" >
                    Load More
            </button>
        </section>


        <script src="{{ URL::asset('public/js/jquery.nice-select.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>   
        
        <script type="text/javascript">

            

            $("#main_loader").fadeIn();
            $('.page_end_div').hide();
            var total_wall_records = {{session::get('WallRecordsCount')}};
            var offset = 0;
            var items = 50;
            if(items>=total_wall_records)
            {
                $("#more_results").replaceWith("<p>No further records</p>");
            }
                
            var flag   = true;
            var temp = true;
            var global_filters = 0;

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
                 
          
          
                  

             $(document).on("click", "#toggleAdvanced", function(e) {
              //$('#toggleAdvanced').on('click', function(e){
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
                      $("#filter-rating").val('0');
                      $(".range1 output").html('0');
                      $(".playlist-holder li").show();
                  }
              });
          });
          $(document).ready(function() {
            $('select').niceSelect(); 
            $("#advanced").hide();
            getRecords();
          });
          
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

            
            
            /*SETTING GLOBAL VARIABLES FOR FILTERATION*/
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
                    $( ".slider-liveness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                  $( function() {
                    $( ".slider-range" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                  $( function() {
                    $( ".slider-loudness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                  $( function() {
                    $( ".slider-speechiness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-valence" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-acousticness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-instrumentalness" ).slider({

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
                  $( function() {
                    $( ".slider-tempo" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-popularity" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      //console.log('#'+$(this).attr('id'));
                      }
                    });

                  } );
                  $( function() {
                    $( ".slider-danceability" ).slider({

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
      $( function() {
            $( ".slider-tempo" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-tempo'){
                 tempo[0] = ui.values[0];
                 tempo[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(tempo != 0){
                filter_selectors += "[data-tempo=\""+tempo+"\"]";                  
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
       $( function() {
            $( ".slider-danceability" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-danceability'){
                 danceability[0] = ui.values[0];
                 danceability[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(danceability != 0){
                filter_selectors += "[data-tempo=\""+danceability+"\"]";                  
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
      $( function() {
            $( ".slider-popularity" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-popularity'){
                 popularity[0] = ui.values[0];
                 popularity[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(popularity != 0){
                filter_selectors += "[data-popularity=\""+popularity+"\"]";                  
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
      
      $( function() {
            $( ".slider-liveness" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-liveness'){
                 liveness[0] = ui.values[0];
                 liveness[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(liveness != 0){
                filter_selectors += "[data-liveness=\""+liveness+"\"]";                  
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
      
      $( function() {
            $( ".slider-speechiness" ).slider({
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
            
            
                var filter_selectors = "";

            if(speechiness != 0){
                filter_selectors += "[data-speechiness=\""+speechiness+"\"]";                  
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
      
      $( function() {
            $( ".slider-loudness" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-loudness'){
                 loudness[0] = ui.values[0];
                 loudness[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(loudness != 0){
                filter_selectors += "[data-loudness=\""+loudness+"\"]";                  
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
      $( function() {
            $( ".slider-instrumentalness" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-instrumentalness'){
                 instrumentalness[0] = ui.values[0];
                 instrumentalness[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(instrumentalness != 0){
                filter_selectors += "[data-instrumentalness=\""+instrumentalness+"\"]";                  
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
            $( ".slider-acousticness" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-acousticness'){
                 acousticness[0] = ui.values[0];
                 acousticness[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(acousticness != 0){
                filter_selectors += "[data-acousticness=\""+acousticness+"\"]";                  
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
      
        $( function() {
            $( ".slider-valence" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-valence'){
                 valence[0] = ui.values[0];
                 valence[1] = ui.values[1];
                  
            }
            
            
                var filter_selectors = "";

            if(valence != 0){
                filter_selectors += "[data-valence=\""+valence+"\"]";                  
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
                  //alag sa
                  
          
          $( function() {
            $( ".slider-range" ).slider({
              range: true,
              
              values: [ 0, 100 ],
              change: function( event, ui ) {
                 // $( "#filter-liveness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $(".playlist-filter").fadeOut();
       
                // console.log(ui.values[ 0 ] + " - " + ui.values[ 1 ] )
                    
            if ($(this).attr('id') == 'filter-speechiness'){
                var index = $(ui.handle).index();
                if(index==0){
                    speechiness[0] = ui.values[index];
                }
                else
                {speechiness[1] = ui.values[index];}
                
                console.log(speechiness[0],speechiness[1])
                 
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
                     //console.log(ui);
            }
             if ($(this).attr('id') == 'filter-tempo'){
                     tempo[0] =   ui.values[0];
                     tempo[1] =   ui.values[1];
            }
             if ($(this).attr('id') == 'filter-popularity'){
                     popularity[0] =   ui.values[0];
                     popularity[1] =   ui.values[1];
                     // console.log(ui);
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
                                   if(temp['speechiness'] && temp['rating']&& temp['valence'] && temp['acousticness'] && temp['instrumentalness'] && temp['liveness'] && temp['loudness'] && temp['tempo'] && temp['popularity'] && temp['danceability'] && temp['energy'])
                                    return true ;
                                    else return false;
                                 }).fadeIn();
                                 
                  
              }
                    
            }

          });
      });
             
          

          

          function getRecords() {
            $('.page_end_div').fadeIn();
            if(flag == true){
              temp = false;
              $("#main_loader").fadeIn();
              $.ajax({
                  type: "get",
                  url: "{{ url('playlist/getWallRecords')}}"+'?offset='+offset+'&items='+items,
                  success: function (data) {
                      
                      $("#main_loader").fadeOut();
                      if(data.Status == "404"){
                          $(".page_end_div").html("Sorry, no playlists found.");
                          $("#more_results").hide();
                          flag = false;

                      }
                      else if (data.Status == "204") {
                          $(".page_end_div").html("No further records");
                         
                          $("#more_results").hide();
                          flag = false;

                      }
                      else {
                          $('#wall_records').append(data);
                            if(global_filters == ''){
                                $(".playlist-filter").fadeIn();
                                $(".search_message").fadeOut();
                                // console.log("219");
                            }
                            else
                            {
                                $(".playlist-filter").fadeOut();
                                
                                $(".search_message").fadeIn();
                                $(".playlist-filter"+global_filters).fadeIn();
                            }
                            $('.page_end_div').hide();
                      }
                  },

                  error: function(XMLHttpRequest, textStatus, errorThrown) {

                  }
              });

              offset+=items;
              temp = true;
          }
      }
        </script>
        

    </body>
</html>