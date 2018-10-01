@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')


            <div id ="wall_records" class="content-container">
              <div class="row">
                <div class="col-md-12">
                  <h3 id ="title_replace" class="title">Wall</h3>
                </div>

              </div>
            </div>


          </div>

            <div class="loader page_end_div">
                <img  id = "main_loader" class="center-block loader-img" src = "{{ URL::asset('public/images/loading.gif') }}"/>
            </div>




        </section>

        <script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>
        <script type="text/javascript">

            $("#main_loader").fadeIn();
            var offset = 0;
            var items = 5;
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

                getRecords();


          });

            $(window).scroll(function() {
                var pos = $(window).scrollTop() + $(window).height();
                if($('.page_end_div').length != 0){
                    if(flag && temp){
                         if (pos  - $(".page_end_div").offset().top <=0.30)
                        {
                            getRecords(offset, items);
                            console.log("flag:" + flag);
                        }
                    }
                }
            });

          function getRecords() {

              temp = false;
              $("#main_loader").fadeIn();
              $.ajax({
                  type: "get",
                  url: "{{ url('playlist/getWallRecords')}}"+'?offset='+offset+'&items='+items,
                  success: function (data) {
                      console.log(data.Status);
                      $("#main_loader").fadeOut();
                      if(data.Status == "404"){
                          $(".page_end_div").html("Sorry, no playlists found.");
                          flag = false;

                      }
                      else if (data.Status == "204") {
                          $(".page_end_div").html("No further records");
                          flag = false;

                      }
                      else {
                          $('#wall_records').append(data);
                      }
                  },

                  error: function(XMLHttpRequest, textStatus, errorThrown) {

                  }
              });

              offset+=items;
              temp = true;
          }
        </script>
    </body>
</html>