@foreach($Users as $user)
            <tr>
                <td>
                    <div class="spotify-image-row">
                    @if(file_exists('public/users/'.$user->id.'.jpg'))
                        <div class="spotify-image-profile" style="background-image: url({{ URL::asset('public/users/'. $user->id.'.jpg')}})">
                    @else
                        <div class="spotify-image-profile" style="background-image: url({{ URL::asset('public/images/default_user.png')}})">
                    @endif
                        </div>
                        <div class="spotify-image-content">
                            <h6>
                            <a href="{{url('users/get').'/'.$user->id}}">{{ $user->name }}</a>
                            </h6>
                        </div>
                    </div>
                </td>
                <td>
                {{ $user->followers }}
                </td>
                <td>
                {{ $user->PlaylistCount }} Playlists
                </td>
                <td>
                
                    <div class="avg-playlist-rating">
                        <div class="rating-column">
                        <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <?php if($i < (int)$user->AvgRating){ ?>
                        <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/filstar.png'); ?>">
                        <?php }else{ ?>
                        <img class="rate_input" id = {{$i}} src="<?php echo URL::asset('public/images/empty-star.png'); ?>">
                        <?php } ?>
                        <?php } ?>
                        </div>
                        <div class="rating-column">
                            <a href="{{url('playlist/getUserWall'.'/'.$user->name.'/'.$user->id)}}" class="see-play-list">See Playlists <img src="http://localhost/spotify/public/images/go-arrow.png"></a>
                        </div>
                    </div>
                </td>
            </tr>

@endforeach
 <!-- <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>
                    USERS
                </th>
                <th>
                    POPULARITY
                </th>
                <th>
                    DANCEABILITY
                </th>
                <th>
                    ENERGY
                </th>
                <th>
                    VALENCE
                </th>
                <th>
                    INSTRUMENTALNESS
                </th>
                <th>
                    LIVENESS
                </th>
                <th>
                    LOUDNESS
                </th>
                <th>
                    Speechiness
                </th>
                <th>
                    BPM
                </th>
                <th>
                    ACOUSTICENESS
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h6 class="spotify-image-content">
                        Brent Hudson
                    </h6>
                </td>
                <td>
                   31%
                </td>
                <td>
                    59%
                </td>
                <td>
                    58%
                </td>
                <td>
                    52%
                </td>
                <td>
                    31%
                </td>
                <td>
                    18%
                </td>
                <td>
                    10%
                </td>
                <td>
                    8%
                </td>
                <td>
                    58%
                </td>
                <td>
                    29%
                </td>
            </tr>
            <tr>
                <td>
                    <h6 class="spotify-image-content">
                        Brent Hudson
                    </h6>
                </td>
                <td>
                   31%
                </td>
                <td>
                    59%
                </td>
                <td>
                    58%
                </td>
                <td>
                    52%
                </td>
                <td>
                    31%
                </td>
                <td>
                    18%
                </td>
                <td>
                    10%
                </td>
                <td>
                    8%
                </td>
                <td>
                    58%
                </td>
                <td>
                    29%
                </td>
            </tr>
            <tr>
                <td>
                    <h6 class="spotify-image-content">
                        Brent Hudson
                    </h6>
                </td>
                <td>
                   31%
                </td>
                <td>
                    59%
                </td>
                <td>
                    58%
                </td>
                <td>
                    52%
                </td>
                <td>
                    31%
                </td>
                <td>
                    18%
                </td>
                <td>
                    10%
                </td>
                <td>
                    8%
                </td>
                <td>
                    58%
                </td>
                <td>
                    29%
                </td>
            </tr>
        </tbody>
    </table>
</div>
@foreach($Users as $user)
<!-- <li>
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
</li> -->
@endforeach


<script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>

<script>


    

</script> -->