<div class="app-header header">
  <div class="container-fluid">
    <div class="d-flex">
      <div class="app-sidebar__toggle" data-toggle="sidebar">
        <a class="open-toggle" href="#">
          <i class="feather feather-menu"></i>
        </a>
        <a class="close-toggle" href="#">
          <i class="feather feather-x"></i>
        </a>
      </div>
      <div class="d-flex order-lg-2 my-auto mr-auto">
          {{-- <div>
            <form action="{{route('admin.optimizeClear')}}" method="post">
              @csrf
              <button
                  id="optimizeClearButton"
                  type="submit"
                  class="nav-link icon border-0"
                  data-toggle="tooltip"
                  data-original-title="پاکسازی کش">
                  <i class="feather feather-cloud-off header-icon"></i>
              </button>
            </form>
          </div> --}}
        {{-- <div>
          <a
            href="{{ $shopUrl }}"
            target="_blank"
            class="nav-link icon border-0"
            data-toggle="tooltip"
            data-original-title="سایت">
            <i class="feather feather-home header-icon"></i>
          </a>
        </div> --}}
        <div class="dropdown header-fullscreen">
          <a class="nav-link icon full-screen-link">
            <i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
            <i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
          </a>
        </div>
        {{-- <div>
          <a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
            <i class="feather feather-bell header-icon"></i>
          </a>
        </div> --}}
        <div>
          <button
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            class="nav-link icon border-0"
            data-toggle="tooltip"
            data-original-title="خروج">
            <i class="feather feather-log-out header-icon"></i>
          </button>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
