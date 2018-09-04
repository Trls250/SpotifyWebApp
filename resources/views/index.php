<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Spotify</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
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
                  <button class="play-btn dektop-play-btn">
                    Add Playlist
                </button>
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
                <button class="btn search-btns">
                    <img src="images/search.png">
                </button> 
                <form class="search-form">
                  <input type="text" name="" class="serch-icons" placeholder="Search for a spotify albums...">
                </form>  
                <button class="play-btn">
                    Add Playlist
                </button>
              </div>
              
          </div>
        </header>
        <section class="main-wrapper">
          <div class="container-fluid">
            <div class="sidebar">
              <ul class="sidebar-lists">
                <li class="active">
                  <a href="#">Wall</a>
                </li>
                <li>
                  <a href="#">Playlists</a>
                </li>
                <li>
                  <a href="#">Playlists</a>
                </li> 
              </ul>
            </div>
            <div class="content-container">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="title">Wall</h3>
                </div>
              </div>
              <div class="row">
                  <div class="post-row clearfix">
                      <div class="post-width post-image"  style="background-image: url('images/playimage.png');">
                      </div>
                      <div class="contentwidth">
                        <div class="postscontent">
                          <h2>Without Words <sub>(2014)</sub></h2>
                          <!-- <button class="follow-btn">Follow</button> -->
                        </div>
                        <p class="followers"><span>87</span> Followers</p>
                        <div class="rating">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/empty-star.png">
                          <span>(230 Rate it)</span>
                        </div>
                        <div class="popular-lists">
                          <ul>
                            <li>
                              Popularity<br/>
                              <span>0.8</span>
                            </li>
                            <li>
                              Danceability<br/>
                              <span>0.46</span>
                            </li>
                            <li>
                              Energy<br/>
                              <span>0.22</span>
                            </li>
                            <li>
                              Valence<br/>
                              <span>0.5</span>
                            </li>
                          </ul>
                        </div>
                        <div class="tags">
                          <ul>
                            <li>
                              GENRES
                            </li>
                            <li>Rock</li>
                            <li>Jazz</li>
                            <li>Pop</li>
                          </ul>
                        </div>
                        <div class="taglists">
                          <div class="playimage" style="background-image: url('images/profile.png')"></div>
                          <div class="playname">
                            <p>Playlist By:</p>
                            <h3>Maurice Morgan</h3>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="post-row clearfix">
                      <div class="post-width post-image"  style="background-image: url('images/playimage.png');">
                      </div>
                      <div class="contentwidth">
                        <div class="postscontent">
                          <h2>Infinite life !<sub>(2018)</sub></h2><!-- 
                          <button class="follow-btn unfollow-btn">Unfollow</button> -->
                        </div>
                        <p class="followers"><span>87</span> Followers</p>
                        <div class="rating">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/empty-star.png">
                          <span>(230 Rate it)</span>
                        </div>
                        <div class="popular-lists">
                          <ul>
                            <li>
                              Popularity<br/>
                              <span>0.8</span>
                            </li>
                            <li>
                              Danceability<br/>
                              <span>0.46</span>
                            </li>
                            <li>
                              Energy<br/>
                              <span>0.22</span>
                            </li>
                            <li>
                              Valence<br/>
                              <span>0.5</span>
                            </li>
                          </ul>
                        </div>
                        <div class="tags">
                          <ul>
                            <li>
                              GENRES
                            </li>
                            <li>Rock</li>
                            <li>Jazz</li>
                            <li>Pop</li>
                          </ul>
                        </div>
                        <div class="taglists">
                          <div class="playimage" style="background-image: url('images/profile.png')"></div>
                          <div class="playname">
                            <p>Playlist By:</p>
                            <h3>Maurice Morgan</h3>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="post-row clearfix">
                      <div class="post-width post-image"  style="background-image: url('images/playimage.png');">
                      </div>
                      <div class="contentwidth">
                        <div class="postscontent">
                          <h2>Mali is....  <sub>(2017)</sub></h2>
                          <!-- <button class="follow-btn">Follow</button> -->
                        </div>
                        <p class="followers"><span>87</span> Followers</p>
                        <div class="rating">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/filstar.png">
                          <img src="images/empty-star.png">
                          <span>(230 Rate it)</span>
                        </div>
                        <div class="popular-lists">
                          <ul>
                            <li>
                              Popularity<br/>
                              <span>0.8</span>
                            </li>
                            <li>
                              Danceability<br/>
                              <span>0.46</span>
                            </li>
                            <li>
                              Energy<br/>
                              <span>0.22</span>
                            </li>
                            <li>
                              Valence<br/>
                              <span>0.5</span>
                            </li>
                          </ul>
                        </div>
                        <div class="tags">
                          <ul>
                            <li>
                              GENRES
                            </li>
                            <li>Rock</li>
                            <li>Jazz</li>
                            <li>Pop</li>
                          </ul>
                        </div>
                        <div class="taglists">
                          <div class="playimage" style="background-image: url('images/profile.png')"></div>
                          <div class="playname">
                            <p>Playlist By:</p>
                            <h3>Maurice Morgan</h3>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </section>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
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
    </body>
</html>