<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ficon bx bx-menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name">{{ auth()->user()->name }}</span><span class="user-status text-muted">Available</span></div><span><img class="round" src="{{ asset(auth()->user()->image) }}" alt="avatar" onerror="this.onerror=null;this.src='{{ URL::asset('app-assets/images/profile/user-uploads/error.jpg') }}';" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pb-0">
                            <a class="dropdown-item" href=""><i class="bx bx-user mr-50"></i> Edit Profile</a>
                            <a class="dropdown-item" href=""><i class="bx bx-abacus mr-50"></i> Change password</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="bx bx-power-off mr-50"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
