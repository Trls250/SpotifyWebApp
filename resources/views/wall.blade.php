@include('includes/header')
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
            <div class="content-container" id="wall_records" data-placement="10">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="title">Wall</h3>
                </div>
              </div>

            </div>
          </div>
        </section>
        <script src= "{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
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

                getRecords(0,2);

              $(".main-wrapper").scroll(function(e){

                  if (processing)
                      return false;

                  if ($(".main-wrapper").scrollTop() >= ($("#wall_records").height() - $(".main-wrapper").height())*0.7){
                      processing = true;
                      alert("hi");
                  }
              });
          });

          function getRecords($offset, $items) {
              $.ajax({
                  type: "get",
                  url: "{{ url('playlist/getWallRecords')}}"+'?offset='+$offset+'&items='+$items,
                  success: function (data) {
                      $(".loader").fadeOut();
                      if(data.status == "404"){
                          $("#wall_records").replaceWith("You need to add atleast one track to this playlist first for track details.");
                      }
                      else {
                          $('#wall_records').append(data);
                      }
                  },

                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                      alert("Status: " + textStatus); alert("Error: " + errorThrown);
                  }
              });
          }
        </script>
    </body>
</html>