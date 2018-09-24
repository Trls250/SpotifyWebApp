@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')

            <div class="content-container">
              <div class="row">
                <div class="col-md-12">
                    <div class="playlists-items">
                        <h3 id="title_to_replace" class="title">Playlists</h3>
                        <ul id = "playlist_records" class="clearfix">
                            <div class="playlist_records">
                            </div>
                        </ul>
                        <div class="loader page-end-div">
                            <img  class= 'center-block loader-img' src = "{{ URL::asset('public/images/loading.gif') }}"/>
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
          var offset = 0;
          var items  = 8;
          var flag   = true;

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
                  if(flag){
                      if(pos >= $(".page-end-div").offset().top){
                              getAllRecords(offset, items);
                              offset += items;
                      }
                  }
              }
          });

          function getAllRecords(offset, items){
              $.ajax({
                  type: "get",
                  url: "{{ url('playlist/getAllRecords')}}"+'?offset='+offset+'&items='+items,
                  success: function (data) {
                      
                      // $(".loader").fadeOut();
                      if(data.Status == "404"){
                          $("#title_to_replace").replaceWith("Sorry, currently there is no playlist in your library.")
                      }else if(data.Status == "204"){
                          flag = false;
                          $(".page-end-div").html("No more playlists.");
                      }else {
                          $('.playlist_records').append(data);
                      }
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                      console.log("Status: " + textStatus); alert("Error: " + errorThrown);
                  }
              });
          }
        </script>
    </body>
</html>