<aside class="sidebar-wrapper">
    <div class="sidebar-header">
      <div class="logo-icon">
        <img src="{{asset('/images/logo.png')}}" class="logo-img" alt="">
      </div>
      <div class="logo-name flex-grow-1">
        <h5 class="mb-0">Dream Car Rent
      </div>
      <div class="sidebar-close">
        <span class="material-icons-outlined">close</span>
      </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
      
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
          <li>
            <a href="{{ url('/home') }}">
              <div class="parent-icon"><i class="fas fa-laptop fa-lg"></i>
              </div>
              <div class="menu-title">Dashboard</div>
            </a>
          </li>
            @if(auth()->user()->can('view_user')
            || auth()->user()->can('view_role')
            || auth()->user()->can('view_permission'))
          <li id="UserAccount">
            <a href="{{ url('/users') }}">
              <div class="parent-icon"><i class="fas fa-user-cog fa-lg"></i>
              </div>
              <div class="menu-title">User Account</div>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('view_brand')
            || auth()->user()->can('view_model')
            || auth()->user()->can('view_vehicle'))
          <li id="Vehicle">
            <a href="{{ url('/brand') }}">
              <div class="parent-icon"><i class="fas fa-car fa-lg"></i>
              </div>
              <div class="menu-title">&nbsp;Vehicle</div>
            </a>
          </li>
          @endif


         @if(auth()->user()->can('view_booking'))
          <li id="Booking">
            <a href="{{ url('/booking') }}">
              <div class="parent-icon">
                <i class="fas fa-solid fa-book"></i>
                <i class="fa-solid fa-book"></i>
              </div>
              <div class="menu-title">Booking</div>
            </a>
          </li>
          @endif

         </ul>
    </div>
    <div class="sidebar-bottom gap-4">
        <div class="dark-mode">
          <a href="javascript:;" class="footer-icon dark-mode-icon">
            <i class="material-icons-outlined">dark_mode</i>  
          </a>
        </div>
    </div>
</aside>