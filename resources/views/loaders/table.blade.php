
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
            @for($j=0; $j<count($Response['ArtistGenres'][$i]['genres']) && $j<3; $j++)

            @if(count($Response['ArtistGenres'][$i]['genres']) == 0)
                {{ '---' }}
            @endif

            {{ $Response['ArtistGenres'][$i]['genres'][$j] }}

            @if($j<count($Response['ArtistGenres'][$i]['genres']) -1)
                {{','}}
            @endif
            @endfor
        </td>

        <td data-header="Popularity">{{$Response['ResponseData']['items'][$i]['track']['popularity']}}</td>
        <td data-header="Valence">{{$Response['TrackFeatures'][$i]['valence']}}</td>
        <td data-header="Danceability">{{$Response['TrackFeatures'][$i]['danceability']}}</td>
        <td data-header="Energy">{{$Response['TrackFeatures'][$i]['energy']}}</td>
        <td data-header="Instrumentalness ">{{$Response['TrackFeatures'][$i]['instrumentalness']}}</td>
        <td data-header="Liveness">{{$Response['TrackFeatures'][$i]['liveness']}}</td>
        <td data-header="Loudness">{{$Response['TrackFeatures'][$i]['loudness']}}</td>
        <td data-header="Speechiness">{{$Response['TrackFeatures'][$i]['speechiness']}}</td>
        <td data-header="Tempo">{{$Response['TrackFeatures'][$i]['tempo']}}</td>
    </tr>
    @endfor
