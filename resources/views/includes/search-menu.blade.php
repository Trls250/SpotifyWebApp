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
                <div class="range-row clearfix">
                    <div class="range1">
                 <label> Instrumentalness - <output id="filter-instrumentalness">  0 - 100 </output></label>
                <div class="slider-instrumentalness" id="filter-instrumentalness"></div>
                  </div>
                  
                 <div class="range1">
                 <label> Liveness - <output id="filter-liveness">  0 - 100 </output></label>
                <div class="slider-liveness" id="filter-liveness"></div>
                  </div>
                    <div class="range1">
                 <label> Loudness - <output id="filter-loudness">  0 - 100 </output></label>
                <div class="slider-loudness" id="filter-loudness"></div>
                  </div>
                  
                     <div class="range1">
                 <label> Speechiness - <output id="filter-speechiness">  0 - 100 </output></label>
                <div class="slider-speechiness" id="filter-speechiness"></div>
                  </div>
                 
                    <div class="range1">
                 <label> BPM - <output id="filter-tempo">  0 - 100 </output></label>
                <div class="slider-tempo" id="filter-tempo"></div>
                  </div>
                 <div class="range1">
                 <label> Popularity - <output id="filter-popularity">  0 - 100 </output></label>
                <div class="slider-popularity" id="filter-popularity"></div>
                  </div>
                 
                 <div class="range1">
                 <label> Danceability - <output id="filter-danceability">  0 - 100 </output></label>
                <div class="slider-danceability" id="filter-danceability"></div>
                  </div>
                    
                     <div class="range1">
                    <label> Energy - <output id="filter-energy">  0 - 100 </output></label>
                <div class="slider-range" id="filter-energy"></div>
                  </div>
                    
                     <div class="range1">
                    <label> Valence - <output id="filter-valence">  0 - 100 </output></label>
                <div class="slider-valence" id="filter-valence"></div>
                  </div>
                    
                      <div class="range1">
                    <label> Acousticness - <output id="filter-acousticness">  0 - 100 </output></label>
                <div class="slider-acousticness" id="filter-acousticness"></div>
                  </div>
                      <div class="range1">
                 <label> Ratings - <output id="filter-ratings" >  0 - 5 </output></label>
                <div class="slider-rating" id="filter-ratings"></div>
                  </div>
                
                  
                </div>
                <p class ="search_message">Search filters applied, loaded results will be pre-filterized</p> 
              </div>
            </div>

 
          
            <script>
            $('.search_message').hide();
            </script>