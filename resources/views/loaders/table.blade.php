

    @for($i=0; $i<count($Response['ResponseData']['items']); $i++)
    <tr>
        <td data-header="#">{{ $Offset + $i}}</td>
        <td data-header="Tracks">{{ $Response['ResponseData']['items'][$i]['track']['name'] }}</td>

        <td data-header="Artists">
        @for($j=0; $j<count($Response['ResponseData']['items'][$i]['track']['artists']); $j++)

            @if(count($Response['ResponseData']['items'][$i]['track']['artists']) == 0)
                {{ 'N/A' }}
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
                {{ 'N/A' }}
            @endif

            {{ $Response['ArtistGenres'][$i]['genres'][$j] }}

            @if($j<count($Response['ArtistGenres'][$i]['genres']) -1)
                {{','}}
            @endif
            @endfor
        </td>

        <td data-header="Year">2005</td>
        <td data-header="Popularity">0.1</td>
        <td data-header="Rock">0.3</td>
        <td data-header="Danceability">0.3</td>
        <td data-header="Energy">0.9</td>
        <td data-header="Instrumentalness ">0.8</td>
        <td data-header="Livenss">0.1</td>
        <td data-header="Loudness">0.3</td>
        <td data-header="Speechiness">0.9</td>
        <td data-header="Temp">0.5</td>
    </tr>
    @endfor
