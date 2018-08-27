<html>

<head>

    <script>
  
        function playlistDetails(id)
        {
            location.replace('<?php echo url('/') ?>/playlist/get/25/1?id='+id);
        }

    </script>

</head>

<body>

    <a href='<?php echo url('/') ?>/authCode' class="btn btn-primary" id="auth" >Verify Spotify!</a>
  
    {!! Form::open(['url' => '/playlist/add', 'method' => 'get']) !!}
        {{Form::label('title', 'playlist_id')}}
        {{Form::text('url', '', ['class' => 'form-control', 'placeholder' => 'Your id'])}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    
    <a href='<?php echo url('/') ?>/playlist/getAll' class="btn btn-primary"  >Your Playlists</a>


    @isset($href)
    
        @foreach ($items as $item)
            <!-- <pre>{{print_r($item)}}</pre> -->
            <p onclick='playlistDetails("{{$item['id']}}")'>{{$item['name']}}</p>
            <p>Tracks: {{$item['tracks']['total']}}</p>
        @endforeach

    @endisset
</body>

</html>


