@foreach($Playlists as $playlist)
                      <li class="playlist-filter" 
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
                      >
                    
                        <div class="play-box">
                            <div class="">
                                <a href="{{url('playlist/open-playlist/'.$playlist->id)}}">
                                @if(file_exists('public/playlists/'.$playlist["id"].'.jpg'))
                                  <div class="play-img"  style="background-image: url({{ URL::asset('public/playlists/'.$playlist['id'].'.jpg') }});">
                                  </div>
                                @else
                                    <div class="play-img"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
                                    </div>
                                @endif
                                </a>
                            </div>
                            <div class="play-content">
                                <h4><a href="{{url('playlist/open-playlist/'.$playlist->id)}}">{{$playlist->title}}</a></h4>
                                <p>{{$playlist->total_tracks}} Tracks</p>
                            </div>
                        
                        </div>
                      </li>
                    @endforeach
