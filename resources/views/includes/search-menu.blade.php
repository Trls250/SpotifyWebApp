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
                 <label> Instrumentalness - <output id="filter-instrumentalness"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-instrumentalness" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-instrumentalness"></div>
                  </div>
                  
                 <div class="range1">
                 <label> Liveness - <output id="filter-liveness"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-liveness" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-liveness"></div>
                  </div>
                    <div class="range1">
                 <label> Loudness - <output id="filter-loudness"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-loudness" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-loudness"></div>
                  </div>
                  
                     <div class="range1">
                 <label> Speechiness - <output id="filter-speechiness"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-speechiness" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-speechiness"></div>
                  </div>
                 
                    <div class="range1">
                 <label> BPM - <output id="filter-tempo"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-tempo" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-tempo"></div>
                  </div>
                 <div class="range1">
                 <label> Popularity - <output id="filter-popularity"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-popularity" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-popularity"></div>
                  </div>
                 
                 <div class="range1">
                 <label> Danceability - <output id="filter-danceability"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-danceability" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-danceability"></div>
                  </div>
                    
                     <div class="range1">
                    <label> Energy - <output id="filter-energy"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-energy" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-energy"></div>
                  </div>
                    
                     <div class="range1">
                    <label> Valence - <output id="filter-valence"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-valence" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-valence"></div>
                  </div>
                    
                      <div class="range1">
                    <label> Acousticness - <output id="filter-acousticness"> 0 </output></label>
                <input type="text" class="filter-input" id="filter-acousticness" type="range" ><span class="contentvalue rightvalue">100</span>
                <div class="slider-range" id="filter-acousticness"></div>
                  </div>
                      <div class="range1">
                 <label> Ratings - <output id="filter-ratings" > 0 </output></label>
                <input type="text" class="filter-input" id="filter-ratings" type="range" ><span class="contentvalue rightvalue">5</span>
                <div class="slider-rating" id="filter-ratings"></div>
                  </div>
                
                  
                </div>
                <p class ="search_message">Search filters applied, loaded results will be pre-filterized</p> 
              </div>
            </div>

 
          
            <script>
            $('.search_message').hide();
            </script>