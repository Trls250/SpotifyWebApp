
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
                    <label>Acousticness  - <output> 0 </output></label>
                    <div class="value-container">
                      <span class="contentvalue leftvalue">0</span><input class="filter-input" id="filter-acousticness" type="range" value="0" step="1" min="0" max="100"><span class="contentvalue rightvalue">100</span>
                    </div>
                  </div>
                </div>
                <p class ="search_message">Search filters applied, loaded results will be pre-filterized</p> 
              </div>
            </div>

          <script>
            $('.search_message').hide();
          </script>
            