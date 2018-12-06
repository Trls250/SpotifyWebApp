<div class="sidebar">
    <ul class="sidebar-lists">
        
        <li class="{{ Request::is('playlist/getWall') ? 'active' : '' }}">
            <a href='{{url('/playlist/getWall')}}'>Home</a>
        </li>
        <li class="{{ Request::is('stats') ? 'active' : '' }}">
            <a href='{{url('stats')}}'>Statistics</a>
        </li>
        <li class="{{ Request::is('playlist/advanced-search') ? 'active' : '' }}">
            <a href='{{url('playlist/advanced-search')}}'>Advanced Search</a>
        </li>
        
        <li class="{{ Request::is('playlist/getLibrary') ? 'active' : '' }}">
            <a href='{{url('/playlist/getLibrary')}}'>My Library</a>
        </li>
        <li class="{{ Request::is('users/me') ? 'active' : '' }}">
            <a href='{{url('users/me')}}'>My Profile</a>
        </li>
<!--        <li class="{{ Request::is('people') ? 'active' : '' }}">
            <a href='{{url('people')}}'>People</a>
        </li>
        <li class="{{ Request::is('playlist/tags')||Request::is('playlist/tags/*') ? 'active' : '' }}">
            <a href='{{url('playlist/tags')}}'>Tags</a>
        </li>
        <li class="{{ Request::is('playlist/advanced-search') ? 'active' : '' }}">
            <a href='{{url('playlist/advanced-search')}}'>Advanced Search</a>
        </li>
        <li class="{{ Request::is('stats') ? 'active' : '' }}">
            <a href='{{url('stats')}}'>Statistics</a>
        </li>-->
         <!-- <li class="{{ Request::is('playlist/getAll') ? 'active' : '' }}">
            <a href='{{url('/playlist/getAll')}}'>My Public Playlists</a>
        </li>
        <li class="{{ Request::is('playlist/getTaggedWall') ? 'active' : '' }}">
            <a href='{{url('playlist/getTaggedWall')}}'>Tagged Playlists</a>
            <div class="notifaction">
                <span id = "tagged_span_count">{{session::get('Tagged')}}</span>
            </div>
        </li> -->
       

    </ul>
</div>

<script>
    
    getRecords();
    
    function getRecords() {
              $.ajax({
                  type: "get",
                  url: "{{ url('/deduct')}}",
                  success: function (data) {
                     
                     //console.log(data);
                     $("#tagged_span_count").html(data);
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {

                  }
              });
      }
    
  </script>