
@if($Status == "200")
@foreach($Playlists as $playlist)
    <div class="row">
        <div class="post-row clearfix">
            @if(file_exists('playlists/'.$playlist->id.'.jpg'))
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('playlists/'.$playlist->id.'.jpg') }});">
                </div>
            @else
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('images/default_playlist.jpg') }});">
                </div>
            @endif

            <div class="contentwidth">
                <div class="postscontent">
                    <h2>{{ $playlist->title }}</h2>
                    <!--<button class="follow-btn">Follow</button>-->
                </div>
                <p class="followers"><span>{{$playlist->followers}}</span> Followers</p>
                <div class="rating">

                    @for($i=0; $i<ceil($playlist->rating); $i++)
                        <img src= {{ URL::asset('images/filstar.png') }}>
                    @endfor
                    @for($i=0; $i<5 - ceil($playlist->rating); $i++)
                        <img src= {{ URL::asset('images/empty-star.png') }}>
                    @endfor


                    <span>({{$playlist->rating_count}} Rated it)</span>
                </div>
                <div class="popular-lists">
                    <ul>
                        <li>
                            Popularity<br/>
                            <span>{{ $playlist->popularity }}</span>
                        </li>
                        <li>
                            Danceability<br/>
                            <span>{{ $playlist->danceability }}</span>
                        </li>
                        <li>
                            Energy<br/>
                            <span>{{ $playlist->energy}}</span>
                        </li>
                        <li>
                            Valence<br/>
                            <span>{{ $playlist->valence}}</span>
                        </li>
                    </ul>
                </div>
                <div class="tags">
                    <p>Most Repeated Artist:</p>
                    <span>{{$playlist->repeated_artist}}</span>
                </div>
                <div class="taglists">
                <!--<div class="playimage" style="background-image: url('{{ URL::asset('images/profile.png') }}')"></div>-->
                    <div class="playname">
                        <p>Playlist By:</p>
                        <span>{{$playlist->creator_name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
    @endif