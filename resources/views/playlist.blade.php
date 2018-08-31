<!doctype html>
<html>
    <head>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>


        <script>

            function playlistDetails(id)
            {

                location.replace('<?php echo url('/') ?>/playlist/details/'+id+'?items=25&page=1');
            }
            function refresh(id)
            {
                location.replace('<?php echo url('/') ?>/playlist/get/'+id);

            }

        </script>


    </head>



    <body>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>


        @else

        <!-- <button class='btn btn-primary' onclick='refresh("{{$Playlist['id']}}")'>refresh</button> -->
        <button class='btn btn-primary' onclick='playlistDetails("{{$Playlist['id']}}")'>details</button>


        <iframe src="https://open.spotify.com/embed/user/{{$Playlist['creator_id']}}/playlist/{{$Playlist['id']}}" width="600" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>



        {!! Form::open(['url' => '/comment/add/'.$Playlist['id'], 'method' => 'POST']) !!}
        {{Form::label('Your Comment', 'comment')}}
        {{Form::textarea('comment', '', ['class' => 'ckeditor', 'placeholder' => 'Enter your comment...'])}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}

        @endif

    </body>
</html>
