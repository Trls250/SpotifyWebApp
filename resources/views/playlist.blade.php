<html>

<head>

<style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
</style>



</head>



<body>

        

        <iframe src='https://open.spotify.com/embed/user/{{$owner['id']}}/playlist/{{$id}}' width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

        <H1>Playlist Information</H1>

        <table>
                <tr>
                        <th>Name</th>
                        <td>{{$name}}</td>
                </tr>
                <tr>
                        <th>Description</th>
                        <td>{{$description}}</td>
                </tr>
                <tr>
                        <th>Playlist Creator</th>
                        <td>{{$owner['display_name']}}</td>
                </tr>
                <tr>
                        <th>Playlist ID</th>
                        <td>{{$owner['id']}}</td>
                </tr>
                <tr>
                        <th>Followers</th>
                        <td>{{$followers['total']}}</td>
                </tr>


        </table>



        <H1>Tracks Information</H1>

</body>



<script>

        $.ajax({
                url:''
        })

</script>


<html>