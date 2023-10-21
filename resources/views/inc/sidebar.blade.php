<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        @if (auth()->check() && auth()->user()->isAdmin() || auth()->user()->user_role_id == 2 || auth()->user()->user_role_id == 3)
        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                <span class="menu-icon">
                    <i class="mdi mdi-poll"></i>
                </span>
                <span class="menu-title txt-light">Dashboard</span>
            </a>
        </li>
        @endif

        {{-- @if (auth()->check() &&  auth()->user()->user_role_id == 3)
        <!-- Partners -->
        <li style="margin-top: -10px" class="nav-item">
            <a class="nav-link {{ Request::is('partners') ? 'active' : '' }}" href="/partners">
                <span class="menu-icon">
                    <i class="mdi mdi-poll"></i>
                </span>
                <span class="menu-title txt-light">Dashboard</span>
            </a>
        </li>

        @endif --}}

        @if (auth()->check() && (auth()->user()->isAdmin()  || auth()->user()->user_role_id == 2))
        <!-- Partners -->
        <li style="margin-top: -10px" class="nav-item">
            <a class="nav-link {{ Request::is('partners') ? 'active' : '' }}" href="/partners">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title txt-light">Partners</span>
            </a>
        </li>

        @endif

        <!-- Departments - Admin Only -->
        @if (auth()->check() && auth()->user()->isAdmin())
            <li style="margin-top: -10px" class="nav-item">
                <a class="nav-link {{ Request::is('departments') ? 'active' : '' }}" href="/departments">
                    <span class="menu-icon">
                        <i class="mdi mdi-buffer"></i>
                    </span>
                    <span class="menu-title txt-light">Departments</span>
                </a>
            </li>
        @endif

        <!-- Configurations - Admin Only -->
        @if (auth()->check() && auth()->user()->isAdmin())
            <li style="margin-top: -10px" class="nav-item">
                <a class="nav-link {{ Request::is('configurations') ? 'active' : '' }}" href="/configurations">
                    <span class="menu-icon">
                        <i class="mdi mdi-wrench"></i>
                    </span>
                    <span class="menu-title txt-light">Configurations</span>
                </a>
            </li>
        @endif

        <!-- My Profile -->
        @if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->user_role_id == 3  || auth()->user()->user_role_id == 2))
        <li style="margin-top: -10px" class="nav-item">
            <a class="nav-link {{ Request::is('profile/*') ? 'active' : '' }}" href="/profile/{{ Auth::user()->id }}">
                <span class="menu-icon">
                    <i class="mdi mdi-account"></i>
                </span>
                <span class="menu-title txt-light">My Profile</span>
            </a>
        </li>
        @endif

        <!-- Settings -->
        @if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->user_role_id == 3 || auth()->user()->user_role_id == 2))
        <li style="margin-top: -10px" class="nav-item">
            <a class="nav-link {{ Request::is('settings') ? 'active' : '' }}" href="/settings">
                <span class="menu-icon">
                    <i class="mdi mdi-settings"></i>
                </span>
                <span class="menu-title txt-light">Settings</span>
            </a>
        </li>
        @endif

        <!-- User Info and Logout -->
        <li class="auth-items">
            <div class="d-flex">
                <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image" width="40rem"
                    height="40rem" style="border-radius: 50%" />
                <div class="ml-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <p class="menu-title text-light mb-0">{{ Auth::user()->name }}</p>
                            <p class="menu-title text-light mt-0">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-transparent">
                                <a href="">
                                    <i class="mdi mdi-exit-to-app text-light"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
@push('scripts')
<script>
  $(document).ready(function() {
    $('.nav-item .nav-link').each(function() {
      if ($(this).attr('href') === window.location.pathname) {
        $(this).addClass('active');
      }
    });
  });
</script>
@endpush
