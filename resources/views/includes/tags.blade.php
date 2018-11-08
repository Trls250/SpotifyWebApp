            <div id = 'advanced' class="rangesliders">
              <div class="content-container">
                <div class="range-row clearfix">
                  <ul class="tags-lists">
                    @foreach($Tags as $key => $tag)
                    <li>
                      <a href="{{url('playlist/tags').'/'.$key}}">
                        {{$tag}}
                      </a>
                    </li>
                    @endforeach
                  </ul>

                </div>
              </div>
            </div>
            
