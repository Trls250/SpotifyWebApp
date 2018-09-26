
        <section class="main-wrapper">
          <div class="container-fluid">
            <div class="content-container">
              <div class="row">
                <div class="col-md-12">
                    <div class="playlists-items">
                        <h3 id="title_to_replace" class="title">Public Playlists</h3>
                        <ul id = "playlist_records" class="clearfix">
                            <div class="playlist_records">
                            </div>
                        </ul>
                        <div class="page-end-div">
                            <div class="msg"></div>
                            <img  id = "main_loader" class= 'center-block loader-img' src = "{{ URL::asset('public/images/loading.gif') }}"/>
                        </div>

                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- <div class="page-end-div"></div> -->
        <script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>
        <script type="text/javascript">
            $(".loader").fadeIn();
            $("#main_loader").fadeIn();
          var offset = 0;
          var items  = 10;
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
                $('.profile-navi').hide();
                $('.profile-nav-top').click(function () {
                    $(this).next('.profile-navi').slideToggle();
                });

                getAllRecords(offset, items);
                offset += items;

          });


          $(window).scroll(function() {
              var pos = $(window).scrollTop() + $(window).height();
              if($('.page-end-div').length != 0){
                  if(flag && temp){
                      if(pos >= $(".page-end-div").offset().top){
                              getAllRecords(offset, items);
                              offset += items;
                      }
                  }
              }
          });

          function getAllRecords(offset, items){
              temp = false;
              {{--console.log("{{ url('playlist/user/getAllRecords')}}"+"?id="+"{{$id}}"+"?offset="+offset+"&items="+items);--}}
              $.ajax({
                  type: "get",
                  url: "{{ url('playlist/user/getAllRecords')}}"+"?id="+"{{$id}}"+"&offset="+offset+"&items="+items,
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
              temp = true;
          }
        </script>
    </body>
</html>


