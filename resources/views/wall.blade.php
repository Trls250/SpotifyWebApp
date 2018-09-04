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



    <div class="container">
        @foreach ($playlists as $playlist)
            {{ $playlist->title }}
            <a class='btn btn-default' href='<?php echo url('playlist/get/'.$playlist->id) ?>'>Select</a>
         </br>
        @endforeach
    </div>

    {{ $playlists->links() }}



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


