@include('includes/header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
        <section class="main-wrapper search-wrapper">
          <div class="container-fluid">

              @include('includes/sidebar')
     
            <div  class="content-container">
              <div class="row ">
                <div class="col-md-12 column-flex">

                  <div class="flex-column">
                  </div>
                </div>
              </div>
            
            <div id ="wall_records">
            <div class="playlist_records latest-activity">
                <p class="popular-user">Popular Users</p>
              <div class="table-responsive">


              <div class="table-responsive">
                <table class="table" id="users">
                    <thead>
                        <tr>
                            <th>
                            Users
                            </th>
                            <th>
                            Followers
                            </th>
                            
                            <th>
                            Avg Playlist Rating
                            </th>
                            <th>
                            User's Playlists
                            </th>
                            </tr>
                            </thead>
                            <tbody>
                                
                  </tbody>
                </table>
              </div>
                

              
        </section>


        <script src="{{ URL::asset('public/js/jquery.nice-select.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.0/rangeslider.min.js"></script>   
        <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
        <script type="text/javascript">
            
        
            //temp= {{json_encode($Users,true)}};
            $('input[type=checkbox]').removeAttr('checked');
            $(document).ready( function () {
                table = $('#users').DataTable({
                    'responsive' : true,
                    'paging' : false,
                    'searching': false,
                    'destroy': true,
                    "bInfo" : false,
                    'ajax':{
                      url: "{{url('playlist/stats-result')}}"
                    },
                    columns: [
                      { data: data },
                      { data: 'Followers' },
                      { data: 'Avg Playlist Rating' },
                      { data: 'Users Playlists' }
                      
                      ]
                   });
                   });

            $(document).ready(function () {
                $(function() {
                // var output = document.querySelectorAll('output')[0];
                $(document).on('input', 'input[type="range"]', function(e) {
                        // console.log($(this).prev());
                        $(this).parents('.range1').find('label output').html(e.currentTarget.value);
                        // output.innerHTML = e.currentTarget.value;
                });
                $('input[type=range]').rangeslider({
                    polyfill: false
                });
                });
                // $('#toggle-search').on('click', function() {
                //   $('#searchBar').toggle("slow");
                // });
                $('.profile-navi').hide();

                $("#search1").select2({
                  width: "100%",
                  allowClear: true,
                });
                $("#search2").select2({
                  width: "100%",
                  allowClear: true,
                });
                $("#search3").select2({
                  width: "100%",
                  allowClear: true,
                });

              //   $('select:not(.ignore)').niceSelect();      
              // FastClick.attach(document.body);
                 
          
          
                
          $(document).ready(function() {
            $('select').niceSelect(); 
            $("#advanced").show();
            getRecords();
          });
          
          $(document).ready(function () {
                $(".menu-icons").on('click', function() {
                  $(".sidebar").animate({
                    width: "toggle"
                  });
                  $(this).toggleClass("open");
                });



          });
          
         


            });
        </script>
        

    </body>
</html>