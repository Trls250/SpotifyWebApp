@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')


            <div id ="wall_records" class="content-container">
              <div class="row">
                <div class="col-md-12">
                  <div class="playlists-items">
                    <h3 id ="title_replace" class="title">Tagged Playlists</h3>
                    <ul id="playlist_records" class="clearfix">
                            <div class="playlist_records">
                            <li>
                                <div class="play-box">
                                    <div class="playlayer">
                                        <div class="play-img" style="background-image: url('https://i.scdn.co/image/820f9f308917a4e4023361d980c84ddd377a9a18');"></div>
                                          <div class="follow">
                                            <button class="play-follow play-unfollow" onclick="window.location='http://localhost/spotify/playlist/open-playlist/37i9dQZF1DWUVpAXiEPK8P'">Select</button>
                                                        <!-- <button class="play-follow play-unfollow">Select</button> -->
                                        </div>
                                    </div>
                                    <div class="play-content">
                                        <h4>Power Workout</h4>
                                        <p>55 Tracks</p>
                                    </div>
                                </div>
                            </li>
                          <script src="http://localhost/spotify/public/js/jquery.js"></script>
                          <script src="http://localhost/spotify/public/js/bootstrap.js"></script>
<script>


    function addPlaylist(id){
        $('#playlist_records').fadeOut();
        $(".msg").hide();
        $("#main_loader").fadeIn();
        $("#title_to_replace").replaceWith( "<h3 class='title'>Loading playlist.....</html>");
        this.add(id);
    }


    function add(id) {

        $('#main_loader').fadeIn();
                        $.ajax({
                            type: "get",
                            url: "http://localhost/spotify/playlist/insertSimple" + '/' + id,
                            success: function (data) {

                                if (data['Success'] == true) {
                                    $("#title_to_replace").replaceWith( "<h3 class='title'>Almost Done.....</html>");
                                    window.location = ('http://localhost/spotify/playlist/open-playlist' + '/' + data['id']);
                                    $(".msg").fadeIn();
                                    $("#main_loader").fadeOut();
                                }
                                else {

                                    console.log(data);
                                    $(".msg").fadeIn();
                                    $("#main_loader").fadeOut();
                                    $('#playlist_records').fadeIn();
                                    $("#title_to_replace").replaceWith( "<h3 class='title'>There was an error adding last playlist to our system.....try again :(</thml>");
                                }
                            },

                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("Status: " + textStatus);
                                $('#main_loader2').fadeOut();
                                $('#playlist_records').fadeIn();
                                $("#title_to_replace").replaceWith("<h3 class='title'> There was an error adding last playlist to our system.....try again :(</h3>");

                            },
                        });



    }

</script></div>
                        </ul>
                  </div>
                </div>

              </div>
            </div>


          </div>

            <!-- <div class="loader page_end_div">
                <img  id = "main_loader" class="center-block loader-img" src = "{{ URL::asset('public/images/loading.gif') }}"/>
            </div> -->




        </section>

       
    </body>
</html>