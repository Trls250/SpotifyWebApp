@include('includes/header')
<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

        <section class="main-wrapper">
          <div class="container-fluid">
            
            @include('includes/sidebar')
            
            <div class="content-container">
              <div class="open-play">
                <div class="open-play-column1">
                  @if(file_exists('public/playlists/'.$Playlist['id'].'.jpg'))
                      <div class="playimages" style="background-image: url('<?php echo URL::asset('public/playlists/'.$Playlist['id'].'.jpg'); ?>')"></div>
                  @else
                        <div class="playimages" style="background-image: url('<?php echo URL::asset('public/images/default_playlist.jpg'); ?>')"></div>
                  @endif
                  <div class="headingrow">
                    <h3><?php echo $Playlist['title'] ?></h3>
                    <!-- <p ><img src="<?php echo URL::asset('public/images/refresh-icon.png'); ?>"/>  Refresh Playlist</p> -->
                  </div>
                  <!-- <p class="years">2014</p> -->
                  <div class="rating">
                    <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <?php if($i < (int)$Playlist['rating']){ ?>
                            <img src="<?php echo URL::asset('public/images/filstar.png'); ?>">
                        <?php }else{ ?>
                            <img src="<?php echo URL::asset('public/images/empty-star.png'); ?>">
                        <?php } ?>
                    <?php } ?>
                    <span>(<?php echo $Playlist['rating_count'] ?> Rate it)</span>
                  </div>
                  <div class="rewviewscontent">
                  <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor.</p> -->
                  </div>
                  <div class="follow-lists">
                    <!-- <button class="play-follow recalcalc">ReCalculate</button> -->
                    <a href="{{ URL::to('playlist/details/'.$Playlist['id']) }}" class="play-follow playlists recalcalc"><img src="<?php echo URL::asset('public/images/play-arrow.png'); ?>"/> Playlist Info</a>
                  </div>
                </div>
                <div class="open-play-column2 comment-box">
                  <div class="iframe">
                    <!-- <img src="<?php echo URL::asset('public/images/iframe.png'); ?>" style="width: 100%;" /> -->
                    <iframe src="https://open.spotify.com/embed/user/{{$Playlist['creator_id']}}/playlist/{{$Playlist['id']}}" width="600" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    <h3>{{$tots_comments}} Comments</h3>
                  </div>
                    <div id="comments">

                    </div>
                    <button class="play-btn dektop-play-btn loader" onclick="getComments()" id ="more_comments" >
                        Load More
                    </button>

                  <div class="ratecomment rate-comment-box">
                    <h4>Rate & Comment</h4>
                    <div class="rating error-rating">
                        <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <?php if($i < (int)$user_rating['rating']){ ?>
                        <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/filstar.png'); ?>">
                        <?php }else{ ?>
                        <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/empty-star.png'); ?>">
                        <?php } ?>
                        <?php } ?>
                    </div>

                    <div class="commentmsg">
                      <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="rating" value="" >
                        <div class="form-group">
                        <textarea class="msgbox comment-text error-comment comment-fields" placeholder="Write comment"></textarea>
                        </div>
                        <div class="form-group">
                          <input id="suggest-track" type="text" class="suggesttrack" name="suggest-track" placeholder="Suggest Track (paste Spotify track URI here) ">
                        </div>

                        <button class="btn btn-submit submit-comment">Submit <img src="<?php echo URL::asset('public/images/arrow.png'); ?>" /></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <script src="{{ URL::asset('public/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/js/bootstrap.js') }} "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <script type="text/javascript">


            var comments_start = 0;
            var comments_limit = 10;
            var total_comments = parseInt({{$tots_comments}});

          $(document).ready(function () {

                if(comments_limit>=total_comments){
                    $("#more_comments").hide();
                }

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


                getComments();

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

                $(".rate_input").on('click', function(e) {

                    var ele = $(this);
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var current = parseInt(e.target.id);
                    for(let i = 0; i<5; i++){
                        if(i<=current){
                            $("#"+ i).attr('src',"<?php echo URL::asset('public/images/filstar.png'); ?>");
                        }
                        else {
                            $("#"+ i).attr('src',"<?php echo URL::asset('public/images/empty-star.png'); ?>");
                        }
                    }

                    $.ajax({

                        url: "{{url('rate/insert')}}" + "/" + "{{$Playlist['id']}}",
                        type: "POST",
                        data: {_token: CSRF_TOKEN, rate: parseInt(e.target.id) + 1},
                        dataType: 'JSON',

                        success: function (data) {



                            if(data['Success']) {
                                $(ele).after(getSuccessAlertBox("Your rating has been saved :)"));
                                //console.log(data);
                            }
                            else
                                $(ele).after(getSuccessAlertBox("There was an error saving your rating :("));

                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {

                            var errors = XMLHttpRequest.responseJSON;
                            for (x in errors.errors) {
                                $(".error-" + x).after('<p class="comment-errors-msg" style="color:red;"> ' + x + ' is required</p>');
                                console.log(".error-" + x);
                            }
                            // console.log(textStatus);
                            // console.log("errorThrown");
                            // console.log(errorThrown);
                            // alert("Status: " + textStatus); alert("Error: " + errorThrown);


                            $(ele).after(getSuccessAlertBox("There was an error saving your rating :("));
                        }

                    });

                });

                $(document).on("click", ".submit-comment", function(e){
                    e.preventDefault();
                    // alert('clicked');
                    $(".comment-errors-msg").remove();
                    $(".comment-fields").css('border-color','#c8c8c8').css("color",'#b7b7b7');
                    var temp = $("#suggest-track").val();
                    temp = temp.split(":");
                    temp = temp[temp.length - 1];
                    var ele = $(this);

                    var data = {
                        id : "<?php echo $Playlist['id'] ?>",
                        comment : $(".comment-text").val(),
                        _token : "{{ csrf_token() }}",
                        suggest_track : $("#suggest-track").val()
                    };

                    $.ajax({
                        url: "<?php echo URL::to('comment/add-new'); ?>",
                        type: "post",
                        data : data,
                        success: function(data){
                            var html = `
                                <div class="commentsbox">
                                    @if(file_exists('public/users/'.$user['id'].'.jpg'))
                                    <div class="commentimages" style="background-image: url({{ URL::asset('public/users/'.$user['id'].'.jpg') }})"></div>
                                     @else
                                    <div class="commentimages" style="background-image: url({{ URL::asset('public/users/default.jpg') }})"></div>
                                    @endif
                                            @if(session::get('UserInfo')['id'] == $user['id'])
                                    <h4>Me</h4>
                                    @else
                                    <h4><?php echo $user['display_name']; ?></h4>
                                        @endif
                                    <p>`+$(".comment-text").val()+`</p>`;

                                    if(temp.length > 10){
                                        html += `<iframe src='https://embed.spotify.com/?uri=spotify:track:`+temp+`' height="80px" frameborder='0' allowtransparency='true'></iframe>`;
                                    }

                                    html += `<p class="time"> <img src="<?php echo URL::asset('public/images/time.png'); ?>"Just now</p>
                                </div>`;
                            $(".rate-comment-box").before(html);
                            $(".comment-text").val('');
                            $("#suggest-track").val('');
                            $(ele).after(getSuccessAlertBox('Comment added successfully.'));
                            setInterval(function(){
                                $(".success-msg").hide(1000);
                            }, 5000);
//                            location.reload();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                            var errors = XMLHttpRequest.responseJSON;
                            for(x in errors.errors){
                                $(".error-"+x).after('<p class="comment-errors-msg" style="color:red;"> '+x+' is required</p>');
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


            function getComments(){

                $.ajax({
                    type: "get",
                    url: "{{ url('playlist/comments/'.$Playlist['id'].'?start=')}}" + comments_start +"&limit=" + comments_limit,
                    success: function (data) {

                        $("#comments").append(data);

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown, data) {
                        console.log("Status: " + textStatus);
                        console.log(data);
                    }
                });

                comments_start += comments_limit;
                if(comments_start>=total_comments){
                    $("#more_comments").hide();
                }
            }


            $("#refresh_playlist").on("click", function () {
            // show main loader here

            $('#all_info_container').fadeOut();
            $('#fullpage_loader').fadeIn();
            //$("#all_info_container").html("<div class='loader'> <img class= 'center-block loader-img' src = '{{ URL::asset('public//images/loading.gif') }}'/> </div>");
            $.ajax({
                type: "get",
                url: "{{ url('playlist/calculate/'.$Playlist['id'])}}",
                success: function (data) {

                       window.location = "{{URL::to('playlist/calculate/'.$Playlist['id'])}}"

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                   console.log("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            })
        });


            $(".delete_button_comment").on('click', function (e) {

                var ele = $(this);
               $.ajax({

                   type: "delete",
                   url: "{{url('comment/delete')}}" + "/" + e.target.id,
                   success: function (data) {

                       if(data['Success']) {
                           $(ele).hide();
                           $(ele).after(getSuccessAlertBox("Your comment was deleted :)"));
                           //console.log(data);
                       }
                       else
                           $(ele).after(getSuccessAlertBox("There was an error deleting your comment :("));

                   },
                   error: function (XMLHttpRequest, textStatus, errorThrown) {

                       var errors = XMLHttpRequest.responseJSON;
                       for (x in errors.errors) {
                           $(".error-" + x).after('<p class="comment-errors-msg" style="color:red;"> ' + x + ' is required</p>');
                           console.log(".error-" + x);
                       }
                       // console.log(textStatus);
                       // console.log("errorThrown");
                       // console.log(errorThrown);
                       // alert("Status: " + textStatus); alert("Error: " + errorThrown);


                       $(ele).after(getSuccessAlertBox("There was an error deleting your comment :("));
                   }

               });

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