<?php 
    
    $wall = "";
    $my_library = "";

    if(isset($get_all_page)){
        $my_library = "active";
    } 
?>
<div class="sidebar">
    <ul class="sidebar-lists">
        <li class="{{ $wall }}">
            <a href='{{url('/playlist/getWall')}}'>Wall</a>
        </li>
        <li class="{{ $my_library }}">
            <a href='{{url('/playlist/getAll')}}'>My Library</a>
        </li>
        <li>
            <a href="#">Playlists</a>
        </li>
    </ul>
</div>