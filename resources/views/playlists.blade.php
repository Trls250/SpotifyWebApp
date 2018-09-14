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
                            <div class="loader">
                                <img  class= 'center-block loader-img' src = "{{ URL::asset('/images/loading.gif') }}"/>
                            </div>
                        </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <script src= "{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.js') }}"></script>
        <script type="text/javascript">
            var offset = 0;
            var items = 10;
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
                offset+=items;

          });


          function getAllRecords(offset, items){
              $.ajax({
                  type: "get",
                  url: "{{ url('playlist/getAllRecords')}}"+'?offset='+offset+'&items='+items,
                  success: function (data) {
                      $(".loader").fadeOut();
                      if(data.Status == "404"){
                          $("#title_to_replace").replaceWith("Sorry, currently there is no playlist in your library.")
                      }
                      else {
                          $('#playlist_records').append(data);
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