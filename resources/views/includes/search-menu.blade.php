@if (Request::is('playlist/advanced-search') || Request::is('playlist/advanced-search'))
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <div class="content-container">
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
</div> -->
<!-- <div class="searchbar">
</div> -->
<div id = 'advanced' class="rangesliders">

    <div class="content-container">
        <h3 class="title" style="margin-left: 15px;">Moods</h3>
        <select id="dropdown">
            <option disabled selected>Select a mood</option>
            <option value="1">Chill</option>
            <option value="2">Positive-Energy</option>
            <option value="3">Hits</option>
            <option value="4">Obscure Classic Rock</option>
        </select>
        
        <h3 class="title" style="margin-left: 15px;">Playlist Info</h3>
        <form id = "search-form" action="" class="search-formss">
            <input id="form-genres" class="form-control" type="text"  name="form-genres" placeholder="Genres">
            <input id="form-tags" type="text" class="form-control" name="form-tags" placeholder="Tags">
            <input id="form-artists" type="text" class="form-control" name="form-artists" placeholder="Artists">
        </form>
        
        <h3 class="title" style="margin-left: 15px;">Audio Features</h3>
        <div class="range-row clearfix">
            <div class="range-column">
                <div class="range1">
                    <label> Instrumentalness - <output id="filter-instrumentalness">  0 - 100 </output></label>
                    <div class="slider slider-instrumentalness" id="filter-instrumentalness"></div>
                </div>

                <div class="range1">
                    <label> Liveness - <output id="filter-liveness">  0 - 100 </output></label>
                    <div class="slider slider-liveness" id="filter-liveness"></div>
                </div>
                <div class="range1">
                    <label> Loudness - <output id="filter-loudness">  -60 - 5 </output></label>
                    <div class="slider-loudness" id="filter-loudness"></div>
                </div>

                <div class="range1">
                    <label> Speechiness - <output id="filter-speechiness">  0 - 100 </output></label>
                    <div class="slider slider-speechiness" id="filter-speechiness"></div>
                </div>

                <div class="range1">
                    <label> BPM - <output id="filter-tempo">  0 - 250 </output></label>
                    <div class="slider-tempo" id="filter-tempo"></div>
                </div>
                <div class="range1">
                    <label> Popularity - <output id="filter-popularity">  0 - 100 </output></label>
                    <div class="slider slider-popularity" id="filter-popularity"></div>
                </div>

                <div class="range1">
                    <label> Danceability - <output id="filter-danceability">  0 - 100 </output></label>
                    <div class="slider slider-danceability" id="filter-danceability"></div>
                </div>

                <div class="range1">
                    <label> Energy - <output id="filter-energy">  0 - 100 </output></label>
                    <div class="slider slider-range" id="filter-energy"></div>
                </div>

                <div class="range1">
                    <label> Valence - <output id="filter-valence">  0 - 100 </output></label>
                    <div class="slider slider-valence" id="filter-valence"></div>
                </div>

                <div class="range1">
                    <label> Acousticness - <output id="filter-acousticness">  0 - 100 </output></label>
                    <div class="slider slider-acousticness" id="filter-acousticness"></div>
                </div>
                <div class="range1">
                    <label> Ratings - <output id="filter-ratings" >  0 - 5 </output></label>
                    <div class="slider-rating" id="filter-ratings"></div>
                </div>

                <div class="range1">
                    <label> Year - <output id="filter-year" >  1900 - 20{{date('y')}} </output></label>
                <div class="slider-year" id="filter-year"></div>
                  </div>
                <button id= "search-form-submit" type="submit" value="Submit">Submit</button>
                  </div>
                  <div class="range-column">

                
                <div class="chart">
                                <canvas id="myChart"></canvas>
                                    </div>
                                    </div>
                                    </div>  
                                    <p class ="search_message">Search filters applied, loaded results will be pre-filterized</p> 

                                    </div>
                                    </div>




                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
                                    <script>
$('.search_message').hide();
                                                     </script>
            @endif
                                    <script>
                                        $('#dropdown').on('change', function () {

                                            if ($(this).val() == "1")
                                            {
                                                $("#filter-energy").attr('id', 'filter-energy-label');
                                                $("#filter-energy").html('');
                                                $("#filter-energy").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 35],
                                                    slide: function (event, ui) {
                                                        $('#filter-energy').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-energy-label').val(0 + " - " + 35).attr('id', 'filter-energy');

                                                $(".slider-loudness").html('');
                                                $(".slider-loudness").slider({
                                                    range: true,
                                                    min: -60,
                                                    max: 5,
                                                    values: [-10, -10],
                                                    slide: function (event, ui) {
                                                        $("#filter-loudness").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-loudness').val(-10 + " - " + -10).attr('id', 'filter-loudness');
                                                
                                                
                                                $("#filter-instrumentalness").attr('id', 'filter-instrumentalness-label');
                                                $("#filter-instrumentalness").html('');
                                                $("#filter-instrumentalness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-instrumentalness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-instrumentalness-label').val(0 + " - " + 100).attr('id', 'filter-instrumentalness');
                                                
                                                $("#filter-liveness").attr('id', 'filter-liveness-label');
                                                $("#filter-liveness").html('');
                                                $("#filter-liveness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-liveness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-liveness-label').val(0 + " - " + 100).attr('id', 'filter-liveness');
                                                
                                                $("#filter-speechiness").attr('id', 'filter-speechiness-label');
                                                $("#filter-speechiness").html('');
                                                $("#filter-speechiness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-speechiness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-speechiness-label').val(0 + " - " + 100).attr('id', 'filter-speechiness');
                                               
                                                $("#filter-popularity").attr('id', 'filter-popularity-label');
                                                $("#filter-popularity").html('');
                                                $("#filter-popularity").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-popularity').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-popularity-label').val(0 + " - " + 100).attr('id', 'filter-popularity');
                                                
                                                 $("#filter-danceability").attr('id', 'filter-danceability-label');
                                                $("#filter-danceability").html('');
                                                $("#filter-danceability").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-danceability').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-danceability-label').val(0 + " - " + 100).attr('id', 'filter-danceability');
                                                
                                                $("#filter-valence").attr('id', 'filter-valence-label');
                                                $("#filter-valence").html('');
                                                $("#filter-valence").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-valence').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-valence-label').val(0 + " - " + 100).attr('id', 'filter-valence');
                                                
                                                  $("#filter-acousticness").attr('id', 'filter-acousticness-label');
                                                $("#filter-acousticness").html('');
                                                $("#filter-acousticness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-acousticness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-acousticness-label').val(0 + " - " + 100).attr('id', 'filter-acousticness');
                                                
                                               $(".slider-rating").html('');
                                                $(".slider-rating").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 5,
                                                    values: [0, 5],
                                                    slide: function (event, ui) {
                                                        $("#filter-ratings").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-ratings').val(0 + " - " + 0).attr('id', 'filter-ratings');
                                                
                                                $(".slider-year").html('');
                                              
                                                
                                                $(".slider-year").slider({
                                                    range: true,
                                                    min: 1900,
                                                    max: (new Date()).getFullYear(),
                                                    values: [0, (new Date()).getFullYear()],
                                                    slide: function (event, ui) {
                                                        $("#filter-year").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-year').val(1900 + " - " + (new Date()).getFullYear()).attr('id', 'filter-year');
                                                
                                                $(".slider-tempo").html('');
                                                $(".slider-tempo").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 250,
                                                    values: [0, 250],
                                                    slide: function (event, ui) {
                                                        $("#filter-tempo").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-tempo').val(0 + " - " + 250).attr('id', 'filter-tempo');
                                                
                                                searchFunction();
                                                
                                                
                                            } else if ($(this).val() == "2") {
                                            
                                            $("#filter-energy").attr('id', 'filter-energy-label');
                                                $("#filter-energy").html('');
                                                $("#filter-energy").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [60, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-energy').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-energy-label').val(60 + " - " + 100).attr('id', 'filter-energy');

                                                $(".slider-loudness").html('');
                                                $(".slider-loudness").slider({
                                                    range: true,
                                                    min: -60,
                                                    max: 5,
                                                    values: [-60, 5],
                                                    slide: function (event, ui) {
                                                        $("#filter-loudness").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-loudness').val(-60 + " - " + 5).attr('id', 'filter-loudness');
                                                
                                                
                                                $("#filter-instrumentalness").attr('id', 'filter-instrumentalness-label');
                                                $("#filter-instrumentalness").html('');
                                                $("#filter-instrumentalness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-instrumentalness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-instrumentalness-label').val(0 + " - " + 100).attr('id', 'filter-instrumentalness');
                                                
                                                $("#filter-liveness").attr('id', 'filter-liveness-label');
                                                $("#filter-liveness").html('');
                                                $("#filter-liveness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-liveness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-liveness-label').val(0 + " - " + 100).attr('id', 'filter-liveness');
                                                
                                                $("#filter-speechiness").attr('id', 'filter-speechiness-label');
                                                $("#filter-speechiness").html('');
                                                $("#filter-speechiness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-speechiness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-speechiness-label').val(0 + " - " + 100).attr('id', 'filter-speechiness');
                                               
                                                $("#filter-popularity").attr('id', 'filter-popularity-label');
                                                $("#filter-popularity").html('');
                                                $("#filter-popularity").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-popularity').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-popularity-label').val(0 + " - " + 100).attr('id', 'filter-popularity');
                                                
                                                 $("#filter-danceability").attr('id', 'filter-danceability-label');
                                                $("#filter-danceability").html('');
                                                $("#filter-danceability").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-danceability').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-danceability-label').val(0 + " - " + 100).attr('id', 'filter-danceability');
                                                
                                                $("#filter-valence").attr('id', 'filter-valence-label');
                                                $("#filter-valence").html('');
                                                $("#filter-valence").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [50, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-valence').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-valence-label').val(50 + " - " + 100).attr('id', 'filter-valence');
                                                
                                                  $("#filter-acousticness").attr('id', 'filter-acousticness-label');
                                                $("#filter-acousticness").html('');
                                                $("#filter-acousticness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-acousticness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-acousticness-label').val(0 + " - " + 100).attr('id', 'filter-acousticness');
                                                
                                               $(".slider-rating").html('');
                                                $(".slider-rating").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 5,
                                                    values: [0, 5],
                                                    slide: function (event, ui) {
                                                        $("#filter-ratings").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-ratings').val(0 + " - " + 0).attr('id', 'filter-ratings');
                                                
                                                $(".slider-year").html('');
                                              
                                                
                                                $(".slider-year").slider({
                                                    range: true,
                                                    min: 1900,
                                                    max: (new Date()).getFullYear(),
                                                    values: [0, (new Date()).getFullYear()],
                                                    slide: function (event, ui) {
                                                        $("#filter-year").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-year').val(1900 + " - " + (new Date()).getFullYear()).attr('id', 'filter-year');
                                                
                                                $(".slider-tempo").html('');
                                                $(".slider-tempo").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 250,
                                                    values: [0, 250],
                                                    slide: function (event, ui) {
                                                        $("#filter-tempo").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-tempo').val(0 + " - " + 250).attr('id', 'filter-tempo');
                                                searchFunction();
                                                
                                            } else if ($(this).val() == "3") {
                                                $("#filter-energy").attr('id', 'filter-energy-label');
                                                $("#filter-energy").html('');
                                                $("#filter-energy").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-energy').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-energy-label').val(60 + " - " + 100).attr('id', 'filter-energy');

                                                $(".slider-loudness").html('');
                                                $(".slider-loudness").slider({
                                                    range: true,
                                                    min: -60,
                                                    max: 5,
                                                    values: [-60, 5],
                                                    slide: function (event, ui) {
                                                        $("#filter-loudness").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-loudness').val(-60 + " - " + 5).attr('id', 'filter-loudness');
                                                
                                                
                                                $("#filter-instrumentalness").attr('id', 'filter-instrumentalness-label');
                                                $("#filter-instrumentalness").html('');
                                                $("#filter-instrumentalness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-instrumentalness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-instrumentalness-label').val(0 + " - " + 100).attr('id', 'filter-instrumentalness');
                                                
                                                $("#filter-liveness").attr('id', 'filter-liveness-label');
                                                $("#filter-liveness").html('');
                                                $("#filter-liveness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-liveness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-liveness-label').val(0 + " - " + 100).attr('id', 'filter-liveness');
                                                
                                                $("#filter-speechiness").attr('id', 'filter-speechiness-label');
                                                $("#filter-speechiness").html('');
                                                $("#filter-speechiness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-speechiness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-speechiness-label').val(0 + " - " + 100).attr('id', 'filter-speechiness');
                                               
                                                $("#filter-popularity").attr('id', 'filter-popularity-label');
                                                $("#filter-popularity").html('');
                                                $("#filter-popularity").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [80, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-popularity').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-popularity-label').val(80 + " - " + 100).attr('id', 'filter-popularity');
                                                
                                                 $("#filter-danceability").attr('id', 'filter-danceability-label');
                                                $("#filter-danceability").html('');
                                                $("#filter-danceability").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-danceability').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-danceability-label').val(0 + " - " + 100).attr('id', 'filter-danceability');
                                                
                                                $("#filter-valence").attr('id', 'filter-valence-label');
                                                $("#filter-valence").html('');
                                                $("#filter-valence").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-valence').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-valence-label').val(0 + " - " + 100).attr('id', 'filter-valence');
                                                
                                                  $("#filter-acousticness").attr('id', 'filter-acousticness-label');
                                                $("#filter-acousticness").html('');
                                                $("#filter-acousticness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-acousticness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-acousticness-label').val(0 + " - " + 100).attr('id', 'filter-acousticness');
                                                
                                               $(".slider-rating").html('');
                                                $(".slider-rating").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 5,
                                                    values: [0, 5],
                                                    slide: function (event, ui) {
                                                        $("#filter-ratings").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-ratings').val(0 + " - " + 0).attr('id', 'filter-ratings');
                                                
                                                $(".slider-year").html('');
                                              
                                                
                                                $(".slider-year").slider({
                                                    range: true,
                                                    min: 1900,
                                                    max: (new Date()).getFullYear(),
                                                    values: [0, (new Date()).getFullYear()],
                                                    slide: function (event, ui) {
                                                        $("#filter-year").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-year').val(1900 + " - " + (new Date()).getFullYear()).attr('id', 'filter-year');
                                                
                                                $(".slider-tempo").html('');
                                                $(".slider-tempo").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 250,
                                                    values: [0, 250],
                                                    slide: function (event, ui) {
                                                        $("#filter-tempo").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-tempo').val(0 + " - " + 250).attr('id', 'filter-tempo');
                                                searchFunction();
                                                
                                                
                                            } else if ($(this).val() == "4") {
                                                $("#filter-energy").attr('id', 'filter-energy-label');
                                                $("#filter-energy").html('');
                                                $("#filter-energy").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-energy').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-energy-label').val(60 + " - " + 100).attr('id', 'filter-energy');

                                                $(".slider-loudness").html('');
                                                $(".slider-loudness").slider({
                                                    range: true,
                                                    min: -60,
                                                    max: 5,
                                                    values: [-60, 5],
                                                    slide: function (event, ui) {
                                                        $("#filter-loudness").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-loudness').val(-60 + " - " + 5).attr('id', 'filter-loudness');
                                                
                                                
                                                $("#filter-instrumentalness").attr('id', 'filter-instrumentalness-label');
                                                $("#filter-instrumentalness").html('');
                                                $("#filter-instrumentalness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-instrumentalness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-instrumentalness-label').val(0 + " - " + 100).attr('id', 'filter-instrumentalness');
                                                
                                                $("#filter-liveness").attr('id', 'filter-liveness-label');
                                                $("#filter-liveness").html('');
                                                $("#filter-liveness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-liveness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-liveness-label').val(0 + " - " + 100).attr('id', 'filter-liveness');
                                                
                                                $("#filter-speechiness").attr('id', 'filter-speechiness-label');
                                                $("#filter-speechiness").html('');
                                                $("#filter-speechiness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-speechiness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-speechiness-label').val(0 + " - " + 100).attr('id', 'filter-speechiness');
                                               
                                                $("#filter-popularity").attr('id', 'filter-popularity-label');
                                                $("#filter-popularity").html('');
                                                $("#filter-popularity").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 30],
                                                    slide: function (event, ui) {
                                                        $('#filter-popularity').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-popularity-label').val(0 + " - " + 30).attr('id', 'filter-popularity');
                                                
                                                 $("#filter-danceability").attr('id', 'filter-danceability-label');
                                                $("#filter-danceability").html('');
                                                $("#filter-danceability").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-danceability').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-danceability-label').val(0 + " - " + 100).attr('id', 'filter-danceability');
                                                
                                                $("#filter-valence").attr('id', 'filter-valence-label');
                                                $("#filter-valence").html('');
                                                $("#filter-valence").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-valence').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-valence-label').val(0 + " - " + 100).attr('id', 'filter-valence');
                                                
                                                  $("#filter-acousticness").attr('id', 'filter-acousticness-label');
                                                $("#filter-acousticness").html('');
                                                $("#filter-acousticness").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 100,
                                                    values: [0, 100],
                                                    slide: function (event, ui) {
                                                        $('#filter-acousticness').val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        }
                                                });
                                                $('#filter-acousticness-label').val(0 + " - " + 100).attr('id', 'filter-acousticness');
                                                
                                               $(".slider-rating").html('');
                                                $(".slider-rating").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 5,
                                                    values: [0, 5],
                                                    slide: function (event, ui) {
                                                        $("#filter-ratings").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-ratings').val(0 + " - " + 0).attr('id', 'filter-ratings');
                                                
                                                $(".slider-year").html('');
                                              
                                                
                                                $(".slider-year").slider({
                                                    range: true,
                                                    min: 1900,
                                                    max: (new Date()).getFullYear(),
                                                    values: [0, 1990],
                                                    slide: function (event, ui) {
                                                        $("#filter-year").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-year').val(1900 + " - " + 1990).attr('id', 'filter-year');
                                                
                                                $(".slider-tempo").html('');
                                                $(".slider-tempo").slider({
                                                    range: true,
                                                    min: 0,
                                                    max: 250,
                                                    values: [0, 250],
                                                    slide: function (event, ui) {
                                                        $("#filter-tempo").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                                                         
                                                        $("#wall_records").fadeOut();
                                                    }
                                                });
                                                $('#filter-tempo').val(0 + " - " + 250).attr('id', 'filter-tempo');
                                               $('#form-genres').val('rock');
                                                searchFunction();
                                            }
                                        });



        </script>