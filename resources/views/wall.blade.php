@include('includes/header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <section class="main-wrapper search-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')
              @include('includes/search-menu')

     
            <div  class="content-container">
              <div class="row ">
                <div class="col-md-12 column-flex">
                  <h3  class="title">{{$page_heading}}</h3>
                  <div class="flex-column">
                  
                  <label>Compact View<input type="checkbox" id="title_replace" checked = 'FALSE' class="ios-switch green tinyswitch" checked /><div><div></div></div></label>
                 
                  </div>
                </div>
              </div>
            
            <div id ="wall_records"></div>
            <div class="playlist_records latest-activity">
            <div class="table-responsive">
              <table class="table" id='sorting'>
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
                          <th>
                              Average Release Year
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
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
        <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
        <script src="http://cdn.datatables.net/responsive/1.0.0/js/dataTables.responsive.js"></script> 
        <script type="text/javascript">
       
               
            /**
             Page Type 1 = Tiled;
             Page Type 2 = Compact;
             */

            //$("#wall_records").hide();
            
            if_is_advanced_search = <?php if (Route::is('advanced-search')){ echo '1'; }else{ echo '0'; } ?>;
            if_is_my_library = <?php if (Route::is('library-records')){ echo '1'; }else{ echo '0'; } ?>;
            
            is_anything_changed= false;

            page_type = '1';
            is_table_loaded_first_time = false;
            table = null;
            $('input[type=checkbox]').removeAttr('checked');
            $(".table-responsive").hide();
            $("#toggleAdvanced").hide();
            $("#title_replace").on('change', function(e){
              e.preventDefault();
              if(page_type == 1){
                page_type = 2;


                if(!is_table_loaded_first_time && is_anything_changed == false ){
                    

                    is_table_loaded_first_time = true;
                    table = $('#sorting').DataTable({
                    'responsive' : true,
                    'paging' : false,
                    'searching': false,
                    'destroy': true,
                    "bInfo" : false,
                    'ajax':{
                      url: whichUrl(),

                    },
                    columns: [
                      { data: 'Name' },
                      { data: 'Popularity' },
                      { data: 'Danceability' },
                      { data: 'Energy' },
                      { data: 'Valence' },
                      { data: 'Instrumentalness' },
                      { data: 'Liveness' },
                      { data: 'Loudness' },
                      { data: 'Speechiness' },
                      { data: 'BPM' },
                      { data: 'Acousticness' },
                      { data: 'Average Release Year'}
                      ]
                   });

                    offset_2 += items;
                }else if(is_anything_changed){
                    
                    is_table_loaded_first_time = true;
                    table = $('#sorting').DataTable({
                    'responsive' : true,
                    'paging' : false,
                    'searching': false,
                    'destroy': true,
                     "bInfo" : false,
                    columns: [
                      { data: 'Name' },
                      { data: 'Popularity' },
                      { data: 'Danceability' },
                      { data: 'Energy' },
                      { data: 'Valence' },
                      { data: 'Instrumentalness' },
                      { data: 'Liveness' },
                      { data: 'Loudness' },
                      { data: 'Speechiness' },
                      { data: 'BPM' },
                      { data: 'Acousticness' },
                      { data: 'Average Release Year'}
                      ]
                   });
                   
                    offset_2 += items;
                    
                }

                $(".table-responsive").show();
                $("#wall_records").hide();
              }else {
                page_type = 1;
                $(".table-responsive").hide();
                $("#wall_records").show();
              }
              temp = false;
              
              if(if_is_advanced_search){
                  searchFunction();
              }else{
                 // getRecords();
              }
              
            })
            $("#main_loader").fadeIn();
            $('.page_end_div').hide();
            var total_wall_records = {{session::get('WallRecordsCount')}};
            var offset_1 = 0;
            var offset_2 = 0;
            var items = 100;

            if(items>=total_wall_records)
            {
                $("#more_results").replaceWith("");
            } 
            var flag   = true;
            var temp = true;
            var global_filters = 0;


            var flagAdvanced = false;
            $(document).ready(function () {
                $(function() {
                $(document).on('input', 'input[type="range"]', function(e) {
                        $(this).parents('.range1').find('label output').html(e.currentTarget.value);
                });
                $('input[type=range]').rangeslider({
                    polyfill: false
                });
                });
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
                $(document).on("click", "#toggleAdvanced", function(e) {
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
                      $("#filter-year").val('0');
                      $(".range1 output").html('0');
                      $(".playlist-holder li").show();
                  }
              });
          });
          $(document).ready(function() {
            $('select').niceSelect(); 
            $("#advanced").show();
            getRecords();
          });
          
          $(document).ready(function () {
              $('#advanced').show();
                $('.search-btns').on('click', function() {
                  $('.search-form').toggle("slow");
                });
                $(".menu-icons").on('click', function() {
                  $(".sidebar").animate({
                    width: "toggle"
                  });
                  $(this).toggleClass("open");
                });

          });

          function whichUrl(){

            if(page_type == 2){
                          return  "{{url($url)}}"+'?offset='+offset_2+'&items='+items+'&type=2'
              }else{
                          return "{{url($url)}}"+'?offset='+offset_1+'&items='+items+'&type=1'
                  }
          }
          $("#search-form").on("submit", function (e) {
            e.preventDefault();
           // alert(e);
          });

          $("#search-form-submit").on("click", function (e) {
            e.preventDefault();
            searchFunction();
          });
          
            /*SETTING GLOBAL VARIABLES FOR FILTERATION*/
           let date = (new Date()).getFullYear();
           let speechiness = [0, 100];
           let valence = [0, 100];
           let instrumentalness = [0, 100];
           let liveness = [0, 100];
           let loudness = [-60, 5];
           let tempo = [0, 250];
           let popularity = [0, 100];
           let danceability = [0, 100];
           let energy = [0, 100];
           let acousticness = [0, 100];
           let year = [1900, date];
           let rating =[0,5];
           
            $( function() {
                    $( ".slider-liveness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
                  $( function() {
                    $( ".slider-range" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
//                  
                  $( function() {
                    $( ".slider-speechiness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-valence" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-acousticness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-instrumentalness" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
                   $( function() {
                    $( ".slider-rating" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
                
                   $( function() {
                    $( ".slider-popularity" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );
                  $( function() {
                    $( ".slider-danceability" ).slider({

                      slide: function( event, ui ) {
                        $('#'+ $(this).attr('id') ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                      }
                    });

                  } );

              $( ".slider-rating" ).slider({
              range: true,
              min: 0,
              max: 5,
              values: [ 0, 5 ],
              change: function( event, ui ) {
                  $("#wall_records").fadeOut();
                    
            if ($(this).attr('id') == 'filter-ratings'){
                 rating[0] = ui.values[0];
                 rating[1] = ui.values[1];
            }
           
            searchFunction();
            
            }
            
          });
          $( ".slider-loudness" ).slider({
              range: true,
              min: -60,
              max: 5,
              values: [ -60, 5 ],
              change: function( event, ui ) {
                  $( "#filter-loudness" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $("#wall_records").fadeOut();
            if ($(this).attr('id') == 'filter-loudness'){
                 loudness[0] = ui.values[0];
                 loudness[1] = ui.values[1];
            }
            searchFunction();
            }
          });
           $( ".slider-tempo" ).slider({
              range: true,
              min: 0,
              max: 250,
              values: [ 0, 250 ],
              change: function( event, ui ) {
                  $( "#filter-tempo" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $("#wall_records").fadeOut();
            if ($(this).attr('id') == 'filter-tempo'){
                 tempo[0] = ui.values[0];
                 tempo[1] = ui.values[1];
            }
            searchFunction();
            }
          });
          
          $( ".slider-year" ).slider({
              
              range: true,
              min: 1900,
              max: (new Date()).getFullYear(),
              values: [ 1900, (new Date()).getFullYear() ],
              change: function( event, ui ) {
                  $( "#filter-year" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                  $("#wall_records").fadeOut();
       
                    
            if ($(this).attr('id') == 'filter-year'){
                 year[0] = ui.values[0];
                 year[1] = ui.values[1];
            }
           
            searchFunction();
            
            }
            
          });
          
              $( ".slider" ).slider({
              range: true,
              min: 0,
              max: 100,
              values: [ 0, 100 ],
              change: function( event, ui ) {
                  $("#wall_records").fadeOut();
       
                    
            if ($(this).attr('id') == 'filter-ratings'){
                 rating[0] = ui.values[0];
                 rating[1] = ui.values[1];
            }
            if ($(this).attr('id') == 'filter-popularity'){
                 popularity[0] = ui.values[0];
                 popularity[1] = ui.values[1];
                  
            }
            if ($(this).attr('id') == 'filter-liveness'){
                 liveness[0] = ui.values[0];
                 liveness[1] = ui.values[1];
                  
            }
            if ($(this).attr('id') == 'filter-speechiness'){
                 speechiness[0] = ui.values[0];
                 speechiness[1] = ui.values[1];
                  
            }
            if ($(this).attr('id') == 'filter-valence'){
                 valence[0] = ui.values[0];
                 valence[1] = ui.values[1];
                  
            }
            if ($(this).attr('id') == 'filter-acousticness'){
                 acousticness[0] = ui.values[0];
                 acousticness[1] = ui.values[1];
                  
            }
            if ($(this).attr('id') == 'filter-instrumentalness'){
                 instrumentalness[0] = ui.values[0];
                 instrumentalness[1] = ui.values[1];
                  
            }
            if ($(this).attr('id') == 'filter-danceability'){
                 danceability[0] = ui.values[0];
                 danceability[1] = ui.values[1];
                  
            }
            if ($(this).attr('id') == 'filter-energy'){
                 energy[0] = ui.values[0];
                 energy[1] = ui.values[1];
                  
            }
            searchFunction();   
            }

          });


          var ctx = document.getElementById("myChart").getContext('2d');
          var myRadarChart = new Chart(ctx, {
              title: 'Visualization',
              type: 'radar',
              data:  {
                labels: ['Instrumentalness', 'Liveness', 'Loudness', 'Speechiness', 'BPM', 'Popularity', 'Danceability', 'Energy', 'Valence', 'Acousticness', 'Rating'],
                datasets: [{
                    label: "Visualization Lower",
                    data: [instrumentalness[0], liveness[0], loudness[0], speechiness[0], tempo[0], popularity[0], danceability[0], energy[0], valence[0], acousticness[0], rating[0]*20],
                },{
                    label: "Visualization Upper",
                    data: [instrumentalness[1], liveness[1], loudness[1], speechiness[1], tempo[1], popularity[1], danceability[1], energy[1], valence[1], acousticness[1], rating[1]*20],
                }]
            }

          });

          function updateConfigByMutating(dataset1, dataset2) {
            myRadarChart.data.datasets = [dataset1, dataset2];

          myRadarChart.update();
      }
     

     function searchFunction(){
         //console.log("search function");
         

       is_anything_changed=true;
       data = {
        'speechiness' : speechiness,
        'valence' : valence,
        'instrumentalness' : instrumentalness,
        'liveness' : liveness,
        'loudness' : loudness,
        'tempo' : tempo,
        'popularity' : popularity,
        'danceability' : danceability,
        'energy' : energy,
        'acousticness' : acousticness,
        'rating' : rating,
        'year'  :  year,
        'genres' : $('#form-genres').val(),
        'artists' : $('#form-artists').val(),
        'tags' : $('#form-tags').val(),
        'type' : page_type
       };
       dataset1 = {
         label : "Visualization Lower",
         data: [instrumentalness[0], liveness[0], loudness[0], speechiness[0], tempo[0], popularity[0], danceability[0], energy[0], valence[0], acousticness[0], rating[0]*20]
       };
       dataset2 = {
         label : "Visualization Upper",
         data: [instrumentalness[1], liveness[1], loudness[1], speechiness[1], tempo[1], popularity[1], danceability[1], energy[1], valence[1], acousticness[1],rating[1]*20]
       };

       updateConfigByMutating(dataset1, dataset2);
       
       if(data.genres == undefined || data.genres == ''){
         data.genres = 'empty';
       }
       if(data.artists == undefined || data.artists == ''){
         data.artists = 'empty';
       }
       if(data.tags == undefined || data.tags == ''){
         data.tags = 'empty';
       }
       

       $.ajax({

        url: "{{url('playlist/advanced-search-results')}}",
        type: "POST",
        data: {_token: "{{ csrf_token() }}", data: data},
        
        success: function (data) {
           // console.log(data.Playlists);
            if(page_type == 2){
                
                table.clear().draw();
                table.rows.add(data.Playlists); // Add new data
                table.columns.adjust().draw();
                //table.rows.add(data.Playlists).draw();
                        }else{
                          $("#wall_records").html(data);
                          $("#wall_records").fadeIn();

                        }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {

            var errors = XMLHttpRequest.responseJSON;
            console.log(textStatus);
            console.log("errorThrown");
            console.log(errorThrown);
            console.log(data);
        }

        });


     }
            
          function getRecords () {
            $('.page_end_div').fadeIn();
            if(flag == true){
              temp = false;
            $("#main_loader").fadeIn();
                if(page_type == 2){
                  url = "{{ url($url)}}"+'?offset='+offset_2+'&items='+items+'&type=2'
                }else{
                  url = "{{ url($url)}}"+'?offset='+offset_1+'&items='+items+'&type=1'

                }
              $.ajax({
                  type: "get",
                  url: url,
                  success: function (data) {
                      
                      $("#main_loader").fadeOut();
                      if(data.Status == "404"){
                          $(".page_end_div").html("Sorry, no playlists found.");
                          $("#more_results").hide();
                          flag = false;

                      }
                      else if (data.Status == "204") {
                          //$(".page_end_div").html("No further records");
                         
                          $("#more_results").hide();
                          flag = false;

                      }
                      else {
                        if(page_type == 2){
                          //$('tbody').append(data);
                          table.rows.add(data.data).draw();
                        }else{
                          $('#wall_records').append(data);

                        }
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

              if(page_type == 2){
                offset_2+=items;
                        }else{
                          offset_1+=items;

                        }
              temp = true;
          }
      }
        </script>
        

    </body>
</html>