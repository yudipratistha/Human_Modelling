    @yield('sidebar')    
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{url('/assets/images/dashboard/1.png')}}" alt="">
            <!-- <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="user-profile.html"> -->
              <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6></a>
            <p class="mb-0 font-roboto">{{ Auth::user()->email }}</p>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Menu             </h6>
                    </div>
                  </li>
                  @if (Auth::user()->is_admin == 0)
                  
                    <!-- <li class="dropdown"><a class="nav-link menu-title link-nav" href="{{route('admin.home')}}"><i data-feather="home"></i><span>Dashboard</span></a></li> -->
                    <li class="dropdown "><a class="nav-link menu-title link-nav {{ isset($activeMenu) ? 'active' : '' }}" href="{{route('admin.ticketsList.index')}}"><i class="icon-ticket" style="margin-right: 15px;vertical-align: bottom;float: none;margin-left: -3px;font-size: 21px;"></i><span>Tickets</span></a></li>
                    <!-- <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Data</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="{{ route('admin.processingData.index') }}">Processing CSV Data</a></li>
                      <li><a href="{{route('admin.ticketsList.index')}}">Tickets</a></li>
                    </ul>
                  </li>-->
                  @elseif (Auth::user()->is_admin == 1)
                    <li class="dropdown "><a class="nav-link menu-title link-nav {{ isset($activeMenu) ? 'active' : '' }}" href="{{route('user.ticketsList.index')}}"><i class="icon-ticket" style="margin-right: 15px;vertical-align: bottom;float: none;margin-left: -3px;font-size: 21px;"></i><span>Tickets</span></a></li>
                  @elseif (Auth::user()->is_admin == 2)
                    <li class="dropdown "><a class="nav-link menu-title link-nav {{ isset($activeMenu) ? 'active' : '' }}" href="{{route('nioshCalculationSingleTask.index')}}"><i class="icofont icofont-calculations" style="margin-right: 15px;vertical-align: bottom;float: none;margin-left: -3px;font-size: 21px;"></i><span>NIOSH Single Task</span></a></li>
                    <li class="dropdown "><a class="nav-link menu-title link-nav {{ isset($activeMenu) ? 'active' : '' }}" href="{{route('nioshCalculationMultiTask.index')}}"><i class="icofont icofont-calculations" style="margin-right: 15px;vertical-align: bottom;float: none;margin-left: -3px;font-size: 21px;"></i><span>NIOSH Multi Task</span></a></li>
                    @endif
                  
                  
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>
        <!-- Page Sidebar Ends-->