<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        <div>
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <span class="menu-icon">
                        <i class="mdi mdi-poll text-warning"></i>
                    </span>
                    <span class="menu-title txt-light">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/partners">
                    <span class="menu-icon">
                        <i class="mdi mdi-account-multiple txt-light"></i>
                    </span>
                    <span class="menu-title txt-light">Partners</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/departments">
                    <span class="menu-icon">
                        <i class="mdi mdi-buffer txt-light"></i>
                    </span>
                    <span class="menu-title txt-light">Departments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/configurations">
                    <span class="menu-icon">
                        <i class="mdi mdi-wrench txt-light"></i>
                    </span>
                    <span class="menu-title txt-light">Configurations</span>
                </a>
            </li>

        </div>
        <div>
            <li class="nav-item">
                <a class="nav-link" href="/profile/{{ Auth::user()->id }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-account txt-light"></i>
                    </span>
                    <span class="menu-title txt-light">My profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/settings">
                    <span class="menu-icon">
                        <i class="mdi mdi-settings txt-light"></i>
                    </span>
                    <span class="menu-title txt-light">Settings</span>
                </a>
            </li>
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
        </div>

    </ul>


</nav>
