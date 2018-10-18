@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')

            <div class="content-container">
              <div class="row">
                <div class="col-md-12">
                    <div class="playlists-items user-info-playlist-items">
                        <h3 id="title_to_replace" class="title">Playlists</h3>
                        <ul id = "playlist_records" class="clearfix">
                            <div class="playlist_records ">
                            </div>
                        </ul>
                        

                    </div>
                </div>
              </div>
            </div>
          </div>
          
        </section>
        <div class="loader page-end-div">
                            <div class="msg"></div>
                            <img  id = "main_loader" class= 'center-block loader-img' src = "{{ URL::asset('public/images/loading.gif') }}"/>
                    </div>
        <!-- <div class="page-end-div"></div> -->
        <script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>
        <script type="text/javascript">
            $("#adding").hide();
          var offset = 0;
          var items  = 50;
          var flag   = true;
          var temp = true;

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
                // $('.profile-navi').hide();
                // $('.profile-nav-top').click(function () {
                //     $(this).next('.profile-navi').slideToggle();
                // });

                getAllRecords(offset, items);
                offset += items;

          });


          $(window).scroll(function() {
              var pos = $(window).scrollTop() + $(window).height();
              if($('.page-end-div').length != 0){
                  if(flag && temp){
                      if(pos > $(".page-end-div").offset().top){

           
                          
                             getAllRecords(offset, items);
                             offset += items;
                      }
                  }
              }
          });

          function getAllRecords(offset, items){
              temp =false;
              $.ajax({
                  type: "get",
                  url: "{{ url('getAllUsers')}}"+'?offset='+offset+'&items='+items,
                  success: function (data) {
                      
                      // $(".loader").fadeOut();
                      if(data.Status == "404"){
                          $("#main_loader").hide();
                          $("#title_to_replace").replaceWith("Sorry, currently there is no playlist in your library.")
                      }else if(data.Status == "204"){
                          flag = false;
                          $(".msg").html("No more playlists.");
                          $("#main_loader").hide();
                      }else {
                          $('.playlist_records').append(data);
                      }
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                      console.log("Status: " + textStatus);
                  }
              });

              temp =true;
          }
          
          function addPlaylist(id){
        $('#playlist_records').fadeOut();
        $(".msg").hide();
        $("#main_loader").fadeIn();
        $("#title_to_replace").replaceWith( "<h3 class='title'>Loading playlist.....</html>");
        this.add(id);
    }


    function add(id) {
        var temp = "#add_btn_" + id;
        $('#main_loader').fadeIn();
                        $.ajax({
                            type: "get",
                            url: "{{url('playlist/insertSimple/')}}" + '/' + id,
                            success: function (data) {

                                if (data['Success'] == true) {
                                    $("#title_to_replace").replaceWith( "<h3 class='title'>Almost Done.....</html>");
                                    $(temp).html(``);
                                    $(".msg").fadeIn();
                                    $("#main_loader").fadeOut();
                                    window.location = ('{{url('playlist/open-playlist/')}}' + '/' + data['id']);
                                }
                                else {

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
          
        </script>
    </body>
</html>