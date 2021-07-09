
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        @if(getMenu())
        @foreach(getMenu() as $m)
          @php
            $url = config('app.adminPath').'/'.$m->module_path;
            $url = (strpos($url,'#')!==FALSE)?'#':$url;
            $active = (Request::is($url.'*'))?"active":"";
            $isTreeview = (count($m->child))?"treeview":"";
            if(getPermission($m->module_path,'can_view')==false) continue;
          @endphp
          <li class="{{$isTreeview}} {{$active}}">
            <a href="{{url($url)}}"><i class="{{$m->icon}}"></i> {{$m->nama}}
              @if(count($m->child))
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              @endif
            </a>
            @if(count($m->child) > 0)
              <ul class="treeview-menu">
                @foreach($m->child as $c)
                  @php
                    $url = config('app.adminPath').'/'.$c->module_path;
                    $url = (strpos($url,'#')!==FALSE)?'#':$url;
                    $active = (Request::is($url.'*'))?"active":"";
                    $isTreeview = (count($c->child))?"treeview":"";
                    if(getPermission($c->module_path,'can_view',getRoleId())==false) continue;
                  @endphp
                  <li class="{{$isTreeview}} {{$active}}">
                    <a href="{{url($url)}}"><i class="{{$c->icon}}"></i> {{$c->nama}}
                      @if(count($c->child))
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      @endif
                    </a>
                    @if(count($c->child))
                      <ul class="treeview-menu">
                        @foreach($c->child as $cc)
                        @php
                          $url = config('app.adminPath').'/'.$cc->module_path;
                          $url = (strpos($url,'#')!==FALSE)?'#':$url;
                          $active = (Request::is($url.'*'))?"active":"";
                          @$isTreeview = (count($cc->child))?"treeview":"";
                          if(getPermission($cc->module_path,'can_view')==false) continue;
                        @endphp
                        <li class="{{$isTreeview}} {{$active}}">
                          <a href="{{url($url)}}"><i class="{{$cc->icon}}"></i> {{$cc->nama}}</a>
                        </li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
                @endforeach
              </ul>
            @endif
          </li>
        @endforeach
        @endif
          
        @if(getRole() == 'SUPERADMIN')
        @php
          echo createSubMenu("fa fa-wrench","Pengaturan",[
            ['path'=>'setting','label'=>'Dasar', 'icons' => 'fa fa-linux'],
            ['path'=>'menu','label'=>'Menu', 'icons' => 'fa fa-list-alt'],
            ['path'=>'kalendar-libur','label'=>'Kalender', 'icons' => 'fa fa-calendar']
          ]);
        @endphp
        @endif

      </ul>
      <!-- /.sidebar-menu-->

      @push('scripts')
          <script type="text/javascript">
          $(function() {
            $('.treeview-menu .active').parents('li').addClass('active');
          })
          </script>
      @endpush
