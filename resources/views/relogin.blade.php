<!doctype html>
<html>
    <head>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>


        <script>

            function relogin()
            {
                location.replace('<?php echo URL::to('/auth/getCode') ?>');
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

        <button class='btn btn-primary' onclick='relogin()'>Login Again!</button>


    </body>
</html>
