<div class="sidebar">
    <ul class="sidebar-lists">
        <li class="{{ Request::is('playlist/getWall') ? 'active' : '' }}">
            <a href='{{url('/playlist/getWall')}}'>Wall</a>
        </li>
        <li class="{{ Request::is('playlist/getAll') ? 'active' : '' }}">
            <a href='{{url('/playlist/getAll')}}'>My Library</a>
        </li>
        <li class="{{ Request::is('users/me') ? 'active' : '' }}">
            <a href='{{url('users/me')}}'>My Profile</a>
        </li>
        <li class="{{ Request::is('user/tagged') ? 'active' : '' }}">
            <a href='{{url('user/tagged')}}'>Tagged Playlists</a>
        </li>
    </ul>
</div>