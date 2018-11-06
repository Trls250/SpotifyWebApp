@foreach($Playlists as $playlist)
            <tr>
                <td>
                    <h6 class="spotify-image-content">
                        @if(isset($playlist->playlist_id))
                            <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->playlist_id); ?>">{{$playlist->title}}</a>
                        @else
                        <a href="<?php echo URL::to('/playlist/open-playlist/'.$playlist->id); ?>">{{$playlist->title}}</a>
                        @endif
                        </h6>
                </td>
                <td>
                            @if ( $playlist->popularity >= 90 )
                            <span> It's a Hit! </span>
                            @else
                            <span>{{ number_format($playlist->popularity,0) }}%</span>
                            @endif
                </td>
                <td>
                <span>{{ number_format($playlist->danceability,0)}}%</span>

                </td>
                <td>
                <span>{{ number_format($playlist->energy,0)}}%</span>
                </td>
                <td>
                <span>{{ number_format($playlist->valence,0)}}%</span>
                </td>
                <td>
                <span>{{ number_format($playlist->instrumentalness,0)}}%</span>
                </td>
                <td>
                <span>{{ number_format($playlist->liveness,0)}}%</span>                    
                </td>
                <td>
                <span>{{ number_format($playlist->loudness,0)}}%</span>
                </td>
                <td>
                <span>{{ number_format($playlist->speechiness,0)}}%</span>
                </td>
                <td>
                <span>{{ number_format($playlist->tempo,0)}}%</span>
                </td>
                <td>
                <span>{{ number_format($playlist->acousticness,0)}}%</span>
                </td>
            </tr>
@endforeach