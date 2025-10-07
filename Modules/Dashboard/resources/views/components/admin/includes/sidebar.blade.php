<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <div class="dropdown user-pro-body text-center">
      <div class="user-info">
        <span class="text-light fs-14">پنل مدیریت</span>
      </div>
    </div>
  </div>
  <div class="app-sidebar3 mt-0">
    <ul class="side-menu">
      @foreach (config('admin-menu') as $parentMenu)
        @isset ($parentMenu['children'])
          <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
              <i class="{{ $parentMenu['icon'] }} sidemenu_icon"></i>
              <span class="side-menu__label">{{ $parentMenu['title'] }}</span>
              <i class="angle fa fa-angle-left"></i>
            </a>
            <ul class="slide-menu">
              @foreach ($parentMenu['children'] as $childMenu)
                <li>
                  <a href="{{ route($childMenu['route']) }}" class="slide-item">
                    <span>{{ $childMenu['title'] }}</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @else
          <li class="slide">
            <a class="side-menu__item" href="{{ route($parentMenu['route']) }}">
              <i class="{{ $parentMenu['icon'] }} sidemenu_icon"></i>
              <span class="side-menu__label">{{ $parentMenu['title'] }}</span>
            </a>
          </li>
        @endisset
      @endforeach
      <li class="slide">
        <!-- Logout Menu Item -->
        <a href="#" class="side-menu__item"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fe fe-log-out sidemenu_icon"></i>
          <span class="side-menu__label">خروج از حساب</span>
        </a>
        <!-- Hidden Logout Form -->
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
  </div>
</aside>