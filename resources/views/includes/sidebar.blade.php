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
        <li class="{{ Request::is('people') ? 'active' : '' }}">
            <a href='{{url('people')}}'>People</a>
        </li>
        <li class="{{ Request::is('playlist/getTaggedWall') ? 'active' : '' }}">
            <a href='{{url('playlist/getTaggedWall')}}'>Tagged Playlists</a>
            <div class="notifaction">
                <span id = "tagged_span_count">{{session::get('Tagged')}}</span>
            </div>
        </li>

    </ul>
</div>

<script>
    
    getRecords();
    
    function getRecords() {
              $.ajax({
                  type: "get",
                  url: "{{ url('/deduct')}}",
                  success: function (data) {
                     
                     console.log(data);
                     $("#tagged_span_count").html(data);
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {

                  }
              });
      }
    
  </script>