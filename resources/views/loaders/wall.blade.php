@foreach($Playlists as $playlist)
    <div class="row">
        <div class="post-row clearfix">
            @if(file_exists('public/playlists/'.$playlist->id.'.jpg'))
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist->id.'.jpg') }});">
                </div>
            @else
                <div class="post-width post-image"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                </div>
            @endif

            <div class="contentwidth">
                <div class="postscontent">
                    <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->id); ?>"><h2>{{ $playlist->title }}</h2></a>
                    <!--<button class="follow-btn">Follow</button>-->
                </div>
                <p class="followers"><span>{{$playlist->followers}}</span> Followers</p>
                <div class="rating">

                    @for($i=0; $i<ceil($playlist->rating); $i++)
                        <img src= {{ URL::asset('public/images/filstar.png') }}>
                    @endfor
                    @for($i=0; $i<5 - ceil($playlist->rating); $i++)
                        <img src= {{ URL::asset('public/images/empty-star.png') }}>
                    @endfor


                    <span>({{$playlist->rating_count}} Rated it)</span>
                </div>
                <div class="popular-lists">
                    <ul>
                        <li>
                            Popularity<br/>
                            @if ( $playlist->popularity >= 90 )
                            <span> It's a Hit! </span>
                            @else
                            <span>{{ number_format($playlist->popularity,0) }}%</span>
                            @endif
                        </li>
                        <li>
                            Danceability<br/>
                            <span>{{ number_format($playlist->danceability,0)}}%</span>
                        </li>
                        <li>
                            Energy<br/>
                            <span>{{ number_format($playlist->energy,0)}}%</span>
                        </li>
                        <li>
                            Valence<br/>
                            <span>{{ number_format($playlist->valence,0)}}%</span>
                        </li>
                        <li>
                            Instrumentalness<br/>
                            <span>{{ number_format($playlist->instrumentalness,0)}}%</span>
                        </li>
                        <li>
                            Liveness<br/>
                            <span>{{ number_format($playlist->liveness,0)}}%</span>
                        </li>
                        <li>
                            Loudness<br/>
                            <span>{{ number_format($playlist->loudness,0)}}%</span>
                        </li>
                        <li>
                            Speechiness<br/>
                            <span>{{ number_format($playlist->speechiness,0)}}%</span>
                        </li>
                        <li>
                            BPM<br/>
                            <span>{{ number_format($playlist->tempo,0)}}%</span>
                        </li>
                        <li>
                            Acousticeness<br/>
                            <span>{{ number_format($playlist->acousticness,0)}}%</span>
                        </li>
                    </ul>
                </div>
                <div class="tags tags-cus-row">
                    <div class="tags-cus-col">
                        <p>Most Repeated Artist:</p>
                        <span>{{$playlist->repeated_artist}}</span>
                    </div>
                    <div class="tags-cus-col">
                        <p>Added By:</p>
                        @if(isset($playlist->added_by_name))
                            <span><a href="{{url('users/get?id=').$playlist->added_by}}">{{$playlist->added_by_name}}</a></span>
                        @else
                            <span><a href="{{url('users/get?id=').$playlist->added_by}}">{{$playlist->added_by}}</a></span>
                        @endif
                    </div>
                </div>
                <div class="taglists">
                <!--<div class="playimage" style="background-image: url('{{ URL::asset('public/images/profile.png') }}')"></div>-->
                    <div class="playname">
                        <p>Playlist By:</p>
                        @if(isset($playlist->creator_name))
                            <span>{{$playlist->creator_name}}</span>
                        @else
                            <span>{{$playlist->creator_id}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach