@foreach($Users as $user)
<li>
    <div class="play-box user-play-box">
        <div class="playlayer">

            @if(file_exists('public/users/'.$user->id.'.jpg'))
                <a href="{{ url('users/get').'/'.$user->id}}"><div class="play-img" style="background-image: url({{ URL::asset('public/users/'. $user->id.'.jpg')}})"></div></a>
            @else
                <a href="{{ url('users/get').'/'.$user->id}}"><div class="play-img" style="background-image: url({{ URL::asset('public/images/default_user.png')}})"></div></a>
            @endif


            <div class="play-content">
                <h4 class = "wrap-elipsis"><a href="{{ url('users/get').'/'.$user->id}}">{{$user->name}}</a></h4>
            <p class="followers"><span>{{ $user->followers }}</span> Followers</p>
            <p class="followers"><span>{{ $user->PlaylistCount }}</span> Added Playlists</p>
                <div class="rating error-rating">
                    <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <?php if($i < (int)$user->AvgRating){ ?>
                        <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/filstar.png'); ?>">
                        <?php }else{ ?>
                        <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/empty-star.png'); ?>">
                        <?php } ?>
                    <?php } ?>
                <h6>Average Playlist Rating</h6>
                </div>
        </div>
        </div>
        

    </div>
    </div>
</li>
@endforeach


<script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>

<script>


    

</script>