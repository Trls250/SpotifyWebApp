<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Spotify</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/nice-select.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="css/style.css">     
    </head>
    <body>
        <header class="main-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-2 col-sm-4 col-xs-4">
                <div class="logo">
                  <img src="images/logo.png"/>
                </div>
              </div>
              <div class="col-md-5 hidden-sm hidden-xs">
                <div class="mobile-search">
                    <button class="btn search-btns">
                      <img src="images/search.png">
                    </button>                  
                  <!-- <form>
                    <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                  </form> -->
                </div>
                <div class="search">
                  <form>
                    <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                  </form>
                </div>
                
              </div>
              <div class="col-md-5 col-sm-8 col-xs-8">
                <div class="addplay-lists">
                  <div class="profile-nav">
                            <a href="#" class="profile-nav-top">
                                <figure style="background-image: url(images/profile.png)"></figure>
                                <span>Darya Vermalen</span>
                                <i class="fa fa-sort-down"></i>
                            </a>
                            <ul class="profile-navi">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </div>
                </div>
              </div>
            </div>
            <div class=" mobile-row">
              <div class="menu-icons" id="menu-icons">
                <span class="sr-onlys"></span>
                <span class="sr-onlys"></span>
                <span class="sr-onlys"></span>
                <span class="close-icons"></span>
              </div>
              <div class="playlists-rows">   
                <button class="play-btn">
                    Add Playlist
                </button>
                <button class="btn search-btns">
                    <img src="images/search.png">
                </button> 
                <form class="search-form">
                  <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                </form>
              </div>
              
          </div>
        </header>
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
                    <div class="form-group">
                      <div class="box">
                        <select>
                          <option value="type1">Type1</option>
                          <option value="type2">Type2</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="box">
                        <select>
                          <option value="market">Market</option>
                          <option value="us">US</option>
                          <option value="mexician" >Mexician</option>
                          <option value="russian">Russian</option>
                          <option value="east">East</option>
                          <option value="west">West</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="box">
                        <select>
                          <option value="genres">Genres</option>
                          <option value="genres2">Genres2</option>
                        </select>
                      </div>
                    </div>
                   <!--  <div class="form-group">
                      <select  id="search1" class="selectlists"  multiple="multiple">     
                        <option>Type1</option>
                        <option>Type2</option>
                        <option>Usman</option>
                      </select> 
                    </div>
                    <div class="form-group">
                      <select  id="search2" class="selectlists"  multiple="multiple">     
                        <option>Type1</option>
                        <option>Type2</option>
                        <option>Usman</option>
                      </select> 
                    </div> -->
                    <div class="form-group">
                      <button class="btn play-follow playlists filter"> <i class="fas fa-filter"></i> Advance Filter</button>
                    </div>
                  </form>
                 </div> 
              </div>
            </div>
            <div class="rangesliders">
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
                  <h3 class="title">Search result</h3>
                  <p class="found-items">48 Playlists found</p>
                </div>
              </div>
              <div class="playlists-items">
                <ul class="clearfix">
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists2.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists4.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists1.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists2.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists1.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="">
                        <div class="play-img" style="background-image: url('images/playlists4.png');">
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Mali is...</h4>
                          <p>20 Tracks</p>
                      </div>
                      
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.nice-select.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function () {
            
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
          });
          $(document).ready(function() {
            $('select').niceSelect(); 
          });
        </script>
    </body>
</html>