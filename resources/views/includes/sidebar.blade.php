<div class="sidebar">
    <ul class="sidebar-lists">
        <li class="{{ Request::is('playlist/getWall') ? 'active' : '' }}">
            <a href='{{url('/playlist/getWall')}}'>Wall</a>
        </li>
        <li class="{{ Request::is('playlist/getAll') ? 'active' : '' }}">
            <a href='{{url('/playlist/getAll')}}'>My Library</a>
        </li>
    </ul>
</div>