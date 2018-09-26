@foreach($Playlists as $playlist)
<li>
    <div class="play-box">
        <div class="playlayer">

            @if (count($playlist['images'])>0)
                <div class="play-img" style="background-image: url('{{$playlist['images'][0]['url']}}');"></div>
            @else
                <div class="play-img"  style="background-image: url({{ URL::asset('public/images/default_playlist.jpg') }});">
            @endif

            <div class="follow">
                @if($playlist['db'] == false)
                    {{--<button class="play-follow" onclick='addPlaylist("{{$playlist['id']}}")'>Add</button>--}}
                @else
                    <button class="play-follow play-unfollow" onclick="window.location='{{url('playlist/open-playlist/'.$playlist['id'])}}'">Select</button>
                @endif
            <!-- <button class="play-follow play-unfollow">Select</button> -->
            </div>
        </div>
        <div class="play-content">
            <h4>{{$playlist['name']}}</h4>
            <p>{{$playlist['tracks']['total']}} Tracks</p>
        </div>

    </div>
    </div>
</li>
@endforeach


<script src= "{{ URL::asset('public/js/jquery.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap.js') }}"></script>

<script>


    function addPlaylist(id){
        $('#playlist_records').fadeOut();
        $(".msg").hide();
        $("#main_loader").fadeIn();
        $("#title_to_replace").replaceWith( "<h3 class='title'>Loading playlist.....</html>");
        this.add(id);
    }


    function add(id) {

        $('#main_loader').fadeIn();
                        $.ajax({
                            type: "get",
                            url: "{{url('playlist/insertSimple/')}}" + '/' + id,
                            success: function (data) {

                                if (data['Success'] == true) {
                                    $("#title_to_replace").replaceWith( "<h3 class='title'>Almost Done.....</html>");
                                    window.location = ('{{url('playlist/open-playlist/')}}' + '/' + data['id']);
                                    $(".msg").fadeIn();
                                    $("#main_loader").fadeOut();
                                }
                                else {

                                    console.log(data);
                                    $(".msg").fadeIn();
                                    $("#main_loader").fadeOut();
                                    $('#playlist_records').fadeIn();
                                    $("#title_to_replace").replaceWith( "<h3 class='title'>There was an error adding last playlist to our system.....try again :(</thml>");
                                }
                            },

                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("Status: " + textStatus);
                                $('#main_loader2').fadeOut();
                                $('#playlist_records').fadeIn();
                                $("#title_to_replace").replaceWith("<h3 class='title'> There was an error adding last playlist to our system.....try again :(</h3>");

                            },
                        });



    }

</script>