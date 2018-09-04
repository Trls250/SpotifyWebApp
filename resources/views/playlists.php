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
              <div class="row">
                <div class="col-md-12">
                  <h3 class="title">Playlists</h3>
                </div>
              </div>
              <div class="playlists-items">
                <ul class="clearfix">
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists4.png');">
                        </div>
                        <div class="follow">
                            <button class="play-follow">Add</button>
                            <!-- <button class="play-follow play-unfollow">Select</button> -->
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
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                            <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists4.png');">
                        </div>
                        <div class="follow">
                             <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Infinite life !</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists1.png');">
                        </div>
                        <div class="follow">
                              <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists4.png');">
                        </div>
                        <div class="follow">
                              <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
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
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                              <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                            <button class="play-follow">Select</button>
                            <!-- <button class="play-follow play-unfollow">Unfollow</button> -->
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists1.png');">
                        </div>
                        <div class="follow">
                            <button class="play-follow">Add</button>
                            <!-- <button class="play-follow play-unfollow">Unfollow</button> -->
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
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                             <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists4.png');">
                        </div>
                        <div class="follow">
                              <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Infinite life !</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists1.png');">
                        </div>
                        <div class="follow">
                              <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists4.png');">
                        </div>
                        <div class="follow">
                              <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
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
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                             <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                             <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                             <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="play-box">
                      <div class="playlayer">
                        <div class="play-img" style="background-image: url('images/playlists3.png');">
                        </div>
                        <div class="follow">
                              <!-- <button class="play-follow">Add</button> -->
                            <button class="play-follow play-unfollow">Select</button>
                        </div>
                      </div>
                      <div class="play-content">
                          <h4>Without Words</h4>
                          <p>12 Tracks</p>
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