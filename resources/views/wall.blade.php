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
            <div class = "page_end_div"></div>
        </section>
        <script src= "{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript">
            var offset = 0;
            var items = 2;
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

                getRecords(offset,items);

              $(".main-wrapper").scroll(function(e){

                  if (processing)
                      return false;

                  if ($(".main-wrapper").scrollTop() >= ($("#wall_records").height() - $(".main-wrapper").height())*0.7){
                      processing = true;
                      alert("hi");
                  }
              });

              $(window).scroll(function() {
                  var pos = $(window).scrollTop() + $(window).height();
                  if($('.page-end-div').length != 0){

                      if(pos >= $(".page-end-div").offset().top){
                          if(flag){

                              flag = false;

                              console.log("here");
                              //getAllRecords(offset, items);
                              offset += items;
                          }
                      }else{
                          flag = true;
                      }
                  }
              });


          });

          function getRecords($offset, $items) {
              $.ajax({
                  type: "get",
                  url: "{{ url('playlist/getWallRecords')}}"+'?offset='+$offset+'&items='+$items,
                  success: function (data) {
                      $(".loader").fadeOut();
                      console.log(data.Status);
                      if(data.Status == "404"){
                          $("#title_replace").html("Sorry, currently there is no playlist in our system.");
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