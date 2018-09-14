@foreach($Playlists as $playlist)
<li>
    <div class="play-box">
        <div class="playlayer">

            @if (count($playlist['images'])>0)
                <div class="play-img" style="background-image: url('{{$playlist['images'][0]['url']}}');"></div>
            @else
                <div class="play-img"  style="background-image: url({{ URL::asset('images/default_playlist.jpg') }});">
            @endif

            <div class="follow">
                @if($playlist['db'] == false)
                    <button class="play-follow">Add</button>
                @else
                    <button class="play-follow play-unfollow">Select</button>
                @endif
            <!-- <button class="play-follow play-unfollow">Select</button> -->
            </div>
        </div>
        <div class="play-content">
            <h4>{{$playlist['name']}}</h4>
            <p>{{$playlist['tracks']['total']}} Tracks</p>
        </div>

    </div>
    </div>
</li>
@endforeach