@foreach($Playlists as $playlist)
<li>
    <div class="play-box">
        <div class="playlayer">

            @if (count($playlist['images'])>0)
                <div class="play-img" style="background-image: url('{{$playlist['images'][0]['url']}}');"></div>
            @else
                <div class="play-img"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});"></div>
            @endif
            <div class="follow">
            
                @if($playlist['db'] == false)
                    <button id = "add_btn_{{$playlist['id']}}" class="play-follow" onclick='addPlaylist("{{$playlist['id']}}")'>Add</button>
                @else
                    <button class="play-follow play-unfollow" onclick="window.location='{{url('playlist/open-playlist/'.$playlist['id'])}}'">Select</button>
                @endif
            <!-- <button class="play-follow play-unfollow">Select</button> -->
            </div>
        </div>
        <div class="play-content">
            <h4 class = "wrap-elipsis">{{$playlist['name']}}</h4>
            <p>{{$playlist['tracks']['total']}} Tracks</p>
        </div>

    </div>
    </div>
</li>

@endforeach


<script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>

<script>


    

</script>