
    @for($i=0; $i<count($Response['ResponseData']['items']); $i++)
    <tr>
        <td data-header="#">{{ $Offset + $i + 1}}</td>
        <td data-header="Tracks">{{ $Response['ResponseData']['items'][$i]['track']['name'] }}</td>

        <td data-header="Artists">
        @for($j=0; $j<count($Response['ResponseData']['items'][$i]['track']['artists']); $j++)

            @if(count($Response['ResponseData']['items'][$i]['track']['artists']) == 0)
                {{ '---' }}
            @endif

            {{ $Response['ResponseData']['items'][$i]['track']['artists'][$j]['name'] }}

            @if($j<count($Response['ResponseData']['items'][$i]['track']['artists']) -1)
                {{ ',' }}
            @endif

        @endfor
        </td>

        <td data-header="Genre">
            @if(isset($Response['ArtistGenres'][$i]['genres']))
            @for($j=0; $j<count($Response['ArtistGenres'][$i]['genres']) && $j<3; $j++)

            @if(count($Response['ArtistGenres'][$i]['genres']) == 0)
                {{ '---' }}
            @endif

            {{ $Response['ArtistGenres'][$i]['genres'][$j] }}

            @if($j<count($Response['ArtistGenres'][$i]['genres']) -1)
                {{','}}
            @endif
            @endfor
            @else
            {{ '--- '}}
            @endif
        </td>

        @if(isset($Response['ResponseData']['items'][$i]['track']['popularity']))
        <td data-header="Popularity">{{$Response['ResponseData']['items'][$i]['track']['popularity']}}</td>
        @else
        <td data-header="Popularity">---</td>
        @endif

        @if(isset($Response['TrackFeatures'][$i]['valence']))
        <td data-header="Valence">{{$Response['TrackFeatures'][$i]['valence']}}</td>
        @else
        <td data-header="Valence">---</td>
        @endif



        @if(isset($Response['TrackFeatures'][$i]['danceability']))
        <td data-header="danceability">{{$Response['TrackFeatures'][$i]['danceability']}}</td>
        @else
        <td data-header="danceability">---</td>
        @endif


         @if(isset($Response['TrackFeatures'][$i]['energy']))
        <td data-header="energy">{{$Response['TrackFeatures'][$i]['energy']}}</td>
        @else
        <td data-header="energy">---</td>
        @endif


         @if(isset($Response['TrackFeatures'][$i]['instrumentalness']))
        <td data-header="instrumentalness">{{$Response['TrackFeatures'][$i]['instrumentalness']}}</td>
        @else
        <td data-header="instrumentalness">---</td>
        @endif

        @if(isset($Response['TrackFeatures'][$i]['liveness']))
        <td data-header="liveness">{{$Response['TrackFeatures'][$i]['liveness']}}</td>
        @else
        <td data-header="liveness">---</td>
        @endif

         @if(isset($Response['TrackFeatures'][$i]['loudness']))
        <td data-header="loudness">{{$Response['TrackFeatures'][$i]['loudness']}}</td>
        @else
        <td data-header="loudness">---</td>
        @endif

        @if(isset($Response['TrackFeatures'][$i]['speechiness']))
        <td data-header="Speechiness">{{$Response['TrackFeatures'][$i]['speechiness']}}</td>
        @else
        <td data-header="Speechiness">---</td>
        @endif


        @if(isset($Response['TrackFeatures'][$i]['tempo']))
        <td data-header="BPM">{{$Response['TrackFeatures'][$i]['tempo']}}</td>
        @else
        <td data-header="BPM">---</td>
        @endif

        @if(isset($Response['TrackFeatures'][$i]['acousticness']))
        <td data-header="Acousticeness">{{($Response['TrackFeatures'][$i]['acousticness'])}}</td>
        @else
        <td data-header="acousticness">---</td>
        @endif

        @if(isset($Response['TrackFeatures'][$i]['duration_ms']))
        <td data-header="Length">{{($Response['TrackFeatures'][$i]['duration_ms'])/1000}}</td>
        @else
        <td data-header="Length">---</td>
        @endif


        

    </tr>
    @endfor
