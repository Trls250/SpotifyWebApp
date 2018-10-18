@foreach($Playlists as $playlist)
    <div class="row playlist-filter" 
                          data-instrumentalness="{{ $playlist['instrumentalness'] }}" 
                          data-liveness="{{ $playlist['liveness'] }}" 
                          data-loudness="{{ $playlist['loudness'] }}" 
                          data-speechiness="{{ $playlist['speechiness'] }}" 
                          data-tempo="{{ $playlist['tempo'] }}" 
                          data-popularity="{{ $playlist['popularity'] }}" 
                          data-danceability="{{ $playlist['danceability'] }}" 
                          data-energy="{{ $playlist['energy'] }}" 
                          data-valence="{{ $playlist['valence'] }}"
                          data-acousticness="{{$playlist['acousticness']}}"
                          data-rating="{{$playlist['rating']}}">
        <div class="post-row clearfix">
            @if(file_exists('public/playlists/'.$playlist->id.'.jpg'))
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist->id.'.jpg') }});">
                </div>
            @else
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                </div>
            @endif

            @include('includes.wall_record')

        </div>
    </div>
@endforeach