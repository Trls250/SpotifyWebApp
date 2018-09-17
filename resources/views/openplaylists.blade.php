@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">
            
            @include('includes/sidebar')
            
            <div class="content-container">
              <div class="open-play">
                <div class="open-play-column1">
                  @if(file_exists('playlists/'.$Playlist['id'].'.jpg'))
                      <div class="playimages" style="background-image: url('<?php echo URL::asset('playlists/'.$Playlist['id'].'.jpg'); ?>')"></div>
                  @else
                        <div class="playimages" style="background-image: url('<?php echo URL::asset('images/default_playlist.jpg'); ?>')"></div>
                  @endif
                  <div class="headingrow">
                    <h3><?php echo $Playlist['title'] ?></h3>
                    <!-- <p ><img src="<?php echo URL::asset('images/refresh-icon.png'); ?>"/>  Refresh Playlist</p> -->
                  </div>
                  <!-- <p class="years">2014</p> -->
                  <div class="rating">
                    <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <?php if($i < (int)$Playlist['rating']){ ?>
                            <img src="<?php echo URL::asset('images/filstar.png'); ?>">
                        <?php }else{ ?>
                            <img src="<?php echo URL::asset('images/empty-star.png'); ?>">
                        <?php } ?>
                    <?php } ?>
                    <span>(<?php echo $Playlist['rating_count'] ?> Rate it)</span>
                  </div>
                  <div class="rewviewscontent">
                  <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor.</p> -->
                  </div>
                  <div class="follow-lists">
                    <!-- <button class="play-follow recalcalc">ReCalculate</button> -->
                    <a href="{{ URL::to('playlist/details/'.$Playlist['id']) }}" class="play-follow playlists recalcalc"><img src="<?php echo URL::asset('images/play-arrow.png'); ?>"/> Playlist Info</a>
                  </div>
                </div>
                <div class="open-play-column2 comment-box">
                  <div class="iframe">
                    <!-- <img src="<?php echo URL::asset('images/iframe.png'); ?>" style="width: 100%;" /> -->
                    <iframe src="https://open.spotify.com/embed/user/{{$Playlist['creator_id']}}/playlist/{{$Playlist['id']}}" width="600" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    <h3>{{count($comments)}} Comments</h3>
                  </div>
                  <?php foreach($comments as $comment){ ?>
                      <div class="commentsbox">
                          <div class="commentimages" style="background-image: url('<?php echo $comment['userProfileImage']; ?>'"></div>
                          <h4><?php echo $comment['userName']; ?></h4>
                          <p><?php echo $comment['text']; ?></p>
                          <p class="time"> <img src="<?php echo URL::asset('images/time.png'); ?>"><?php echo $comment['time']; ?></p>
                      </div>
                  <?php } ?>
                  <div class="ratecomment rate-comment-box">
                    <h4>Rate & comment</h4>
                    <div class="rating rateYo error-rating">
                     <!--  <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/empty-star.png'); ?>"></a> -->
                      <span>Like it</span>
                    </div>
                    <div class="commentmsg">
                      <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="rating" value="" >
                        <div class="form-group">
                        <textarea class="msgbox comment-text error-comment comment-fields" placeholder="Write comment"></textarea>
                        </div>
                        <div class="form-group">
                          <input id="suggest-track" type="text" class="suggesttrack" name="suggest-track" placeholder="Suggest Track (paste Spotify track ID here) ">
                        </div>
                        <button class="btn btn-submit submit-comment">Submit <img src="<?php echo URL::asset('images/arrow.png'); ?>" /></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.js') }} "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
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

                $(function () {
 
                $(".rateYo").rateYo({
                      rating: 0,
                      fullStar: true,
                      starWidth: "25px",
                      ratedFill: "#ffef0f",
                      numStars : 5,
                      onChange: function (rating, rateYoInstance) {
                          $("#rating").val(rating);
                      },
                      onInit: function (rating, rateYoInstance) {
                          $("#rating").val(rating);
                      }
                  });
                });

                $(document).on("click", ".submit-comment", function(e){
                    e.preventDefault();
                    // alert('clicked');
                    $(".comment-errors-msg").remove();
                    $(".comment-fields").css('border-color','#c8c8c8').css("color",'#b7b7b7');

                    var ele = $(this);

                    var data = {
                        id : "<?php echo $Playlist['id'] ?>",
                        comment : $(".comment-text").val(),
                        _token : "{{ csrf_token() }}",
                        rating : $("#rating").val(),
                        suggest_track : $("#suggest-track").val()
                    };
                    
                    $.ajax({
                        url: "<?php echo URL::to('comment/add-new'); ?>",
                        type: "post",
                        data : data,
                        success: function(data){
                            
                            $(".rate-comment-box").before(`
                                <div class="commentsbox">
                                    <div class="commentimages" style="background-image: url('<?php echo $user['profileImage']; ?>'"></div>
                                    <h4><?php echo $user['display_name']; ?></h4>
                                    <p>`+$(".comment-text").val()+`</p>
                                    <p class="time"> <img src="<?php echo URL::asset('images/time.png'); ?>"Just now</p>
                                </div>`);
                            $(".comment-text").val('');
                            $("#suggest-track").val('');
                            $(ele).after(getSuccessAlertBox('Comment added successfully.'));
                            setInterval(function(){
                                $(".success-msg").hide(1000);
                            }, 5000);
                            location.reload();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                           
                            var errors = XMLHttpRequest.responseJSON;
                            for(x in errors.errors){
                                $(".error-"+x).css("border-color","red").css('color','red').after('<p class="comment-errors-msg" style="color:red;"> '+x+' is required</p>');
                                console.log(".error-"+x);
                            }
                            // console.log(textStatus);
                            // console.log("errorThrown");
                            // console.log(errorThrown);
                            // alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }  
                    });
                });
          });

          $("#refresh_playlist").on("click", function () {
            // show main loader here

            $('#all_info_container').fadeOut();
            $('#fullpage_loader').fadeIn();
            //$("#all_info_container").html("<div class='loader'> <img class= 'center-block loader-img' src = '{{ URL::asset('/images/loading.gif') }}'/> </div>");
            $.ajax({
                type: "get",
                url: "{{ url('playlist/calculate/'.$Playlist['id'])}}",
                success: function (data) {

                       window.location = "{{URL::to('playlist/calculate/'.$Playlist['id'])}}"

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            })
        });

          function getSuccessAlertBox(msg){
              var success =    `
                          <div class="alert alert-success alert-dismissible success-msg" style="text-align: left;position: fixed;bottom: 20%;right: 5%;width: 30%;">
                              <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              `+msg+`
                          </div>`;

              return success;
          }
        </script>
    </body>
</html>