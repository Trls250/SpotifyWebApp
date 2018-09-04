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
            <div class="content-container">
              <div class="open-play">
                <div class="open-play-column1">
                  <div class="playimages" style="background-image: url('images/open-.png')"></div>
                  <div class="headingrow">
                    <h3>Superorganism</h3>
                    <p><img src="images/refresh-icon.png"/>  Refresh Playlist</p>
                  </div>
                  <p class="years">2014</p>
                  <div class="rating">
                    <img src="images/filstar.png">
                    <img src="images/filstar.png">
                    <img src="images/filstar.png">
                    <img src="images/filstar.png">
                    <img src="images/empty-star.png">
                    <span>(230 Rate it)</span>
                  </div>
                  <div class="rewviewscontent">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor.</p>
                  </div>
                  <div class="follow-lists">
                    <button class="play-follow recalcalc">ReCalculate</button>
                    <button class="play-follow playlists recalcalc"><img src="images/play-arrow.png"/> Playlist Info</button>
                  </div>
                </div>
                <div class="open-play-column2">
                  <div class="iframe">
                    <img src="images/iframe.png" style="width: 100%;" />
                    <h3>3 Comments</h3>
                  </div>
                  <div class="commentsbox">
                    <div class="commentimages" style="background-image: url('images/comment-image.png');"></div>
                    <h4>Matthew Corwin <span>@matthew489</span></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                    <p class="time"> <img src="images/time.png"> 3 hours ago</p>
                  </div>
                  <div class="commentsbox">
                    <div class="commentimages" style="background-image: url('images/comment-image.png');"></div>
                    <h4>Matthew Corwin <span>@matthew489</span></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                    <p class="time"> <img src="images/time.png"> 3 hours ago</p>
                  </div>
                  <div class="commentsbox">
                    <div class="commentimages" style="background-image: url('images/comment-image.png');"></div>
                    <h4>Matthew Corwin <span>@matthew489</span></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                    <p class="time"> <img src="images/time.png"> 3 hours ago</p>
                  </div>
                  <div class="ratecomment">
                    <h4>Rate & comment</h4>
                    <div class="rating">
                      <a href=""><img src="images/filstar.png"></a>
                      <a href=""><img src="images/filstar.png"></a>
                      <a href=""><img src="images/filstar.png"></a>
                      <a href=""><img src="images/filstar.png"></a>
                      <a href=""><img src="images/empty-star.png"></a>
                      <span>Like it</span>
                    </div>
                    <div class="commentmsg">
                      <form>
                        <div class="form-group">
                        <textarea class="msgbox" placeholder="Write comment"></textarea>
                        </div>
                        <div class="form-group">
                          <input type="text" class="suggesttrack" name="" placeholder="Suggest Track (paste Spotify track ID here) ">
                        </div>
                        <button class="btn btn-submit">Submit <img src="images/arrow.png"/></button>
                      </form>
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