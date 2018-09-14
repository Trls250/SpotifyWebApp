<html>

<head>

    <script>

        function playlistDetails(id)
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
    @endif

    <a href='<?php echo url('auth/getCode') ?>' class="btn btn-primary" id="auth" >Verify Spotify!</a>

    {!! Form::open(['url' => '/playlist/add', 'method' => 'get']) !!}
        {{Form::label('title', 'playlist_id')}}
        {{Form::text('url', '', ['class' => 'form-control', 'placeholder' => 'Your id'])}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

    <a href='<?php echo url('/') ?>/playlist/getAll' class="btn btn-primary"  >Your Playlists</a>


    @isset($href)

        @foreach ($items as $item)
            <p id='name'>{{$item['name']}}</p>

            @if ($item['db'] == false)
                <a class='btn btn-default' href='<?php echo url('playlist/insert/'.$item['id']) ?>'>Add!</a>
            @else
                <a class='btn btn-default' href='<?php echo url('playlist/get/'.$item['id']) ?>'>Select</a>
            @endif

            <p>Tracks: {{$item['tracks']['total']}}</p>
        @endforeach

    @endisset
</body>

</html>


