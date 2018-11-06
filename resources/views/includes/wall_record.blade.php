<div class="contentwidth">
                <div class="postscontent" >
                @if(!$FromTag)
                    <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->id); ?>"><h2>{{ $playlist->title }}</h2></a>
                @else
                    <a href="<?php echo URL::to('/playlist/open-tagged-playlist/'.$playlist->id); ?>"><h2>{{ $playlist->title }}</h2></a>

                @endif
                @if(isset($playlist->tagged_by_user_id))
                    @if($playlist->tagged_by_user_name != null && $playlist->tagged_by_user_name != '')
                        <h6 class="tag-titles"><span>Tagged By </span><a href="{{url('users/get').'/'.$playlist->tagged_by_user_id}}">{{$playlist->tagged_by_user_name}}</a></h6>
                    @else
                        <h6 class="tag-titles"><span>Tagged By </span><a href="{{url('users/get').'/'.$playlist->tagged_by_user_id}}">{{$playlist->tagged_by_user_id}}</a></h6>
                    @endif
                @endif
      
                    <!--<button class="follow-btn">Follow</button>-->
                </div>
                <p class="followers"><span>{{$playlist->total_tracks}}</span> Tracks <span> - </span>
                <span>{{$playlist->followers}}</span> Followers</p>
                <!-- <p>{{!$playlist->description}}</p> -->
                <p><?php echo $playlist->description ?></p>
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
                        <p>Top Artists:</p>
                        <span>{{$playlist->repeated_artist}}</span>
                    </div>
                    <div class="tags-cus-col">
                        <p>Added By:</p>
                        @if(isset($playlist->added_by_name))
                            <span><a href="{{url('users/get').'/'.$playlist->added_by}}">{{$playlist->added_by_name}}</a></span>
                        @else
                            <span><a href="{{url('users/get').'/'.$playlist->added_by}}">{{$playlist->added_by}}</a></span>
                        @endif
                    </div>
                </div>
                <div class="taglists">
                <!--<div class="playimage" style="background-image: url('{{ URL::asset('public/images/profile.png') }}')"></div>-->
                    <div class="playname">
                        <p>Top Genres:</p>
                        <span>{{$playlist->repeated_genre}}</span>
                    </div>
                    <div class="playname">
                        <p>Playlist By:</p>
                        @if(isset($playlist->creator_name))
                            <span><a href="{{url('users/get').'/'.$playlist->creator_id}}">{{$playlist->creator_name}}</a></span>
                        @else
                            <span><a href="{{url('users/get').'/'.$playlist->creator_id}}">{{$playlist->creator_id}}</a></span>
                        @endif
                    </div>
                </div>
            </div>