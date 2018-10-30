@foreach($Playlists as $playlist)
    <div class="row">
        @if($playlist->is_viewed == 0)
        <div class="post-row clearfix active-notifaction">
        @else
        <div class="post-row clearfix">
        @endif
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

