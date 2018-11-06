@foreach($Playlists as $playlist)
    <div class="row playlist-filter">
        <div class="post-row clearfix">

        @if(isset($playlist->playlist_id))
            @if(file_exists('public/playlists/'.$playlist->playlist_id.'.jpg'))
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist->playlist_id.'.jpg') }});">
                </div>
            @else
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                </div>
            @endif

            @include('includes.wall_record')
        @else
             @if(file_exists('public/playlists/'.$playlist->id.'.jpg'))
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist->id.'.jpg') }});">
                </div>
            @else
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                </div>
            @endif

            @include('includes.wall_record')

        @endif
        </div>
    </div>
@endforeach