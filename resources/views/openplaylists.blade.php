@include('includes/header')
        <section class="main-wrapper">
          <div class="container-fluid">
            <div class="sidebar">
              <ul class="sidebar-lists">
                <li>
                  <a href="#">Wall</a>
                </li>
                <li class="active">
                  <a href="#">Playlists</a>
                </li>
                <li>
                  <a href="#">My Playlists</a>
                </li> 
              </ul>
            </div>
            <div class="content-container">
              <div class="open-play">
                <div class="open-play-column1">
                  <div class="playimages" style="background-image: url('<?php echo URL::asset('images/open-.png'); ?>')"></div>
                  <div class="headingrow">
                    <h3><?php echo $Playlist['title'] ?></h3>
                    <p><img src="<?php echo URL::asset('images/refresh-icon.png'); ?>"/>  Refresh Playlist</p>
                  </div>
                  <p class="years">2014</p>
                  <div class="rating">
                    <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <?php if($i < (int)$Playlist['rating']){ ?>
                            <img src="<?php echo URL::asset('images/filstar.png'); ?>">
                        <?php }else{ ?>
                            <img src="<?php echo URL::asset('images/empty-star.png'); ?>">
                        <?php } ?>
                    <?php } ?>
                    <span>(230 Rate it)</span>
                  </div>
                  <div class="rewviewscontent">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor.</p>
                  </div>
                  <div class="follow-lists">
                    <button class="play-follow recalcalc">ReCalculate</button>
                    <button class="play-follow playlists recalcalc"><img src="<?php echo URL::asset('images/play-arrow.png'); ?>"/> Playlist Info</button>
                  </div>
                </div>
                <div class="open-play-column2">
                  <div class="iframe">
                    <img src="<?php echo URL::asset('images/iframe.png'); ?>" style="width: 100%;" />
                    <h3><?php echo count($comments); ?> Comments</h3>
                  </div>
                  <?php foreach($comments as $comment){ ?>
                      <div class="commentsbox">
                          <div class="commentimages" style="background-image: url('<?php echo $comment['userProfileImage']; ?>'"></div>
                          <h4><?php echo $comment['userName']; ?></h4>
                          <p><?php echo $comment['text']; ?></p>
                          <p class="time"> <img src="<?php echo URL::asset('images/time.png'); ?>"><?php echo $comment['time']; ?></p>
                      </div>
                  <?php } ?>
                  <div class="ratecomment">
                    <h4>Rate & comment</h4>
                    <div class="rating rateYo">
                     <!--  <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/filstar.png'); ?>"></a>
                      <a href=""><img src="<?php echo URL::asset('images/empty-star.png'); ?>"></a> -->
                      <span>Like it</span>
                    </div>
                    <input type="hidden" id="rating" value="" >
                    <div class="commentmsg">
                      <form>
                        <div class="form-group">
                        <textarea class="msgbox comment-text" placeholder="Write comment"></textarea>
                        </div>
                        <div class="form-group">
                          <input type="text" class="suggesttrack" name="" placeholder="Suggest Track (paste Spotify track ID here) ">
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
                      rating: 2,
                      fullStar: true,
                      starWidth: "25px",
                      ratedFill: "#ffef0f",
                      numStars : 5
                  });
                });

                $(document).on("click", ".submit-comment", function(e){
                    e.preventDefault();
                    // alert('clicked');
                    var data = {
                        id : "<?php echo $Playlist['id'] ?>",
                        comment : $(".comment-text").val(),
                        _token : "{{ csrf_token() }}",
                        rating : $("#rating").val()
                    };
                    $.ajax({
                        url: "<?php echo URL::to('/comment/add/' . $Playlist["id"]); ?>",
                        type: "post",
                        data : data,
                        success: function(data){
                            console.log(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            console.log("textStatus");
                            console.log(textStatus);
                            console.log("errorThrown");
                            console.log(errorThrown);
                            // alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }  
                    });
                });
          });
        </script>
    </body>
</html>